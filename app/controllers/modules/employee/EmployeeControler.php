<?php
/*
*	Employee Module controller
*/

class EmployeeController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new EmployeeRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// Get module landing data
		$entries = EmployeeEntry::getAllEmployees();


  
		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('employee.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Employees';


		
		$this->layout->css_files = array(
			'plugins/datatables/dataTables.bootstrap.css'

		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'


		);

		$this->layout->content = View::make('modules.employee.entryList', array('title' => 'List Employees', 'user' => $user['user'], 'entries' => $entries['entries'] ));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  		$franchiseeList = array();

		// Get franchisee  
		$franchiseeIDs = FranchiseeEntry::getAllFranchisees(null);
		
		if ($franchiseeIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_franchisees'));
		}
		foreach ($franchiseeIDs['entries'] as $franchisee)
		{
			$franchiseeList[$franchisee->franchisee_id] = $franchisee->franchisee_id;
		}
	
		$this->layout->title = 'Add Employee';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.employee.entry', array('mode' => 'add',
		'postRoute' => 'EmployeePostAddEntry', 'entries' => $franchiseeList, 'title' => 'Add Employee', 'user' => $user['user']));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));


 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), EmployeeEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}

 

		$addNewEntry = $this->repo->addEntry(Input::get('employee_id'), Input::get('first_name'), Input::get('last_name'), Input::get('mobile_number'), Input::get('employee_description'), Input::get('email'), Input::get('password'), Input::get('franchisee_id'), Input::get('user_group'));
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('employee.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('employeeLanding')->with('success_message', Lang::get('employee.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}



	// Display edit entry page
	public function getEditEntry($employee_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

  
		

		$franchiseeList = array();

		// Get franchisee  
		$franchiseeIDs = FranchiseeEntry::getAllFranchisees(null);
		
		if ($franchiseeIDs['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_franchisees'));
		}
		foreach ($franchiseeIDs['entries'] as $franchisee)
		{
			$franchiseeList[$franchisee->franchisee_id] = $franchisee->franchisee_id;
		}
		$entry = EmployeeEntry::getSingleEmployeeEntry($employee_id);
		$employee_franchisee = EmployeeFranchisee::getEmployeeFranchisee($employee_id);
		
		if ($entry['status'] == 0)
		{ 
			return Redirect::back()->with('error_message', Lang::get('employee.msg_error_getting_entry'));
		}

		$this->layout->title = 'Edit Employee';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.employee.entry', array('mode' => 'edit',
		'postRoute' => 'EmployeePostEditEntry', 'title' => 'Edit Employee', 'entry' => $entry['entry'], 'entries' => $franchiseeList, 'employee_franchisee' => $employee_franchisee, 'user' => $user['user']));

	}




	// Post edit entry page
	public function postEditEntry()
	{

		
		Input::merge(array_map('trim', Input::all()));


		$entryValidator = Validator::make(Input::all(), EmployeeEntry::$edit_entry_rules);

		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('employee.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 		
		$editNewEntry = $this->repo->postEditEntry( Input::get('entry_id'), Input::get('employee_id'), Input::get('first_name'), Input::get('last_name'), Input::get('mobile_number'), Input::get('employee_description'), Input::get('email'), Input::get('password'), Input::get('franchisee_id'), Input::get('employee_franchisee'));
		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('employee.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('employeeLanding')->with('success_message', Lang::get('employee.msg_success_editing_entry', array('name' => Input::get('name'))));
		}

	} 


	// Post delete entry
	public function getDeleteEntry($employee_id = null)
	{
		if ($employee_id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('employee.msg_error_getting_entry'));
		}

		$entry = EmployeeEntry::getSingleEmployeeEntry($employee_id);	
		if ($entry['status'] == 0)

		{
			return Redirect::back()->with('error_message', Lang::get('employee.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('employee.msg_error_getting_entry'));
		}
	
  
		$deleteEntry = $this->repo->deleteEntry($entry['entry']->id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('employeeLanding')->with('success_message', Lang::get('employee.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('employeeLanding')->with('error_message', Lang::get('employee.msg_error_deleting_entry'));
		}
	}


  
}
