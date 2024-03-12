<?php

namespace App\Services\Commission;

use App\Enums\Bank\BankEnum;
use App\Enums\Money\MoneyEnum;
use App\Enums\PaymentMethod\PaymentMethodEnum;
use App\Exceptions\Commission\FailedCalcCommissionException;

class CalcCommissionService
{
    public function __construct(private readonly array $data)
    {

    }

    /**
     * @throws FailedCalcCommissionException
     */
    public function handle(): float
    {
        $commission = $this->findCommissionRule();
        $amount = $this->data['amount'];

        if (!$commission) {
            throw new FailedCalcCommissionException();
        }

        return $this->calculateCommission(
            $amount,
            $commission['fee_percent'],
            $commission['fee_fix'],
            $commission['fee_min']
        );
    }

    private function calculateCommission(
        float $amount,
        float $feePercent,
        ?float $feeFix,
        ?float $feeMin
    ): float {
        $commission = round($amount * $feePercent /100 + $feeFix, 2);
        if ($commission < $feeMin) {
            $commission = $feeMin;
        }

        return $commission;
    }

    private function findCommissionRule(): ?array
    {
        $commissions = $this->getCommissionsData();

        foreach ($commissions as $rule) {
            if ($this->matchesRule($rule)) {
                return $rule;
            }
        }

        return null;
    }

    private function matchesRule(array $rule): bool
    {
        if ($this->data['bank'] !== $rule['bank'] ||
            $this->data['payment_method'] !== $rule['payment_method'] ||
            $this->data['currency'] !== $rule['currency']) {
            return false;
        }


         if (isset($rule['min_amount']) && $this->data['amount'] < $rule['min_amount']) {
             return false;
         }

         if (isset($rule['max_amount']) && $this->data['amount'] > $rule['max_amount']) {
             return false;
         }

        return true;
    }


    public function getCommissionsData(): array
    {
        return [
            [
                'bank' => BankEnum::SBERBANK->value,
                'payment_method' => PaymentMethodEnum::CARD->value,
                'currency' => MoneyEnum::RUB->value,
                'min_amount' => 1,
                'max_amount' => 1000,
                'fee_percent' => 4,
                'fee_fix' => 1,
                'fee_min' => 3,
            ],
            [
                'bank' => BankEnum::SBERBANK->value,
                'payment_method' => PaymentMethodEnum::CARD->value,
                'currency' => MoneyEnum::RUB->value,
                'min_amount' => 1000,
                'max_amount' => 10000,
                'fee_percent' => 3,
                'fee_fix' => 1,
                'fee_min' => 3,
            ],
            [
                'bank' => BankEnum::SBERBANK->value,
                'payment_method' => PaymentMethodEnum::CARD->value,
                'currency' => MoneyEnum::EUR->value,
                'min_amount' => 1,
                'max_amount' => 10000,
                'fee_percent' => 7,
                'fee_fix' => 1,
                'fee_min' => 4,
            ],
            [
                'bank' => BankEnum::SBERBANK->value,
                'payment_method' => PaymentMethodEnum::QIWI->value,
                'currency' => MoneyEnum::RUB->value,
                'min_amount' => 1,
                'max_amount' => 75000,
                'fee_percent' => 5,
                'fee_fix' => 0,
                'fee_min' => 3,
            ],
            [
                'bank' => BankEnum::TINKOFF->value,
                'payment_method' => PaymentMethodEnum::CARD->value,
                'currency' => MoneyEnum::RUB->value,
                'min_amount' => 15000,
                'max_amount' => null,
                'fee_percent' => 2.5,
                'fee_fix' => null,
                'fee_min' => null,
            ]
        ];
    }
}