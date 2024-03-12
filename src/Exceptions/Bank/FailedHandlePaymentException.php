<?php

namespace App\Exceptions\Bank;

use App\Exceptions\BusinessLogicException;

class FailedHandlePaymentException extends BusinessLogicException
{
    protected $code = self::FAILED_HANDLE_PAYMENT;
    protected $message = 'Failed handle payment! Try again.';
}