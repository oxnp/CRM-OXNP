<?php

namespace App\Http\Models\supporting_function;

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
        $result = $hours.':'.$diff->format('%I:%S');

        return $result;
    }

    public static function diffTimeFromToDateToMinutes($date_from, $date_to){
        $diff = date_diff(date_create($date_from), date_create($date_to));
        $minutes = $diff->days * 24 * 60;
        $minutes += $diff->h * 60;
        $minutes += $diff->i;

       return $minutes;

    }

}
