<?php
/*
*	Core controller
*
*	Serves the following:
*	- example page
*	- sign in
*	- registe
*	- forgotten password page
*	- sign out
*	- dashboard
*	- profile page
*/


class CoreController extends BaseController

{

	// Enviroment variables
	protected $layout;
	protected $repo;

	// Constructing default values
	public function __construct() {

		$this->layout = "master";
		$this->repo = new CoreRepository;

    }




	// Test function for various
	public function getTest()
	{
		return Redirect::route('getHome')->with('info_message', 'This is a test.');
	}


	/*
	 *	External pages (Example)
	 */

	// Show  Example page
	public function getExamplePage()
	{


		$this->layout->css_files = array(
 			'css/core/screen.css',
			'css/core/font-awesome.css'
		);

 		$this->layout->js_header_files = array(
			'js/vendor/scrollReveal.min.js',
			'js/core/home.js',
			'js/core/contact.js',
			'js/core/api.js'

		);

		$this->layout->content = View::make('core.examplepage');

	}
 
   	// Show Home page (landing)
	public function getBackendDashboard()
	{

		$user = User::getUserInfos(Auth::user()->id); 

		if ($user['status'] == 0)
		{
			return Redirect::route('getSignIn')->with('error_message', Lang::get('messages.not_logged_in'));
		}
  
    	

		$dashboardTracking = ClientTracking::getAllTracksDashboard();

		$lastClients = ClientEntry::getLastClients(10);

		$countedUsers = ClientEntry::getCountClients();

		$countedBoats = BoatsEntry::getCountBoats();

		$countedFranchisee = FranchiseeEntry::getCountFranchisee();

		$this->layout->css_files = array( 
		
		);

		$this->layout->js_header_files = array( 

		);
		$this->layout->content = View::make('core.home', array('title' => 'Administracija oglasa', 'user' => $user['user'], 'trackingdata' => $dashboardTracking, 'lastclients' => $lastClients, 'counted_user_number' => $countedUsers, 'counted_boats_number' => $countedBoats, 'counted_franchisee_number' => $countedFranchisee));
	}
 
  
	// E-mail verification
	public function getVerifyEmail()
	{
		if (Input::has('email') && Input::has('code'))
		{
			$verification = $this->repo->verifyEmail(Input::get('email'), Input::get('code'));

			if ($verification['status'] == 1)
			{
				if ($verification['verified'] == true)
				{
					return Redirect::route('getDashboard')->with('success_message', Lang::get('messages.success_verified_email'));
				}
			}
		}

		return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_validating_email'));
	}





	/*
	*	Language management
	*/



	// Switch language and redirect to home or Dashboard
	public function getChangeLanguage($id)
	{
		$languages = Language::getLanguage();

		if (Auth::user())
		{
			if ($languages['status'] == 0)
			{
				return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.no_languages'));
			}

			foreach($languages['languages'] as $language)
			{
				if ($language->iso_tag == $id)
				{
					Session::put('lang', $id);

					App::setLocale($id);

					$fn = $this->repo->setUserLanguage($language->id);
				}
			}

			return Redirect::route('getDashboard');
		}
		else
		{
			if ($languages['status'] == 0)
			{
				return Redirect::route('getHome')->with('error_message', Lang::get('messages.no_languages'));
			}

			foreach($languages['languages'] as $language)
			{
				if ($language->iso_tag == $id)
				{
					Session::put('lang', $id);

					App::setLocale($id);
				}
			}

			return Redirect::route('getHome');
		}
	}



	// Switch language and go back
	public function getSwitchLanguage($id)
	{
		$languages = Language::getLanguage();

		if (Auth::user())
		{
			if ($languages['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.no_languages'));
			}

			foreach($languages['languages'] as $language)
			{
				if ($language->iso_tag == $id)
				{
					Session::put('lang', $id);

					App::setLocale($id);

					$fn = $this->repo->setUserLanguage($language->id);
				}
			}

			return Redirect::back();
		}
		else
		{
			if ($languages['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.no_languages'));
			}

