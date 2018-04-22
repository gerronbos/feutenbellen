<?php
Route::get('/mailinglist', ['uses' => 'MailingController@getIndex','as' => 'mailinglist']);

Route::get('/resendmail/{user_id}', ['uses' => 'MailingController@resendMail','as' => 'resendmail']);