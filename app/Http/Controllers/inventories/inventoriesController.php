<?php

namespace App\Http\Controllers\inventories;

use App\Http\Models\inventories\Inventories;
use App\Http\Models\inventories\InventoryCategories;
use App\Http\Models\projects\Projects;
use App\Http\Models\users\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class inventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory_categories = InventoryCategories::getCategoriesTree();
        $users = User::getUsers();
        $projects = Projects::getProjects();
        $inventories_list = Inventories::getInventories();
        return view('inventories.list')->with([
            'inventories_list'=>$inventories_list,
            'inventory_categories'=>$inventory_categories,
            'users'=>$users,
            'projects'=>$projects
        ]);
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
        Inventories::addInventory($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            Inventories::updateInventory($request,$id);
            return back();
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
