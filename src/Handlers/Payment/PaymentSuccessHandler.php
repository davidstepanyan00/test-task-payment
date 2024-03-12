<?php

namespace App\Handlers\Payment;

use App\Enums\Money\MoneyEnum;
use App\Enums\PaymentMethod\PaymentMethodEnum;
use App\Notifications\Payment\SendSuccessPaymentNotification;

class PaymentSuccessHandler
{
    public function __construct(private readonly array $data)
    {
    }

    public function handle(): void
    {
        $sendSuccessNotification = $this->data['type'] === PaymentMethodEnum::QIWI->value ||
            ($this->data['type'] === PaymentMethodEnum::CARD->value && $this->data['currency'] === MoneyEnum::EUR);

        if ($sendSuccessNotification) {
            (new SendSuccessPaymentNotification())->handle();
        }
    }
}