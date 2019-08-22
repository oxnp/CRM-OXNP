<?php

namespace App\Http\Models\projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsCategories extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    public static function getProjectsCategories(){
       $projects_categories = ProjectsCategories::all()->toArray();
        return $projects_categories;
    }
}
