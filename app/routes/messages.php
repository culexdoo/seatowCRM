<?php

/*
 *	CoreApp - MessagesRoutes
 */
  
Route::group(array('prefix' => 'messages'), function()
{
	// Landing
	Route::get('/', array('as' => 'messagesLanding', 'uses' => 'MessagesController@getLanding'));
 	Route::post('add-entry', array('as' => 'MessagePostAddEntry', 'uses' => 'MessagesController@postAddEntry'));
	// Messages entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('inbox', array('as' => 'InboxMessages', 'uses' => 'MessagesController@getInbox'));
		Route::get('sent', array('as' => 'SentMessages', 'uses' => 'MessagesController@getSent'));
		Route::get('single/{id}', array('as' => 'SingleMessage', 'uses' => 'MessagesController@getSingleMessage'));

	});



 
});

?>