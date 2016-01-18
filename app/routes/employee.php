<?php

/*
 *	CoreApp - EmployeeRoutes
 */
  
Route::group(array('prefix' => 'employee'), function()
{
	// Landing
	Route::get('/', array('as' => 'employeeLanding', 'uses' => 'EmployeeController@getLanding'));
 
	// Employee entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'EmployeeGetAddEntry', 'uses' => 'EmployeeController@getAddEntry'));

		Route::post('new-entry', array('as' => 'EmployeePostAddEntry', 'uses' => 'EmployeeController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'EmployeeGetEditEntry', 'uses' => 'EmployeeController@getEditEntry'));

		Route::post('change-entry', array('as' => 'EmployeePostEditEntry', 'uses' => 'EmployeeController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'EmployeeGetDeleteEntry', 'uses' => 'EmployeeController@getDeleteEntry'));

	});
});
?>