<?php
Route::get('/calls', ['uses' => 'CallController@getIndex','as' => 'calls']);

Route::get('/call/{pledge_id}', ['uses' => 'CallController@getShow','as' => 'call.show']);
Route::post('/call/{pledge_id}', ['uses' => 'CallController@postShow']);

Route::post('/call/{pledge_id}/saveCall', ['uses' => 'CallController@saveShow', "as" => "call.save"]);

Route::get("/singup/{pledge_id}",["uses" => "SingupController@getByUser", "as" => "call.singup"]);
Route::post("/singup/{pledge_id}",["uses" => "SingupController@postByUser"]);


