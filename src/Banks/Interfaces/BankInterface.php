<?php

namespace App\Banks\Interfaces;

use App\Banks\Responses\Payment;
use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use Money\Money;

interface BankInterface
{
    public function createPayment(Money $amount, PaymentMethodInterface $paymentMethod): Payment;
}