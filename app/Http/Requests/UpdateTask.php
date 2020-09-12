<?php

namespace App\Http\Requests;

class UpdateTask extends StoreTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'sometimes|required|unique:tasks,name,' . $this->task->id;
        $rules['status_id'] = 'sometimes|required|exists:task_statuses,id';

        return $rules;
    }
}
