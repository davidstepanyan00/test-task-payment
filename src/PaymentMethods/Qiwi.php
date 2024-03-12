<?php

namespace App\PaymentMethods;

use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use DateTime;

class Qiwi implements PaymentMethodInterface
{
    public function __construct(
        private readonly string $phoneNumber,
        private readonly DateTime $expiryDate
    ) {
    }

    public function getExpiryDate(): DateTime
    {
        return $this->expiryDate;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}