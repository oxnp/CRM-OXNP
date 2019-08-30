<?php

namespace App\Http\Models\bugs;

use Illuminate\Database\Eloquent\Model;

class BugsStatuses extends Model
{
    /*get list bugs statuses*/
    public static function getBugsStatuses(){
        $bugs_statuses = BugsStatuses::all();
        return $bugs_statuses;
    }
}
