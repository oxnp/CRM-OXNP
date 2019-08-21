<?php

namespace App\Http\Controllers\projects;

use App\Http\Models\users\UsersTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\projects\Projects;
use App\Http\Models\projects\ProjectsStatuses;
use App\Http\Models\clients\Clients;
use App\Http\Models\projects\ProjectsAttachments;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  $err = array();
    public function index()
    {
        $projects = Projects::getProjects();
        $clients = Clients::getClients();
        $project_statuses = ProjectsStatuses::getProjectsStatuses();
        $users = UsersTest::getUsers();
        return view('projects.projects')->with([
            'projects'=>$projects,
            'clients'=>$clients,
            'project_statuses'=>$project_statuses,
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $add_project = Projects::addProject($request);
        if($add_project){
            return redirect()->to(route('projects_list').'/'.$add_project['id']);
        }else{
            $this->err['create'] = false;
            return  response()->json($this->err);
        }
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
        $projects = Projects::getProjects();
        $project =  Projects::getProjectById($id);
        $client = Clients::getClientById($project['client_id']);
        $project_attachemnts = ProjectsAttachments::getAttachmentsByProjectId($id);
        $participants_user =  Projects::ProjectsParticipants($project['participants_id']);
        $project_statuses = ProjectsStatuses::getProjectsStatuses();
        $users = UsersTest::getUsers();
        return view('projects.project')->with([
            'projects'=>$projects,
            'client'=>$client,
            'project'=>$project,
            'participants_user'=>$participants_user,
            'project_attachemnts'=>$project_attachemnts,
            'project_statuses'=>$project_statuses,
            'users'=>$users
        ]);
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
        $project_update = Projects::updateProjectById($id,$request);
        if($project_update){
            return redirect()->route('projects_detail',$id);
        }else{
            $this->err['update'] = false;
            return  response()->json($this->err);
        }

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
