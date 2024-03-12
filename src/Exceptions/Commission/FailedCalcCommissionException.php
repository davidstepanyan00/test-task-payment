<?php

namespace App\Exceptions\Commission;

use App\Exceptions\BusinessLogicException;

class FailedCalcCommissionException extends BusinessLogicException
{
    protected $code = self::FAILED_CALC_COMMISSION;
    protected $message = 'Failed calc commission.';
}