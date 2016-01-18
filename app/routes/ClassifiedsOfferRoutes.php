<?php

/*
 *	CoreApp - ClassifiedsOfferRoutes
 */
  
Route::group(array('prefix' => 'classifieds-offer'), function()
{
	// Landing
	Route::get('/', array('as' => 'ClassifiedsOfferLanding', 'uses' => 'ClassifiedsOfferController@getLanding'));
 
	// ClassifiedsOffer entries, listing, adding, editing, removing
	Route::group(array('prefix' => 'entries'), function()
	{
 
		Route::get('add-entry', array('as' => 'ClassifiedsOfferGetAddEntry', 'uses' => 'ClassifiedsOfferController@getAddEntry'));

		Route::post('new-entry', array('as' => 'ClassifiedsOfferPostAddEntry', 'uses' => 'ClassifiedsOfferController@postAddEntry'));

		Route::get('edit-entry/{id}', array('as' => 'ClassifiedsOfferGetEditEntry', 'uses' => 'ClassifiedsOfferController@getEditEntry'));

		Route::post('change-entry', array('as' => 'ClassifiedsOfferPostEditEntry', 'uses' => 'ClassifiedsOfferController@postEditEntry'));

		Route::get('delete-entry/{id}', array('as' => 'ClassifiedsOfferGetDeleteEntry', 'uses' => 'ClassifiedsOfferController@getDeleteEntry'));

	});



 
});

?>