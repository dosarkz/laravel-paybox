<?php

return [
    'merchant_id' => env('PAYBOX_MERCHANT_ID'),
    'secret_key' => env('PAYBOX_SECRET_KEY'),
    'routes' => [
        'payments' => env('PAYBOX_GATEWAY_URL', 'https://api.paybox.money/v4/payments'),
    ],
    'currency' => env('PAYBOX_CURRENCY', 'KZT'),
    'check_url' => env('PAYBOX_CHECK_URL', null),
    'cancel_url' => env('PAYBOX_CANCEL_URL', null),
    'result_url' => env('PAYBOX_RESULT_URL', null),
    'success_url' => env('PAYBOX_SUCCESS_URL', null),
    'failure_url' => env('PAYBOX_FAILURE_URL', null),
    'back_url' => env('PAYBOX_BACK_URL', null),
];
