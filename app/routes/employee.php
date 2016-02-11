<?php

/*
 *	CoreApp - EmployeeRoutes
 */
  
Route::group(array('prefix' => 'employee'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'employeeLanding', 'uses' => 'EmployeeController@getLanding'));
 
	// Employee entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'EmployeeGetAddEntry', 'uses' => 'EmployeeController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'EmployeePostAddEntry', 'uses' => 'EmployeeController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'EmployeeGetEditEntry', 'uses' => 'EmployeeController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'EmployeePostEditEntry', 'uses' => 'EmployeeController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'EmployeeGetDeleteEntry', 'uses' => 'EmployeeController@getDeleteEntry'));

	});
});
?>