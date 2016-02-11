<?php

/*
 *	CoreApp - MessagesRoutes
 */
  
Route::group(array('prefix' => 'messages'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'messagesLanding', 'uses' => 'MessagesController@getLanding'));
 	Route::post('add-entry', array('before' => 'auth', 'as' => 'MessagePostAddEntry', 'uses' => 'MessagesController@postAddEntry'));
	// Messages entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('inbox', array('before' => 'auth', 'as' => 'InboxMessages', 'uses' => 'MessagesController@getInbox'));

		Route::get('trash', array('before' => 'auth', 'as' => 'TrashMessages', 'uses' => 'MessagesController@getTrash'));

		Route::get('sent', array('before' => 'auth', 'as' => 'SentMessages', 'uses' => 'MessagesController@getSent'));

		Route::get('single/{id}', array('before' => 'auth', 'as' => 'SingleView', 'uses' => 'MessagesController@getSingleView'));

		Route::get('reply-add/{id}', array('before' => 'auth', 'as' => 'SingleViewReplyAdd', 'uses' => 'MessagesController@getSingleViewReplyAdd'));

		Route::post('reply-post', array('before' => 'auth', 'as' => 'SingleViewReplyPost', 'uses' => 'MessagesController@postSingleViewReply'));

		Route::get('delete-message/{id}', array('before' => 'auth', 'as' => 'DeleteSingleMessage', 'uses' => 'MessagesController@getDeleteEntry'));

	});



 
});

?>