<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsStatuses extends Model
{
    /*get project statuses*/
    public static function getProjectsStatuses():array{
       $project_statuses = ProjectsStatuses::all()->toArray();
       return $project_statuses;
    }
}
