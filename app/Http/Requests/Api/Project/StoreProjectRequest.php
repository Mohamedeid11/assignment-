<?php

namespace App\Http\Requests\Api\Project;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends ApiRequest
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
            'name'                      => ['required', 'string', 'max:255'],
            'status'                    => ['required', 'string', Rule::in(['active', 'inactive', 'completed'])],
            'attributes'                => ['nullable', 'array'],
            'attributes.*.attribute_id' => ['required_with:attributes', 'exists:attributes,id'],
            'attributes.*.value'        => ['required_with:attributes', 'string'],
        ];
    }
}
