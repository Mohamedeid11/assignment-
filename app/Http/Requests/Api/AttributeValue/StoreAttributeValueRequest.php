<?php

namespace App\Http\Requests\Api\AttributeValue;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class StoreAttributeValueRequest extends ApiRequest
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
            'attribute_id'  => ['required', 'exists:attributes,id'],
            'value'         => ['required', 'string'],
            'entity_id'     => ['required', 'integer'],
            'entity_type'   => ['required', 'string'],
        ];
    }
}
