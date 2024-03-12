<?php


namespace App\Entities;

use App\Enums\Bank\BankEnum;
use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use DateTime;
use Money\Money;

class Payment
{
    private DateTime $createdAt;

    public function __construct(
        private readonly Money $amount,
        private readonly Money $commission,
        private readonly PaymentMethodInterface $paymentMethod,
        private readonly BankEnum $bank,
    ) {
        $this->createdAt = new DateTime();
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCommission(): Money
    {
        return $this->commission;
    }

    public function getPaymentMethod(): PaymentMethodInterface
    {
        return $this->paymentMethod;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getNetAmount(): Money
    {
        return $this->amount->subtract($this->commission);
    }

    public function getBank(): BankEnum
    {
        return $this->bank;
    }

}