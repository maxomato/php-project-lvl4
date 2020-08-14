<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tasks',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'exists:users,id|nullable',
            'description' => 'max:300',
            'labels' => 'array',
            'labels.*' => 'exists:labels,id'
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => __('task.status.required')
        ];
    }
}
