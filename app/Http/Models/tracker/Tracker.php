<?php

namespace App\Http\Models\tracker;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Http\Models\supporting_function\SupportTimer;
use App\Http\Models\tracker\SchedulesToUsers;
use Illuminate\Support\Facades\Auth;

class Tracker extends Model
{
    protected $table = "schedule_track_history";
    protected $fillable =['id','schedule_to_users_id','user_id','track_from','track_to','flag_in_progress_th','total_time','created_at','updated_at'];
    public static function stopTracker ($category_id, $task_id, $track_id){
       $track = Tracker::find($track_id);

       $track_from = $track->track_from;
       $track_to = $track->track_to = Carbon::now()->timezone('Europe/Kiev')->toDateTimeString();
       $track->track_to = $track_to;
       $track->flag_in_progress_th = 0;
       $track->total_time = SupportTimer::getTimeToTask($track_from);
       $track->save();

        $total_track_time = SchedulesToUsers::sumTimeTrackByTaskByUserId($task_id,Auth::id());
        $schedule = SchedulesToUsers::where('schedule_id',$task_id);
        $schedule->update([
            'total_track_time'=> $total_track_time
        ]);
 

       return $track;
    }

    public static function startTracker ($category_id, $task_id){

        $shedule_to_user = SchedulesToUsers::where('schedule_id',$task_id)->select('id')->get()->toArray();


        if($shedule_to_user == null){
            $schedule = SchedulesToUsers::create([
                'schedule_id'=>$task_id,
                'flag_in_progress'=>1,
                'user_id'=>Auth::id(),
                'total_track_min'=> '00:00:00'
            ]);
        }

        if (isset($schedule)){
            Tracker::create([
                'schedule_to_users_id' => $schedule['id'],
                'user_id' => Auth::id(),
                'track_from' => Carbon::now()->timezone('Europe/Kiev')->toDateTimeString(),
                'track_to' => null,
                'flag_in_progress_th' => 1,
                'total_time' => '00:00:00',
            ]);
        }else{
            Tracker::create([
                'schedule_to_users_id' => $shedule_to_user[0]['id'],
                'user_id' => Auth::id(),
                'track_from' => Carbon::now()->timezone('Europe/Kiev')->toDateTimeString(),
                'track_to' => null,
                'flag_in_progress_th' => 1,
                'total_time' => '00:00:00',
            ]);
        }

    }
}
