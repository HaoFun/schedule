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

Route::group(['namespace' => 'Api'], function ($route) {
    $route->post('auth/register', 'AuthorizationController@signUp')->name('auth.register');

    $route->group(['middleware' => 'with.oauth'], function ($route) {
        $route->post('auth/login', 'AuthorizationController@store')->name('auth.login');
        $route->put('auth/refresh', 'AuthorizationController@refresh')->name('auth.refresh');
    });

    $route->group(['middleware' => 'auth:api'], function ($route) {
        $route->resource('departments', 'DepartmentController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

        $route->resource('types', 'TypeController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

        $route->resource('trackers', 'TrackerController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

        $route->get('projects/search', 'ProjectController@search')->name('projects.search');
        $route->get('projects/{project}/history', 'ProjectController@history')->name('projects.history');
        $route->resource('projects', 'ProjectController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

        $route->get('issues/search', 'IssueController@search')->name('issues.search');
        $route->get('issues/{issue}/history', 'IssueController@history')->name('issues.history');
        $route->resource('issues', 'IssueController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

        $route->resource('contents', 'ContentController', ['only' => ['show', 'update', 'destroy']]);

        $route->put('todos/{todo}/toggle', 'TodoController@toggle')->name('todos.toggle');
        $route->get('todos/search', 'TodoController@search')->name('todos.search');
        $route->resource('todos', 'TodoController', ['only' => ['show', 'store', 'update', 'destroy']]);

        $route->get('auth/me', 'AuthorizationController@me')->name('auth.me');
        $route->delete('auth/logout', 'AuthorizationController@destroy')->name('auth.logout');
        $route->patch('auth/{auth}/update', 'AuthorizationController@update')->name('auth.update');
        $route->delete('auth/{auth}', 'AuthorizationController@userDestroy')->name('auth.destroy');
    });
});