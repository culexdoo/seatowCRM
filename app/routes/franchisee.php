<?php

/*
 *	CoreApp - FranchiseeRoutes
 */
  
Route::group(array('prefix' => 'franchisee'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'franchiseeLanding', 'uses' => 'FranchiseeController@getLanding'));
 
	// Franchisee entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'FranchiseeGetAddEntry', 'uses' => 'FranchiseeController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'FranchiseePostAddEntry', 'uses' => 'FranchiseeController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'FranchiseeGetEditEntry', 'uses' => 'FranchiseeController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'FranchiseePostEditEntry', 'uses' => 'FranchiseeController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'FranchiseeGetDeleteEntry', 'uses' => 'FranchiseeController@getDeleteEntry'));

	});



 
});

?>