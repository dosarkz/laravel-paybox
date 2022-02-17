<?php

namespace Dosarkz\Paybox\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPaymentPayboxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pg_order_id' => ['string', 'required'],
            'pg_merchant_id' => ['numeric', 'required'],
            'pg_amount' => ['required', 'numeric'],
            'pg_description' => ['required', 'string'],
            'pg_salt' => ['required', 'string'],
            'pg_currency' => 'in:KZT,USD,EUR|string',
            'pg_check_url' => 'string',
            'pg_result_url' => 'string',
            'pg_request_method' => 'string|in:GET,POST,XML',
            'pg_success_url' => 'string',
            'pg_failure_url' => 'string',
            'pg_success_url_method' => 'in:GET,POST|string',
            'pg_failure_url_method' => 'in:GET,POST|string',
            'pg_state_url' => 'string',
            'pg_state_url_method' => 'in:GET,POST|string',
            'pg_site_url' => 'string',
            'pg_payment_system'  => 'string',
            'pg_lifetime' => 'integer',
            'pg_user_phone' => 'string',
            'pg_user_contact_email' => 'string|email',
            'pg_user_ip' => 'string',
            'pg_postpone_payment' => 'integer',
            'pg_language' => 'string|in:en,ru',
            'pg_testing_mode' => 'integer',
            'pg_user_id' => 'integer',
            'pg_recurring_start' => 'integer',
            'pg_recurring_lifetime' => 'integer',
            'pg_receipt_positions[0][count]' => 'integer',
            'pg_receipt_positions[0][name]' => 'string',
            'pg_receipt_positions[0][tax_type]' => 'integer',
            'pg_receipt_positions[0][price]' => 'numeric',
            'pg_param1' => 'string',
            'pg_param2' => 'string',
            'pg_param3' => 'string',
            'pg_auto_clearing' => 'integer',
            'pg_payment_method' => 'string|in:wallet,internetbank,other,bankcard,cash,mobile_commerce'
        ];
    }
}
