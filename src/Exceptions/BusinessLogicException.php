<?php

namespace App\Exceptions;

use Exception;

abstract class BusinessLogicException extends Exception
{
    public const PAYMENT_METHOD_NOT_DEFINED = 600;
    public const MONEY_NOT_DEFINED = 601;
    public const FAILED_CREATE_PAYMENT = 602;
    public const ERROR_CONNECTING_TO_BANK = 603;
    public const FAILED_HANDLE_PAYMENT = 604;
    public const FAILED_CALC_COMMISSION = 605;
    public const BANK_NOT_DEFINED = 606;
}