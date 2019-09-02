<?php

namespace App\Http\Models\bugs;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Bugs extends Model
{
    protected $fillable =['name','description','project_id','category_id','steps','wait_result','fact_result','director_id','executor_id','dead_line','priority_id','sprint_id','status_id','arounds','updated_at'];

    /*
    * get list bugs by project ID
    * @param  int  $id
    * @return array $bugs
    */
    public static function getBugsByProjectId($id):array {
        $bugs = Bugs::where('project_id',$id)->get()->toArray();
        return $bugs;
    }

    /*get bug by ID
    * @param  int  $id
    * @return array $bug
    */
    public static function getBug($id):array{
        $bug = Bugs::find($id)->toArray();
        return $bug;
    }

    /*add bug
    * @param  Request $request, int $project_id, int $category_id
    * @return array or false
    */
    public static function addBug($request, $project_id, $category_id)
    {
        $create = Bugs::create(array(
            'name' => $request->name,
            'project_id' => $project_id,
            'category_id' => $category_id,
            'description' => $request->description,
            'steps' => $request->steps,
            'wait_result' => $request->wait_result,
            'fact_result' => $request->fact_result,
            'director_id' => $request->director_id,
            'executor_id' => $request->executor_id,
            'dead_line' => $request->dead_line,
            'priority_id' => $request->priority_id,
            'sprint_id' => $request->sprint_id,
            'status_id' => $request->status_id,
            'arounds' => $request->arounds
        ));
        if($create){
            return $create->toArray();
        }else{
            return false;
        }
    }

    /*update bug by ID
    * @param  Request $request, int $project_id, int $category_id, int $bug_id
    * @return bool
    */
    public static function updateBug($request, $project_id, $category_id, $bug_id):bool
    {
        $update = Bugs::find($bug_id)->update(array(
            'name' => $request->name,
            'description' => $request->description,
            'steps' => $request->steps,
            'wait_result' => $request->wait_result,
            'fact_result' => $request->fact_result,
            'director_id' => $request->director_id,
            'executor_id' => $request->executor_id,
            'dead_line' => $request->dead_line,
            'priority_id' => $request->priority_id,
            'sprint_id' => $request->sprint_id,
            'status_id' => $request->status_id,
            'arounds' => $request->arounds,
            'updated_at' => Carbon::now()
        ));
        if($update){
            return true;
        }else{
            return false;
        }
    }

}
