<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksPriority extends Model
{
    public static function geTasksPriority(){
        $tasks_priority = TasksPriority::all()->toArray();
        return $tasks_priority;
    }
}
