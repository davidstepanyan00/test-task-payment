<?php


namespace App\Banks;

use App\Banks\Interfaces\BankInterface;
use App\Banks\Responses\Payment;
use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use Money\Money;

class Sberbank implements BankInterface
{
    public function createPayment(Money $amount, PaymentMethodInterface $paymentMethod): Payment
    {
        return new Payment(Payment::STATUS_COMPLETED);
    }
}