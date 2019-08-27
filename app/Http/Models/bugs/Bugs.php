<?php

namespace App\Http\Models\bugs;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bugs extends Model
{
    protected $fillable =['name','description','project_id','category_id','steps','wait_result','fact_result','director_id','executor_id','dead_line','priority_id','sprint_id','status_id','arounds','updated_at'];
    public static function getBugsByProjectId($id){
        $bugs = Bugs::where('project_id',$id)->get()->toArray();
        return $bugs;
    }

    public static function addBug($request,$project_id,$category_id){
        $create = Bugs::create(array(
            'name'=>$request->name,
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'description'=>$request->description,
            'steps'=>$request->steps,
            'wait_result'=>$request->wait_result,
            'fact_result'=>$request->fact_result,
            'director_id'=>$request->director_id,
            'executor_id'=>$request->executor_id,
            'dead_line'=>$request->dead_line,
            'priority_id'=>$request->priority_id,
            'sprint_id'=>$request->sprint_id,
            'status_id'=>$request->status_id,
            'arounds'=>$request->arounds
        ));

        if($create){
            return $create;
        }else{
            return false;
        }
    }
    public static function updateBug($request,$project_id,$category_id,$bug_id){

    $update = Bugs::find($bug_id)->update(array(
        'name'=>$request->name,
        'description'=>$request->description,
        'steps'=>$request->steps,
        'wait_result'=>$request->wait_result,
        'fact_result'=>$request->fact_result,
        'director_id'=>$request->director_id,
        'executor_id'=>$request->executor_id,
        'dead_line'=>$request->dead_line,
        'priority_id'=>$request->priority_id,
        'sprint_id'=>$request->sprint_id,
        'status_id'=>$request->status_id,
        'arounds'=>$request->arounds,
        'updated_at'=>Carbon::now()
    ));

        if($update){
            return $update;
        }else{
            return false;
        }
    }
    public static function getBug($id){
        $bug = Bugs::find($id)->toArray();
        return $bug;
    }
}