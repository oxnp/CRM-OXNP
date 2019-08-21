<?php

namespace App\Http\Models\users;

use Illuminate\Database\Eloquent\Model;

class UsersTest extends Model
{
    public static  function getUsers(){
        $users = UsersTest::leftjoin('users_role','users_role.role_id','users_tests.role_id')->get()->toArray();
        return $users;
    }
}
