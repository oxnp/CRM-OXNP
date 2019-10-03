<?php

namespace App\Http\Controllers\clients;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\clients\Clients;
use App\Http\Models\clients\ClientsStatuses;
use App\Http\Models\clients\ClientsTrust;
use App\Http\Models\projects\Projects;
use App\Http\Models\users\User;


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
         dd($clients);
        $clients_statuses = ClientsStatuses::getClientsStatuses();
        $clients_trust = ClientsTrust::getTrustStatuses();
        $users = User::getUsers();

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $add_client = Clients::addClient($request);
            return redirect()->route('clients.show', $add_client['id']);
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No added client';
            return response()->json($this->err);
        }
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
        $users = User::getUsers();
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
        try {
            Clients::updateClientById($id, $request);
            return redirect()->route('clients.show', $id);
        } catch (QueryException $exception) {
            $this->err['errors'] = 'Not update client';
            return response()->json($this->err);
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
