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
		);

		$this->layout->js_header_files = array( 
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
  

		$this->layout->title = 'Add Boats';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.boats.entry', array('mode' => 'add',
		'postRoute' => 'BoatsPostAddEntry', 'title' => 'Add Boats', 'user' => $user['user']));
 	
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
 

		$addNewEntry = $this->repo->addEntry(Input::get('boat_brand'), Input::get('boat_name'), Input::get('year'), Input::get('registration_no'), Input::get('federal_doc_no'), Input::get('boat_color'), Input::get('lenght'), Input::get('description'));
		

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

		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.boats.entry', array('mode' => 'edit',
		'postRoute' => 'BoatsPostEditEntry', 'title' => 'Uredi oglas', 'entry' => $entry['entry'], 'user' => $user['user']));

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
 
 			
		$editNewEntry = $this->repo->postEditEntry(Input::get('entry_id'), Input::get('boat_brand'), Input::get('boat_name'), Input::get('year'), Input::get('registration_no'), Input::get('federal_doc_no'), Input::get('boat_color'), Input::get('lenght'), Input::get('description'));

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('boats.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('boatsLanding')->with('success_message', Lang::get('classifieds.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}


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


  
}
