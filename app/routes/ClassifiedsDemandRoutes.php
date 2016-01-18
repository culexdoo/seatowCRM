<?php

/*
 *	CoreApp - ClassifiedsDemandRoutes
 */
  
Route::group(array('prefix' => 'classifieds-demand'), function()
{
	// Landing
	Route::get('/', array('as' => 'ClassifiedsDemandLanding', 'uses' => 'ClassifiedsDemandController@getLanding'));
 
	// ClassifiedsDemand entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'ClassifiedsDemandGetAddEntry', 'uses' => 'ClassifiedsDemandController@getAddEntry'));

		Route::post('new-entry', array('as' => 'ClassifiedsDemandPostAddEntry', 'uses' => 'ClassifiedsDemandController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'ClassifiedsDemandGetEditEntry', 'uses' => 'ClassifiedsDemandController@getEditEntry'));

		Route::post('change-entry', array('as' => 'ClassifiedsDemandPostEditEntry', 'uses' => 'ClassifiedsDemandController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'ClassifiedsDemandGetDeleteEntry', 'uses' => 'ClassifiedsDemandController@getDeleteEntry'));

	});



 
});

?>