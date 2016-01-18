<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
 */

App::before(function ($request)
{
	function goDie($input = null)
	{
		if ($input != null)
		{
			// Start HTML definition (HTML5, utf-8, with Normalize.css and basic styling)
			echo '<!DOCTYPE html><html><head><meta charset="utf-8"><link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css"><style>body{width:100%;background-color:#fff;margin:0;padding:0;} p{margin:0 0 20px;padding:5px 10px;background-color:#eee;color:#333;} body p:first-child {background-color:#4BA2B5;} pre{padding:10px;border:1px solid #ddd;background-color:#eee;margin: 0 20px 20px;}</style><title>Temp output</title></head><body>';

			// $input is not null, check if it's an object, array or neither
			if (is_object($input))
			{
				// $input is object; check if has a links() method indicating Laravel pagination
				if (method_exists($input, 'links'))
				{
					// $input has links() method; use foreach to print out members of object
					echo '<p>Input is <strong>object</strong> and <strong>has pagination</strong>, adapting output.</p>';
					foreach ($input as $elementKey => $element)
					{
						echo '<pre>['. $elementKey .'] => '; print_r($element); echo '</pre>';
					}
				}
				else
				{
					// $input has no links() method
					echo '<p>Input is object and <strong>has no pagination</strong>, adapting output.</p><pre>'; print_r($input); echo '</pre>';
				}
			}
			elseif (is_array($input))
			{
				// $input is an array
				echo '<p>Element is an <strong>array</strong>, adapting output.</p>';
				foreach ($input as $elementKey => $element)
				{
					// check if element of array is object
					// (to handle status + Eloquent model or Query Builder result)
					if (is_object($element))
					{
						// $element is object; check if has a links() method indicating Laravel pagination
						if (method_exists($element, 'links'))
						{
							// $element has links() method; use foreach to print out members of object
							echo '<p>Element is <strong>object</strong> and <strong>has pagination</strong>, adapting output. Key: [' . $elementKey . ']</p>';
							foreach ($element as $subElementKey => $subElement)
							{
								echo '<pre>['. $subElementKey .'] => '; print_r($subElement); echo '</pre>';
							}
						}
						else
						{
							// $element has no links() method
							echo '<p>Element is <strong>object</strong> and <strong>has no pagination</strong>, adapting output.</p><pre>'; print_r($element); echo '</pre>';
						}
					}
					else
					{
						// $element is not an object or an array
						echo '<p>Element is <strong>not object nor an array</strong>, adapting output.</p><pre>[' . $elementKey . '] => '; print_r($element); echo '</pre>';
					}
				}
			}
			else
			{
				// $input is not an object or an array
				echo '<p>Input is <strong>not object nor an array</strong>, adapting output.</p><pre>'; print_r($input); echo '</pre>';
			}

			// End HTML definition
			echo '</body></html>';
		}
		die;
	}



	/*
	*	What must be done:
	*
	*	- filtering out users that are inactive
	*	- filtering out users that are deleted
	*	- filtering users that have unverified e-mails and notifying them
	*	- filtering users that have a temporary password and redirecting them
	*/
	if (Auth::check())
	{
		
		$user = User::getUserInfos(Auth::user()->id); 
	 
	}
});

App::after(function ($request, $response)
{
	//
});



/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
 */

Route::filter('auth', function ()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('sign-in')->with('info_message', Lang::get('messages.not_signed_in'));
		}
	}
	else
	{

	}
});



/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
 */

Route::filter('guest', function ()
{
	if (Auth::check())
	{
		return Redirect::route('getHome');
	}

});



/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
 */

Route::filter('csrf', function ()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});





/*
 *	Custom filters for CityHub
 */



// Superadmin only
Route::filter('superadmin', function ()
{
	if (!Entrust::hasRole('superadmin'))
	{
		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
	}
});



// Admin only
Route::filter('admin', function()
{
	if (!Entrust::hasRole('admin'))
	{
		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
	}
});



// Superadmin and admin
Route::filter('superadmin_admin', function()
{
	if (!(Entrust::hasRole('superadmin') || Entrust::hasRole('admin')))
	{
		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
	}
});



// Superadmin and admin
Route::filter('superadmin_admin_manager', function ()
{
	if (!(Entrust::hasRole('superadmin') || Entrust::hasRole('admin') || Entrust::hasRole('manager')))
	{
		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
	}
});



// Manager only
Route::filter('manager', function ()
{
	if (!Entrust::hasRole('manager'))
	{
		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
	}
});



/*
*	Module filter
*
*	Filter checks if module is disabled or under maintenance. Used for web version only.
*	If user is logged in and there's an error, module defaults to Dashboard with error/warning message,
*	otherwise it jumps to home page with error/warning message. Superadministrators are sent to the
*	module regardless of module's status.
*/
Route::filter('module', function($route, $request, $value)
{
	$moduleData = Module::getModule($value);

	if ($moduleData['status'] == 1)
	{
		if ($moduleData['module']->is_active == false)
		{
			if (Auth::check())
			{
				if (!Entrust::hasRole('superadmin'))
				{
					return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_module_disabled'));
				}
			}
			else
			{
				return Redirect::route('getHome')->with('error_message', Lang::get('messages.error_module_disabled'));
			}
		}

		if ($moduleData['module']->is_under_maintenance == true)
		{
			if (Auth::check())
			{
				if (!Entrust::hasRole('superadmin'))
				{
					return Redirect::route('getDashboard')->with('warning_message', Lang::get('messages.warning_module_under_maintenance'));
				}
			}
			else
			{
				return Redirect::route('getHome')->with('warning_message', Lang::get('messages.warning_module_under_maintenance'));
			}
		}
	}
	else
	{
		if (Auth::check())
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_module'));
		}
		else
		{
			return Redirect::route('getHome')->with('error_message', Lang::get('messages.error_getting_module'));
		}
	}
});



/*
*	Before filter, basic authorization
*/
Route::filter('auth.basic', function ($request)
{
	//header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');
	header('Access-Control-Allow-Options: *');
	//header('Access-Control-Allow-Credentials: true');
	return Auth::onceBasic();
});



/*
*	After filter, allow access origin
*/
Route::filter('accesOrigin', function($route, $request, $response)
{
	$response->headers->set('Access-Control-Allow-Origin', '*');
	$response->headers->set('Access-Control-Allow-Methods', '*');
	$response->headers->set('Access-Control-Allow-Headers', '*');
	//$response->headers->set('Access-Control-Allow-Credentials', 'true');
	return $response;
});
