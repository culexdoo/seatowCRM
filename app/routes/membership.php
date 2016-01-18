<?php

/*
 *	CoreApp - MembershipRoutes
 */
  
Route::group(array('prefix' => 'membership'), function()
{
	// Landing
	Route::get('/', array('as' => 'membershipLanding', 'uses' => 'MembershipController@getLanding'));
 
	// Membership entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'MembershipGetAddEntry', 'uses' => 'MembershipController@getAddEntry'));

		Route::post('new-entry', array('as' => 'MembershipPostAddEntry', 'uses' => 'MembershipController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'MembershipGetEditEntry', 'uses' => 'MembershipController@getEditEntry'));

		Route::post('change-entry', array('as' => 'MembershipPostEditEntry', 'uses' => 'MembershipController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'MembershipGetDeleteEntry', 'uses' => 'MembershipController@getDeleteEntry'));

	});



 
});

?>