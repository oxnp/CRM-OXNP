<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
/*projects*/
Route::resource('projects', 'projects\projectsController');

Route::post('/projects-attachments/{id}', 'projects\projectsController@storeAttachmentsByProjectId')->name('projects_attachment_by_id');
Route::post('/projects-category/{id}', 'projects\projectsController@addCategoryToProjectById')->name('add_category_to_project');
/*projects*/

/*clients*/
Route::resource('clients', 'clients\clientsController');
/*clients*/

/*tasks */
Route::get('/projects/{project_id}/category/{category_id}/add-task', 'tasks\tasksController@showAddTaskForm')->name('show_add_task_form');
Route::post('/projects/{project_id}/category/{category_id}/add-task', 'tasks\tasksController@addTask')->name('tasks_add');
Route::get('/projects/{project_id}/category/{category_id}/task/{task_id}/add-subtask', 'tasks\tasksController@showAddSubTaskForm')->name('show_add_sub_task_form');
Route::post('/projects/{project_id}/category/{category_id}/task/{task_id}/add-subtask', 'tasks\tasksController@SubAddTask')->name('add_sub_task');
Route::get('/projects/{project_id}/category/{category_id}/task/{task_id}', 'tasks\tasksController@showTask')->name('tasks_show_detail');
Route::put('/projects/{project_id}/category/{category_id}/task/{task_id}', 'tasks\tasksController@updateTask')->name('tasks_update');
Route::get('/projects/{project_id}/category/{category_id}/subtask/{task_id}', 'tasks\tasksController@showSubTask')->name('subtasks_show_detail');
Route::post('/projects/{project_id}/category/{category_id}/subtask/{task_id}', 'tasks\tasksController@updateSubTask')->name('subtasks_update');
Route::post('/tasks-attachments/projects/{project_id}/task/{task_id}', 'tasks\tasksController@storeAttachmentsByTaskId')->name('tasks_attachment_by_id');
/*tasks*/

/*bugs*/

Route::get('/projects/{project_id}/category/{category_id}/bug', 'bugs\bugsController@showAddBugForm')->name('show_add_bug_form');
Route::get('/projects/{project_id}/category/{category_id}/bug/{bug_id}', 'bugs\bugsController@showBug')->name('show_bug');
Route::post('/projects/{project_id}/category/{category_id}/bug', 'bugs\bugsController@addBug')->name('add_bug');
Route::put('/projects/{project_id}/category/{category_id}/bug/{bug_id}', 'bugs\bugsController@updateBug')->name('update_bug');

Route::post('/bugs-attachments/projects/{project_id}/bug/{bug_id}', 'bugs\bugsController@storeAttachmentsByBugId')->name('bugs_attachment_by_id');
/*bugs*/

/*sprints*/
Route::post('/projects/{project_id}/sprints/add-sprint', 'sprints\sprintsController@addSprint')->name('sprints_add');
/*sprints*/

/*tracker*/
Route::put('/projects/{project_id}/task/{task_id}/tracker/{track_id}/type/{type}/stop', 'tracker\trackerController@stopTrack')->name('stop_track');
Route::post('/projects/{project_id}/task/{task_id}/tracker/type/{type}/start', 'tracker\trackerController@startTrack')->name('start_track');
/*tracker*/

/*inventory*/
Route::resource('inventories', 'inventories\inventoriesController');
/*inventory*/

