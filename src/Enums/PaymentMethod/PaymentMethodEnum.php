<?php

namespace App\Enums\PaymentMethod;

enum PaymentMethodEnum: string
{
  case CARD = 'card';
  case QIWI = 'qiwi';
}