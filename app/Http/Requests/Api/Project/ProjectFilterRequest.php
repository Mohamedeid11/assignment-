<?php

namespace App\Http\Requests\Api\Project;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

class ProjectFilterRequest extends ApiRequest
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
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            '*.operator' => ['required_with:*.value', Rule::in(['=', '<', '>', '<=', '>=', 'LIKE']),],
            '*.department' => 'required_with:*.operator|string',
        ];
    }
}
