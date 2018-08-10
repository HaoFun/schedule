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

Route::get('/', function () {
    return \App\Models\User::find(1)->projects[1]->contents()->create([
        'content_body' => 'Test_Create',
        'created_by' => 1,
        'updated_by' => 1
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
