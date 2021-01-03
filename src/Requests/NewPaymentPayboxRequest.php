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
            'x_idempotency_key' => 'required',
            'order' => [
                'string',
                'required'
            ],
            'amount' => [
                'numeric', 'required'
            ],
            'refund_amount' => [
                'numeric',
            ],
            'currency' => [
                'required', 'string'
            ],
            'description' => [
                'required', 'string',
            ],
            'payment_system' => ['string'],
            'cleared' => 'boolean',
            'expires_at' => ['required'],
            'language' => [
                'string', 'in:ru,en,de'
            ],
        ];
    }
}
