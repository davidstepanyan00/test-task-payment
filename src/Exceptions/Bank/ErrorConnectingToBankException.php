<?php

namespace App\Exceptions\Bank;

use App\Exceptions\BusinessLogicException;

class ErrorConnectingToBankException extends BusinessLogicException
{
    protected $code = self::ERROR_CONNECTING_TO_BANK;
    protected $message = 'Error connecting to bank.';
}