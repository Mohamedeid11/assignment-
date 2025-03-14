<?php

namespace App\Http\Requests\Api\AttributeValue;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeValueRequest extends ApiRequest
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
            'attribute_id'  => ['sometimes', 'exists:attributes,id'],
            'value'         => ['sometimes', 'string'],
            'entity_id'     => ['sometimes', 'integer'],
            'entity_type'   => ['sometimes', 'string'],
        ];
    }
}
