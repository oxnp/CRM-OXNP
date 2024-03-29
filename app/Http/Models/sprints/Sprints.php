<?php

namespace App\Http\Models\sprints;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sprints extends Model
{
    protected $fillable =['name','project_id','date_from','date_to','created_at','updated_at'];

    /*get sprints by project
    * @param int $project_id
    * @return array or false
    */
    public static function getSprintsByProjectId($project_id):array{
        $sprints = Sprints::where('project_id',$project_id)->get()->toArray();
        return $sprints;
    }
    /*add sprint
    * @param Request $request
    * @return array or false
    */
    public static function addSprint($request){
        $add_sprint= Sprints::create([
           'name'=> $request->name,
           'project_id'=> $request->project_id,
           'date_from'=> $request->date_from,
           'date_to'=> $request->date_to,
           'created_at'=> Carbon::now(),
           'updated_at'=> Carbon::now()
        ]);
        if($add_sprint){
            return $add_sprint->toArray();
        }else{
            return false;
        }
    }
}
