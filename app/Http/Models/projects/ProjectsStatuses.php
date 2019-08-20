<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsStatuses extends Model
{
    public static function getProjectsStatuses(){
       $project_statuses = ProjectsStatuses::all();
       return $project_statuses;
    }
}
