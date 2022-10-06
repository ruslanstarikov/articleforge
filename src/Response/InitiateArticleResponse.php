<?php

namespace Ruslanstarikov\Articleforge\Response;

class InitiateArticleResponse
{
    /** @var string */
    private $refKey, $status, $errorMessage;

    public function __construct(array $responseArray)
    {
        $this->setRefKey($responseArray['ref_key'] ?? null);
        $this->setStatus($responseArray['status']);
        $this->setErrorMessage($responseArray['error_message'] ?? null);
    }

    public function toArray(): array
    {
        return [
            'ref_key' => $this->getRefKey(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
    }

    /**
     * @return null|string
     */
    public function getRefKey(): ?string
    {
        return $this->refKey;
    }

    /**
     * @param string|null $refKey
     */
    public function setRefKey(?string $refKey): void
    {
        $this->refKey = $refKey;
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
     * @return string
     */
    public function getErrorMessage(): string
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