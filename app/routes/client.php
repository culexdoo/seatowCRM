<?php

/*
 *	CoreApp - ClientRoutes
 */
  
Route::group(array('prefix' => 'client'), function()
{
	// Landing
	Route::get('/', array('as' => 'clientLanding', 'uses' => 'ClientController@getLanding'));
 
	// Membership entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'ClientGetAddEntry', 'uses' => 'ClientController@getAddEntry'));

		Route::post('new-entry', array('as' => 'ClientPostAddEntry', 'uses' => 'ClientController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'ClientGetEditEntry', 'uses' => 'ClientController@getEditEntry'));

		Route::post('change-entry', array('as' => 'ClientPostEditEntry', 'uses' => 'ClientController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'ClientGetDeleteEntry', 'uses' => 'ClientController@getDeleteEntry'));

		Route::get('add-event/{id}', array('as' => 'EventGetAddEvent', 'uses' => 'EventController@getAddEvent'));

		Route::post('new-event', array('as' => 'EventPostAddEvent', 'uses' => 'EventController@postAddEvent'));

		Route::get('edit-event/{id}', array('as' => 'EventGetEditEvent', 'uses' => 'EventController@getEditEvent'));


	});



 
});

?>