<?php
Route::get('/stats', ['uses' => 'StatsController@getIndex','as' => 'stats']);