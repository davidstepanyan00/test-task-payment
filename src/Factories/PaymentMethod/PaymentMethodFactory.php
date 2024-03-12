<?php

namespace App\Factories\PaymentMethod;

use App\Enums\PaymentMethod\PaymentMethodEnum;
use App\Exceptions\PaymentMethod\PaymentMethodNotDefinedException;
use App\PaymentMethods\Card;
use App\PaymentMethods\Interfaces\PaymentMethodInterface;
use App\PaymentMethods\Qiwi;

class PaymentMethodFactory
{
    /**
     * @throws PaymentMethodNotDefinedException
     */
    public static function createPaymentMethod(array $data): PaymentMethodInterface
    {
        return match($data['payment_method']) {
            PaymentMethodEnum::QIWI->value => new Qiwi($data['phone_number'], $data['expiration_date']),
            PaymentMethodEnum::CARD->value => new Card($data['card_number'], $data['expiration_date'], $data['cvc']),
            default => throw new PaymentMethodNotDefinedException(),
        };
    }
}