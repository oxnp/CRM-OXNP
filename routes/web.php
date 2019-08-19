<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/projects', "projects\projectsController@index")->name('projects_list');
Route::get('/projects/{id}', "projects\projectsController@show")->name('projects_detail');
