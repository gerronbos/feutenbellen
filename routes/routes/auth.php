<?php

Route::get('auth', ['uses' => 'AuthController@getLogin','as' => 'login']);
Route::post('auth', ['uses' => 'AuthController@postLogin']);

Route::get('auth.logout', ['uses' => 'AuthController@getLogout','as' => 'logout']);