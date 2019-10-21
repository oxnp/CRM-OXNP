<?php

namespace App\Http\Models\users;

use App\Http\Models\users\UsersStatuses;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Models\users\UsersCalendar;
use App\Http\Models\users\UsersRole;
use DB;
class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status_id','role_id','birthday','avatar','description','date_interview','description_candidate','start_work_date','stop_work_date','reason_for_dismissal','salary'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   /**
    * get all users
    * @param
    * @return array
    */
    public static  function getUsers(){
        $users = User::leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $users;
    }

    /**
     * update user data
     * @param Request $request, Int $id
     * @return array
     */
    public static function updateUserById($request,$avatar, $id){
        if ($avatar != '') {
            $user = User::find($id)->update(array(
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'status_id' => $request->status_id,
                'birthday' => $request->birthday,
                'description' => $request->description,
                'date_interview' => $request->date_interview,
                'description_candidate' => $request->description_candidate,
                'start_work_date' => $request->start_work_date,
                'stop_work_date' => $request->stop_work_date,
                'reason_for_dismissal' => $request->reason_for_dismissal,
                'avatar' => $avatar
            ));
        }else{
            $user = User::find($id)->update(array(
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'status_id' => $request->status_id,
                'birthday' => $request->birthday,
                'description' => $request->description,
                'date_interview' => $request->date_interview,
                'description_candidate' => $request->description_candidate,
                'start_work_date' => $request->start_work_date,
                'stop_work_date' => $request->stop_work_date,
                'reason_for_dismissal' => $request->reason_for_dismissal
            ));
        }

    }
    /**
     * get user
     * @param Int $id
     * @return array
     */
    public static  function getUser($id): array{
        $users = User::where('users.id',$id)
            ->leftjoin('users_statuses','users_statuses.id','users.status_id')
            ->leftjoin('users_role','users_role.role_id','users.role_id')
            ->select('users.id as user_id','users.name','users.email',
                     'users.role_id','users.status_id','users.birthday',
                     'users.avatar','users.description','users.date_interview','users.description_candidate',
                     'users.start_work_date','users.stop_work_date','users.reason_for_dismissal',
                     'users.salary','users.created_at','users.updated_at','users_statuses.name_status',
                     'users_role.role_name','users_role.privilege')
            ->get()->toArray();
        return $users;
    }
    /**
     * get all roles user
     * @param Int $id
     * @return array
     */
    public static function getRolesUsers(): array{
        $roles = UsersRole::all()->toArray();
        return $roles;
    }
    /**
     * get all statuses users
     * @param
     * @return array
     */
    public static function getUsersStatuses(): array{
        $roles = UsersStatuses::all()->toArray();
        return $roles;
    }
    /**
     * get calendar users
     * @param Int $id, String $year_from, String $year_to, String $month_from, String $month_to, String $day_from, String $day_to
     * @return array
     */
    public static function getSumDaysUserById($id,$year_from,$year_to,$month_from,$month_to,$day_from,$day_to){
        $days = UsersCalendar::whereUserId($id)
            ->where('year','>=',$year_from)
            ->where('year','<=',$year_to)
            ->where('month','>=',$month_from)
            ->where('month','<=',$month_to)
            ->where('date','>=',$day_from)
            ->where('date','<=',$day_to)
            ->leftjoin('users_absent_list','users_absent_list.id','users_calendar.type_absent_id')
            ->select(DB::raw('sum(sum_days) as sum'),'users_absent_list.name')->groupby('type_absent_id')->get()->toArray();

        $absents_array = array();
        foreach($days as $item){
            $absents_array[$item['name']] = $item['sum'];
        }
        return $absents_array;
    }
    /**
     * get user by ID
     * @param int $participant_id
     * @return array
     */
    public static  function getUsersByParticipantsId($participant_id){
        $users = User::whereIn('id',explode(',',$participant_id))->leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $users;
    }
}
