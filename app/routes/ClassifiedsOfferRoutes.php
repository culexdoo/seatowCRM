<?php

/*
 *	CoreApp - ClassifiedsOfferRoutes
 */
  
Route::group(array('prefix' => 'classifieds-offer'), function()
{
	// Landing
	Route::get('/', array('before' => 'auth', 'as' => 'ClassifiedsOfferLanding', 'uses' => 'ClassifiedsOfferController@getLanding'));
 
	// ClassifiedsOffer entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('before' => 'auth', 'as' => 'ClassifiedsOfferGetAddEntry', 'uses' => 'ClassifiedsOfferController@getAddEntry'));

		Route::post('new-entry', array('before' => 'auth', 'as' => 'ClassifiedsOfferPostAddEntry', 'uses' => 'ClassifiedsOfferController@postAddEntry'));

		Route::get('edit-entry/{id}', array('before' => 'auth', 'as' => 'ClassifiedsOfferGetEditEntry', 'uses' => 'ClassifiedsOfferController@getEditEntry'));

		Route::post('change-entry', array('before' => 'auth', 'as' => 'ClassifiedsOfferPostEditEntry', 'uses' => 'ClassifiedsOfferController@postEditEntry'));

		Route::get('delete-entry/{id}', array('before' => 'auth', 'as' => 'ClassifiedsOfferGetDeleteEntry', 'uses' => 'ClassifiedsOfferController@getDeleteEntry'));

	});



 
});

?>