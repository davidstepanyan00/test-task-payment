<?php

namespace App\Services\Payments;

use App\Entities\Payment;
use App\Exceptions\PaymentMethod\FailedCreatePaymentException;
use App\Services\Payments\Commands\CreatePaymentCommand;
use Throwable;

class CreatePaymentService
{
    /**
     * @throws FailedCreatePaymentException
     */
    public function handle(CreatePaymentCommand $command): Payment
    {
        try {
            return new Payment($command->getAmount(), $command->getCommission(), $command->getPaymentMethod(), $command->getBank());
        } catch (Throwable $e) {
            throw new FailedCreatePaymentException();
        }
    }
}