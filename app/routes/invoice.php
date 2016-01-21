<?php

/*
 *	CoreApp - InvoicesRoutes
 */
  
Route::group(array('prefix' => 'invoice'), function()
{
	// Landing
	Route::get('/', array('as' => 'invoiceLanding', 'uses' => 'InvoiceController@getLanding'));
 
	// Invoice entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'InvoiceGetAddEntry', 'uses' => 'InvoiceController@getAddEntry'));

		Route::post('new-entry', array('as' => 'InvoicePostAddEntry', 'uses' => 'InvoiceController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'InvoiceGetEditEntry', 'uses' => 'InvoiceController@getEditEntry'));

		Route::post('change-entry', array('as' => 'InvoicePostEditEntry', 'uses' => 'InvoiceController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'InvoiceGetDeleteEntry', 'uses' => 'InvoiceController@getDeleteEntry'));

	});



 
});

?>