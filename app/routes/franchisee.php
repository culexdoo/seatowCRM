<?php

/*
 *	CoreApp - FranchiseeRoutes
 */
  
Route::group(array('prefix' => 'franchisee'), function()
{
	// Landing
	Route::get('/', array('as' => 'franchiseeLanding', 'uses' => 'FranchiseeController@getLanding'));
 
	// Franchisee entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'FranchiseeGetAddEntry', 'uses' => 'FranchiseeController@getAddEntry'));

		Route::post('new-entry', array('as' => 'FranchiseePostAddEntry', 'uses' => 'FranchiseeController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'FranchiseeGetEditEntry', 'uses' => 'FranchiseeController@getEditEntry'));

		Route::post('change-entry', array('as' => 'FranchiseePostEditEntry', 'uses' => 'FranchiseeController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'FranchiseeGetDeleteEntry', 'uses' => 'FranchiseeController@getDeleteEntry'));

	});



 
});

?>