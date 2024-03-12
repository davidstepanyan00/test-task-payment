<?php

namespace App\Exceptions\PaymentMethod;

use App\Exceptions\BusinessLogicException;

class FailedCreatePaymentException extends BusinessLogicException
{
    protected $code = self::FAILED_CREATE_PAYMENT;
    protected $message = 'Failed create payment.';
}