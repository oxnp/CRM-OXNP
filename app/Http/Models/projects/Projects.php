<?php

namespace App\Http\Models\projects;

use App\Http\Models\users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable =['status_id','client_id','name','date_start','date_end','price','description','curr_website','old_website','participants_id','accesses','updated_at'];
    /*get projects
    * @param
    * @return array
    */
    public static function getProjects():array
    {
        $projects = Projects::where('status_id','!=',5)->select('name','id')->get()->toArray();
        return $projects;
    }
    /*get detail project by ID
    * @param int $id
    * @return array
    */
    public static function getProjectById($id):array
    {
        $project = Projects::findOrFail($id)->toArray();
        return $project;
    }
    /*get project by clients ID
    * @param int $id
    * @return array
    */
    public static  function ProjectsByClient($id):array
    {
        $projects = Projects::where('client_id',$id)->get()->toArray();
        return $projects;
    }
    /*get participants to project by IDs user 1,2,3...
    * @param string $participants_ids
    * @return array
    */
    public static  function ProjectsParticipants($participants_ids):array
    {
        $participants = User::whereIn('id', explode(',',$participants_ids))
            ->leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $participants;
    }
    /*add project
    * @param Request $request
    * @return array or false
    */
    public static function addProject($request)
    {
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
            'participants_id'=> (isset($request->participants_id)) ? implode(',',$request->participants_id) : '',
            'accesses'=> $request->accesses
        ]);

        if($create){
            return $create->toArray();
        }else{
            return false;
        }
    }
    /*update project by ID
    * @param int $id, Request $request
    * @return bool
    */
    public static function updateProjectById($id,$request):bool
    {
        $update = Projects::find($id)->update(array(
            'status_id'=> $request->status_id,
            'name'=> $request->name,
            'date_start'=> $request->date_start,
            'date_end'=> $request->date_end,
            'price'=> $request->price,
            'description'=> $request->description,
            'curr_website'=> $request->curr_website,
            'old_website'=> $request->old_website,
            'participants_id'=> (isset($request->participants_id)) ? implode(',',$request->participants_id) : '',
            'accesses'=> $request->accesses,
            'updated_at'=> Carbon::now()
        ));

        if($update){
            return true;
        }else{
            return false;
        }
    }
}
