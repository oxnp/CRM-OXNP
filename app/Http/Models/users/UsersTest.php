<?php

namespace App\Http\Models\users;

use Illuminate\Database\Eloquent\Model;

class UsersTest extends Model
{
    public static  function getUsers(){
        $users = UsersTest::all();
        return $users;
    }
}
