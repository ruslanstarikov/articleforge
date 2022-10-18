<?php
declare(strict_types=1);

namespace Ruslanstarikov\Articleforge\Response;

class ArticleListResponse
{
    /** @var Article[] */
    private $data;

    /** @var string|null */
    private $status;

    /** @var string|null */
    private $errorMessage;

    /**
     * @param array $response
     * @throws \Exception
     */
    public function __construct(array $response)
    {
        $this->setStatus($response['status']);
        $arrArticles = [];
        $data = $response['data'] ?? null;
        if(!empty($data)) {
            foreach ($data as $itemData) {
                $arrArticles[] = (new Article($itemData));
            }
        }
        $this->setData($arrArticles);
        $this->setErrorMessage($response['error_message'] ?? null);
    }

    public function toArray()
    {
        $articles = $this->getData();
        $arrArticles = [];
        foreach($articles as $article) {
            $arrArticles[] = $article->toArray();
        }
        return [
            'data' => $arrArticles,
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
    }


    /**
     * @return ?Article[]
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param ?Article[] $data
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param string|null $errorMessage
     */
    public function setErrorMessage(?string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}