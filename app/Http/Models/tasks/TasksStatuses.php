<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksStatuses extends Model
{
    public static function geTasksStatuses(){
        $tasks_statuses = TasksStatuses::all()->toArray();
        return $tasks_statuses;
    }
}
