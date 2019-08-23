<?php

namespace App\Http\Models\supporting_function;

use Illuminate\Database\Eloquent\Model;

class SupportLeftSideBar extends Model
{
    public static function getTreeCategoryAndTasks($categories_to_project,$tasks){
        $tree_category_and_task = array();
        foreach ($categories_to_project as $key_category => $category) {
            $tree_category_and_task[$category['name']][$category['category_id']][] ='';
            if (!empty($tasks)) {
                foreach ($tasks as $key_task => $task) {
                    if ($task['category_id'] == $category['category_id'] && $task['relative_task_id'] == '0') {
                        $tree_category_and_task[$category['name']][$category['category_id']][$task['id']] = $task;
                        foreach ($tasks as $k => $v) {
                            if ($task['id'] == $v['relative_task_id'] && $task['category_id'] == $category['category_id']) {
                                $tree_category_and_task[$category['name']][$category['category_id']][$task['id']]['subtasks'][] = $v;
                            }
                        }
                    }
                }
            }
        }
        return $tree_category_and_task;
    }

    public static function getDiffCategory($categories_to_project,$projects_categories){
        foreach($projects_categories as $key=>$projects_category){
            foreach($categories_to_project as $project_to_category)
                if($projects_category['name'] == $project_to_category['name']) {
                    unset($projects_categories[$key]);
                }
        }
        return $projects_categories;
    }

}
