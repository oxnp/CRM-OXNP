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
/*projects*/
Route::get('/projects', 'projects\projectsController@index')->name('projects_list');
Route::get('/projects/{id}', 'projects\projectsController@show')->name('projects_detail');

Route::post('/projects', 'projects\projectsController@create')->name('projects_add');
Route::put('/projects/{id}', 'projects\projectsController@update')->name('projects_update');

Route::post('/projects-attachments/{id}', 'projects\projectsController@storeAttachmentsByProjectId')->name('projects_attachment_by_id');

Route::post('/projects-category/{id}', 'projects\projectsController@addCategoryToProjectById')->name('add_category_to_project');
/*projects*/

/*clients*/
Route::get('/clients', 'clients\clientsController@index')->name('clients_list');
Route::get('/clients/{id}', 'clients\clientsController@show')->name('clients_detail');

Route::post('/clients', 'clients\clientsController@create')->name('clients_add');
Route::put('/clients/{id}', 'clients\clientsController@update')->name('clients_update');
/*clients*/

/*tasks*/
Route::get('/projects/{project_id}/category/{category_id}/add-task', 'tasks\tasksController@showAddTaskForm')->name('show_add_task_form');
Route::post('/projects/{project_id}/category/{category_id}/add-task', 'tasks\tasksController@addTaskByProjectIdAndCategoryId')->name('tasks_add');

Route::get('/projects/{project_id}/category/{category_id}/task/{task_id}/add-subtask', 'tasks\tasksController@showSubAddTaskForm')->name('show_add_sub_task_form');
Route::post('/projects/{project_id}/category/{category_id}/task/{task_id}/add-subtask', 'tasks\tasksController@SubAddTask')->name('add_sub_task');

Route::get('/projects/{project_id}/category/{category_id}/task/{task_id}', 'tasks\tasksController@showTask')->name('tasks_show_detail');
Route::post('/projects/{project_id}/category/{category_id}/task/{task_id}', 'tasks\tasksController@updateTask')->name('tasks_update');

Route::get('/projects/{project_id}/category/{category_id}/subtask/{task_id}', 'tasks\tasksController@showSubTask')->name('subtasks_show_detail');
//Route::post('/projects/{project_id}/category/{category_id}/subtask/{task_id}', 'tasks\tasksController@updateSubTask')->name('subtasks_update');

/*tasks*/