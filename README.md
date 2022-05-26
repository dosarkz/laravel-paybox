# Acquiring system for accepting payments [Paybox.Money](https://paybox.money/docs/ru) for Laravel >=7
> List of available functional
- Creating a new payment
- Receiving information about the payment

## Installation 

 - Install the package via composer:
 `composer require dosarkz/laravel-paybox`
 - Publish configuration file:
 `php artisan vendor:publish --tag paybox-config`
 - Set `merchant_id` and `secret_key` in the env file

## Usage
> Env file
```
PAYBOX_GATEWAY_URL=https://api.paybox.money
PAYBOX_MERCHANT_ID=
PAYBOX_SECRET_KEY=
PAYBOX_SALT=your_secret
PAYBOX_CHECK_URL=
PAYBOX_RESULT_URL=

```
> Generate new order
```php
use Dosarkz\Paybox\Facades\Paybox;

class OrdersController extends Controller
{
    public function pay(Order $order)
    {
        ...

        return Paybox::generate([
            'pg_order_id' => '',
            'pg_merchant_id' => '',
            'pg_amount' => 100,
            'pg_description' => "Test",
            'pg_salt' => '',
            'pg_check_url' =>'',
            'pg_result_url' => '',
        ]);
    }
}
```

> Get information about payment
```php
    return Paybox::paymentInfo([
            'pg_merchant_id' => '',
            'pg_payment_id' => '',
            'pg_order_id' => '',
            'pg_salt' => ''
    ]);
```


## License 

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
