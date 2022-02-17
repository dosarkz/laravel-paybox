<?php

namespace Dosarkz\Paybox;


use Dosarkz\Paybox\Requests\NewPaymentPayboxRequest;
use Dosarkz\Paybox\Requests\PayboxStatusPaymentRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @property PayboxStatus $status
 */
class PayboxService
{
    public PayboxStatus $status;

    /**
     * @var array
     */
    protected array $config = [];

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
     * @return \SimpleXMLElement
     * @throws ValidationException
     * @throws \Exception
     */
    public function generate(array $data = []): \SimpleXMLElement
    {
        $validator = Validator::make($data, ((new NewPaymentPayboxRequest())->rules()));
        if ($validator->fails())
            throw new ValidationException($validator);

        $this->generateSig($data, 'init_payment.php');
        return $this->request('post', $this->fullPath('init_payment'), $data);
    }

    /**
     * Получение информации о платеже
     * @param $data
     * @throws \Exception
     */
    public function paymentInfo(array $data): static
    {
        $validator = Validator::make($data, ((new PayboxStatusPaymentRequest())->rules()));
        if ($validator->fails())
            throw new ValidationException($validator);

        $this->generateSig($data, 'get_status2.php');
        $req = $this->request('get', $this->fullPath('status_payment'), $data);
        $this->setStatus(new PayboxStatus());
        $this->status->setPgStatus($req->pg_status);
        $this->status->setPgPaymentId($req->pg_payment_id);
        $this->status->setPgTransactionStatus($req->pg_transaction_status);
        return $this;
    }

    /**
     * @param $route
     * @return string
     */
    private function fullPath($route): string
    {
        return $this->config['url'] . '/' . $this->config['routes'][$route];
    }

    /**
     * @throws \Exception
     */
    private function request(string $verb, string $route, array $data): \SimpleXMLElement
    {
        $v = strtolower($verb);
        $response = Http::{$v}($route, $data);
        if (!$response->ok())
            throw new \Exception($response->body());

        $data = simplexml_load_string($response->body());

        if ($data->pg_status != 'ok')
            throw new \Exception($response->body());

        return $data;
    }

    /**
     * @return PayboxStatus
     */
    public function getStatus(): PayboxStatus
    {
        return $this->status;
    }

    /**
     * @param PayboxStatus $status
     */
    public function setStatus(PayboxStatus $status): void
    {
        $this->status = $status;
    }



    /**
     * @param array $data
     * @param string $type
     * @return void
     */
    private function generateSig(array &$data, string $type)
    {
        $requestForSignature = $this->makeFlatParamsArray($data);
        ksort($requestForSignature);
        array_unshift($requestForSignature, $type);
        $requestForSignature[] = $this->config['secret_key'];
        $data['pg_sig'] = md5(implode(';', $requestForSignature));
    }

    /**
     * Имя делаем вида tag001subtag001
     * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
     */
    private function makeFlatParamsArray($arrParams, $parent_name = ''): array
    {
        $arrFlatParams = [];
        $i = 0;
        foreach ($arrParams as $key => $val) {
            $i++;

            $name = $parent_name . $key . sprintf('%03d', $i);
            if (is_array($val)) {
                $arrFlatParams = array_merge($arrFlatParams, $this->makeFlatParamsArray($val, $name));
                continue;
            }
            $arrFlatParams += array($name => (string)$val);
        }

        return $arrFlatParams;
    }


}

