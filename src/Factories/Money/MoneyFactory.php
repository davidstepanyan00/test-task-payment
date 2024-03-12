<?php

namespace App\Factories\Money;

use App\Enums\Money\MoneyEnum;
use App\Exceptions\Money\MoneyNotDefinedException;
use Money\Money;

class MoneyFactory
{
    /**
     * @throws MoneyNotDefinedException
     */
    public static function createMoney(string $currency, float $amount): Money
    {
        return match ($currency) {
            MoneyEnum::EUR->value => Money::EUR($amount),
            MoneyEnum::RUB->value => Money::RUB($amount),
            MoneyEnum::USD->value => Money::USD($amount),
            default => throw new MoneyNotDefinedException(),
        };
    }
}