			foreach($languages['languages'] as $language)
			{
				if ($language->iso_tag == $id)
				{
					Session::put('lang', $id);

					App::setLocale($id);
				}
			}

			return Redirect::back();
		}
	}






	// Do the sign out
	public function getSignOut()
	{
		if (Auth::check())
		{
			Auth::logout();
			Session::flush();

			return Redirect::route('getSignIn')->with('info_message', Lang::get('messages.sign_out_success'));

		}

		else
		{
			return Redirect::route('getSignIn')->with('info_message', Lang::get('messages.sign_out_resign'));
		}

	}






	// Display reset password
	public function getResetPassword($token = null)
	{
		if (is_null($token)) App::abort(404);

		$this->layout->css_files = array(
			'css/core/forgotPassword.css'
		);
		$this->layout->content = View::make('core.resetPassword', array('token' => $token));
	}



	// Post reset password
	public function postResetPassword()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error_message', Lang::get($response));
				break;

			case Password::PASSWORD_RESET:
				return Redirect::route('getHome')->with('success_message', Lang::get('messages.success_changed_password'));
				break;
		}
	}


 

 


	/*
	 *	User profile page
	 */



	// Show profile page
	public function getProfile() 
	{
		$user = User::getUserInfos(Auth::user()->id);

		if ($user['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
 
		$this->layout->title = 'Uredi profil';

		$this->layout->content = View::make('core.profile', array('title' => 'Uredi profil', 'user' => $user['user']));
	}



	// Save profile changes
	public function postProfile()
	{
		Input::merge(array_map('trim', Input::all()));

		$userValidator = Validator::make(Input::all(), User::edit_profile_rules(Auth::user()->id));

		if ($userValidator->fails()) 
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_validating_profile'))->withErrors($userValidator)->withInput();
		}
		else
		{
			if (Input::get('old_password') != null || Input::get('old_password') != '')
			{
				if (Hash::check(Input::get('old_password'), Auth::user()->password))
				{
					$updateProfileResponse = $this->repo->updateProfile(Input::get('email'), Input::get('new_password'), Input::get('first_name'), Input::get('last_name'));

					if ($updateProfileResponse['status'] == 0)
					{
						return Redirect::back()->with('error_message', Lang::get('messages.error_password_no_update'))->withErrors($userValidator)->withInput();
					}

					return Redirect::route('getProfile')->with('success_message', Lang::get('messages.success_password_updated'));
				}
				else
				{
					return Redirect::back()->with('error_message', Lang::get('messages.error_password_mismatch'))->withErrors($userValidator)->withInput();
				}
			}
			else
			{
				$updateProfileResponse = $this->repo->updateProfile(Input::get('email'), null, Input::get('first_name'), Input::get('last_name'));

				if ($updateProfileResponse['status'] == 0)
				{
					return Redirect::back()->with('error_message', Lang::get('messages.error_password_no_update'))->withErrors($userValidator)->withInput();
				}

				return Redirect::route('getProfile')->with('success_message', Lang::get('messages.success_password_updated'));
			}
		}
	}

// Show profile page
	public function getOptions() 
	{
		$user = User::getUserInfos(Auth::user()->id);

		if ($user['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
 
		$this->layout->title = 'Edit options';

		$this->layout->content = View::make('core.options', array('title' => 'Edit options', 'user' => $user['user']));
	}



	// Save profile changes
	public function postOptions()
	{
		Input::merge(array_map('trim', Input::all()));

		$userValidator = Validator::make(Input::all(), User::edit_options_rules(Auth::user()->id));

		if ($userValidator->fails()) 
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_validating_profile'))->withErrors($userValidator)->withInput();
		}

		
	}





	/*
	*	Users segment
	*/



	// Show users list page, depending on role
	public function getUsersList()
	{
		// Get the users list
		$users = User::getUserInfos(null, null, null);
		if ($users['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_users_list'));
		}

		// Get current user
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'))->withInput();
		}

		// Load users list according to role
		switch ($user['user']->role_id)
		{
			// Superadmin
			case '1':
				$this->layout->title = Lang::get('usersList.title');
				$this->layout->css_files = array(
					'css/modules/cityNews/newsList.css',
					'css/core/dataTables.bootstrap.css'
				);

				$this->layout->js_footer_files = array(
		 			'js/core/jquery.dataTables.min.js',
					'js/core/dataTables.bootstrap.js'
				);
				$this->layout->content = View::make('core.superadmin.usersList', array('users' => $users['users']));
			break;

			// Admin
			case '2':
				$cities = CitiesUsers::getCitiesByUser(Auth::user()->id);
				if ($cities['status'] == 0)
				{
					return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_no_cities'));
				}

				foreach ($cities['cities'] as $city)
				{
					// Load managers
					$cityUsers = CitiesUsers::getUsersByCity($city->id, 3);

					if ($cityUsers['status'] == 0)
					{
						return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_users_list'));
					}

					$fullCityUsersList[] = $cityUsers['users'];
				}

				$this->layout->title = Lang::get('usersList.title');
				$this->layout->css_files = array(
					'css/modules/cityNews/newsList.css',
					'css/core/dataTables.bootstrap.css'
				);

				$this->layout->js_footer_files = array(
		 			'js/core/jquery.dataTables.min.js',
					'js/core/dataTables.bootstrap.js'
				);
				$this->layout->content = View::make('core.admin.usersList', array('users' => $fullCityUsersList));
			break;

			// Everyone else
			default:
				return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
	}



	// Show new user page
	public function getNewUser()
	{
		// Load languages
		$languagesList = Language::getLanguage();
		if ($languagesList['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.no_languages'));
		}

		foreach ($languagesList['languages'] as $language)
		{
			if ($language->local_name == '' || $language->local_name == null)
			{
				$languages[$language->id] = $language->language;
			}
			else
			{
				$languages[$language->id] = $language->language . ' (' . $language->local_name . ')';
			}
		}

		$rolesList = Role::getRoleInformations();
		if ($rolesList['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_no_roles'));
		}

		// If superadmin, load roles
		if (Entrust::hasRole('superadmin'))
		{
			$superadmin = true;

			$citiesList = City::getCity();
			if ($citiesList['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_no_cities'));
			}
			foreach ($citiesList['cities'] as $city)
			{
				if ($city->city_is_active == true)
				{
					if ($city->alternate_name == '' || $city->alternate_name == null)
					{
						$cityName = $city->name;
					}
					else
					{
						$cityName = $city->name . ' (' . $city->alternate_name .')';
					}
					$cities[] = array('id' => $city->id, 'name' => $cityName, 'checked' => false);
				}
			}

			foreach ($rolesList['roles'] as $role)
			{
				// Exclude anonymous role from list
				if ($role->id != 6)
				{
					$roles[$role->id] = Lang::get('databaseAssets.' . $role->name);
				}
			}
		}
		else
		{
			$superadmin = false;

			$adminCities = CitiesUsers::getCitiesByUser(Auth::user()->id);
			if ($adminCities['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_no_cities'));
			}
			foreach ($adminCities['cities'] as $city)
			{
				if ($city->is_active == true)
				{
					if ($city->alternate_name == '' || $city->alternate_name == null)
					{
						$cityName = $city->name;
					}
					else
					{
						$cityName = $city->name . ' (' . $city->alternate_name .')';
					}
					$cities[] = array('id' => $city->id, 'name' => $cityName, 'checked' => false);
				}
			}

			foreach ($rolesList['roles'] as $role)
			{
				// Include only managers and employees
				if ($role->id == 3 || $role->id == 4)
				{
					$roles[$role->id] = Lang::get('databaseAssets.' . $role->name);
				}
			}
		}

		// Everything checks out, load view
		$this->layout->title = Lang::get('user.title_add_user');

		$this->layout->content = View::make('core.user', array('mode' => 'add', 'postRoute' => 'postNewUser', 'title' => Lang::get('user.title_add_user'), 'languages' => $languages, 'superadmin' => $superadmin, 'roles' => $roles, 'cities' => $cities));
	}



	// Post new user
	public function postNewUser()
	{
		if (Entrust::hasRole('superadmin'))
		{
			$userValidator = Validator::make(Input::all(), User::$new_user_rules_superadmin);
		}
		else
		{
			$userValidator = Validator::make(Input::all(), User::$new_user_rules_admin);
		}

		// If manager or employee, demand cities
		if (Input::get('role') == 3 || Input::get('role') == 4)
		{
			if (!Input::has('cities'))
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_validating_new_user'))->withErrors($userValidator)->withInput();
			}
		}

		if ($userValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_validating_new_user'))->withErrors($userValidator)->withInput();
		}

		if (Entrust::hasRole('superadmin'))
		{
			$tryNewUser = $this->repo->setNewUserSuperadmin(Input::get('email'), Input::get('password'), Input::get('email_is_verified'), Input::get('is_banned'), Input::get('is_deleted'), Input::get('first_name'), Input::get('last_name'), Input::get('address'), Input::get('city'), Input::get('phone'), Input::get('job_title'), Input::get('biography'), Input::get('language'), Input::get('role'), Input::get('cities'));
		}
		else
		{
			$tryNewUser = $this->repo->setNewUserAdmin(Input::get('email'), Input::get('password'), Input::get('first_name'), Input::get('last_name'), Input::get('address'), Input::get('city'), Input::get('phone'), Input::get('job_title'), Input::get('biography'), Input::get('language'), Input::get('role'), Input::get('cities'));
		}

		switch ($tryNewUser['status'])
		{
			case 1:
				return Redirect::route('getUsersList')->with('success_message', Lang::get('messages.new_user_created', array('name' => Input::get('first_name') . ' ' . Input::get('last_name'))));
				break;

			case 2:
				return Redirect::back()->with('error_message', Lang::get('messages.error_admin_check_failed'))->withErrors($userValidator)->withInput();
				break;

			case 3:
				return Redirect::back()->with('error_message', Lang::get('messages.error_admin_unauthorized'))->withErrors($userValidator)->withInput();
				break;

			default:
				return Redirect::back()->with('error_message', Lang::get('messages.error_creating_new_user'))->withErrors($userValidator)->withInput();
		}
	}



	// Show edit user page
	public function getEditUser($id = null)
	{
		if ($id == null)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_no_user_specified'));
		}

		if ($id == Auth::user()->id)
		{
			return Redirect::route('getProfile');
		}

		$user = User::getUserInfos($id);

		if ($user['status'] == 0)
		{
			return Redirect::route('getUsersList')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		$languagesList = Language::getLanguage();
		if ($languagesList['status'] == 0)
		{
			return Redirect::route('getUsersList')->with('error_message', Lang::get('messages.no_languages'));
		}
		foreach ($languagesList['languages'] as $language)
		{
			if ($language->local_name == '' || $language->local_name == null)
			{
				$languages[$language->id] = $language->language;
			}
			else
			{
				$languages[$language->id] = $language->language . ' (' . $language->local_name . ')';
			}
		}

		if (Entrust::hasRole('superadmin'))
		{
			$superadmin = true;

			$getAllCities = City::getCity();

			if ($getAllCities['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
			}

			foreach ($getAllCities['cities'] as $city)
			{
				if ($city->city_is_active == true)
				{
					if ($city->alternate_name == '' || $city->alternate_name == null)
					{
						$cityName = $city->name;
					}
					else
					{
						$cityName = $city->name . ' (' . $city->alternate_name .')';
					}

					$checkUser = $this->repo->getCheckCityUser($id, $city->id);
					if ($checkUser['status'] == 0)
					{
						return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
					}

					$cities[] = array('id' => $city->id, 'name' => $cityName, 'checked' => $checkUser['hasCity']);
				}
			}
		}
		else
		{
			$superadmin = false;

			$editPermission = $this->repo->getCheckAdminEditUser(Auth::user()->id, $id);
 			if ($editPermission['status'] == 0)
			{
				return Redirect::route('getUsersList')->with('error_message', Lang::get('messages.error_getting_user_info'));
			}
			if ($editPermission['can_edit'] == false)
			{
				return Redirect::route('getUsersList')->with('error_message', Lang::get('messages.error_cant_edit_user'));
			}

			$getUserCities = CitiesUsers::getCitiesByUser($id);
			if ($getUserCities['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
			}

			foreach ($getUserCities['cities'] as $city)
			{
				if ($city->is_active == true)
				{
					if ($city->alternate_name == '' || $city->alternate_name == null)
					{
						$cityName = $city->name;
					}
					else
					{
						$cityName = $city->name . ' (' . $city->alternate_name .')';
					}

					$checkUser = $this->repo->getCheckCityUser($id, $city->id);
					if ($checkUser['status'] == 0)
					{
						return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'));
					}

					$cities[] = array('id' => $city->id, 'name' => $cityName, 'checked' => $checkUser['hasCity']);
				}
			}
		}

		$rolesList = Role::getRoleInformations();
		if ($rolesList['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_no_roles'));
		}
		foreach ($rolesList['roles'] as $role)
		{
			if (Entrust::hasRole('superadmin'))
			{
				// Exclude anonymous role from list
				if ($role->id != 6)
				{
					$roles[$role->id] = Lang::get('databaseAssets.' . $role->name);
				}
			}
			else
			{
				// Exclude all roles except Manager and Employee
				if ($role->id == 3 || $role->id == 4)
				{
					$roles[$role->id] = Lang::get('databaseAssets.' . $role->name);
				}
			}
		}

		$this->layout->title = Lang::get('user.title_edit_user', array('name' => $user['user']->first_name . ' ' . $user['user']->last_name));

		$this->layout->content = View::make('core.user', array('mode' => 'edit', 'postRoute' => 'postEditUser', 'title' => Lang::get('user.title_edit_user', array('name' => $user['user']->first_name . ' ' . $user['user']->last_name)), 'user' => $user['user'], 'languages' => $languages, 'roles' => $roles, 'superadmin' => $superadmin, 'cities' => $cities));
	}



	// Post edit user
	public function postEditUser()
	{
		if (Entrust::hasRole('superadmin'))
		{
			$userValidator = Validator::make(Input::all(), User::edit_user_rules_superadmin(Input::get('id')));
		}
		else
		{
			$userValidator = Validator::make(Input::all(), User::edit_user_rules_admin(Input::get('id')));
		}

		// If admin, manager or employee, demand cities
		if (Input::get('role') == 2 || Input::get('role') == 3 || Input::get('role') == 4)
		{
			if (!Input::has('cities'))
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_validating_new_user'))->withErrors($userValidator)->withInput();
			}
		}

		if ($userValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_validating_edit_user'))->withErrors($userValidator)->withInput();
		}
		else
		{
			$theUser = User::getUserInfos(Input::get('id'));

			if ($theUser['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_getting_user_info'))->withErrors($userValidator)->withInput();
			}

			if (Entrust::hasRole('superadmin'))
			{
				$tryEditUser = $this->repo->setEditUserSuperadmin(Input::get('id'), Input::get('email'), Input::get('password'), Input::get('email_is_verified'), Input::get('is_banned'), Input::get('is_deleted'), Input::get('first_name'), Input::get('last_name'), Input::get('address'), Input::get('city'), Input::get('phone'), Input::get('job_title'), Input::get('biography'), Input::get('language'), Input::get('role'), $theUser['user']->role_id, Input::get('cities'));
			}
			else
			{
				$tryEditUser = $this->repo->setEditUserAdmin(Input::get('id'), Input::get('email'), Input::get('password'), Input::get('first_name'), Input::get('last_name'), Input::get('address'), Input::get('city'), Input::get('phone'), Input::get('job_title'), Input::get('biography'), Input::get('language'), Input::get('role'), $theUser['user']->role_id, Input::get('cities'));
			}

			if ($tryEditUser['status'] == 1)
			{
				return Redirect::route('getUsersList')->with('success_message', Lang::get('messages.user_edited', array('name' => Input::get('first_name') . ' ' . Input::get('last_name'))));
			}
			else
			{
				return Redirect::back()->with('error_message', Lang::get('messages.error_editing_user'))->withErrors($userValidator)->withInput();
			}
		}
	}
 
}
