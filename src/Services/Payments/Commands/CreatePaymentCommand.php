<?php


namespace App\Services\Payments\Commands;

use App\Enums\Bank\BankEnum;
use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use Money\Money;

class CreatePaymentCommand
{
    public function __construct(
        private readonly Money $amount,
        private readonly PaymentMethodInterface $paymentMethod,
        private readonly BankEnum $bank,
        private readonly Money $commission,
    ) {
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getPaymentMethod(): PaymentMethodInterface
    {
        return $this->paymentMethod;
    }

    public function getBank(): BankEnum
    {
        return $this->bank;
    }

    public function getCommission(): Money
    {
        return $this->commission;
    }
}