<?php

namespace App\Http\Models\projects;

use App\Http\Models\users\UsersTest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable =['status_id','client_id','name','date_start','date_end','price','description','curr_website','old_website','participants_id','accesses','updated_at'];
    public static function getProjects(){
        $projects = Projects::where('status_id','!=',5)->select('name','id')->get();
        return $projects;
    }
    public static function getProjectById($id){
        $project = Projects::find($id)->toArray();
        return $project;
    }
    public static  function ProjectsByClient($id){
        $projects = Projects::where('client_id',$id)->get()->toArray();
        return $projects;
    }
    public static  function ProjectsParticipants($participants_id)
    {
        $participants = UsersTest::whereIn('id', explode(',',$participants_id))->get()->toArray();
        return $participants;
    }
    public static function addProject($request){
        $create = Projects::create([
            'status_id'=> $request->status_id,
            'client_id'=> $request->client_id,
            'name'=> $request->name,
            'date_start'=> $request->date_start,
            'date_end'=> $request->date_end,
            'price'=> $request->price,
            'description'=> $request->description,
            'curr_website'=> $request->curr_website,
            'old_website'=> $request->old_website,
            'participants_id'=> implode(',',$request->participants_id),
            'accesses'=> $request->accesses
        ]);

        if($create){
            return $create->toArray();
        }else{
            return false;
        }
    }
    public static function updateProjectById($id,$request){
        $update = Projects::find($id)->update(array(
            'status_id'=> $request->status_id,
            'name'=> $request->name,
            'date_start'=> $request->date_start,
            'date_end'=> $request->date_end,
            'price'=> $request->price,
            'description'=> $request->description,
            'curr_website'=> $request->curr_website,
            'old_website'=> $request->old_website,
            'participants_id'=> implode(',',$request->participants_id),
            'accesses'=> $request->accesses,
            'updated_at'=> Carbon::now()
        ));

        if($update){
            return $update;
        }else{
            return false;
        }
    }
}
