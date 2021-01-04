# Acquiring system for accepting payments [Paybox.Money 4.0.0](https://paybox.money/docs/ru/pay-in/4.0)
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
PAYBOX_MERCHANT_ID=
PAYBOX_SECRET_KEY=
PAYBOX_SUCCESS_URL=

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
            "x_idempotency_key" => 'UUID of order', // required
            'order' => "my-super",
            'amount' =>  20, // required
            "refund_amount" => 0,
            "currency" => "KZT", // required
            "description" =>"Description", // required
            "payment_system"=> "string",
            "cleared" => true,
            "expires_at" => "Date", // required
            "language" => "ru",
            "param1" => "string",
            "param2" => "string",
            "param3" => "string",
            "options" => [
               "callbacks" => [
                    "result_url" => "string",
                    "check_url" => "string",
                    "cancel_url" =>"string",
                    "success_url" => "string",
                    "failure_url" => "string",
                    "back_url"   => "string",
                    "capture_url" => string" 
               ]
            ]
        ]);
    }
}
```

> After completing the request for a new order on response you will receive the ID that you will need to insert below there
```php
$id = 'Set the Paybox order ID';
return Paybox::paymentInfo($id);
```


## License 

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
