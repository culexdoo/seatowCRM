<?php
/*
*	Franchisee Module controller
*/

class FranchiseeController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new FranchiseeRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //

		// Get module landing data
		$entries = FranchiseeEntry::getAllFranchisees();


  
		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Franchisee';


		$this->layout->css_files = array( 
			'plugins/datatables/dataTables.bootstrap.css'
		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'
		);


		$this->layout->content = View::make('modules.franchisee.entryList', array('title' => 'List Franchisee', 'user' => $user['user'], 'entries' => $entries['entries'] ));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  
				// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		// Getting all countries
		$countryList = array();

		$countriesIDs = Countries::getAllCountries();

		if ($countriesIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_clients'));
		}
		foreach ($countriesIDs['countries'] as $country)
		{
			$countryList[$country->country_name] = $country->country_name;
		}
		//-------------------------------------------
		$this->layout->title = 'Add Franchisee';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.franchisee.entry', array('mode' => 'add',
		'postRoute' => 'FranchiseePostAddEntry', 'title' => 'Add Franchisee', 'user' => $user['user'], 'countries' => $countryList));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  
				// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), FranchiseeEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addEntry(
			Input::get('address'),
			Input::get('franchisee_id'),
			Input::get('city'), 
			Input::get('country'), 
			Input::get('zip'), 
			Input::get('franchisee_short'), 
			Input::get('franchisee_long'), 
			Input::get('state')
			);
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('franchiseeLanding')->with('success_message', Lang::get('franchisee.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}



	// Display edit entry page
	public function getEditEntry($entry_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
		// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		  
		$entry = FranchiseeEntry::getSingleFranchiseeEntry($entry_id);

		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}
				// Getting all countries
		$countryList = array();

		$countriesIDs = Countries::getAllCountries();
		
		if ($countriesIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_franchisees'));
		}
		foreach ($countriesIDs['countries'] as $country)
		{
			$countryList[$country->country_name] = $country->country_name;
		}
		
		//-------------------------------------------

		$this->layout->title = 'Edit Franchisee';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.franchisee.entry', array('mode' => 'edit',
		'postRoute' => 'FranchiseePostEditEntry', 'title' => 'Edit Franchisee', 'entry' => $entry['entry'], 'user' => $user['user'], 'countries' => $countryList));

	}




	// Post edit entry page
	public function postEditEntry()
	{
			$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  
				// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		
		Input::merge(array_map('trim', Input::all()));


		$entryValidator = Validator::make(Input::all(), FranchiseeEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditEntry(
			Input::get('entry_id'),
			Input::get('address'),
			Input::get('franchisee_id'),
			Input::get('city'), 
			Input::get('country'), 
			Input::get('zip'), 
			Input::get('franchisee_short'), 
			Input::get('franchisee_long'), 
			Input::get('state')
			);

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('franchiseeLanding')->with('success_message', Lang::get('franchisee.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}


	// Post delete entry
	public function getDeleteEntry($id = null)
	{
		
		$user = User::getUserInfos(Auth::user()->id);
		if ($id == null)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}
		// - AUTHORITY CHECK STARTS HERE - //
		$hasAuthority = false;

		switch ($user['user']->user_group)
		{
			case 'superadmin':
			// Superadmin has default authority over everything
			$hasAuthority = true;
			break;

			case 'admin':
			// Admins should also have authority
			$hasAuthority = true;
			break;

			case 'employee':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			case 'client':
			// Admins should also have authority
			$hasAuthority = false;
			break;

			default:
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //

		$entry = FranchiseeEntry::getSingleFranchiseeEntry($id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('franchiseeLanding')->with('success_message', Lang::get('franchisee.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('franchiseeLanding')->with('error_message', Lang::get('franchisee.msg_error_deleting_entry'));
		}
	}


  
}
