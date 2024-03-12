<?php

namespace App\Factories\Bank;

use App\Banks\Interfaces\BankInterface;
use App\Banks\Sberbank;
use App\Banks\Tinkoff;
use App\Enums\Bank\BankEnum;
use App\Exceptions\Bank\BankNotDefinedException;

class BankFactory
{
    /**
     * @throws BankNotDefinedException
     */
    public static function createBank(BankEnum $bank): BankInterface
    {
        return match ($bank->value) {
            BankEnum::SBERBANK->value => new Sberbank(),
            BankEnum::TINKOFF->value => new Tinkoff(),
            default => throw new BankNotDefinedException(),
        };
    }
}