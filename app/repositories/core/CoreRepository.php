<?php
/*
*
*	Handles functions:
*	- languages
*	- users
*	- cities
*	- modules
*/



class CoreRepository
{
	/*
	*	Users section
	*/
    public function __construct(){

    }





	// Verify user e-mail
	public function verifyEmail($email, $code)
	{
		try
		{
			$user = User::getUserByEmail($email);
			if ($user['status'] == 0)
			{
				return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_validating_email'));
			}

			$userItem = User::find($user['user']->id);

			if ($code == $userItem->verify_code)
			{
				$userItem->verify_code = null;
				$userItem->email_is_verified = true;
				$userItem->save();

				return array('status' => 1, 'verified' => true);
			}
			else
			{
				return array('status' => 1, 'verified' => false);
			}

		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

 


	// Register user without password
	public function registerUserWithoutPassword($email, $first_name, $last_name, $facebook_id = null, $google_id = null)
	{
		try
		{
			$newUser = new User;
			$newUser->email = $email;

			$newUser->first_name = $first_name;
			$newUser->last_name = $last_name;

			$newUser->password = Hash::make('CityHubDefPass123!#');
			$newUser->is_temp_password = true;

			if ($facebook_id != null)
			{
				$newUser->facebook_id = $facebook_id;
			}

			if ($google_id != null)
			{
				$newUser->google_id = $google_id;
			}

			$newUser->language = 1;

			$newUser->save();

			$newUser->attachRole(5);

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Edit profile
	public function updateProfile($email, $password = null, $first_name, $last_name)
	{


		try
		{

			$profileUser = User::find(Auth::user()->id);

			if ($password != null || $password != '')
			{
				$profileUser->password = Hash::make($password);
			}

			$profileUser->first_name = $first_name;
			$profileUser->last_name = $last_name;

			$profileUser->save();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// New user (superadmin)
	public function setNewUserSuperadmin($email, $password, $email_is_verified, $is_banned, $is_deleted, $first_name, $last_name, $address, $city, $phone, $job_title, $biography, $language, $role, $cities)
	{
		try
		{
			DB::beginTransaction();

			$newUser = new User;
			$newUser->email = $email;

			if ($password != '' || $password != null)
			{
				$newUser->password = Hash::make($password);
			}

			$newUser->email_is_verified = $email_is_verified;
			$newUser->is_banned = $is_banned;
			$newUser->is_deleted = $is_deleted;

			$newUser->first_name = $first_name;
			$newUser->last_name = $last_name;
			$newUser->address = $address;
			$newUser->city = $city;
			$newUser->phone = $phone;
			$newUser->job_title = $job_title;
			$newUser->biography = $biography;

			$newUser->language = $language;

			$newUser->save();

			if ($role != 6)
			{
				$newUser->attachRole($role);

				if ($cities != null)
				{
					if (($role == 2 || $role == 3 || $role == 4) && count($cities) > 0)
					{
						foreach ($cities as $cityID => $cityChecked)
						{
							if ($cityChecked == true)
							{
								$newUserCity = new CitiesUsers;
								$newUserCity->user_id = $newUser->id;
								$newUserCity->city_id = $cityID;

								$newUserCity->save();
							}
						}
					}
				}
			}
			else
			{
				$newUser->attachRole(5);
			}

			DB::commit();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			DB::rollback();

			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// New user (admin)
	public function setNewUserAdmin($email, $password, $first_name, $last_name, $address, $city, $phone, $job_title, $biography, $language, $role, $cities = null)
	{
		foreach ($cities as $cityID => $cityChecked)
		{
			if ($cityChecked == true)
			{
				$canEditCity = $this->getCheckCityUser(Auth::user()->id, $cityID);
				if ($canEditCity['status'] == 0)
				{
					return array('status' => 2); // Check failed
				}
				if ($canEditCity['status'] == 1)
				{
					if ($canEditCity['hasCity'] == false)
					{
						return array('status' => 3); // Admin not authorized
					}
				}
			}
		}

		try
		{
			DB::beginTransaction();

			$newUser = new User;
			$newUser->email = $email;

			if ($password != '' || $password != null)
			{
				$newUser->password = Hash::make($password);
			}

			$newUser->first_name = $first_name;
			$newUser->last_name = $last_name;
			$newUser->address = $address;
			$newUser->city = $city;
			$newUser->phone = $phone;
			$newUser->job_title = $job_title;
			$newUser->biography = $biography;

			$newUser->language = $language;

			$newUser->save();

			if ($role == 2 || $role == 3)
			{
				$newUser->attachRole($role);
			}
			else
			{
				$newUser->attachRole(3);
			}

			if ($cities != null)
			{
				foreach($cities as $cityID => $cityChecked)
				{
					if ($cityChecked == true)
					{
						$newUserCity = new CitiesUsers;
						$newUserCity->user_id = $newUser->id;
						$newUserCity->city_id = $cityID;

						$newUserCity->save();
					}
				}
			}

			DB::commit();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			DB::rollback();

			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Edit user (superadmin)
	public function setEditUserSuperadmin($id, $email, $password, $email_is_verified, $is_banned, $is_deleted, $first_name, $last_name, $address, $city, $phone, $job_title, $biography, $language, $role, $old_role, $cities = null)
	{
		try
		{
			DB::beginTransaction();

			$editUser = User::find($id);
			$editUser->email = $email;

			if ($password != '' || $password != null)
			{
				$editUser->password = Hash::make($password);
			}

			$editUser->email_is_verified = $email_is_verified;
			$editUser->is_banned = $is_banned;
			$editUser->is_deleted = $is_deleted;

			$editUser->first_name = $first_name;
			$editUser->last_name = $last_name;
			$editUser->address = $address;
			$editUser->city = $city;
			$editUser->phone = $phone;
			$editUser->job_title = $job_title;
			$editUser->biography = $biography;

			$editUser->language = $language;

			$editUser->save();

			$editUser->detachRole($old_role);

			if ($role != 6)
			{
				$editUser->attachRole($role);
			}
			else
			{
				$editUser->attachRole(5);
			}

			$removingUser = $this->removeUserFromCities($id);

			if ($removingUser['status'] == 1 && $cities != null)
			{
				if (($role == 2 || $role == 3 || $role == 4) && count($cities) > 0)
				{
					foreach ($cities as $cityID => $cityChecked)
					{
						if ($cityChecked == true)
						{
							$newUserCity = new CitiesUsers;
							$newUserCity->user_id = $id;
							$newUserCity->city_id = $cityID;

							$newUserCity->save();
						}
					}
				}
			}

			DB::commit();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			DB::rollback();

			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Edit user (admin)
	public function setEditUserAdmin($id, $email, $password, $first_name, $last_name, $address, $city, $phone, $job_title, $biography, $language, $role, $old_role, $cities = null)
	{
		try
		{
			DB::beginTransaction();

			$editUser = User::find($id);
			$editUser->email = $email;

			if ($password != '' || $password != null)
			{
				$editUser->password = Hash::make($password);
			}

			$editUser->first_name = $first_name;
			$editUser->last_name = $last_name;
			$editUser->address = $address;
			$editUser->city = $city;
			$editUser->phone = $phone;
			$editUser->job_title = $job_title;
			$editUser->biography = $biography;

			$editUser->language = $language;

			$editUser->save();

			$editUser->detachRole($old_role);

			if ($role != 6)
			{
				$editUser->attachRole($role);
			}
			else
			{
				$editUser->attachRole(5);
			}

			$removingUser = $this->removeUserFromCities($id);

			if ($removingUser['status'] == 1 && $cities != null)
			{
				if (($role == 2 || $role == 3 || $role == 4) && count($cities) > 0)
				{
					foreach ($cities as $cityID => $cityChecked)
					{
						if ($cityChecked == true)
						{
							$newUserCity = new CitiesUsers;
							$newUserCity->user_id = $id;
							$newUserCity->city_id = $cityID;

							$newUserCity->save();
						}
					}
				}
			}

			DB::commit();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			DB::rollback();

			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Assign Facebook ID to user
	public function addFacebookToUser($email = null, $facebook_id = null)
	{
		try
		{
			if ($email != null)
			{
				$user = User::getUserByEmail($email);

				if ($user['status'] == 1)
				{
					$user = User::find($user['user']->id);
					$user->facebook_id = $facebook_id;
					$user->save();

					return array('status' => 1, 'user' => $user);
				}
				else
				{
					return array('status' => 0, 'reason' => 'Failed to find user by e-mail.');
				}
			}
			else
			{
				return array('status' => 0, 'reason' => 'E-mail is empty.');
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Assign Google ID to user
	public function addGoogleToUser($email = null, $google_id = null)
	{
		try
		{
			if ($email != null)
			{
				$user = User::getUserByEmail($email);

				if ($user['status'] == 1)
				{
					$user = User::find($user['user']->id);
					$user->google_id = $google_id;
					$user->save();

					return array('status' => 1, 'user' => $user);
				}
				else
				{
					return array('status' => 0, 'reason' => 'Failed to find user by e-mail.');
				}
			}
			else
			{
				return array('status' => 0, 'reason' => 'E-mail is empty.');
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Insert password into current profile
	public function insertPassword($password, $language)
	{
		try
		{
			$user = User::find(Auth::user()->id);
			$user->password = Hash::make($password);
			$user->is_temp_password = false;
			$user->language = $language;

			$user->save();

			return array('status' => 1, 'name' => $user->first_name);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Remove user from city
	public function removeUserFromCities($user = null)
	{
		if ($user == null)
		{
			return array('status' => 0);
		}

		$usersCities = CitiesUsers::getCitiesByUser($user);
		if ($usersCities['status'] == 0)
		{
			return array('status' => 0);
		}

		if (count($usersCities['cities']) > 0)
		{
			try
			{
				DB::beginTransaction();

				foreach ($usersCities['cities'] as $city)
				{
					DB::table('cities_users')
					->where('id', '=', $city->cities_users_id)
					->delete();
				}

				DB::commit();

				return array('status' => 1);
			}
			catch (Exception $exp)
			{
				DB::rollback();

				return array('status' => 0);
			}
		}
	}



	// Check admin authority over city
	public function checkAdminCity($user = null, $city = null)
	{
		if ($user == null || $city == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{
			$userCities = CitiesUsers::getCitiesByUser($user);
			if ($userCities['status'] == 0)
			{
				return array('status' => 0, 'reason' => 'Error fetching user cities.');
			}

			$authority = false;
			foreach ($userCities['cities'] as $userCity)
			{
				if ($userCity->id == $city)
				{
					$authority = true;
				}
			}

			return array('status' => 1, 'hasAuthority' => $authority);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Check manager authority over company
	public function checkManagerCompany($user = null, $company = null)
	{
		if ($user == null || $company == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{
			$userCompanies = CityCompaniesUsers::getCityCompaniesByUser($user);
			if ($userCompanies['status'] == 0)
			{
				return array('status' => 0, 'reason' => 'Error fetching user cities.');
			}

			$authority = false;
			foreach ($userCompanies['companies'] as $userCompany)
			{
				if ($userCompany->id == $company)
				{
					$authority = true;
				}
			}

			return array('status' => 1, 'hasAuthority' => $authority);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Check admin authority over company
	public function checkAdminCompany($user = null, $company = null)
	{
		if ($user == null || $company == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{
			$userCities = CitiesUsers::getCitiesByUser($user);
			if ($userCities['status'] == 0)
			{
				return array('status' => 0, 'reason' => 'Error fetching user cities.');
			}

			$authority = false;
			foreach ($userCities['cities'] as $userCity)
			{
				$cityCompanies = CityCompany::getCityCompany($userCity->id);
				if ($cityCompanies['status'] == 0)
				{
					return array('status' => 0, 'reason' => 'Error fetching city companies.');
				}

				foreach($cityCompanies['companies'] as $cityCompany)
				{
					if ($cityCompany->id == $company)
					{
						$authority = true;
					}
				}
			}

			return array('status' => 1, 'hasAuthority' => $authority);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}





	/*
	*	Languages section
	*/



	// Get User Language
	public function getUserLanguage()
	{
		try
		{
			$user = User::getUserInfos(Auth::user()->id);

			if ($user['status'] == 1)
			{
				return array('status' => 1, 'language_id' => $user['user']->language_id, 'language_iso_tag' => $user['user']->language_iso_tag, 'language' => $user['user']->language, 'language_local_name' => $user['user']->language_local_name);
			}
			else
			{
				return array('status' => 0, 'reason' => 'Failure retrieving user informations.');
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

	// Get User landing page
	public function getUserLandingPage()
	{
		try
		{
			$user = User::getUserInfos(Auth::user()->id);

			if ($user['status'] == 1)
			{
				return array('status' => 1, 'landing_page' => $user['user']->landing_page);
			}
			else
			{
				return array('status' => 0, 'reason' => 'Failure retrieving user informations.');
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	// Set user language
	public function setUserLanguage($id = null)
	{
		if ($id != null)
		{
			try
			{
				$theUser = User::find(Auth::user()->id);
				$theUser->language = $id;

				$theUser->save();

				return array('status' => 1);
			}
			catch (Exception $exp)
			{
				return array('status' => 0, 'reason' => $exp->getMessage());
			}
		}
		else
		{
			return array('status' => 0, 'reason' => 'No language selected.');
		}
	}



	/*
	*	Dashboard
	*/
	public function getAdminDashboard()
	{
		// Get cities
		$citiesByUser = CitiesUsers::getCitiesByUser(Auth::user()->id);

		if ($citiesByUser['status'] == 1)
		{
			if (count($citiesByUser['cities']) > 0)
			{
				// For every city of the admin, do data retrieval
				foreach($citiesByUser['cities'] as $city)
				{
					// Check if city has CityNews attached
					$checkCityNews = CitiesModules::checkCityModule($city->id, 2);

					if ($checkCityNews['status'] == 1)
					{
						if ($checkCityNews['hasModule'] == true)
						{
							// Retrieve CityNews for all city companies
							$cityNewsModule = CityNews::getDashboardModule($city->id, 5);

							if ($cityNewsModule['status'] == 1)
							{
								$cityNewsStatus = 1;
								$cityNewsData = $cityNewsModule['city_news'];
							}
							else
							{
								$cityNewsStatus = 0;
								$cityNewsData = null;
							}
							$cityNewsRoute = $checkCityNews['route'];
							$cityNewsIdentifier = $checkCityNews['identifier'];
						}
						else
						{
							$cityNewsStatus = 2; // Status 2 means module is inactive for this city
							$cityNewsData = null;
							$cityNewsRoute = null;
							$cityNewsIdentifier = null;
						}
					}
					else
					{
						$cityNewsStatus = 0;
						$cityNewsData = null;
						$cityNewsRoute = null;
						$cityNewsIdentifier = null;
					}

					// Check if city has Communal Service attached
					$checkCommunalService = CitiesModules::checkCityModule($city->id, 1);

					if ($checkCommunalService['status'] == 1)
					{
						if ($checkCommunalService['hasModule'] == true)
						{

							$communalServiceReq = CommunalServiceReport::getLastReportsByCity($city->id, 5);
							if ($communalServiceReq['status'] == 1)
							{
								$communalServiceStatus = 1;
								$communalServiceData = $communalServiceReq['reports'];
							}
							else
							{
								$communalServiceStatus = 0;
								$communalServiceData = null;
							}
							$communalServiceRoute = $checkCommunalService['route'];
							$communalServiceIdentifier = $checkCommunalService['identifier'];
						}
						else
						{
							$communalServiceStatus = 2; // Status 2 means module is inactive for this city
							$communalServiceData = null;
							$communalServiceRoute = null;
							$communalServiceIdentifier = null;
						}
					}
					else
					{
						$communalServiceStatus = 0;
						$communalServiceData = null;
						$communalServiceRoute = null;
						$communalServiceIdentifier = null;
					}

					// get Subscribers for City
					$subscribers = FollowIds::getSubscribers(false, $city->id);
					// get Report stats for City
					$reportStats = CommunalServiceReport::CommunalServiceReportStatsPerCity($city->id);

					// Load other modules here and place in array, depending on the city
					$cityData[] = array('city' => $city, 'cityNews_status' => $cityNewsStatus, 'cityNews_data' => $cityNewsData, 'cityNews_route' => $cityNewsRoute, 'cityNews_identifier' => $cityNewsIdentifier, 'communalService_status' => $communalServiceStatus, 'communalService_data' => $communalServiceData, 'communalService_route' => $communalServiceRoute, 'communalService_identifier' => $communalServiceIdentifier, 'subscribers' => $subscribers, 'reportStats' => $reportStats['stats']);
					}

					return array('status' => 1, 'city_data' => $cityData);
					}
					else
					{
						return array('status' => 2); // Here, status 2 means no cities to display
						}
						}
						else
						{
							return array('status' => 0);
							}
							}



							// Get managers dashboard
							public function getManagerDashboard()
							{

								$listCompanies = array();

								$managerCompanies = CityCompaniesUsers::getCityCompaniesByUser(Auth::user()->id);
								if ($managerCompanies == 0)
								{
									return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_no_companies'));
								}
								if (count($managerCompanies['companies']) > 0)
								{
									foreach ($managerCompanies['companies'] as $company)
									{
										if ($company->city_is_active == true)
										{

											$companyReports = CommunalServiceReport::getLastReportsByCompany($company->id);

											$countNum = 0;
											$count = CommunalServiceReportCompany::getCountReportsByCompany($company->id);
											if ($count['status'] == 1)
											{
												$countNum = $count['number'];
											}

											if ($companyReports['status'] == 0)
											{
												return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_reports'));
											}
											$listCompanies[] = array('company' => $company, 'reports' => $companyReports['reports'], 'count_items' => $countNum);

										}
									}
								}
								else
								{
									return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_no_companies'));
								}



								// Get cities
								$cityCompaniesByUser = CityCompaniesUsers::getCityCompaniesByUser(Auth::user()->id);
								if ($cityCompaniesByUser['status'] == 0)
								{
									return array('status' => 0);
								}

								$cityCompanyData = array();

								if (count($cityCompaniesByUser) > 0)
								{
									foreach($cityCompaniesByUser['companies'] as $cityCompany)
									{
										$countNum = 0;
										$count = CityNews::getCountNewsByCompany($cityCompany->id);
										if ($count['status'] == 1)
										{
											$countNum = $count['number'];
										}
 										$checkCityNews = CitiesModules::checkCityModule($cityCompany->city_id, 2);
										if ($checkCityNews['status'] == 0)
										{
											$cityCityNewsStatus = false;
											$cityNewsRoute = null;
											$cityNewsIdentifier = null;
											$cityCityNewsData = $checkCityNews['reason'];
										}
										else
										{
											if ($checkCityNews['hasModule'] == true)
											{
												$cityCityNewsStatus = true;
												$cityNewsRoute = $checkCityNews['route'];
												$cityNewsIdentifier = $checkCityNews['identifier'];

												$cityCityNewsData = CityNews::getDashboardModule(null, 5, $cityCompany->id);
												if ($cityCityNewsData['status'] == 1)
												{
													$cityCityNewsData = $cityCityNewsData['city_news'];
												}
												else
												{
													$cityCityNewsData = array();
												}
											}
											else
											{
												$cityCityNewsStatus = false;
												$cityNewsRoute = null;
												$cityNewsIdentifier = null;
												$cityCityNewsData = '';
											}
										}

										$cityCompanyData[] = array('city_company' => $cityCompany, 'city_news_status' => $cityCityNewsStatus, 'city_news_data' => $cityCityNewsData, 'route' => $cityNewsRoute, 'identifier' => $cityNewsIdentifier, 'news_items' => $countNum);
									}

									return array('status' => 1, 'city_companies' => $cityCompanyData, 'companies' => $listCompanies);
								}
								else
								{
									// No city companies
									return array('status' => 2, 'city_companies' => array());
								}
							}



							// Users dashboard
							public function getUserDashboard()
							{
								// Get status of Communal Service
								$comSerStatus = Module::getModule(1);

								// Get Communal Service reports by user ID
								$comSerReports = CommunalServiceReport::getLastReportsByUser(Auth::user()->id, 10);

								return array('status' => 1, 'communalService' => $comSerStatus, 'communalServiceData' => $comSerReports);
							}




							/*
							*	Cities section
							*/

							// Get list of cities for the superadmin dashboard with modules per city
							public function getSuperadminDashCities()
							{
								$cities = City::getCity();

								if ($cities['status'] == 1)
								{
									foreach($cities['cities'] as $city)
									{
										$modules = CitiesModules::getModulesByCity($city->id);

										if ($modules['status'] == 1)
										{
											$modules = $modules['modules'];
										}
										else
										{
											$modules = null;
										}

										// Get only admins
										$users = CitiesUsers::getUsersByCity($city->id, 2);

										if ($users['status'] == 1)
										{
											$users = $users['users'];
										}
										else
										{
											$users = null;
										}

										$citiesData[] = array('city' => $city, 'modules' => $modules, 'users' => $users);
									}

									return $citiesData;
								}
								else
								{
									return null;
								}
							}




							// Inserting new city into database
							public function postNewCity($is_active, $name, $alternate_name, $latitude, $longitude, $coordinates, $country, $language, $admins, $modules, $zip_code, $header_image, $coat_of_arms_image)
							{
								try
								{

									DB::beginTransaction();

									if ($coordinates != null) {
										$newCityArea = new Areas;
										$newCityArea->coordinates = $coordinates;
										$newCityArea->save();
										$lastInsertAreaID = $newCityArea->id;
									}

									$city = new City;
									$city->is_active = $is_active;
									$city->name = $name;
									$city->alternate_name = $alternate_name;
									$city->city_center_latitude = $latitude;
									$city->city_center_longitude = $longitude;
									$city->country = $country;
									$city->default_language = $language;
									$city->zip_code = $zip_code;
									$city->city_area = $lastInsertAreaID;

									if ($header_image != null)
									{
										// Image data
										$headerImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $header_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($header_image->getRealPath())
										->orientate()
										->fit(1280, 640)
										->save($headerImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											$city->header_image = $imagename;
										}
									}

									if ($coat_of_arms_image != null)
									{
										// Image data
										$coatImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $coat_of_arms_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($coat_of_arms_image->getRealPath())
										->orientate()
										->fit(512, 512)
										->save($coatImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											$city->coat_of_arms_image = $imagename;
										}
									}

									$city->save();


									if ($admins != null) {

										$newUserCity = new CitiesUsers;
										$newUserCity->user_id = $admins;
										$newUserCity->city_id = $city->id;

										$newUserCity->save();

									}

									if ($modules != null)
									{
										foreach ($modules as $module)
										{
											$newModuleCity = new CitiesModules;
											$newModuleCity->module = $module;
											$newModuleCity->city = $city->id;

											$newModuleCity->save();

											// Create new user options for Communal Service
											if ($module == 1)
											{
												try
												{
													$newCommunalServiceCityOptions = CommunalServiceCityOptions::createNewCityOptions($city->id);
												}
												catch (Exception $exp)
												{
													//return array('status' => 0, 'reason' => $exp->getMessage());
												}
											}
										}
									} else
									{
										$newModuleCity = new CitiesModules;
										$newModuleCity->module = 1;
										$newModuleCity->city = $city->id;

										$newModuleCity->save();
									}

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}



							// Edit into database
							public function postEditCity($id, $is_active, $name, $alternate_name, $latitude, $longitude, $coordinates, $area_id, $country, $language, $admins, $modules, $zip_code, $header_image, $coat_of_arms_image)
							{
								try
								{

									DB::beginTransaction();


									$city = City::find($id);
									$city->is_active = $is_active;
									$city->name = $name;
									$city->alternate_name = $alternate_name;
									$city->city_center_latitude = $latitude;
									$city->city_center_longitude = $longitude;
									$city->country = $country;
									$city->default_language = $language;
									$city->zip_code = $zip_code;

									if ($coordinates != null) {
										if ($area_id != null) {
											$updatedCityArea = Areas::find($area_id);
											$updatedCityArea->coordinates = $coordinates;
											$updatedCityArea->save();
											$city->city_area = $area_id;
										}
										else {
											$newCityArea = new Areas;
											$newCityArea->coordinates = $coordinates;
											$newCityArea->save();
											$lastInsertAreaID = $newCityArea->id;
											$city->city_area = $lastInsertAreaID;
										}
									}

									if ($header_image != null)
									{
										// Image data
										$headerImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $header_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($header_image->getRealPath())
										->orientate()
										->fit(1280, 640)
										->save($headerImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											if (File::exists($headerImagePath . $city->header_image))
											{
												File::delete($headerImagePath . $city->header_image);
											}

											$city->header_image = $imagename;
										}
									}

									if ($coat_of_arms_image != null)
									{
										// Image data
										$coatImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $coat_of_arms_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($coat_of_arms_image->getRealPath())
										->orientate()
										->fit(512, 512)
										->save($coatImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											if (File::exists($coatImagePath . $city->coat_of_arms_image))
											{
												File::delete($coatImagePath . $city->coat_of_arms_image);
											}

											$city->coat_of_arms_image = $imagename;
										}
									}

									$city->save();

									if ($admins != null)
									{
										$currentAdmins = CitiesUsers::getUsersByCity($id, 2);
										if ($currentAdmins['status'] == 1)
										{
											foreach($currentAdmins['users'] as $user)
											{
												DB::table('cities_users')
												->where('city_id', '=', $id)
												->where('user_id', '=', $user->id)
												->delete();
											}


											$newUserCity = new CitiesUsers;
											$newUserCity->user_id = $admins;
											$newUserCity->city_id = $id;

											$newUserCity->save();

										}
									}

									DB::table('cities_modules')
									->where('city', '=', $city->id)
									->delete();

									if (isset($modules))
									{
										foreach ($modules as $module)
										{
											$newModuleCity = new CitiesModules;
											$newModuleCity->module = $module;
											$newModuleCity->city = $city->id;
											$newModuleCity->save();

											// Create new user options for Communal Service
											if ($module == 1)
											{
												try
												{
													$newCommunalServiceCityOptions = CommunalServiceCityOptions::createNewCityOptions($city->id);
												}
												catch (Exception $exp)
												{
													//return array('status' => 0, 'reason' => $exp->getMessage());
												}
											}
										}
									}

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}


							public function deleteCity($id)
							{
								try
								{
									DB::beginTransaction();

									// Delete all connections with modules
									DB::table('cities_modules')
									->where('cities_modules.city', '=', $id)
									->delete();

									// Delete all manager and employee links to the city
									DB::table('cities_users')
									->where('cities_users.city_id', '=', $id)
									->delete();

									// Delete company entry
									DB::table('city_companies')
									->where('city_companies.city_id', '=', $id)
									->delete();

									// Delete all city news entries
									DB::table('city_news')
									->where('city_news.city_id', '=', $id)
									->delete();

									// Delete communal service optiones
									DB::table('communalservice_city_options')
									->where('communalservice_city_options.city_id', '=', $id)
									->delete();

									// Delete communal service reports with this city
									DB::table('communalservice_reports_cities')
									->where('communalservice_reports_cities.city_id', '=', $id)
									->delete();

									// Delete reports types connected with cities
									DB::table('communalservice_report_types_cities')
									->where('communalservice_report_types_cities.city_id', '=', $id)
									->delete();

									// Delete templates connected with cities
									DB::table('communalservice_templates')
									->where('communalservice_templates.city_id', '=', $id)
									->delete();

									// Delete tourist information categories
									DB::table('touristinformation_categories')
									->where('touristinformation_categories.city_id', '=', $id)
									->delete();

									// Delete all Cities from table cities
									DB::table('cities')
									->where('cities.id', '=', $id)
									->delete();

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}


							// Post edit city (admin)
							public function postEditCityAdmin($id, $name, $alternate_name, $coordinates, $area_id, $country, $language, $zip_code, $header_image, $coat_of_arms_image)
							{
								try
								{
									DB::beginTransaction();

									$city = City::find($id);
									$city->name = $name;
									$city->alternate_name = $alternate_name;
									$city->country = $country;
									$city->default_language = $language;
									$city->zip_code = $zip_code;

									if ($coordinates != null) {
										if ($area_id != null) {
											$updatedCityArea = Areas::find($area_id);
											$updatedCityArea->coordinates = $coordinates;
											$updatedCityArea->save();
											$city->city_area = $area_id;
										}
										else {
											$newCityArea = new Areas;
											$newCityArea->coordinates = $coordinates;
											$newCityArea->save();
											$lastInsertAreaID = $newCityArea->id;
											$city->city_area = $lastInsertAreaID;
										}
									}

									if ($header_image != null)
									{
										// Image data
										$headerImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $header_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($header_image->getRealPath())
										->orientate()
										->fit(1280, 640)
										->save($headerImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											if (File::exists($headerImagePath . $city->header_image))
											{
												File::delete($headerImagePath . $city->header_image);
											}

											$city->header_image = $imagename;
										}
									}

									if ($coat_of_arms_image != null)
									{
										// Image data
										$coatImagePath = public_path() . "/uploads/core/cities/";

										// Image name is the same in thumbs and full size image
										$extension = $coat_of_arms_image->getClientOriginalExtension(); // getting image extension
										$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

										$uploadSuccess = Image::make($coat_of_arms_image->getRealPath())
										->orientate()
										->fit(512, 512)
										->save($coatImagePath . $imagename) // original
										->destroy();

										if ($uploadSuccess)
										{
											if (File::exists($coatImagePath . $city->coat_of_arms_image))
											{
												File::delete($coatImagePath . $city->coat_of_arms_image);
											}

											$city->coat_of_arms_image = $imagename;
										}
									}

									$city->save();

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}



							// Check if user exists in city
							public function getCheckCityUser($user = null, $city = null)
							{
								if ($user == null || $city == null)
								{
									return array('status' => 0);
								}

								$cities = CitiesUsers::getCitiesByUser($user);
								if ($cities['status'] == 0)
								{
									return array('status' => 0);
								}

								$hasCity = false;
								foreach ($cities['cities'] as $cityItem)
								{
									if ($cityItem->id == $city)
									{
										$hasCity = true;
									}
								}

								return array('status' => 1, 'hasCity' => $hasCity);
							}



							// Check if admin has authority to edit user (manager or employee)
							public function getCheckAdminEditUser($admin, $user)
							{
								$adminCities = CitiesUsers::getCitiesByUser($admin);
								if ($adminCities['status'] == 0)
								{
									return array('status' => 0);
								}

								$canEdit = false;

								foreach($adminCities['cities'] as $city)
								{
									$cityUsers = CitiesUsers::getUsersByCity($city->id);

									if ($cityUsers['status'] == 0)
									{
										return array('status' => 0);
									}
									foreach ($cityUsers['users'] as $userData)
									{
										if ($userData->id == $user && ($userData->role_id == 3 || $userData->role_id == 4))
										{
											$canEdit = true;
										}
									}
								}

								return array('status' => 1, 'can_edit' => $canEdit);
							}





							/*
							*	Companies section
							*/



							// Get data for superadmin view of city companies
							public function getSuperadminCityCompanies()
							{
								$companies = CityCompany::getCityCompany(null, null, null);

								$cityCompanies = array();

								if ($companies['status'] == 1)
								{
									foreach ($companies['companies'] as $company)
									{
										$users = CitiesUsers::getUsersByCity($company->city_id);

										if ($users['status'] == 1)
										{
											$usersList = $users['users'];
										}
										else
										{
											$usersList = null;
										}

										$cityCompanies[] = array('city_company' => $company, 'users' => $usersList);
									}

									return array('status' => 1, 'city_companies' => $cityCompanies);
								}
								else
								{
									return array('status' => 0, 'No companies.');
								}
							}



							// Get admin view of city companies
							public function getAdminCityCompanies()
							{
								$adminCities = CitiesUsers::getCitiesByUser(Auth::user()->id);
								if ($adminCities['status'] == 0)
								{
									return array('status' => 0, 'reason' => Lang::get('messages.error_no_cities'));
								}

								if (count($adminCities['cities']) > 0)
								{
									foreach ($adminCities['cities'] as $city)
									{
										if ($city->is_active == true)
										{
											$cityCompanies = CityCompany::getCityCompany($city->id, null, null);
											if ($cityCompanies['status'] == 0)
											{
												return array('status' => 0, 'reason' => Lang::get('messages.error_no_companies'));
											}

											$cityCompaniesList = array();
											foreach($cityCompanies['companies'] as $company)
											{
												// Get Managers
												$cityCompanyUsers = CityCompaniesUsers::getUsersByCityCompany($company->id, 3);
												if ($cityCompanyUsers['status'] == 0)
												{
													return array('status' => 0, 'reason' => 'Error getting managers.');
												}

												$cityCompaniesList[] = array('company' => $company, 'users' => $cityCompanyUsers['users']);
											}

											$completeList[] = array(
												'city_id'				=>	$city->id,
												'city_name'				=>	$city->name,
												'city_alternate_name'	=>	$city->alternate_name,
												'city_companies'		=>	$cityCompaniesList
											);
										}
									}

									return array('status' => 1, 'city_companies' => $completeList);
								}
								else
								{
									return array('status' => 0, 'reason' => Lang::get('messages.no_cities_assigned'));
								}
							}



							// Inserting new company into database
							public function postNewCompany($name, $email, $phone, $address, $description, $fb_page_id, $city_id, $managers)
							{

								try
								{
									DB::beginTransaction();

									$company = new CityCompany;
									$company->name = $name;
									$company->email = $email;
									$company->phone = $phone;
									$company->address = $address;
									$company->description = $description;
									$company->fb_page_id = $fb_page_id;
									$company->city_id = $city_id;

									$company->save();

									if (count($managers) > 0)
									{
										foreach($managers as $user_key => $manager_id)
										{
											$newCityCompanyManager = new CityCompaniesUsers;
											$newCityCompanyManager->city_company_id = $company->id;
											$newCityCompanyManager->user_id = $manager_id;
											$newCityCompanyManager->save();
										}
									}

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}



							// Editing new company into database
							public function postEditCompany($id, $name, $email, $phone, $address, $description, $city_id, $managers, $fb_page_id)
							{
								try
								{
									if (Entrust::hasRole('admin'))
									{
										$adminCheck = $this->checkAdminCompany(Auth::user()->id, $id);
										if ($adminCheck['status'] == 0)
										{
											return array('status' => 0, 'reason' => 'Admin company check failed.');
										}
										if ($adminCheck['hasAuthority'] == false)
										{
											return array('status' => 0, 'reason' => 'Admin has no authority.');
										}
									}

									DB::beginTransaction();

									$company = CityCompany::find($id);
									$company->name = $name;
									$company->email = $email;
									$company->phone = $phone;
									$company->address = $address;
									$company->description = $description;
									$company->fb_page_id = $fb_page_id;
									$company->city_id = $city_id;

									$company->save();

									// Remove all managers
									$currentManagers = CityCompaniesUsers::getUsersByCityCompany($id, 3);
									if ($currentManagers['status'] == 1)
									{
										foreach($currentManagers['users'] as $user)
										{
											DB::table('city_companies_users')
											->where('city_company_id', '=', $id)
											->where('user_id', '=', $user->user_id)
											->delete();
										}
									}

									// Add all managers
									foreach($managers as $key => $manager)
									{
										$newCompanyCityUser = new CityCompaniesUsers;
										$newCompanyCityUser->city_company_id = $id;
										$newCompanyCityUser->user_id = $manager;
										$newCompanyCityUser->save();
									}

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}



							// Editing new company into database
							public function postEditCompanyManager($id, $name, $email, $phone, $address, $description, $fb_page_id)
							{
								try
								{
									$managerCheck = $this->checkManagerCompany(Auth::user()->id, $id);
									if ($managerCheck['status'] == 0)
									{
										return array('status' => 0, 'reason' => 'Manager - company check failed.');
									}
									if ($managerCheck['hasAuthority'] == false)
									{
										return array('status' => 0, 'reason' => 'Unauthorized company change.');
									}

									$company = CityCompany::find($id);
									$company->name = $name;
									$company->email = $email;
									$company->phone = $phone;
									$company->address = $address;
									$company->description = $description;
									$company->fb_page_id = $fb_page_id;

									$company->save();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}




							// Delete company
							public function deleteCompany($id)
							{
								try
								{
									DB::beginTransaction();

									// Delete all Communal Service delegations
									DB::table('communalservice_reports_companies')
									->where('communalservice_reports_companies.company_id', '=', $id)
									->delete();

									// Delete all CityNews entries
									DB::table('city_news')
									->where('city_news.company_id', '=', $id)
									->delete();

									// Delete all manager and employee links to the company
									DB::table('city_companies_users')
									->where('city_companies_users.city_company_id', '=', $id)
									->delete();

									// Delete company entry
									DB::table('city_companies')
									->where('city_companies.id', '=', $id)
									->delete();

									DB::commit();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									DB::rollback();

									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}





							/*
							*	Modules section
							*/



							// Get list of modules or module details
							public function getModule($id = null)
							{
								if ($id != null)
								{
									$module = Module::getModule($id);
									if ($module['status'] == 1)
									{
										return $module['module'];
									}
									else
									{
										return null;
									}
								}
								else
								{
									$modules = Module::getModule();
									if ($modules['status'] == 1)
									{
										return $modules['modules'];
									}
									else
									{
										return null;
									}
								}
							}



							// Set module options
							public function setModuleOptions($id, $is_active, $is_mobile_active, $is_under_maintenance)
							{
								try
								{
									$targetModule = Module::find($id);
									$targetModule->is_active = $is_active;
									$targetModule->is_mobile_active = $is_mobile_active;
									$targetModule->is_under_maintenance = $is_under_maintenance;

									$targetModule->save();

									return array('status' => 1);
								}
								catch (Exception $exp)
								{
									return array('status' => 0, 'reason' => $exp->getMessage());
								}
							}

							public function deleteUserSubscription($user_id, $city_id, $superadmin = false)
							{
								if($superadmin)
								{
									$user = User::find($user_id);
									$user->follow = '';
									$user->save();
									return array('status' => 1);
								}
								else
								{
									$userFollows = User::where('id', '=', $user_id)->select('follow')->first();
									$cityFollows = FollowIds::where('city_id', '=', $city_id)->select('id')->get();
									$cityFollows_arr = [];
									foreach ($cityFollows as $followid)
									{
										$cityFollows_arr[] = $followid->id;
									}
									$userFollows_arr = explode(',', $userFollows->follow);

									foreach($cityFollows_arr as $cf)
									{
										foreach($userFollows_arr as $key => $uf)
										{
											if($cf == $uf)
											{
												unset($userFollows_arr[$key]);
											}
										}
									}
									$newUserFollow = implode(',', $userFollows_arr);
									$user = User::find($user_id);
									$user->follow = $newUserFollow;
									$user->save();
									return array('status' => 1);
								}
							}


						}
