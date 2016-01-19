<?php

/*
 *	CoreApp - BoatsRoutes
 */
  
Route::group(array('prefix' => 'boats'), function()
{
	// Landing
	Route::get('/', array('as' => 'boatsLanding', 'uses' => 'BoatsController@getLanding'));
 
	// Boats entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'BoatsGetAddEntry', 'uses' => 'BoatsController@getAddEntry'));

		Route::post('new-entry', array('as' => 'BoatsPostAddEntry', 'uses' => 'BoatsController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'BoatsGetEditEntry', 'uses' => 'BoatsController@getEditEntry'));

		Route::post('change-entry', array('as' => 'BoatsPostEditEntry', 'uses' => 'BoatsController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'BoatsGetDeleteEntry', 'uses' => 'BoatsController@getDeleteEntry'));

	});
		// Boat_Hull entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'boat-hull'), function()
	{
 
		Route::get('add-hull', array('as' => 'BoatsGetAddHull', 'uses' => 'BoatsController@getAddHull'));

		Route::post('new-hull', array('as' => 'BoatsPostAddHull', 'uses' => 'BoatsController@postAddHull'));

		Route::get('edit-hull/{id}', array('as' => 'BoatsGetEditHull', 'uses' => 'BoatsController@getEditHull'));

		Route::post('change-hull', array('as' => 'BoatsPostEditHull', 'uses' => 'BoatsController@postEditHull'));

		Route::get('delete-hull/{id}', array('as' => 'BoatsGetDeleteHull', 'uses' => 'BoatsController@getDeleteHull'));

	});

		// Boat_Make entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'boat-make'), function()
	{
 
		Route::get('add-make', array('as' => 'BoatsGetAddMake', 'uses' => 'BoatsController@getAddMake'));

		Route::post('new-make', array('as' => 'BoatsPostAddMake', 'uses' => 'BoatsController@postAddMake'));

		Route::get('edit-make/{id}', array('as' => 'BoatsGetEditMake', 'uses' => 'BoatsController@getEditMake'));

		Route::post('change-make', array('as' => 'BoatsPostEditMake', 'uses' => 'BoatsController@postEditMake'));

		Route::get('delete-make/{id}', array('as' => 'BoatsGetDeleteMake', 'uses' => 'BoatsController@getDeleteMake'));

	});







 
});

?>