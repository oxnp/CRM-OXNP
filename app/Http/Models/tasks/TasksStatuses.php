<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksStatuses extends Model
{
    /*get task statuses*/
    public static function geTasksStatuses():array{
        $tasks_statuses = TasksStatuses::all()->toArray();
        return $tasks_statuses;
    }
}
