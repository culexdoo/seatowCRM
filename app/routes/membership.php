<?php

/*
 *	CoreApp - MembershipRoutes
 */
  
Route::group(array('prefix' => 'membership'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'membershipLanding', 'uses' => 'MembershipController@getLanding'));
 
	// Membership entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'MembershipGetAddEntry', 'uses' => 'MembershipController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'MembershipPostAddEntry', 'uses' => 'MembershipController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'MembershipGetEditEntry', 'uses' => 'MembershipController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'MembershipPostEditEntry', 'uses' => 'MembershipController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'MembershipGetDeleteEntry', 'uses' => 'MembershipController@getDeleteEntry'));

	});



 
});

?>