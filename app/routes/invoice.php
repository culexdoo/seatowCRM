<?php

/*
 *	CoreApp - InvoicesRoutes
 */
  
Route::group(array('prefix' => 'invoice'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'invoiceLanding', 'uses' => 'InvoiceController@getLanding'));
	Route::get('pdf/{id}', array('before' => 'auth', 'as' => 'InvoiceCreatePdf', 'uses' => 'InvoiceController@createPdf'));
 
	// Invoice entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'InvoiceGetAddEntry', 'uses' => 'InvoiceController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'InvoicePostAddEntry', 'uses' => 'InvoiceController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'InvoiceGetEditEntry', 'uses' => 'InvoiceController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'InvoicePostEditEntry', 'uses' => 'InvoiceController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'InvoiceGetDeleteEntry', 'uses' => 'InvoiceController@getDeleteEntry'));

		Route::post('send-email', array('before' => 'auth', 'as' => 'InvoicesPostEmail', 'uses' => 'InvoiceController@postEmail'));

	});



 
});

?>