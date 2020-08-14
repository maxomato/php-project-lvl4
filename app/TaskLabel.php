<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLabel extends Model
{
    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
