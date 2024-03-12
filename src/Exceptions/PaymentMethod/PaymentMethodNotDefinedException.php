<?php

namespace App\Exceptions\PaymentMethod;

use App\Exceptions\BusinessLogicException;

class PaymentMethodNotDefinedException extends BusinessLogicException
{
    protected $code = self::PAYMENT_METHOD_NOT_DEFINED;
    protected $message = 'Payment method is not defined.';
}