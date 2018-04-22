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

require "routes/auth.php";

Route::group(['middleware' => ['auth']], function () {
    require "routes/dashboard.php";
    require "routes/calls.php";
    require "routes/pledges.php";
    require "routes/mails.php";
    require "routes/user.php";
    require "routes/stats.php";
});


Route::get('/calls/calls', ['uses' => 'CallController@getCalled']);
Route::get('/calls/notcalls', ['uses' => 'CallController@getNotCalled']);
Route::get('/api/pledges', ['uses' => 'PledgeController@getPledges']);
Route::get('/api/pledge/{pledge_id}', ['uses' => 'PledgeController@getPledge',"as"=>"api.pledge.get"]);

Route::get('/singup', ['uses' => 'SingupController@getIndex']);

