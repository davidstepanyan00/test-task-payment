<?php

use App\Enums\Bank\BankEnum;
use App\Exceptions\Bank\FailedHandlePaymentException;
use App\Factories\Money\MoneyFactory;
use App\Factories\PaymentMethod\PaymentMethodFactory;
use App\Handlers\Payment\PaymentSuccessHandler;
use App\Http\Response;
use App\Services\Commission\CalcCommissionService;
use App\Services\Payments\ChargePaymentService;
use App\Services\Payments\Commands\CreatePaymentCommand;
use App\Services\Payments\CreatePaymentService;

require_once './vendor/autoload.php';

// при оплате qiwi
$requestData = [
    'phone_number' => '+79144556677',
    'expiration_date' => (new \DateTime('2024-03-15 15:00:00')),
    'payment_method' => 'qiwi',
    'currency' => 'rub',
    'amount' => 10000,
    'bank' => 'sberbank',
];

//// при оплате card
//$requestData = [
//    'card_number' => '4242424242424242',
//    'expiration_date' => (new \DateTime('2024-03-15 15:00:00')),
//    'cvc' => 123,
//    'payment_method' => 'card',
//    'currency' => 'rub',
//    'amount' => 100,
//    'bank' => 'sberbank',
//];

try {
    $paymentMethod = PaymentMethodFactory::createPaymentMethod($requestData);

    $amount = MoneyFactory::createMoney($requestData['currency'], $requestData['amount']);

    $commission = MoneyFactory::createMoney($requestData['currency'], (new CalcCommissionService($requestData))->handle());

    $totalAmount = MoneyFactory::createMoney($requestData['currency'], (float) $amount->getAmount() + (float) $commission->getAmount());

    $payment = (new CreatePaymentService())->handle(
        new CreatePaymentCommand($totalAmount, $paymentMethod, BankEnum::from($requestData['bank']), $commission)
    );

    $response = (new ChargePaymentService())->handle($payment);

     if ($response->isFailed()) {
        throw new FailedHandlePaymentException();
     }

    (new PaymentSuccessHandler($requestData))->handle();

     $requestData['commission'] = $commission->getAmount();
     $requestData['pay_amount'] = $totalAmount->getAmount();

    echo Response::getData(array_merge($requestData, ['message' => 'Thank you! Payment completed']));
} catch (Throwable $e) {
    echo Response::getData(['message' => $e->getMessage()], $e->getCode());
}
