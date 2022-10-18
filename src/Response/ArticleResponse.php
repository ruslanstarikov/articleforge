<?php
declare(strict_types=1);

namespace Ruslanstarikov\Articleforge\Response;

class ArticleResponse
{
    /** @var string */
    private $data, $status;

    public function __construct(array $response)
    {
        $this->setData($response['data']);
        $this->setStatus($response['status']);
    }

    public function toArray()
    {
        return [
            'data' => $this->getData(),
            'status' => $this->getStatus()
        ];
    }
    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
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


}