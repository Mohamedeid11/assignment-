<?php

namespace App\Http\Requests\Api\Timesheet;

use App\Http\Requests\Api\ApiRequest;

class UpdateTimesheetRequest extends ApiRequest
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
            'task_name' => ['sometimes', 'string', 'max:255'],
            'date' => ['sometimes', 'date'],
            'hours' => ['sometimes', 'numeric', 'min:0'],
            'user_id' => ['sometimes', 'exists:users,id'],
            'project_id' => ['sometimes', 'exists:projects,id'],
        ];
    }
}
