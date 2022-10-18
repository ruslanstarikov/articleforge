<?php

declare(strict_types=1);

namespace Ruslanstarikov\Articleforge\Response;

class DeleteArticleResponse
{
    private string $status;
    private string $errorMessage;

    public function __construct(array $response)
    {
        $this->setStatus($response['status']);
        if(!empty($errorMessage))
            $this->setErrorMessage($response['error_message']);
    }

    public function toArray(): array
    {
        return [
            'status' => $this->getStatus(),
            'errorMessage' => $this->getErrorMessage()
        ];
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
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }


}