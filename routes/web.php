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
/*projects*/
Route::get('/projects', "projects\projectsController@index")->name('projects_list');
Route::get('/projects/{id}', "projects\projectsController@show")->name('projects_detail');

Route::post('/projects', "projects\projectsController@create")->name('projects_add');
Route::put('/projects/{id}', "projects\projectsController@update")->name('projects_update');
/*projects*/

/*clients*/
Route::get('/clients', "clients\clientsController@index")->name('clients_list');
Route::get('/clients/{id}', "clients\clientsController@show")->name('clients_detail');

Route::post('/clients', "clients\clientsController@create")->name('clients_add');
Route::put('/clients/{id}', "clients\clientsController@update")->name('clients_update');

/*clients*/