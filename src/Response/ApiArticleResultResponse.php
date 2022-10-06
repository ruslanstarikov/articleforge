<?php
declare(strict_types=1);
namespace Ruslanstarikov\Articleforge\Response;

class ApiArticleResultResponse
{
    /** @var string|null */
    private $article, $status, $errorMessage;

    /** @var int|null */
    private $articleId;

    public function __construct(array $response)
    {
        $this->setArticle($response['article'] ?? null);
        $this->setArticleId($response['article_id'] ?? null);
        $this->setStatus($response['status']);
        $this->setErrorMessage($response['error_message'] ?? null);
    }

    public function toArray()
    {
        return [
            'article' => $this->getArticle(),
            'articleId'=> $this->getArticleId(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
    }

    /**
     * @return string|null
     */
    public function getArticle(): ?string
    {
        return $this->article;
    }

    /**
     * @param string|null $article
     */
    public function setArticle(?string $article): void
    {
        $this->article = $article;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
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

    /**
     * @return int|null
     */
    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    /**
     * @param int|null $articleId
     */
    public function setArticleId(?int $articleId): void
    {
        $this->articleId = $articleId;
    }
}