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
        $rules['name'] = 'required|unique:tasks,name,' . $this->task->id;

        return $rules;
    }
}
