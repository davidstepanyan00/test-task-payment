<?php

namespace App\Services\Payments;

use App\Entities\Payment;
use App\Exceptions\Bank\ErrorConnectingToBankException;
use App\Factories\Bank\BankFactory;
use Throwable;

class ChargePaymentService
{
    /**
     * @throws ErrorConnectingToBankException
     */
    public function handle(Payment $payment): \App\Banks\Responses\Payment
    {
        try {
            $bank = BankFactory::createBank($payment->getBank());

            return $bank->createPayment($payment->getAmount(), $payment->getPaymentMethod());
        } catch (Throwable $e) {
            throw new ErrorConnectingToBankException();
        }
    }
}