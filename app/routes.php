<?php
/*
 *	CityHub core routes
 */



// Test route
Route::get('test', array('as' => 'getTest', 'uses' => 'CoreController@getTest'));
 

   Route::get('/updateapp', function()
{
\Artisan::call('dump-autoload');
echo 'dump-autoload complete';
});



/*
 *	Dashboard
 *
 *	- available only to logged in users
 *	- Controller handles the type and file loading depending on user role
 */ 

Route::get('dashboard', array('before' => 'auth', 'as' => 'getDashboard', 'uses' => 'CoreController@getBackendDashboard'));
 
 
/*
 *	 Pages available to everyone
 */

 
// Change language route (with redirect to Dashboard)
Route::get('change-language/{id}', array('as' => 'changeLang', 'uses' => 'CoreController@getChangeLanguage'));

// Change language route (with redirect back())
Route::get('switch-language/{id}', array('as' => 'switchLang', 'uses' => 'CoreController@getSwitchLanguage'));


// Sign out
Route::get('sign-out', array('before' => 'auth', 'as' => 'getSignOut', 'uses' => 'CoreController@getSignOut'));

 
// Update password when creating new user via social networks
Route::get('set-password', array('before' => 'auth', 'as' => 'getUpdatePassword', 'uses' => 'CoreController@getUpdatePassword'));

// Post update password
Route::post('update-informations', array('before' => 'auth', 'as' => 'postUpdatePassword', 'uses' => 'CoreController@postUpdatePassword'));


 
// Forgot password processing
Route::post('refresh-password', array('before' => 'csrf', 'as' => 'postForgotPassword', 'uses' => 'CoreController@postForgotPassword'));

// Reset password page
Route::get('reset-password/{token}', array('as' => 'getResetPassword', 'uses' => 'CoreController@getResetPassword'));;

// Post reset password
Route::post('new-password', array('before' => 'csrf', 'as' => 'postResetPassword', 'uses' => 'CoreController@postResetPassword'));

// Get verify e-mail
Route::get('verify-email', array('as' => 'getVerifyEmail', 'uses' => 'CoreController@getVerifyEmail'));





/*
 *	Dashboard
 *
 *	- available only to logged in users
 *	- Controller handles the type and file loading depending on user role
 */ 
//Route::get('dashboard', array('before' => 'auth', 'as' => 'getDashboard', 'uses' => 'CoreController@getDashboard'));






/*
 *	User profile - available only to registered users
 */



// Profile page
Route::get('profile', array('before' => 'auth', 'as' => 'getProfile', 'uses' => 'CoreController@getProfile'));

// Save profile changes
Route::post('save-profile', array('before' => 'csrf', 'as' => 'postProfile', 'uses' => 'CoreController@postProfile'));





// Profile page
Route::get('options', array('before' => 'auth', 'as' => 'getOptions', 'uses' => 'CoreController@getoptions'));

// Save options changes
Route::post('save-options', array('before' => 'csrf', 'as' => 'postOptions', 'uses' => 'CoreController@postoptions'));





/*
 *	Pages available to superadmin and admin
 */



// Users list
Route::get('users', array('before' => 'superadmin_admin', 'as' => 'getUsersList', 'uses' => 'CoreController@getUsersList'));

// Add user
Route::get('new-user', array('before' => 'superadmin_admin', 'as' => 'getNewUser', 'uses' => 'CoreController@getNewUser'));

// Post new user
Route::post('add-new-user', array('before' => 'superadmin_admin|csrf', 'as' => 'postNewUser', 'uses' => 'CoreController@postNewUser'));

// Edit user
Route::get('edit-user/{id}', array('before' => 'superadmin_admin', 'as' => 'getEditUser', 'uses' => 'CoreController@getEditUser'));

// Post edit user
Route::post('save-user', array('before' => 'superadmin_admin|csrf', 'as' => 'postEditUser', 'uses' => 'CoreController@postEditUser'));



 
 
/*
*	Inclusion of Frontend routes
*/
include 'routes/FrontendRoutes.php';
include 'routes/api.php';

include 'routes/ClassifiedsOfferRoutes.php';
include 'routes/ClassifiedsDemandRoutes.php';

include 'routes/membership.php';
include 'routes/franchisee.php';
include 'routes/employee.php';
include 'routes/boats.php';
include 'routes/client.php';
include 'routes/invoice.php';
include 'routes/messages.php';