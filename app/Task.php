<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'];

    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\User');
    }
}
