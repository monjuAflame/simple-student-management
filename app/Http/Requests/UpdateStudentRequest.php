<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $model = $this->route('student')->user_id;
        return [
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['nullable', 'string', 'max:60'],
            'phone' => ['nullable',  Rule::unique(User::class)->ignore($model)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($model)],
            'course_id' => ['required', 'array'],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'dob' => ['nullable', 'date'],
            'address' => ['string', 'nullable', 'max:150'],
            'status' => ['nullable', 'numeric', Rule::in(['1', '0'])],
        ];
    }
}
