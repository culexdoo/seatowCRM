<?php

/*
 *	CoreApp - BoatsRoutes
 */
  
Route::group(array('prefix' => 'boats'), function()
{
	// Landing
	Route::get('/', array('as' => 'boatsLanding', 'uses' => 'BoatsController@getLanding'));
 
	// Membership entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'BoatsGetAddEntry', 'uses' => 'BoatsController@getAddEntry'));

		Route::post('new-entry', array('as' => 'BoatsPostAddEntry', 'uses' => 'BoatsController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'BoatsGetEditEntry', 'uses' => 'BoatsController@getEditEntry'));

		Route::post('change-entry', array('as' => 'BoatsPostEditEntry', 'uses' => 'BoatsController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'BoatsGetDeleteEntry', 'uses' => 'BoatsController@getDeleteEntry'));

	});



 
});

?>