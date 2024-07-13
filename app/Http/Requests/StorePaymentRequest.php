<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'enrolment_id' => ['required', 'numeric'],
            'payment_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'method' => ['required', 'string'],
            'remark' => ['nullable', 'string'],
        ];
    }
}
