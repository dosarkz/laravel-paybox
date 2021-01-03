<?php

namespace Dosarkz\Paybox;

use Illuminate\Support\Str;

class Curl
{
    private $url;
    private $method;
    private $data;
    private $options;

    public function __construct($url, $method, $data = [], $options = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->data = $data;
        $this->options = $options;
    }

    public function generate()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers[] = 'Authorization: Basic ' . base64_encode($this->options['merchant_id'] . ':' . $this->options['secret_key']);

        if ($this->method === 'POST') {
            $headers[] = 'X-Idempotency-Key: ' . $this->options['x_idempotency_key'] ?? Str::uuid();
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->data));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = json_decode($response, true);
        curl_close($curl);

        return [
            'code' => $httpCode,
            'response' => $response
        ];
    }
}