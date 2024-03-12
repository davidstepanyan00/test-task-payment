<?php

namespace App\Exceptions\Money;

use App\Exceptions\BusinessLogicException;

class MoneyNotDefinedException extends BusinessLogicException
{
    protected $code = self::MONEY_NOT_DEFINED;
    protected $message = 'Money not defined.';
}