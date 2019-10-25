<?php

namespace App\Http\Controllers\tasks;


use App\Http\Models\bugs\Bugs;
use App\Http\Models\projects\CategoriesToProject;
use App\Http\Models\projects\Projects;
use App\Http\Models\sprints\Sprints;
use App\Http\Models\users\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\tasks\Tasks;
use App\Http\Models\tasks\TasksPriority;
use App\Http\Models\tasks\TasksStatuses;
use App\Http\Models\projects\ProjectsCategories;
use App\Http\Models\supporting_function\SupportLeftSideBar;
use App\Http\Models\supporting_function\SupportTimer;
use App\Http\Models\tasks\TasksAttachments;
use App\Http\Models\tracker\SchedulesToUsers;
use Auth;
use Session;
class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $err = array();
    public $result_action = array();
    public function index()
    {
        //
    }
    public function storeAttachmentsByTaskId(Request $request,$project_id, $task_id)
    {
        $count_files = count($request->file('files'));
        if($count_files > 0) {
            $files_added = 0;
            foreach ($request->file('files') as $file) {
                $storage = $file->store('public/projects/'.$project_id.'/tasks/' . $task_id);
                $name_file = explode('/', $storage);

                $storage = '/storage/app/public/projects/'.$project_id.'/tasks/'. $task_id .'/'. $name_file[5];

                $type_file = strtolower($file->getClientOriginalExtension());
                $project_attach = TasksAttachments::setAttachmentsByTaskId($task_id, $type_file, $storage);
                if ($project_attach) {
                    $files_added++;
                } else {
                    $this->err['attach_file'] = false;
                    return response()->json($this->err);
                }
            }
            return back()->with(['files_added'=>$files_added]);
        }
        return back();
    }

    public function showAddSubTaskForm($project_id, $category_id,$task_id){
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $bugs = Bugs::getBugsByProjectId($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);

        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);
        $users = User::getUsers();
        $sprints = Sprints::getSprintsByProjectId($project_id);
        $tree_by_sprints = SupportLeftSideBar::getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints);

        $users_by_project = User::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();

        return view('tasks.addsubtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=> $categories_to_project,
            'project' => $project,
            'task'=>$task,
            'users'=>$users,
            'sprints'=>$sprints,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task' =>$tree_category_and_task,
            'tree_by_sprints'=>$tree_by_sprints
        ]);

    }


    public function showAddTaskForm($project_id,$category_id){
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $bugs = Bugs::getBugsByProjectId($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $project = Projects::getProjectById($project_id);

        $users_by_project = User::getUsersByParticipantsId($project['participants_id']);
        $users = User::getUsers();
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();
        $sprints = Sprints::getSprintsByProjectId($project_id);
        $tree_by_sprints = SupportLeftSideBar::getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints);
        return view('tasks.addtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'users_by_project'=>$users_by_project,
            'users'=>$users,
            'sprints'=>$sprints,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task'=>$tree_category_and_task,
            'tree_by_sprints'=>$tree_by_sprints
        ]);
    }

    public function addTask(Request $request,$project_id,$category_id){
        try {
            $add_task = Tasks::addTask($request, $project_id, $category_id);
            $this->storeAttachmentsByTaskId($request, $project_id, $add_task['id']);
            return redirect()->to(route('projects.show',$project_id));
            //return back();
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No added task';
            return response()->json($this->err);
        }
    }

    public function SubAddTask(Request $request,$project_id,$category_id,$task_id){
        try {
            $add_sub_task = Tasks::addTask($request,$project_id,$category_id,$task_id);
            $this->storeAttachmentsByTaskId($request, $project_id, $add_sub_task['id']);
            return redirect()->to(route('projects.show',$project_id));
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No added subtask';
            return response()->json($this->err);
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
        $bugs = Bugs::getBugsByProjectId($project_id);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);
        $users = User::getUsers();
        $sprints = Sprints::getSprintsByProjectId($project_id);
        $tree_by_sprints = SupportLeftSideBar::getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints);
        $users_by_project = User::getUsersByParticipantsId($project['participants_id']);
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();
        $task_attachemnts = TasksAttachments::getAttachmentsByTaskId($task_id);
        $schedules = SchedulesToUsers::getSchedulesToUserById(Auth::ID(), $task_id,'task');

        $curr_track_for_task = '';
        $flag_track = 0;
        $schedule_track_id = 0;
        $sum_my_time_for_task = SupportTimer::getSumTimerByTaskIdAndUserId($task_id,'task');

        foreach($schedules as $schedule){
            if ($schedule['flag_in_progress_th'] == 1){
                $curr_track_for_task = SupportTimer::getTimeToTask($schedule['track_from']);
                $sum_my_time_for_task = SupportTimer::sumTimer(array($sum_my_time_for_task,$curr_track_for_task));
                $flag_track = true;
                $schedule_track_id = $schedule['id'];
            }
        }

        $this->result_action['files_added'] = Session::get('files_added');

        return view('tasks.showsubtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'task'=>$task,
            'task_attachemnts'=>$task_attachemnts,
            'users'=>$users,
            'sprints'=>$sprints,
            'users_by_project'=>$users_by_project,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'tree_category_and_task'=>$tree_category_and_task,
            'tree_by_sprints'=>$tree_by_sprints,
            'schedules'=>$schedules,
            'curr_track_for_task'=>$curr_track_for_task,
            'sum_my_time_for_task'=>$sum_my_time_for_task,
            'flag_track'=>$flag_track,
            'schedule_track_id'=>$schedule_track_id,
            'result_action'=>$this->result_action
        ]);
    }

    public function showTask($project_id,$category_id,$task_id)
    {
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $bugs = Bugs::getBugsByProjectId($project_id);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $project = Projects::getProjectById($project_id);
        $task = Tasks::getTaskById($task_id);
        $task_attachments = TasksAttachments::getAttachmentsByTaskId($task_id);

        $users_by_project = User::getUsersByParticipantsId($project['participants_id']);
        $users = User::getUsers();
        $tasks_priority = TasksPriority::geTasksPriority();
        $tasks_statuses = TasksStatuses::geTasksStatuses();
        $sprints = Sprints::getSprintsByProjectId($project_id);
        $tree_by_sprints = SupportLeftSideBar::getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints);
        $schedules = SchedulesToUsers::getSchedulesToUserById(Auth::ID(),$task_id,'task');

        $curr_track_for_task = '';
        $flag_track = 0;
        $schedule_track_id = 0;
        $sum_my_time_for_task = SupportTimer::getSumTimerByTaskIdAndUserId($task_id,'task');

        foreach($schedules as $schedule){
            if ($schedule['flag_in_progress_th'] == 1){
                $curr_track_for_task = SupportTimer::getTimeToTask($schedule['track_from']);
                $sum_my_time_for_task = SupportTimer::sumTimer(array($sum_my_time_for_task,$curr_track_for_task));
                $flag_track = true;
                $schedule_track_id = $schedule['id'];
            }
        }

        //dd($sum_my_time_for_task);
        $this->result_action['files_added'] = Session::get('files_added');


        return view('tasks.showtask')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'project'=>$project,
            'task'=>$task,
            'task_attachments'=>$task_attachments,
            'users_by_project'=>$users_by_project,
            'users'=>$users,
            'tasks_priority'=>$tasks_priority,
            'tasks_statuses'=>$tasks_statuses,
            'sprints'=>$sprints,
            'tree_category_and_task'=>$tree_category_and_task,
            'tree_by_sprints'=>$tree_by_sprints,
            'schedules'=>$schedules,
            'curr_track_for_task'=>$curr_track_for_task,
            'sum_my_time_for_task'=>$sum_my_time_for_task,
            'flag_track'=>$flag_track,
            'schedule_track_id'=>$schedule_track_id,
            'result_action'=>$this->result_action
        ]);
    }

    public function updateTask(Request $request,$project_id,$category_id,$id)
    {
        try {
            $task_update = Tasks::updateTask($request, $category_id, $id);
           // return redirect()->route('projects.show',$project_id);
            return back();
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No update subtask/task';
            return response()->json($this->err);
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
