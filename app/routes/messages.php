<?php

/*
 *	CoreApp - MessagesRoutes
 */
  
Route::group(array('prefix' => 'messages'), function()
{
	// Landing
	Route::get('/', array('as' => 'messagesLanding', 'uses' => 'MessagesController@getLanding'));
 
	// Messages entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'MessagesGetAddEntry', 'uses' => 'MessagesController@getAddEntry'));

		Route::post('new-entry', array('as' => 'MessagesPostAddEntry', 'uses' => 'MessagesController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'MessagesGetEditEntry', 'uses' => 'MessagesController@getEditEntry'));

		Route::post('change-entry', array('as' => 'MessagesPostEditEntry', 'uses' => 'MessagesController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'MessagesGetDeleteEntry', 'uses' => 'MessagesController@getDeleteEntry'));

	});



 
});

?>