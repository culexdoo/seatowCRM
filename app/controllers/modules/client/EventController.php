<?php
/*
*	Client Module controller
*/

class EventController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;

// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new EventRepository;
 
	}

public function getAddEvent($user_id)

	{	
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
		$member=ClientEntry::getSingleClientEntry($user_id);
	
		$this->layout->title = 'Add Event';


		$this->layout->css_files = array(
			'css/core/select2.min.css'
		);

		$this->layout->js_header_files = array( 
			'js/core/select2.full.min.js'
		);

		$this->layout->content = View::make('modules.client.event', array('mode' => 'add',
		'postRoute' => 'EventPostAddEvent', 'title' => 'Add Event', 
		'user' => $user['user'], 'entries' => $member));
 	
	}



	// Post add classifiedoffer
	public function postAddEvent()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));
		

	
		$addNewEntry = $this->repo->addEvent(
			Input::get('membership_id'),
			Input::get('action'),
			Input::get('additional_note'),
			Input::get('employee_first_name'),
			Input::get('employee_last_name'),
			Input::get('user_id')
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
	public function getEditEvent($entry_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		  
		$entry = EventEntry::getSingleClientEvent($entry_id);
	//	goDie( $entry['entry']->mailing_country);
		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}
		
		//-------------------------------------------


		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array(
			'css/core/select2.min.css'
		);

		$this->layout->js_header_files = array( 
			'js/core/select2.full.min.js'
		);


		$this->layout->content = View::make('modules.client.entry', array('mode' => 'edit',
		'postRoute' => 'ClientPostEditEntry', 'title' => 'Uredi oglas', 'entry' => $entry['entry'], 'user' => $user['user']));

	}
	// Post edit entry page
	public function postEditEvent()
	{

		
		Input::merge(array_map('trim', Input::all()));

	
 		
		$entryValidator = Validator::make(Input::all(), EventEntry::$edit_entry_rules);
		

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditEvent(
			Input::get('membership_id'),
			Input::get('event'),
			Input::get('additional_notes')
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


}
