<?php
Route::get('/', ['uses' => 'DashboardController@getIndex','as' => 'dashboard']);