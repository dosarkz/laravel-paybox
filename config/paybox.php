<?php

return [
    'merchant_id' => env('PAYBOX_MERCHANT_ID'),
    'secret_key' => env('PAYBOX_SECRET_KEY'),
    'routes' => [
        'payments' => env('PAYBOX_GATEWAY_URL', 'https://api.paybox.money/v4/payments'),
    ],
    'currency' => env('PAYBOX_CURRENCY', 'KZT')
];
