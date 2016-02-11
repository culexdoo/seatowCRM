<?php

/*
 *	CoreApp - ClassifiedsDemandRoutes
 */
  
Route::group(array('prefix' => 'classifieds-demand'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'ClassifiedsDemandLanding', 'uses' => 'ClassifiedsDemandController@getLanding'));
 
	// ClassifiedsDemand entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'ClassifiedsDemandGetAddEntry', 'uses' => 'ClassifiedsDemandController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'ClassifiedsDemandPostAddEntry', 'uses' => 'ClassifiedsDemandController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'ClassifiedsDemandGetEditEntry', 'uses' => 'ClassifiedsDemandController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'ClassifiedsDemandPostEditEntry', 'uses' => 'ClassifiedsDemandController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'ClassifiedsDemandGetDeleteEntry', 'uses' => 'ClassifiedsDemandController@getDeleteEntry'));

	});



 
});

?>