<?php

namespace Ruslanstarikov\Articleforge\Response;

class CheckUsageResponse
{
    /** @var string|null */
    private $status, $monthlyWordsRemaining, $errorMessage;
    /** @var int|null  */
    private $apiRequests, $prepaidWordsAvailable;
    /** @var bool|null */
    private $overuseProtection;
    /** @var float|null */
    private $prepaidAmount, $overageUsageCharge;

    public function __construct(array $response)
    {
        $this->setStatus($response['status']);
        $apiRequests = $response['API Requests'] ?? null;
        $monthlyWordsRemaining = $response['Monthly Words Remaining'] ?? null;
        $overUseProtection = $response['Overuse Protection'] ?? null === 'YES';
        $prepaidAmount = $response['Prepaid Amount'] ?? null;
        $prepaidWordsAvailable = $response['Prepaid Words Available'] ?? null;
        $overageUsageCharge = $response['Overage Usage Charge'] ?? null;

        $this->setApiRequests((int)$apiRequests);
        $this->setMonthlyWordsRemaining((int)$monthlyWordsRemaining);
        $this->setOveruseProtection($overUseProtection);
        $this->setPrepaidAmount((float)$prepaidAmount);
        $this->setPrepaidWordsAvailable((int)$prepaidWordsAvailable);
        $this->setOverageUsageCharge((float)$overageUsageCharge);
    }

    public function toArray(): array
    {
        return [
            'status' => $this->getStatus(),
            'apiRequests' => $this->getApiRequests(),
            'monthlyWordsRemaining' => $this->getMonthlyWordsRemaining(),
            'overuseProtection' => $this->getOveruseProtection(),
            'prepaidAmount' => $this->getPrepaidAmount(),
            'prepaidWordsAvailable' => $this->getPrepaidWordsAvailable(),
            'overageUsageCharge' => $this->getOverageUsageCharge(),
            'error' => $this->getErrorMessage()
        ];
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
    public function getMonthlyWordsRemaining(): ?string
    {
        return $this->monthlyWordsRemaining;
    }

    /**
     * @param string|null $monthlyWordsRemaining
     */
    public function setMonthlyWordsRemaining(?string $monthlyWordsRemaining): void
    {
        $this->monthlyWordsRemaining = $monthlyWordsRemaining;
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
    public function getApiRequests(): ?int
    {
        return $this->apiRequests;
    }

    /**
     * @param int|null $apiRequests
     */
    public function setApiRequests(?int $apiRequests): void
    {
        $this->apiRequests = $apiRequests;
    }

    /**
     * @return int|null
     */
    public function getPrepaidWordsAvailable(): ?int
    {
        return $this->prepaidWordsAvailable;
    }

    /**
     * @param int|null $prepaidWordsAvailable
     */
    public function setPrepaidWordsAvailable(?int $prepaidWordsAvailable): void
    {
        $this->prepaidWordsAvailable = $prepaidWordsAvailable;
    }

    /**
     * @return bool|null
     */
    public function getOveruseProtection(): ?bool
    {
        return $this->overuseProtection;
    }

    /**
     * @param bool|null $overuseProtection
     */
    public function setOveruseProtection(?bool $overuseProtection): void
    {
        $this->overuseProtection = $overuseProtection;
    }

    /**
     * @return float|null
     */
    public function getPrepaidAmount(): ?float
    {
        return $this->prepaidAmount;
    }

    /**
     * @param float|null $prepaidAmount
     */
    public function setPrepaidAmount(?float $prepaidAmount): void
    {
        $this->prepaidAmount = $prepaidAmount;
    }

    /**
     * @return float|null
     */
    public function getOverageUsageCharge(): ?float
    {
        return $this->overageUsageCharge;
    }

    /**
     * @param float|null $overageUsageCharge
     */
    public function setOverageUsageCharge(?float $overageUsageCharge): void
    {
        $this->overageUsageCharge = $overageUsageCharge;
    }

}