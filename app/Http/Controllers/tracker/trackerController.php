<?php

namespace App\Http\Controllers\tracker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\tracker\Tracker;

class trackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Start tracker .
     *
     * @param  int  $category_id, int  $task_id, int $track_id
     * @return redirect back
     */
    public function startTrack(Request $request, $project_id, $task_id)
    {
        Tracker::startTracker($project_id, $task_id);
        return back();
    }
    /**
     * Stop tracker .
     *
     * @param  int  $category_id, int  $task_id, int $track_id
     * @return redirect back
     */
    public function stopTrack(Request $request, $project_id, $task_id, $track_id)
    {
       Tracker::stopTracker($project_id, $task_id, $track_id);
        return back();
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
        //
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
