<?php
declare(strict_types=1);

namespace Ruslanstarikov\Articleforge\Response;

class InitiateArticleResponse
{
    /** @var string */
    private $status, $errorMessage;
    /** @var int */
    private $refKey;

    public function __construct(array $responseArray)
    {
        $this->setRefKey($responseArray['ref_key'] ?? null);
        $this->setStatus($responseArray['status']);
        $this->setErrorMessage($responseArray['error_message'] ?? null);
    }

    public function toArray(): array
    {
        return [
            'refKey' => $this->getRefKey(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
    }

    /**
     * @return int|null
     */
    public function getRefKey(): ?int
    {
        return $this->refKey;
    }

    /**
     * @param int|null $refKey
     */
    public function setRefKey(?int $refKey): void
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