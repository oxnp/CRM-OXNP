<?php

namespace App\Http\Models\tracker;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\tracker\Tracker;
class SchedulesToUsers extends Model
{
    protected $fillable =['id','schedule_id','user_id','flag_in_progress','total_track_time'];
    public $timestamps = false;
    public static function getSchedulesToUserById($user_id,$schedule_id){
        $schedules = SchedulesToUsers::where('schedules_to_users.user_id',$user_id)
            ->where('schedules_to_users.schedule_id',$schedule_id)
            ->join('schedule_track_history','schedule_track_history.schedule_to_users_id','schedules_to_users.id')
            ->join('users','users.id','schedule_track_history.user_id')->select(
                'schedule_track_history.id',
                'schedule_track_history.flag_in_progress_th',
                'schedule_track_history.track_from',
                'schedule_track_history.track_to',
                'schedule_track_history.total_time',
                'schedule_track_history.user_id',
                'schedule_track_history.created_at',
                'schedule_track_history.updated_at',
                'users.name'
            )
            ->get()->toArray();
      //  dd($schedules);
        return $schedules;
    }

    public static function sumTimeTrackByTaskByUserId($task_id, $user_id){
        $schedules_to_users = SchedulesToUsers::where('schedule_track_history.user_id',$user_id)->where('schedules_to_users.schedule_id',$task_id)->
            leftjoin('schedule_track_history','schedule_track_history.schedule_to_users_id','schedules_to_users.id')
            ->select('total_time')->get();

            $times = $schedules_to_users->toArray();
            $seconds = 0;
            foreach ($times as $time)
            {
                list($hour,$minute,$second) = explode(':', $time['total_time']);
                $seconds += $hour*3600;
                $seconds += $minute*60;
                $seconds += $second;
            }
            $hours = floor($seconds/3600);
            $seconds -= $hours*3600;
            $minutes  = floor($seconds/60);

            $seconds -= $minutes*60;
            if ((int)$seconds <10){
                $seconds = sprintf("%02d", (int)$seconds);
            }
            return "{$hours}:{$minutes}:{$seconds}";


    }
}
