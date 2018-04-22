<?php
Route::get('/pledges', ['uses' => 'PledgeController@getIndex','as' => 'pledges']);

Route::get('/pledges/new', ['uses' => 'PledgeController@getNew','as' => 'pledges.new']);
Route::post('/pledges/new', ['uses' => 'PledgeController@postNew']);

Route::get('/pledges/edit/{id}', ['uses' => 'PledgeController@getEdit','as' => 'pledges.edit']);
Route::post('/pledges/edit/{id}', ['uses' => 'PledgeController@postEdit']);




Route::get('/pledges/import', ['uses' => 'PledgeController@getImport','as' => 'pledges.import']);
Route::post('/pledges/import', ['uses' => 'PledgeController@postImport']);

Route::get("duplicates", ['uses' => 'PledgeController@getDups','as' => 'pledges.dups']);

Route::get("duplicates/{user_id}/setstatus/{status}", ['uses' => 'PledgeController@setDupStatus','as' => 'pledges.dups.set.status']);







