<?php

namespace App\Http\Requests\Api\Timesheet;

use App\Http\Requests\Api\ApiRequest;

class StoreTimesheetRequest extends ApiRequest
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
            'task_name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'hours' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }
}
