<?php

namespace App\PaymentMethods;

use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use DateTime;

class Card implements PaymentMethodInterface
{
    public function __construct(
        private readonly string $pan,
        private readonly DateTime $expiryDate,
        private readonly int $cvc
    ) {
    }

    public function getPan(): string
    {
        return $this->pan;
    }

    public function getExpiryDate(): DateTime
    {
        return $this->expiryDate;
    }

    public function getCvc(): int
    {
        return $this->cvc;
    }
}