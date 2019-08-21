<?php

namespace App\Http\Controllers\clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\clients\Clients;
use App\Http\Models\clients\ClientsStatuses;
use App\Http\Models\clients\ClientsTrust;
use App\Http\Models\projects\Projects;
use App\Http\Models\users\UsersTest;


class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $err = array();
    public function index()
    {
        $projects = Projects::getProjects();
        $clients = Clients::getClients();
        $clients_statuses = ClientsStatuses::getClientsStatuses();
        $clients_trust = ClientsTrust::getTrustStatuses();
        $users = UsersTest::getUsers();
        return view('clients.clients')->with([
            'clients'=>$clients,
            'projects'=>$projects,
            'clients_statuses'=>$clients_statuses,
            'clients_trust'=>$clients_trust,
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
        $err = array();
        $add_client = Clients::addClient($request);
        if($add_client){
            return redirect()->to(route('clients_list').'/'.$add_client['id']);
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
        $client = Clients::getClientById($id);
        $clients_statuses = ClientsStatuses::getClientsStatuses();
        $clients_trust = ClientsTrust::getTrustStatuses();
        $users = UsersTest::getUsers();
        $projects_by_client = Projects::ProjectsByClient($id);
        return view('clients.client')->with([
            'client'=>$client,
            'projects'=>$projects,
            'clients_statuses'=>$clients_statuses,
            'clients_trust'=>$clients_trust,
            'users'=>$users,
            'projects_by_client'=>$projects_by_client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

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
        $err = array();
        $client_update = Clients::updateClientById($id,$request);
        if($client_update){
            return redirect()->route('clients_detail',$id);
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
