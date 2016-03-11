<?php

Route::group(['prefix' => config('usermanager.prefix'), 'middleware' => config('usermanager.middleware')], function() {
    /**
     * All the routes for the users
     */
    Route::get('users', ['as' => 'user.manager.index', 'uses' => 'UsersController@index']);
    Route::post('users', ['as' => 'user.manager.store', 'uses' => 'UsersController@store']);
    Route::get('users/create', ['as' => 'user.manager.create', 'uses' => 'UsersController@create']);
    Route::delete('users/{users}', ['as' => 'user.manager.destroy', 'uses' => 'UsersController@destroy']);
    Route::put('users/{users}', ['as' => 'user.manager.update', 'uses' => 'UsersController@update']);
    Route::patch('users/{users}', 'UsersController@update');
    Route::get('users/{users}/edit', ['as' => 'user.manager.edit', 'uses' => 'UsersController@edit']);
    Route::post('users/{users}/restore', ['as' => 'user.manager.restore', 'uses' => 'UsersController@restore']);
    Route::delete('users/{users}/permanently-destroy', ['as' => 'user.manager.permanentlyDestroy', 'uses' => 'UsersController@permanentlyDestroy']);

    /**
     * All the routes for the roles
     */
    Route::get('roles', ['as' => 'role.manager.index', 'uses' => 'RolesController@index']);
    Route::post('roles', ['as' => 'role.manager.store', 'uses' => 'RolesController@store']);
    Route::get('roles/create', ['as' => 'role.manager.create', 'uses' => 'RolesController@create']);
    //Route::get('roles/{roles}', ['as' => 'role.manager.show', 'uses' => 'RolesController@show']);
    Route::delete('roles/{roles}', ['as' => 'role.manager.destroy', 'uses' => 'RolesController@destroy']);
    Route::put('roles/{roles}', ['as' => 'role.manager.update', 'uses' => 'RolesController@update']);
    Route::patch('roles/{roles}', 'RolesController@update');
    Route::get('roles/{roles}/edit', ['as' => 'role.manager.edit', 'uses' => 'RolesController@edit']);
});
