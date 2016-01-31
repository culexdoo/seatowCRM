<?php

/*
 *	CoreApp - Superadmin
 */
  
Route::group(array('prefix' => 'superadmin'), function()
{
	// Landing
	Route::get('/', array('as' => 'superadminLanding', 'uses' => 'CoreController@getSuperAdmin'));
 
	// Invoice entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'SuperAdminGetAddEntry', 'uses' => 'CoreController@getSuperAdmin'));

		Route::post('new-entry', array('as' => 'SuperAdminPostAddEntry', 'uses' => 'CoreController@postSuperAdmin'));

	});



 
});

?>