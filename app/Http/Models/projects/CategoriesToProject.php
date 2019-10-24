<?php

namespace App\Http\Models\projects;

use App\Http\Models\projects\ProjectsCategories;
use Illuminate\Database\Eloquent\Model;


class CategoriesToProject extends Model
{
    public $table ='categories_to_project';
    public $timestamps = false;
    protected $fillable = ['project_id','category_id'];

    /**
     * Add category to project and to list category
    * @param int $id, string $name
    * @return array
    */
    public static function addCategoryToProject($id,$name){
        $add_category = ProjectsCategories::create([
            'name'=> $name
        ])->toArray();
    return  $add_category;
    }

    /**
     * Add category to project and to list category by id
    * @param int $id, int $category_id
    * @return array or false
    */
    public static function addCategoryToProjectById($project_id,$name){

        $category_id = ProjectsCategories::whereName($name)->get()->toArray();

        if(empty($category_id)){
            $search_cat = parent::addCategoryToProject($project_id,$name);
            $category_id = $search_cat['id'];
        }else{
            $category_id = $category_id[0]['id'];
        }

        $add_category_to_project = CategoriesToProject::create([
            'project_id'=>$project_id,
            'category_id'=>$category_id
        ]);

        if($add_category_to_project ){
            return $add_category_to_project->toArray();
        }else{
            return false;
        }
    }
    /**
     * get categories by project ID
    * @param int $id
    * @return array
    */
    public static function getCategoriesToProjectById($id):array{
        $categories_to_project = CategoriesToProject::where('project_id',$id)
            ->leftjoin(parent::getProjectsCategoriesTableName(),parent::getProjectsCategoriesTableName().'.id','=','category_id')
            ->get()->toArray();
         return $categories_to_project;

    }
    /**
     * get table name
    * @param
    * @return string
    */
    public function getProjectsCategoriesTableName():string {
        return  with(new ProjectsCategories)->getTable();
    }
}
