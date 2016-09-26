<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cadastro', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'web'], function () {

    Route::get('roles', ['as' => 'roles.index', 'uses' => 'Admin\RolesController@index']);
    Route::put('roles/update/{id}', ['as' => 'roles.update', 'uses' => 'Admin\RolesController@update']);
    Route::get('roles/permissions/{id}', ['as' => 'roles.permissions', 'uses' => 'Admin\RolesController@permissions']);
    Route::post('roles/permissions/{id}/store', ['as' => 'roles.permissions.store', 'uses' => 'Admin\RolesController@storePermission']);
    Route::get('roles/permissions/{id}/revoke/{permission_id}', ['as' => 'roles.permissions.revoke', 'uses' => 'Admin\RolesController@revokePermission']);

    Route::get('users', ['as' => 'users.index', 'uses' => 'Admin\UsersController@index']);
    Route::get('users/roles/{id}', ['as' => 'users.roles', 'uses' => 'Admin\UsersController@roles']);
    Route::post('users/roles/{id}/store', ['as' => 'users.roles.store', 'uses' => 'Admin\UsersController@storeRole']);
    Route::get('users/roles/{id}/revoke/{role_id}', ['as' => 'users.roles.revoke', 'uses' => 'Admin\UsersController@revokeRole']);
});