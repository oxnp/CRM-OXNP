<?php

namespace App\Http\Models\projects;

use App\Http\Models\projects\ProjectsCategories;
use Illuminate\Database\Eloquent\Model;


class CategoriesToProject extends Model
{
    public $table ='categories_to_project';
    public $timestamps = false;
    protected $fillable = ['project_id','category_id'];

    /* Add category to project and to list category*/
    public static function addCategoryToProject($id,$name){
        $add_category = ProjectsCategories::create([
            'name'=> $name
        ]);
        if ($add_category){
            $category_data = $add_category->toArray();
            $add_category_to_project = parent::addCategoryToProjectById($id,$category_data['id']);
            return $add_category_to_project;
        }else{
            return false;
        }
    }

    /* Add category to project and to list category by id */
    public static function addCategoryToProjectById($id,$category_id){
        $add_category_to_project = CategoriesToProject::create([
            'project_id'=>$id,
            'category_id'=>$category_id
        ]);
        if($add_category_to_project ){
            return $add_category_to_project->toArray();
        }else{
            return false;
        }
    }
    /* get categories by project ID*/
    public static function getCategoriesToProjectById($id):array{
        $categories_to_project = CategoriesToProject::where('project_id',$id)
            ->leftjoin(parent::getProjectsCategoriesTableName(),parent::getProjectsCategoriesTableName().'.id','=','category_id')
            ->get()->toArray();
         return $categories_to_project;

    }
    /* get table name*/
    public function getProjectsCategoriesTableName():string {
        return  with(new ProjectsCategories)->getTable();
    }
}
