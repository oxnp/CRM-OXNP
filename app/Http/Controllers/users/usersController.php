<?php

namespace App\Http\Controllers\users;

use App\Http\Models\inventories\Inventories;
use App\Http\Models\projects\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\users\User;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::getUsers();
       $projects = Projects::getProjects();
       return view('users.users')->with(['users'=>$users,'projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::getUser($id);
        $projects = Projects::getProjects();

        $year_from = date('Y');
        $year_to = date('Y');
        $month_from = date('m');
        $month_to= date('m');
        $day_from = date('d');
        $day_to  = date('d');

        $roles = User::getRolesUsers();
        $statuses = User::getUsersStatuses();
        //dd($user);
        $d = User::getSumDaysUserById($id,$year_from,$year_to,$month_from,$month_to,$day_from,$day_to);
        $inventories = Inventories::getInventoriesByUserId($id);
        return view('users.user')->with(['user'=>$user,'projects'=>$projects,'roles'=>$roles,'statuses'=>$statuses,'inventories'=>$inventories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // dd($request->all());
        $avatar = '';
        if (isset($request->avatar)){
            $avatar = $this->storeUserAvatar($request->file('avatar'), $id);
            User::updateUserById($request, $avatar, $id);
        }else{
            User::updateUserById($request,$avatar, $id);
        }

        return redirect()->route('users.show',$id);
    }
    public function storeUserAvatar($file, $id){
        $storage = $file->store('public/users/' . $id);
        $name_file = explode('/', $storage);
        $storage = '/storage/app/public/users/' . $id . '/' . $name_file[3];
        return $storage;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
