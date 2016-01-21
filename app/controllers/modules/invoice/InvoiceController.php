<?php
/*
*	Invoice Module controller
*/

class InvoiceController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new InvoiceRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// Get module landing data
		$entries = InvoiceEntry::getAllInvoices();


  
		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('invoice.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Invoice';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.invoice.entryList', array('title' => 'List Invoice', 'user' => $user['user'], 'entries' => $entries['entries'] ));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  

		$this->layout->title = 'Add Invoice';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.invoice.entry', array('mode' => 'add',
		'postRoute' => 'InvoicePostAddEntry', 'title' => 'Add Invoice', 'user' => $user['user']));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), InvoiceEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addEntry(Input::get('id'), Input::get('franchisee_id'), Input::get('city'), Input::get('zip'), Input::get('franchisee_short'), Input::get('franchisee_long'));
		

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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		  
		$entry = FranchiseeEntry::getSingleFranchiseeEntry($entry_id);

		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

		$this->layout->title = 'Edit Franchisee';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.franchisee.entry', array('mode' => 'edit',
		'postRoute' => 'FranchiseePostEditEntry', 'title' => 'Edit Franchisee', 'entry' => $entry['entry'], 'user' => $user['user']));

	}




	// Post edit entry page
	public function postEditEntry()
	{

		
		Input::merge(array_map('trim', Input::all()));


		$entryValidator = Validator::make(Input::all(), FranchiseeEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			
		$editNewEntry = $this->repo->postEditEntry(Input::get('entry_id'), Input::get('franchisee_id'), Input::get('city'), Input::get('zip'), Input::get('franchisee_short'), Input::get('franchisee_long'));

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
		if ($id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

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
