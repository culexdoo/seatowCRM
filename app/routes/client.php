<?php

/*
 *	CoreApp - ClientRoutes
 */
  
Route::group(array('prefix' => 'client'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'clientLanding', 'uses' => 'ClientController@getLanding'));
 
	// Membership entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'ClientGetAddEntry', 'uses' => 'ClientController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'ClientPostAddEntry', 'uses' => 'ClientController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'ClientGetEditEntry', 'uses' => 'ClientController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'ClientPostEditEntry', 'uses' => 'ClientController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'ClientGetDeleteEntry', 'uses' => 'ClientController@getDeleteEntry'));

		Route::get('add-event/{id}', array('before' => 'auth', 'as' => 'EventGetAddEvent', 'uses' => 'EventController@getAddEvent'));

		Route::post('new-event', array('before' => 'auth', 'as' => 'EventPostAddEvent', 'uses' => 'EventController@postAddEvent'));

		Route::get('edit-event/{id}', array('before' => 'auth', 'as' => 'EventGetEditEvent', 'uses' => 'EventController@getEditEvent'));


	});



 
});

?>