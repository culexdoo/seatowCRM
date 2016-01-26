<?php
/*
*	Client Module controller
*/

class ClientController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new ClientRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// Get module landing data
		$entries = ClientEntry::getAllClients();
	

		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Clients';


		$this->layout->css_files = array( 
			'plugins/datatables/dataTables.bootstrap.css',
			'css/core/select2.min.js'
		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js',
			'js/core/select2.full.min.js'

			
		);

		$this->layout->content = View::make('modules.client.entryList', array('title' => 'List Clients', 'user' => $user['user'], 'entries' => $entries['entries']));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);


		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
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

  		// Getting all franchisses
		$franchiseeList = array();

		$franchiseeIDs = FranchiseeEntry::getAllFranchisees();

		if ($franchiseeIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_clients'));
		}
		foreach ($franchiseeIDs['entries'] as $franchisees)
		{
			$franchiseeList[$franchisees->franchisee_id] = $franchisees->franchisee_id;
		}
		//-------------------------------------------
		 // Getting all hulls data 
		$hullList = array();

		
		$hullsIDs = HullEntry::getAllHulls(null);


		if ($hullsIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_franchisees'));
		}
		foreach ($hullsIDs['hull_entries'] as $hulls)
		{
			$hullList[$hulls->entry_id] = $hulls->hull_name;
		}
		//-------finish hulls data
		// Getting all makes data
		$makeList = array();

		$makesIDs = MakeEntry::getAllMakes(null);

		if ($makesIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_franchisees'));
		}
		foreach ($makesIDs['make_entries'] as $makes)
		{
			$makeList[$makes->entry_id] = $makes->make_name;
		}
		
		//-------finish hulls data

		$this->layout->title = 'Add Client';


		$this->layout->css_files = array(
			'css/core/select2.min.css'
		);

		$this->layout->js_header_files = array( 
			'js/core/select2.full.min.js'
		);

		$this->layout->content = View::make('modules.client.entry', array('mode' => 'add',
		'postRoute' => 'ClientPostAddEntry', 'title' => 'Add Client', 'user' => $user['user'], 'entries' => $franchiseeList, 'countries' => $countryList, 'hull_entries' => $hullList, 'make_entries' => $makeList));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));
		


 		//projverva dali sam popunio sve fildove
	$entryValidator = Validator::make(Input::all(), ClientEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 	

		$addNewEntry = $this->repo->addEntry(
			Auth::user()->id,
			Auth::user()->first_name,
			Auth::user()->last_name,
			Input::file('image'),
			Input::get('membership_from'),
			Input::get('membership_to'),
			Input::get('country_name'), 
			Input::get('first_name'), 
			Input::get('last_name'), 
			Input::get('company'), 
			Input::get('address'), 
			Input::get('state'), 
			Input::get('city'), 
			Input::get('zip'), 
			Input::get('mobile_number'), 
			Input::get('email'), 
			Input::get('mobile_number_2'), 
			Input::get('email_2'), 
			Input::get('home_number'), 
			Input::get('bus_no'), 
			Input::get('summer_no'), 
			Input::get('fax_no'), 
			Input::get('homeport'), 
			Input::get('additional_city'), 
			Input::get('additional_state'), 
			Input::get('notes'), 
			Input::get('additional_notes'), 
			Input::get('membership_id'), 
			Input::get('title'), 
			Input::get('status'), 
			Input::get('franchisee_id'), 
			Input::get('member_since'), 
			Input::get('member_type'), 
			//mailing 11 inputs
			Input::get('mailing_title'), 
			Input::get('mailing_first_name'), 
			Input::get('mailing_last_name'), 
			Input::get('mailing_company'), 
			Input::get('mailing_address'), 
			Input::get('mailing_country'), 
			Input::get('mailing_state'), 
			Input::get('mailing_city'), 
			Input::get('mailing_zip'), 
			Input::get('mailing_mobile_number'), 
			Input::get('mailing_email'), 
			Input::get('short_team_member'),
			//INPUT BOATS INFORMATION
			Input::get('boat_brand'), 
			Input::get('boat_name'), 
			Input::get('year'), 
			Input::get('registration_no'), 
			Input::get('federal_doc_no'), 
			Input::get('boat_color'), 
			Input::get('lenght'), 
			Input::get('description'), 
			Input::get('hull_id'), 
			Input::get('make_id'), 
			Input::get('engine_type_id'), 
			Input::get('fuel_type')
			
			);
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('clientLanding')->with('success_message', Lang::get('messages.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}



	// Display edit entry page
	public function getEditEntry($entry_id)
	{	

		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		  
		$entry = ClientEntry::getSingleClientEntry($entry_id);
		//goDie($entry['entry']);
		if ($entry['status'] == 0)

		{ 
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}


		// Get event list
		$eventList = ClientTracking::getAllTracks($entry['entry']->membership_id);



		

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

		// Getting all franchisses
		$franchiseeList = array();

		$franchiseeIDs = FranchiseeEntry::getAllFranchisees();

		if ($franchiseeIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_franchisees'));
		}
		foreach ($franchiseeIDs['entries'] as $franchisees)
		{
			$franchiseeList[$franchisees->franchisee_id] = $franchisees->franchisee_id;
		}
		//-------------------------------------------
		 // Getting all hulls data 
		$hullList = array();

		
		$hullsIDs = HullEntry::getAllHulls(null);


		if ($hullsIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entry'));
		}
		foreach ($hullsIDs['hull_entries'] as $hulls)
		{
			$hullList[$hulls->entry_id] = $hulls->hull_name;
		}
		//-------finish hulls data
		// Getting all makes data
		$makeList = array();

		$makesIDs = MakeEntry::getAllMakes(null);


		if ($makesIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entry'));
		}
		foreach ($makesIDs['make_entries'] as $makes)
		{
			$makeList[$makes->entry_id] = $makes->make_name;
		}


		$this->layout->title = 'Edit client';
		$this->layout->css_files = array(
			'css/core/select2.min.css'
		);

		$this->layout->js_header_files = array( 
			'js/core/select2.full.min.js'
		);


		$this->layout->content = View::make('modules.client.entry', array('mode' => 'edit',
		'postRoute' => 'ClientPostEditEntry', 'title' => 'Edit client', 'entry' => $entry['entry'], 'user' => $user['user'], 'entries' => $franchiseeList, 'hull_entries' => $hullList, 'make_entries' => $makeList, 'preselected_make' => $entry['entry']->make_id, 'preselected_hull' => $entry['entry']->hull_id, 'preselected_country' => $entry['entry']->country_name,'countries' => $countryList, 'trackingdata' => $eventList));

	}




	// Post edit entry page
	public function postEditEntry()
	{

		
		Input::merge(array_map('trim', Input::all()));

	
 		
		$entryValidator = Validator::make(Input::all(), ClientEntry::$edit_entry_rules);
		

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditEntry(
			Auth::user()->id,
			Auth::user()->first_name,
			Auth::user()->last_name,
			Input::get('boat_id'),
			Input::file('image'),
			Input::get('entry_id'), 
			Input::get('first_name'), 
			Input::get('last_name'), 
			Input::get('company'), 
			Input::get('address'), 
			Input::get('state'), 
			Input::get('city'), 
			Input::get('zip'), 
			Input::get('mobile_number'), 
			Input::get('email'), 
			Input::get('mobile_number_2'), 
			Input::get('email_2'), 
			Input::get('home_number'), 
			Input::get('bus_no'), 
			Input::get('summer_no'), 
			Input::get('fax_no'), 
			Input::get('homeport'), 
			Input::get('additional_city'), 
			Input::get('additional_state'), 
			Input::get('notes'), 
			Input::get('additional_notes'), 
			Input::get('membership_id'), 
			Input::get('title'),
			Input::get('status'), 
			Input::get('franchisee_id'), 
			Input::get('member_since'), 
			Input::get('member_type'),
			Input::get('mailing_title'), 
			Input::get('mailing_first_name'), 
			Input::get('mailing_last_name'), 
			Input::get('mailing_company'), 
			Input::get('mailing_address'), 
			Input::get('mailing_country'), 
			Input::get('mailing_state'), 
			Input::get('mailing_city'), 
			Input::get('mailing_zip'), 
			Input::get('mailing_mobile_number'), 
			Input::get('mailing_email'), 
			Input::get('country_name'), 
			Input::get('event'),
			Input::get('short_team_member'),
			Input::get('membership_from'),
			Input::get('membership_to'),
			//INPUT BOATS INFORMATION
			Input::get('boat_brand'), 
			Input::get('boat_name'), 
			Input::get('year'), 
			Input::get('registration_no'), 
			Input::get('federal_doc_no'), 
			Input::get('boat_color'), 
			Input::get('lenght'), 
			Input::get('description'), 
			Input::get('hull_id'), 
			Input::get('make_id'), 
			Input::get('engine_type_id'), 
			Input::get('fuel_type')
			);

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('clientLanding')->with('success_message', Lang::get('messages.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}


	// Post delete entry
	public function getDeleteEntry($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

		$entry = ClientEntry::getSingleClientEntry($id);

		
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

		$deleteEntry = $this->repo->deleteEntry($id, $entry['entry']->membership_id, Auth::user()->id, Auth::user()->first_name, Auth::user()->last_name, $entry['entry']->boat_id);



		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('clientLanding')->with('success_message', Lang::get('messages.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('clientLanding')->with('error_message', Lang::get('messages.msg_error_deleting_entry'));
		}
	}

}
