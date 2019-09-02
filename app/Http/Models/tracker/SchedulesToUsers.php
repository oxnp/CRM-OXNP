<?php

namespace App\Http\Models\tracker;

use Illuminate\Database\Eloquent\Model;

class SchedulesToUsers extends Model
{
    public static function getSchedulesToUserById($user_id,$schedule_id){
        $schedules = SchedulesToUsers::where('schedules_to_users.user_id',$user_id)
            ->where('schedules_to_users.schedule_id',$schedule_id)
            ->join('schedule_track_history','schedule_track_history.schedule_to_users_id','schedules_to_users.id')
            ->join('users','users.id','schedules_to_users.user_id')
            ->get()->toArray();
        //dd($schedules);
        return $schedules;
    }
}
