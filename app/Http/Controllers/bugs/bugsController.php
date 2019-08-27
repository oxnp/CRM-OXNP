<?php

namespace App\Http\Controllers\bugs;

use App\Http\Models\projects\CategoriesToProject;
use App\Http\Models\projects\Projects;
use App\Http\Models\projects\ProjectsCategories;
use App\Http\Models\supporting_function\SupportLeftSideBar;
use App\Http\Models\tasks\Tasks;
use App\Http\Models\bugs\BugsPriorities;
use App\Http\Models\bugs\BugsStatuses;
use App\Http\Models\users\UsersTest;
use Illuminate\Http\Request;
use App\Http\Models\bugs\Bugs;
use App\Http\Controllers\Controller;

class bugsController extends Controller
{
    public $err = array();
    public function showAddBugForm($project_id,$category_id){
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $bugs = Bugs::getBugsByProjectId($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $project = Projects::getProjectById($project_id);
        $users = UsersTest::getUsers();
        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $bugs_statuses = BugsStatuses::getBugsStatuses();
        $bugs_priorities = BugsPriorities::getBugsPriorities();

        return view('bugs.addbugs')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=> $categories_to_project,
            'project' => $project,
            'users'=>$users,
            'users_by_project'=>$users_by_project,
            'bugs_statuses'=>$bugs_statuses,
            'bugs_priorities'=>$bugs_priorities,
            'tree_category_and_task' =>$tree_category_and_task
        ]);
    }

    public function showBug($project_id,$category_id,$bug_id){
        $bug = Bugs::getBug($bug_id);
        $projects_categories = ProjectsCategories::getProjectsCategories();
        $categories_to_project = CategoriesToProject::getCategoriesToProjectById($project_id);
        $bugs = Bugs::getBugsByProjectId($project_id);
        $projects_categories = SupportLeftSideBar::getDiffCategory($categories_to_project,$projects_categories);
        $tasks = Tasks::getTasksByProjectId($project_id);
        $tree_category_and_task = SupportLeftSideBar::getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs);
        $project = Projects::getProjectById($project_id);
        $users_by_project = UsersTest::getUsersByParticipantsId($project['participants_id']);
        $users = UsersTest::getUsers();
        $bugs_statuses = BugsStatuses::getBugsStatuses();
        $bugs_priorities = BugsPriorities::getBugsPriorities();

        return view('bugs.showbugs')->with([
            'project_id'=>$project_id,
            'category_id'=>$category_id,
            'projects_categories'=>$projects_categories,
            'categories_to_project'=> $categories_to_project,
            'project' => $project,
            'bug'=>$bug,
            'users'=>$users,
            'users_by_project'=>$users_by_project,
            'bugs_statuses'=>$bugs_statuses,
            'bugs_priorities'=>$bugs_priorities,
            'tree_category_and_task' =>$tree_category_and_task
        ]);
    }

    public function addBug(Request $request,$project_id,$category_id){
        $add_bug = Bugs::addBug($request,$project_id,$category_id);
        if ($add_bug){
            return redirect()->to(route('projects_list').'/'.$project_id);
        }else{
            $this->err['create_bug'] = false;
            return  response()->json($this->err);
        }
    }

    public function updateBug(Request $request,$project_id,$category_id,$bug_id){
        $update_bug = Bugs::updateBug($request,$project_id,$category_id,$bug_id);
        if ($update_bug){
            return redirect()->to(route('projects_list').'/'.$project_id);
        }else{
            $this->err['update_bug'] = false;
            return  response()->json($this->err);
        }
    }


}
