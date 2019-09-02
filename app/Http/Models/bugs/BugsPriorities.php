<?php

namespace App\Http\Models\bugs;

use Illuminate\Database\Eloquent\Model;

class BugsPriorities extends Model
{
    /*get list bugs priorities
    * @param
    * @return array
    */
    public static function getBugsPriorities(){
        $bugs_priorities = BugsPriorities::all();
        return $bugs_priorities;
    }
}
