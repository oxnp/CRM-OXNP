<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class TasksPriority extends Model
{
    /*get task priorities
     * @param
     * @return array
    */
    public static function geTasksPriority():array{
        $tasks_priority = TasksPriority::all()->toArray();
        return $tasks_priority;
    }
}
