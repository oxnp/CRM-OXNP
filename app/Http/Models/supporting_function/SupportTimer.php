<?php

namespace App\Http\Models\supporting_function;

use App\Http\Models\tracker\SchedulesToUsers;
use Illuminate\Database\Eloquent\Model;

class SupportTimer extends Model
{
    public static function getTimeToTask($date_time_task){
        date_default_timezone_set('Europe/Kiev');
        $curr_date = date_create(date('Y-m-d H:i:s'));
        $track_from  = date_create($date_time_task);
        $diff = date_diff($track_from, $curr_date);
        $hours = $diff->days * 24;
        $hours += $diff->h;
        if ((int)$hours <10){
            $hours = sprintf("%02d", (int)$hours);
        }
        $result = $hours.':'.$diff->format('%I:%S');
        return $result;
    }


    public static function sumTimeTrackByTaskByUserId($task_id, $user_id, $type){
        $schedules_to_users = SchedulesToUsers::where('schedule_track_history.user_id',$user_id)
            ->where('schedules_to_users.schedule_id',$task_id)
            ->where('schedules_to_users.type',$type)
            ->leftjoin('schedule_track_history','schedule_track_history.schedule_to_users_id','schedules_to_users.id')
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
        if ((int)$hours <10){
            $hours = sprintf("%02d", (int)$hours);
        }
        $seconds -= $hours*3600;

        $minutes  = floor($seconds/60);
        if ((int)$minutes <10){
            $minutes = sprintf("%02d", (int)$minutes);
        }
        $seconds -= $minutes*60;
        if ((int)$seconds <10){
            $seconds = sprintf("%02d", (int)$seconds);
        }
        return "{$hours}:{$minutes}:{$seconds}";
    }
}