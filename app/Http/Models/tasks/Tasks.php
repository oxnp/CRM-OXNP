<?php

namespace App\Http\Models\tasks;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tasks extends Model
{
    protected $fillable =['name','description','sprint_id','executor_id','director_id','dead_line','project_id','category_id','relative_task_id','status_id','priority_id','time_estimate','time_tracker','created_at','updated_at'];
    /*add task and subtask
     * @param Request $request, int $project_id, int $category_id, int $main_task=0
    * @return array or false
    */
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

    /*update task and subtask by ID
     * @param Request $request, int $category_id, int $id
    * @return bool
    */
    public static function updateTask($request,$category_id,$id):bool{

        $task = Tasks::find($id);

        $update = $task->update(array(
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
/*
        if($task->only('relative_task_id')['relative_task_id'] == 0){
            $subtasks = Tasks::where('relative_task_id',$id)->update([
                'sprint_id' => $request->sprint_id
            ]);
        }
        uncomment for change sprint to all subtask if change sprint on main task
*/
        if($update){
            return true;
        }else{
            return false;
        }
    }
    /*get tasks by project ID
     * @param int $id
     * @return array
     */

    public static function getTasksByProjectId($id):array{
        $tasks = Tasks::where('project_id',$id)->get()->toArray();
        return $tasks;
    }
    /*get task by ID
     * @param int $id
     * @return array
    */
    public static function getTaskById($id):array{
        $task = Tasks::find($id)->toArray();
        return $task;
    }
}
