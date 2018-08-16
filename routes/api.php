<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function ($route) {
    $route->resource('departments', 'DepartmentController');
    $route->resource('trackers', 'TrackerController');
    $route->get('projects/search', 'ProjectController@search')->name('projects.search');
    $route->get('projects/{project}/history', 'ProjectController@history')->name('projects.history');
    $route->resource('projects', 'ProjectController');
});