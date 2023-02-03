<?php
declare(strict_types=1);

namespace Ruslanstarikov\Articleforge\Response;

class GetApiProgressResponse
{
    /** @var int  */
    public $apiStatus;
    /** @var float  */
    public $progress;
    /** @var string  */
    public $status, $errorMessage;

    public function __construct(array $response)
    {
        $this->setApiStatus((int)$response['api_status']);
        $this->setProgress((float)$response['progress']);
        $this->setStatus($response['status']);
        $this->setErrorMessage($response['error_message'] ?? null);
    }

    public function toArray()
    {
        return [
            'apiStatus' => $this->getApiStatus(),
            'progress' => $this->getProgress(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
    }

    /**
     * @return int
     */
    public function getApiStatus(): int
    {
        return $this->apiStatus;
    }

    /**
     * @param int $apiStatus
     */
    public function setApiStatus(int $apiStatus): void
    {
        $this->apiStatus = $apiStatus;
    }

    /**
     * @return float
     */
    public function getProgress(): float
    {
        return $this->progress;
    }

    /**
     * @param float $progress
     */
    public function setProgress(float $progress): void
    {
        $this->progress = $progress;
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