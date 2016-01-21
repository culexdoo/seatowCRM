<?php

/*
 *	CoreApp - frontend routes 
 */
 
// Home / landing
Route::get('/', array('before' => 'auth','as' => 'getFrontendLanding', 'uses' => 'CoreController@getBackendDashboard'));
  
Route::get('view-offer-entry/{id}', array('as' => 'getSingleOfferEntry', 'uses' => 'FrontendController@getSingleOfferEntry'));

Route::get('view-demand-entry/{id}', array('as' => 'getSingleDemandEntry', 'uses' => 'FrontendController@getSingleDemandEntry'));

Route::get('offer-category-list/{id}', array('as' => 'getOfferCategoryEntries', 'uses' => 'FrontendController@getOfferCategoryClassifieds'));

Route::get('demand-category-list/{id}', array('as' => 'getDemandCategoryEntries', 'uses' => 'FrontendController@getDemandCategoryClassifieds'));

// Sign in page
Route::get('sign-in', array('before' => 'guest', 'as' => 'getSignIn', 'uses' => 'FrontendController@getSignIn'));
  
// Register page
Route::get('register', array('before' => 'guest', 'as' => 'getRegister', 'uses' => 'FrontendController@getRegister'));
 
// Post register page
Route::post('register-user', array('before' => 'csrf', 'as' => 'postRegister', 'uses' => 'FrontendController@postRegister'));

// Forgot password page
Route::get('forgot-password', array('as' => 'getForgotPassword', 'uses' => 'FrontendController@getForgotPassword'));
 
// Sign in processing --- 'before' => 'guest|csrf', 
Route::post('sign-me-in', array('before' => 'guest', 'as' => 'postSignIn', 'uses' => 'FrontendController@postSignIn'));

?>