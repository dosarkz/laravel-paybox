<?php

namespace Dosarkz\Paybox;


use Dosarkz\Paybox\Requests\NewPaymentPayboxRequest;
use Illuminate\Support\Facades\Validator;


class Paybox
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Создание нового платежа
     * @param array $data
     * @return \Illuminate\Support\MessageBag|mixed
     */
    public function generate($data = [])
    {
        $validator = Validator::make($data, ((new NewPaymentPayboxRequest())->rules()));

        if ($validator->fails()) {
            return $validator->errors();
        }

        $options['merchant_id'] = $this->config['merchant_id'];
        $options['secret_key'] = $this->config['secret_key'];
        $options['x_idempotency_key'] = $data['x_idempotency_key'];
        unset($data['x_idempotency_key']);

        $curl = new Curl($this->config['routes']['payments'], 'POST', $data, $options);
        return $curl->generate();
    }

    /**
     * Получение информации о платеже
     * @param $id
     * @return array
     */
    public function paymentInfo($id)
    {
        $options['merchant_id'] = $this->config['merchant_id'];
        $options['secret_key'] = $this->config['secret_key'];
        $curl = new Curl($this->config['routes']['payments'] . '/' . $id, 'GET', [], $options);
        return $curl->generate();
    }

}

