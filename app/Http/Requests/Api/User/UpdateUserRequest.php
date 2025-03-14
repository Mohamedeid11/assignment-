<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => ['sometimes', 'string', 'max:255'],
            'last_name'     => ['sometimes', 'string', 'max:255'],
            'email'         => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('id'))],
            'password'      => ['nullable', 'string', 'confirmed','min:8'],
        ];
    }
}
