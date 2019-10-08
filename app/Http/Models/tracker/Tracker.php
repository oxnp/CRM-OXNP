<?php

namespace App\Http\Models\tracker;

use App\Http\Models\bugs\Bugs;
use App\Http\Models\tasks\Tasks;
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

    /**
     * stop tracker
     * @param int $category_id, int $task_id, int $track_id, string $type
     * @return
     */

    public static function stopTracker ($category_id = 0, $task_id, $track_id,$type){

       $track = Tracker::find($track_id);

       $track_from = $track->track_from;
       $track_to = $track->track_to = Carbon::now()->timezone('Europe/Kiev')->toDateTimeString();
       $track->track_to = $track_to;
       $track->flag_in_progress_th = 0;
       $track->total_time = SupportTimer::getTimeToTask($track_from);
       $track->save();

        $total_track_time = SupportTimer::sumTimeTrackByTaskByUserId($task_id,Auth::id(),$type);
        $schedule = SchedulesToUsers::where('schedule_id',$task_id)->where('type',$type)->where('user_id',Auth::id());
        $schedule->update([
            'total_track_time'=> $total_track_time,
            'flag_in_progress' => 0
        ]);

        $total_time_task = SupportTimer::getSumTimerByTaskId($task_id,$type);
        if ($type == 'task'){
            $task = Tasks::find($task_id);
            $task->update([
                'time_tracker'=>$total_time_task
            ]);
        }

        if ($type == 'bug'){
            $bug = Bugs::find($task_id);
            $bug->update([
                'time_tracker'=>$total_time_task
            ]);
        }

       //return $track;
    }
    /**
     * start tracker
     * @param int $category_id, int $task_id, string $type
     * @return
     */
    public static function startTracker ($category_id, $task_id,$type){


        $schedule_in_progress = Tracker::where('schedule_track_history.user_id',Auth::id())
            ->where('schedule_track_history.flag_in_progress_th',1)
            ->leftjoin('schedules_to_users','schedules_to_users.id','schedule_track_history.schedule_to_users_id')
            ->select('schedule_track_history.id as track_id','schedules_to_users.schedule_id as schedule_id','schedules_to_users.type')
            ->get()->toArray();

        if(!empty($schedule_in_progress)){
            self::stopTracker(0,$schedule_in_progress[0]['schedule_id'],$schedule_in_progress[0]['track_id'],$schedule_in_progress[0]['type']);
        }

        $shedule_to_user = SchedulesToUsers::where('schedule_id',$task_id)->where('type',$type)->where('user_id',Auth::id())->select('id')->get()->toArray();

        if($shedule_to_user == null){
            $schedule = SchedulesToUsers::create([
                'schedule_id'=>$task_id,
                'flag_in_progress'=>1,
                'user_id'=>Auth::id(),
                'type'=>$type,
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

            $update_progress = SchedulesToUsers::where('type',$type)->where('user_id',Auth::id())->where('id', $shedule_to_user[0]['id']);
            $update_progress->update(['flag_in_progress' => 1]);
        }

    }
}
