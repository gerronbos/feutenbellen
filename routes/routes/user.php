<?php
Route::get('/users', ['uses' => 'UserController@getIndex','as' => 'users']);

Route::get('/users/new', ['uses' => 'UserController@getNew','as' => 'users.new']);
Route::post('/users/new', ['uses' => 'UserController@postNew']);

Route::get('/users/{user_id}', ['uses' => 'UserController@getEdit','as' => 'users.edit']);
Route::post('/users/{user_id}', ['uses' => 'UserController@postEdit','as']);





