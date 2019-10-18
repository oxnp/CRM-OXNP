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
     * get user
     * @param
     * @return array
     */
    public static  function getUser($id){
        $users = User::where('users.id',$id)
            ->leftjoin('users_statuses','users_statuses.id','users.status_id')
            ->leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $users;
    }
    public static function getRolesUsers(){
        $roles = UsersRole::all()->toArray();
        return $roles;
    }
    public static function getUsersStatuses(){
        $roles = UsersStatuses::all()->toArray();
        return $roles;
    }
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
