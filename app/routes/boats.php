<?php

/*
 *	CoreApp - BoatsRoutes
 */
  
Route::group(array('prefix' => 'boats'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'boatsLanding', 'uses' => 'BoatsController@getLanding'));
 
	// Boats entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'BoatsGetAddEntry', 'uses' => 'BoatsController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'BoatsPostAddEntry', 'uses' => 'BoatsController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'BoatsGetEditEntry', 'uses' => 'BoatsController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'BoatsPostEditEntry', 'uses' => 'BoatsController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'BoatsGetDeleteEntry', 'uses' => 'BoatsController@getDeleteEntry'));

	});
		// Boat_Hull entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'boat-hull'), function()
	{
 
		Route::get('add-hull', array('before' => 'auth', 'as' => 'BoatsGetAddHull', 'uses' => 'BoatsController@getAddHull'));

		Route::post('new-hull', array('before' => 'auth', 'as' => 'BoatsPostAddHull', 'uses' => 'BoatsController@postAddHull'));

		Route::get('edit-hull/{id}', array('before' => 'auth', 'as' => 'BoatsGetEditHull', 'uses' => 'BoatsController@getEditHull'));

		Route::post('change-hull', array('before' => 'auth', 'as' => 'BoatsPostEditHull', 'uses' => 'BoatsController@postEditHull'));

		Route::get('delete-hull/{id}', array('before' => 'auth', 'as' => 'BoatsGetDeleteHull', 'uses' => 'BoatsController@getDeleteHull'));

	});

		// Boat_Make entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'boat-make'), function()
	{
 
		Route::get('add-make', array('before' => 'auth', 'as' => 'BoatsGetAddMake', 'uses' => 'BoatsController@getAddMake'));

		Route::post('new-make', array('before' => 'auth', 'as' => 'BoatsPostAddMake', 'uses' => 'BoatsController@postAddMake'));

		Route::get('edit-make/{id}', array('before' => 'auth', 'as' => 'BoatsGetEditMake', 'uses' => 'BoatsController@getEditMake'));

		Route::post('change-make', array('before' => 'auth', 'as' => 'BoatsPostEditMake', 'uses' => 'BoatsController@postEditMake'));

		Route::get('delete-make/{id}', array('before' => 'auth', 'as' => 'BoatsGetDeleteMake', 'uses' => 'BoatsController@getDeleteMake'));

	});







 
});

?>