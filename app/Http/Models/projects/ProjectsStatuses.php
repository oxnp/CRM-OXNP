<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsStatuses extends Model
{
    /*get project statuses
    * @param
    * @return array
    */
    public static function getProjectsStatuses():array{
       $project_statuses = ProjectsStatuses::all()->toArray();
       return $project_statuses;
    }
}
