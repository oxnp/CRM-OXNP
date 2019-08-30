<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tasks extends Model
{
    protected $fillable =['name','description','sprint_id','executor_id','director_id','dead_line','project_id','category_id','relative_task_id','status_id','priority_id','time_estimate','time_tracker','created_at','updated_at'];
    /*add task and subtask*/
    public static function addTask($request,$project_id,$category_id,$main_task = 0){
        $add_task = Tasks::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'sprint_id'=>$request->sprint_id,
        'executor_id'=>$request->executor_id,
        'director_id'=>$request->director_id,
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

    /*update task and subtask by ID*/
    public static function updateTask($request,$category_id,$id):bool{
        $update = Tasks::find($id)->update(array(
            'name'=>$request->name,
            'description'=>$request->description,
            'sprint_id'=>$request->sprint_id,
            'executor_id'=>$request->executor_id,
            'director_id'=>$request->director_id,
            'dead_line'=>$request->dead_line,
            'status_id'=>$request->status_id,
            'priority_id'=>$request->priority_id,
            'time_estimate'=>$request->time_estimate,
            'time_tracker'=>$request->time_tracker,
            'updated_at'=> Carbon::now()
        ));

        if($update){
            return true;
        }else{
            return false;
        }
    }
    /*get tasks by project ID*/
    public static function getTasksByProjectId($id):array{
        $tasks = Tasks::where('project_id',$id)->get()->toArray();
        return $tasks;
    }
    /*get task by ID*/
    public static function getTaskById($id):array{
        $task = Tasks::find($id)->toArray();
        return $task;
    }
}
