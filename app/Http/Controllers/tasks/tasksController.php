<?php

namespace App\Http\Controllers\tasks;


use App\Http\Models\projects\CategoriesToProject;
use App\Http\Models\projects\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\tasks\Tasks;
use App\Http\Models\projects\ProjectsCategories;
class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $err = array();
    public function index()
    {
        //
    }

    public function showAddTaskForm($project_id,$category_id){
      //  $projects_categories = ProjectsCategories::getProjectsCategories();
       // $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);

        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);

        foreach($projects_categories as $key=>$projects_category){
            foreach($categories_to_project as $project_to_category)
                if($projects_category['name'] == $project_to_category['name']) {
                    unset($projects_categories[$key]);
                }
        }
        $tasks = Tasks::getTasksByProjectId($project_id);

        $tree_category_and_task = array();


        foreach ($categories_to_project as $key_category => $category) {
            $tree_category_and_task[$category['name']][] ='';
            if (!empty($tasks)) {
                foreach ($tasks as $key_task => $task) {
                    if ($task['category_id'] == $category['category_id'] && $task['relative_task_id'] == '0') {
                        $tree_category_and_task[$category['name']][$category['category_id']][$task['id']] = $task;
                        foreach ($tasks as $k => $v) {
                            if ($task['id'] == $v['relative_task_id'] && $task['category_id'] == $category['category_id']) {
                                $tree_category_and_task[$category['name']][$category['category_id']][$task['id']]['subtasks'][] = $v;
                            }
                        }
                    }
                }
            }
        }




        $project = Projects::getProjectById($project_id);
        return view('tasks.addtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=> $categories_to_project,
            'project' => $project,
            'tree_category_and_task' =>$tree_category_and_task
        ]);
    }

    public function addTaskByProjectIdAndCategoryId(Request $request,$project_id,$category_id){
        $add_task = Tasks::addTask($request,$project_id,$category_id);
        if ($add_task){
            return redirect()->to(route('projects_list').'/'.$project_id);
        }else{
            $this->err['create'] = false;
            return  response()->json($this->err);
        }
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
    public function show($project_id,$category_id,$task_id)
    {


        $task = Tasks::getTaskById($task_id);
        dd($task);
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