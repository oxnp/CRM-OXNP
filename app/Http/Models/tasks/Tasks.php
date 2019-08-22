<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable =['name','description','sprint_id','executor_id','dead_line','project_id','category_id','relative_task_id','status_id','priority_id','time_estimate','time_tracker','created_at','updated_at'];
    public static function addTask($request,$project_id,$category_id,$main_task = 0){

        $add_task = Tasks::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'sprint_id'=>$request->sprint_id,
        'executor_id'=>$request->executor_id,
        'dead_line'=>$request->dead_line,
        'project_id'=>$project_id,
        'category_id'=>$category_id,
        'relative_task_id'=>$main_task,
        'status_id'=>$request->status_id,
        'priority_id'=>$request->priority_id,
        'time_estimate'=>$request->time_estimate,
        'time_tracker'=>$request->time_tracker
        ]);

        if($add_task){
            return $add_task->toArray();
        }else{
            return false;
        }
    }

    public static function getTasksByProjectId($id){
        $tasks = Tasks::where('project_id',$id)->get()->toArray();
        return $tasks;
    }

    public static function getTaskById($id){
        $task = Tasks::where('id',$id)->get()->toArray();

        dd($task);

        return $task;
    }
}
