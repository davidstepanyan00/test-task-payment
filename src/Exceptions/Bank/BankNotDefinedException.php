<?php

namespace App\Exceptions\Bank;

use App\Exceptions\BusinessLogicException;

class BankNotDefinedException extends BusinessLogicException
{
    protected $code = self::BANK_NOT_DEFINED;
    protected $message = 'Bank not defined.';
}