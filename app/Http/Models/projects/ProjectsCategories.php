<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsCategories extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    /*get project categories
    * @param
    * @return array
    */
    public static function getProjectsCategories():array{
       $projects_categories = ProjectsCategories::all()->toArray();
        return $projects_categories;
    }
}
