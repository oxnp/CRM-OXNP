<?php

namespace App\Http\Models\projects;

use App\Http\Models\users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\tracker\SchedulesToUsers;
use App\Http\Models\tracker\Tracker;
use App\Http\Models\tasks\Tasks;
use DB;

class Projects extends Model
{
    protected $fillable =['status_id','client_id','name','date_start','date_end','price','description','curr_website','old_website','participants_id','accesses','updated_at'];

    public static function getFullTimeForProjectById($id){
        $tasks = Tasks::where('tasks.project_id',$id)
            ->leftjoin('schedules_to_users','schedules_to_users.schedule_id','tasks.id')
            ->leftjoin('users','users.id','schedules_to_users.user_id')
            ->leftjoin('users_role','users_role.role_id','users.role_id')
            ->where('schedules_to_users.type','task')
            ->select('schedules_to_users.total_track_time','schedules_to_users.user_id','users.name','users_role.role_name');

        $bug = Tasks::where('tasks.project_id',$id)
            ->leftjoin('schedules_to_users','schedules_to_users.schedule_id','tasks.id')
            ->leftjoin('users','users.id','schedules_to_users.user_id')
            ->leftjoin('users_role','users_role.role_id','users.role_id')
            ->where('schedules_to_users.type','bug')
            ->select('schedules_to_users.total_track_time','schedules_to_users.user_id','users.name','users_role.role_name')
            ->union($tasks->orderBy('schedules_to_users.user_id','asc'))
        ->get();


        $data = array();
        foreach($bug->toArray() as $key=>$value){
            $data[$value['user_id']]['role'] = $value['role_name'];
            $data[$value['user_id']]['name'] = $value['name'];
            $data[$value['user_id']]['total_track_time'][] = $value['total_track_time'];
        }
        foreach($data as $key=>$value) {
            $data[$key]['total_track_time'] = SchedulesToUsers::sumTimeTrackForProject($data[$key]['total_track_time']);
        }
      return $data;
    }

    /*get projects
    * @param
    * @return array
    */
    public static function getProjects():array
    {
       // $projects = Projects::where('status_id','!=',5)->select('name','id')->get()->toArray();
        $projects = Projects::
        leftjoin('projects_statuses',function($join){
            $join->on('projects_statuses.id','projects.status_id');
        })
        ->leftjoin('clients',function($join){
            $join->on('clients.id','projects.client_id');
        })
        ->leftjoin('users',function($join){
            $join->on('users.id','clients.who_join_user_id');
            $join->orOn('users.id','clients.manager_id');
        })
        ->select('projects.name as project_name',
                'projects.id as project_id',
                'projects_statuses.name_status as project_status',
                'clients.id as client_id',
                'clients.first_name as client_first_name',
                'clients.last_name as client_last_name',
                'clients.country as client_country',
                'clients.timezone as client_timezone',
                DB::raw('SUBSTRING_INDEX(group_concat(users.name), \',\', 1) as who_join'),
                DB::raw('SUBSTRING_INDEX(group_concat(users.name), \',\', -1) as manager')
            )
            ->groupby('projects.id')
            ->orderby('clients.country','asc')
            ->get()->toArray();

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
