<?php

return [
    'merchant_id' => env('PAYBOX_MERCHANT_ID'),
    'secret_key' => env('PAYBOX_SECRET_KEY'),
    'url' => env('PAYBOX_GATEWAY_URL', 'https://api.paybox.money'),
    'routes' => [
        'init_payment' => 'init_payment.php',
        'status_payment' => 'get_status2.php',
    ],
    'currency' => env('PAYBOX_CURRENCY', 'KZT')
];
