<?php

namespace App\Http\Models\users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static  function getUsers(){
        $users = User::leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $users;
    }

    public static  function getUsersByParticipantsId($participant_id){
        $users = User::whereIn('id',explode(',',$participant_id))->leftjoin('users_role','users_role.role_id','users.role_id')->get()->toArray();
        return $users;
    }
}
