<?php

namespace App\Http\Controllers\tasks;


use App\Http\Models\projects\CategoriesToProject;
use App\Http\Models\projects\Projects;
use App\Http\Models\users\UsersTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\tasks\Tasks;
use App\Http\Models\tasks\TasksPriority;
use App\Http\Models\tasks\TasksStatuses;
use App\Http\Models\projects\ProjectsCategories;
use App\Http\Models\supporting_function\SupportLeftSideBar;
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

    public function showSubAddTaskForm($project_id, $category_id,$task_id){
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks);
        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);

        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();

        return view('tasks.addsubtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=> $categories_to_project,
            'project' => $project,
            'task'=>$task,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task' =>$tree_category_and_task
        ]);

    }


    public function showAddTaskForm($project_id,$category_id){
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks);
        $project = Projects::getProjectById($project_id);

        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();

        return view('tasks.addtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task'=>$tree_category_and_task
        ]);
    }

    public function addTaskByProjectIdAndCategoryId(Request $request,$project_id,$category_id){
        $add_task = Tasks::addTask($request,$project_id,$category_id);
        if ($add_task){
            return redirect()->to(route('projects_list').'/'.$project_id);
        }else{
            $this->err['create_task'] = false;
            return  response()->json($this->err);
        }
    }

    public function SubAddTask(Request $request,$project_id,$category_id,$task_id){
        $add_sub_task = Tasks::addTask($request,$project_id,$category_id,$task_id);
        if ($add_sub_task){
            return redirect()->to(route('projects_list').'/'.$project_id);
        }else{
            $this->err['create_sub_task'] = false;
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

    }
    public function showSubTask($project_id,$category_id,$task_id)
    {
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks);
        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);

        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();

        return view('tasks.showsubtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'task'=>$task,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task'=>$tree_category_and_task
        ]);
    }
    public function updateSubTask(){

    }

    public function showTask($project_id,$category_id,$task_id)
    {
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks);
        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);

        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();



        return view('tasks.showtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'task'=>$task,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task'=>$tree_category_and_task
        ]);
    }

    public function updateTask(Request $request,$project_id,$category_id,$id)
    {
        $task_update = Tasks::updateTask($request,$id);
        if($task_update){
            return redirect()->route('projects_detail',$project_id);
        }else{
            $this->err['task_update'] = false;
            return  response()->json($this->err);
        }
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
