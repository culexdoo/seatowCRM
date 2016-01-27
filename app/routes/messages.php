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

		Route::get('trash', array('as' => 'TrashMessages', 'uses' => 'MessagesController@getTrash'));

		Route::get('sent', array('as' => 'SentMessages', 'uses' => 'MessagesController@getSent'));

		Route::get('single/{id}', array('as' => 'SingleView', 'uses' => 'MessagesController@getSingleView'));

		Route::get('reply-add/{id}', array('as' => 'SingleViewReplyAdd', 'uses' => 'MessagesController@getSingleViewReplyAdd'));

		Route::post('reply-post', array('as' => 'SingleViewReplyPost', 'uses' => 'MessagesController@postSingleViewReply'));

		Route::get('delete-message/{id}', array('as' => 'DeleteSingleMessage', 'uses' => 'MessagesController@getDeleteEntry'));

	});



 
});

?>