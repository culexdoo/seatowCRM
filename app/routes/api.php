<?php
/**
 * @Author: BetaWare
 * @Date:   2015-03-12 10:15:15
 * @Last Modified by:   BetaWare
 * @Last Modified time: 2015-04-26 13:37:16
 */
//before auth routes like register, forgot password, this is for routes that dont use authorization
Route::group(array('prefix' => 'api'), function()
{
	Route::group(array('prefix' => 'v1'), function()
	{

		Route::get('getLanguages', array('as' => 'getLanguages', 'uses' => 'apiCore@getLanguages'));
		
		Route::post('recover', array('as'     => 'recover', 'uses' => 'apiCore@recover'));
		Route::post('socialLogin', array('as' => 'socialLogin', 'uses' => 'apiCore@socialLogin'));
		Route::post('register', array('as'    => 'register', 'uses' => 'apiCore@register'));


	});


	Route::group(array('before' => 'auth.basic', 'prefix' => 'v1'), function()
	{
		// Routes, normal controllers
        
        Route::get('login', array('as'            => 'login', 'uses' => 'apiCore@login'));
		Route::get('checkCurrentCity', array('as' => 'checkCurrentCity', 'uses' => 'apiCore@checkCurrentCity'));
		Route::get('cities', array('as'           => 'cities', 'uses' => 'apiCore@getCities' ));
        
        //push subscri
        Route::post('getPushData', array('as'            => 'getPushData', 'uses' => 'apiCore@getPushData'));
		 Route::post('saveToken', array('as'            => 'saveToken', 'uses' => 'apiCore@saveToken'));
        Route::post('follow', array('as'            => 'follow', 'uses' => 'apiCore@follow'));

        Route::post('communalService/report/', array('as'  => 'communalService/report', 'uses' => 'apiCommunalServiceController@getSingleReport' ));//deep linking
     
		// Routes, resourcefull controllers
		//communal service
		Route::get('communalService/votes', array('as'            => 'communalService/votes', 'uses' => 'apiCommunalServiceController@vote' ));
		Route::resource('communalService/reports', 'apiCommunalServiceController');

		//city news
		Route::resource('cityNews', 'apiCityNewsController');
        Route::post('socialFeed', array('as'  => 'socialFeed', 'uses' => 'apiCityNewsController@socialFeed' ));
		//tourist information
		Route::group(array('prefix' => 'touristInfo'), function() {

			Route::get('categories', array('as' => 'categories', 'uses' => 'apiTouristInfoController@getCategories'));
			Route::get('entries/{id}', array('as'    => 'entries', 'uses' => 'apiTouristInfoController@getEntries'));
			Route::get('entry/{id}', array('as'    => 'entry', 'uses' => 'apiTouristInfoController@getEntry'));

		});

	});

});