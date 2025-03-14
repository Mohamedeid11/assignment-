<?php

namespace App\Http\Requests\Api\Attribute;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class StoreAttributeRequest extends ApiRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:attributes,name'],
            'type' => ['required', 'string', Rule::in(['text', 'number', 'date', 'select'])],
        ];
    }
}
