<?php

namespace App\Http\Controllers\projects;

use App\Http\Models\sprints\Sprints;
use App\Http\Models\tasks\Tasks;
use App\Http\Models\bugs\Bugs;
use App\Http\Models\users\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\projects\Projects;
use App\Http\Models\projects\ProjectsStatuses;
use App\Http\Models\clients\Clients;
use App\Http\Models\projects\ProjectsAttachments;
use App\Http\Models\projects\ProjectsCategories;
use App\Http\Models\projects\CategoriesToProject;
use Session;
use App\Http\Models\supporting_function\SupportLeftSideBar;
class projectsController extends Controller
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
        $projects = Projects::getProjects();
        $clients = Clients::getClients();
        $project_statuses = ProjectsStatuses::getProjectsStatuses();
        $users = User::getUsers();
        return view('projects.projects')->with([
            'projects'=>$projects,
            'clients'=>$clients,
            'project_statuses'=>$project_statuses,
            'users'=>$users
        ]);
    }

    public function addCategoryToProjectById(Request $request, $id)
    {
        try {
            if (is_numeric($request->categoriestoproject)) {
                $add_caegory_to_project = CategoriesToProject::addCategoryToProjectById($id, $request->categoriestoproject);
            } else {
                $add_caegory_to_project = CategoriesToProject::addCategoryToProject($id, $request->categoriestoproject);
            }
            return redirect()->route('projects.show', $id);
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No add category to project';
            return response()->json($this->err);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $add_project = Projects::addProject($request);
            $this->storeAttachmentsByProjectId($request, $add_project['id']);
            return redirect()->route('projects.show', $add_project['id']);
        } catch (QueryException $exception) {
            $this->err['errors'] = 'No add project';
            return response()->json($this->err);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttachmentsByProjectId(Request $request, $id)
    {
        $count_files = count($request->file('files'));
        if($count_files > 0) {
            $files_added = 0;
            foreach ($request->file('files') as $file) {
                $storage = $file->store('public/projects/' . $id);
                $name_file = explode('/', $storage);
                $storage = '/storage/app/public/projects/' . $id . '/' . $name_file[3];
                $type_file = $file->getClientOriginalExtension();
                $project_attach = ProjectsAttachments::setAttachmentsByProjectId($id, $type_file, $storage);
                if ($project_attach) {
                    $files_added++;
                } else {
                    $this->err['attach_file'] = false;
                    return response()->json($this->err);
                }
            }
            return redirect()->route('projects.show',$id)->with(['files_added'=>$files_added]);
        }
        return redirect()->route('projects.show',$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($id);
        $bugs = Bugs::getBugsByProjectId($id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($id);
        $sprints = Sprints::getSprintsByProjectId($id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $tree_by_sprints = SupportLeftSideBar::getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints);

        $project = Projects::getProjectById($id);
        $client = Clients::getClientById($project['client_id']);
        $project_attachemnts = ProjectsAttachments::getAttachmentsByProjectId($id);
        $participants_user =  Projects::ProjectsParticipants($project['participants_id']);
        $project_statuses = ProjectsStatuses::getProjectsStatuses();
        $users = User::getUsers();
        $this->result_action['files_added'] = Session::get('files_added');

        return view('projects.project')->with([
            'projects_categories'=>$projects_categories,
            'categories_to_project'=>$categories_to_project,
            'client'=>$client,
            'project'=>$project,
            'participants_user'=>$participants_user,
            'project_attachemnts'=>$project_attachemnts,
            'project_statuses'=>$project_statuses,
            'users'=>$users,
            'sprints'=>$sprints,
            'tree_category_and_task'=>$tree_category_and_task,
            'tree_by_sprints'=>$tree_by_sprints,
            'result_action'=>$this->result_action
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
            return redirect()->route('projects.show',$id);
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
