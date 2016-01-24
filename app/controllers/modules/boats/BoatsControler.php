<?php
/*
*	Boats Module controller
*/

class BoatsController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new BoatsRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// Get module landing data
		$entries = BoatsEntry::getAllBoats();


		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Boats';


				$this->layout->css_files = array( 
			'plugins/datatables/dataTables.bootstrap.css'
		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'
			);

		$this->layout->content = View::make('modules.boats.entryList', array('title' => 'List Boats', 'user' => $user['user'], 'entries' => $entries['entries'] ));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
		//getting all client data
		$allClientList = array();

		$clientList = User::getAllClients(null);
		
		if ($clientList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($clientList['clients'] as $client)
		{
			$allClientList[$client->membership_id] = $client->first_name . " " . $client->last_name . " - " .  "ID: " . $client->membership_id;
		}
		
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
		
		$this->layout->title = 'Add Boats';


			$this->layout->css_files = array(
			'css/core/select2.min.css'
		);

		$this->layout->js_header_files = array( 
			'js/core/select2.full.min.js'
		);

		$this->layout->content = View::make('modules.boats.entry', array('mode' => 'add',
		'postRoute' => 'BoatsPostAddEntry', 'title' => 'Add Boats', 'user' => $user['user'], 'hull_entries' => $hullList, 'make_entries' => $makeList, 'clients' => $allClientList));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), BoatsEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addEntry(
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
			Input::get('fuel_type'), 
			Input::get('client_id'));
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('boatsLanding')->with('success_message', Lang::get('boats.msg_success_entry_added', array('title' => Input::get('title'))));
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

		  
		$entry = BoatsEntry::getSingleBoatsEntry($entry_id);

		
		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}
		//getting all client data
		$allClientList = array();

		$clientList = User::getAllClients(null);
		
		if ($clientList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($clientList['clients'] as $client)
		{
			$allClientList[$client->membership_id] = $client->first_name . " " . $client->last_name . " - " .  "ID: " . $client->membership_id;
		}
		
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
		
		//-------finish hulls data

		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	  	

		$this->layout->content = View::make('modules.boats.entry', array('mode' => 'edit',
		'postRoute' => 'BoatsPostEditEntry', 'title' => 'Edit boat', 'entry' => $entry['entry'], 'user' => $user['user'],'hull_entries' => $hullList, 'make_entries' => $makeList, 'preselected_make' => $entry['entry']->make_id, 'preselected_hull' => $entry['entry']->hull_id, 'clients' => $allClientList, 'preselected_client' => $entry['entry']->membership_id));

	}




	// Post edit entry page
	public function postEditEntry()
	{

		
		Input::merge(array_map('trim', Input::all()));
 		
		$entryValidator = Validator::make(Input::all(), BoatsEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditEntry(Input::get('entry_id'), Input::get('boat_brand'), Input::get('boat_name'), Input::get('year'), Input::get('registration_no'), Input::get('federal_doc_no'), Input::get('boat_color'), Input::get('lenght'), Input::get('description'), Input::get('hull_id'), Input::get('make_id'), Input::get('engine_type_id'), Input::get('fuel_type'), Input::get('client_id'), Input::get('client_id'));

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('boatsLanding')->with('success_message', Lang::get('classifieds.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}
	// Display edit entry page

	// Post delete entry
	public function getDeleteEntry($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		$entry = BoatsEntry::getSingleBoatsEntry($id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('boatsLanding')->with('success_message', Lang::get('boats.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('boatsLanding')->with('error_message', Lang::get('boats.msg_error_deleting_entry'));
		}
	}

	//------------------------------------------------------------------------------

	// THIS IS ABOUT HULL --------- THIS IS ABOUT HULL----------THIS IS ABOUT HULL--

	//------------------------------------------------------------------------------

	// Get add entry
	public function getAddHull()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);


		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		$hull_name = HullEntry::getAllHulls();
	

			if ($hull_name['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('hulls.msg_error_getting_entry'));
		}


		$this->layout->title = 'Add Hull';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.boats.hull', array('mode' => 'add',
		'postRoute' => 'BoatsPostAddHull', 'title' => 'Add Hull', 'user' => $user['user'], 'hull_entries' => $hull_name['hull_entries'] ));
 	
	}


	public function getEditHull($entry_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
		$entry = HullEntry::getSingleHullEntry($entry_id);


		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}
		$hull_name = HullEntry::getAllHulls();
	

		if ($hull_name['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('hulls.msg_error_getting_entry'));
		}

		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.boats.hull', array('mode' => 'edit',
		'postRoute' => 'BoatsPostEditHull', 'title' => 'Edit Hull', 'user' => $user['user'], 'hull_entries' => $hull_name['hull_entries'], 'entry' => $entry['entry']));
	}


	


	// Post add classifiedoffer
	public function postAddHull()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), HullEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addHullEntry(Input::get('hull_name'));
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('BoatsGetAddHull')->with('success_message', Lang::get('boats.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}




	// Post edit entry page
	public function postEditHull()
	{

		
		Input::merge(array_map('trim', Input::all()));
 		
		$entryValidator = Validator::make(Input::all(), HullEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_validating_hull'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditHullEntry(Input::get('entry_id'), Input::get('hull_name'));

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('BoatsGetAddHull')->with('success_message', Lang::get('classifieds.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}




	

		// Post delete entry
	public function getDeleteHull($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('BoatsGetAddHull')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		$entry = HullEntry::getSingleHullEntry($id);

		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('BoatsGetAddHull')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteHullEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('BoatsGetAddHull')->with('success_message', Lang::get('boats.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('BoatsGetAddHull')->with('error_message', Lang::get('boats.msg_error_deleting_entry'));
		}
	}

	//------------------------------------------------------------------------------

	// THIS IS ABOUT MAKE --------- THIS IS ABOUT MAKE----------THIS IS ABOUT MAKE--

	//------------------------------------------------------------------------------

	
	// Get add entry
	public function getAddMake()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);


		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		$make_name = MakeEntry::getAllMakes();
	

			if ($make_name['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('makes.msg_error_getting_entry'));
		}


		$this->layout->title = 'Add Make';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.boats.make', array('mode' => 'add',
		'postRoute' => 'BoatsPostAddMake', 'title' => 'Add Make', 'user' => $user['user'], 'make_entries' => $make_name['make_entries'] ));
 	
	}
	public function getEditMake($entry_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
		$entry = MakeEntry::getSingleMakeEntry($entry_id);


		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}
		$make_name = MakeEntry::getAllMakes();
	

		if ($make_name['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('makes.msg_error_getting_entry'));
		}

		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.boats.make', array('mode' => 'edit',
		'postRoute' => 'BoatsPostEditMake', 'title' => 'Edit Make', 'user' => $user['user'], 'make_entries' => $make_name['make_entries'], 'entry' => $entry['entry']));
	}




	// Post add classifiedoffer
	public function postAddMake()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), MakeEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('core.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addMakeEntry(Input::get('make_name'));
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('core.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('BoatsGetAddMake')->with('success_message', Lang::get('core.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}




	// Post edit entry page
	public function postEditMake()
	{

		
		Input::merge(array_map('trim', Input::all()));
 		
		$entryValidator = Validator::make(Input::all(), MakeEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('core.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditMakeEntry(Input::get('entry_id'), Input::get('make_name'));

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('core.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('BoatsGetAddMake')->with('success_message', Lang::get('core.msg_success_editing_entry', array('make_name' => Input::get('make_name'))));
		}
	}




	

		// Post delete entry
	public function getDeleteMake($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('BoatsGetAddMake')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		$entry = MakeEntry::getSingleMakeEntry($id);

		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('BoatsGetAddMake')->with('error_message', Lang::get('boats.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteMakeEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('BoatsGetAddMake')->with('success_message', Lang::get('boats.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('BoatsGetAddMake')->with('error_message', Lang::get('boats.msg_error_deleting_entry'));
		}
	}


  
}
