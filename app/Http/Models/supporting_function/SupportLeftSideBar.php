<?php

namespace App\Http\Models\supporting_function;

use Illuminate\Database\Eloquent\Model;

class SupportLeftSideBar extends Model
{
    /*get left tree menu
    * @param array $categories_to_project, array $tasks, array $bugs
    * @return array
    */
    public static function getTreeCategoryAndTasks($categories_to_project,$tasks,$bugs):array{
        $tree_category_and_task = array();
        foreach ($categories_to_project as $key_category => $category) {
            $tree_category_and_task[$category['name']][$category['category_id']][] ='';
            if (!empty($tasks) || !empty($bugs)) {

                foreach ($tasks as $key_task => $task) {
                    if ($task['category_id'] == $category['category_id'] && $task['relative_task_id'] == '0') {
                        $tree_category_and_task[$category['name']][$category['category_id']]['tasks'][$task['id']] = $task;
                        foreach ($tasks as $k => $v) {
                            if ($task['id'] == $v['relative_task_id'] && $task['category_id'] == $category['category_id']) {
                                $tree_category_and_task[$category['name']][$category['category_id']]['tasks'][$task['id']]['subtasks'][] = $v;
                            }
                        }
                    }
                }
                foreach ($bugs as $key_bugs => $bug) {
                    if ($bug['category_id'] == $category['category_id']) {
                        $tree_category_and_task[$category['name']][$category['category_id']]['bugs'][] = $bug;
                     }
                }
            }
        }
        return $tree_category_and_task;
    }
    /*get different category on list category and project category
    * @param array $categories_to_project, array $projects_categories
    * @return array
    */
    public static function getDiffCategory($categories_to_project,$projects_categories):array{
        foreach($projects_categories as $key=>$projects_category){
            foreach($categories_to_project as $project_to_category)
                if($projects_category['name'] == $project_to_category['name']) {
                    unset($projects_categories[$key]);
                }
        }
        return $projects_categories;
    }
    /*get left tree menu by sprint
    * @param array $categories_to_project, array $tasks, array $bugs, array $sprints
    * @return array
    */
    public static function getTreeTasksAndBugsBySprints($categories_to_project,$tasks,$bugs,$sprints)
    {
        $tree = array();
        foreach($sprints as $key=>$sprint){
            foreach($categories_to_project as $categories){
                foreach($tasks as $keytask=>$task){
                      if($task['sprint_id'] == $sprint['id'] && $categories['id'] == $task['category_id']){
                        $tree[$sprint['name']][$categories['name']]['tasks'][$task['id']] = $task;
                        foreach($tasks as $key=>$value){
                            if ($task['id'] == $value['relative_task_id']){
                                $tree[$sprint['name']][$categories['name']]['tasks'][$task['id']]['subtasks'][] = $value;
                            }
                        }
                    }
                }
                foreach($bugs as $keybug=>$bug){
                    if($bug['sprint_id'] == $sprint['id']  && $categories['id'] == $bug['category_id']){
                        $tree[$sprint['name']][$categories['name']]['bugs'][] = $bug;
                    }
                }
            }
        }
        return $tree;
    }

}
