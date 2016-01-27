<?php
/*
*	Messages Module controller
*/

class MessagesController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new MessagesRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		$allEmployeeList = array();

		$employeeList= EmployeeEntry::getAllEmployees(null);
		
		if ($employeeList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($employeeList['entries'] as $employee)
		{
			$allEmployeeList[$employee->id] = $employee->first_name . " " . $employee->last_name . " - " .  "ID: " . $employee->employee_id;
		}

		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);

		$this->layout->title = 'List Messages';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.messages.entry', array('mode' => 'add',
		'postRoute' => 'MessagePostAddEntry', 'title' => 'Compose', 'user' => $user['user'], 'entries' => $allEmployeeList, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}



	// Post 
	public function postAddEntry()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));
		//$user = User::getUserInfos(Auth::user()->id);

 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), MessagesEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
		$recieverEmployee = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('reciever'));

		//$setSent = $this->repo->setSent($id);
		
		//goDie($setSent);
		$senderEmployee = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('user_id'));
		$addNewEntry = $this->repo->addEntry(
			Input::get('user_id'), 
			Input::get('reciever'), 
			Input::get('subject'), 
			Input::get('message'),
			$recieverEmployee['employee']->first_name,
			$recieverEmployee['employee']->last_name,
			$senderEmployee['employee']->first_name,
			$senderEmployee['employee']->last_name

			);
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages_msg.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('messagesLanding')->with('success_message', Lang::get('messages_msg.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}
	
	public function getInbox()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}



		$messageList = MessagesEntry::getAllInboxMessages(Auth::user()->id);
		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);
		$this->layout->title = 'List Messages';


		$this->layout->css_files = array(
			'plugins/datatables/dataTables.bootstrap.css'

		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'


		);
		
		$this->layout->content = View::make('modules.messages.entryList', array('mode' => 'add',
		 'title' => 'Compose', 'user' => $user['user'], 'entries' => $messageList, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}
	public function getTrash()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}



		$messageList = MessagesEntry::getAllTrashMessages(Auth::user()->id);
		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);


		$this->layout->title = 'List Messages';


		$this->layout->css_files = array(
			'plugins/datatables/dataTables.bootstrap.css'

		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'


		);
		
		$this->layout->content = View::make('modules.messages.entryListTrash', array('mode' => 'add',
		 'title' => 'Compose', 'user' => $user['user'], 'entries' => $messageList, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}
	public function getSent()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}



		$messageList = MessagesEntry::getAllSentMessages(Auth::user()->id);
		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);



		$this->layout->title = 'List Messages';


		$this->layout->css_files = array(
			'plugins/datatables/dataTables.bootstrap.css'

		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'


		);
		
		$this->layout->content = View::make('modules.messages.entryListSent', array('mode' => 'add',
		 'title' => 'Compose', 'user' => $user['user'], 'entries' => $messageList, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}
	public function getSingleView($id)
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}



		$message = MessagesEntry::getSingleMessagesEntry($id);

		$setEntryRead = $this->repo->setEntryRead($id);

		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);

		$this->layout->title = 'List Messages';


		$this->layout->css_files = array(
			

		);

		$this->layout->js_header_files = array( 
			


		);

		$this->layout->content = View::make('modules.messages.singleView', array('mode' => 'add',
		 'title' => 'Compose', 'user' => $user['user'], 'message' => $message, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}

	public function getSingleViewReplyAdd($id)
	{
		 
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		$allEmployeeList = array();

		$employeeList= EmployeeEntry::getAllEmployees(null);
		$countedunreadmessages = MessagesEntry::getCountUnreadMessages(Auth::user()->id);
		$counteddeletedmessages = MessagesEntry::getCountDeletedMessages(Auth::user()->id);
		$countedsentmessages = MessagesEntry::getCountSentMessages(Auth::user()->id);
		if ($employeeList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($employeeList['entries'] as $employee)
		{
			$allEmployeeList[$employee->id] = $employee->first_name . " " . $employee->last_name . " - " .  "ID: " . $employee->employee_id;
		}

		$this->layout->title = 'List Messages';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.messages.reply', array('mode' => 'add',
		'postRoute' => 'SingleViewReplyPost', 'title' => 'Compose', 'user' => $user['user'], 'entries' => $allEmployeeList, 'predefinedreply' => $id, 'countedunreadmessages' => $countedunreadmessages, 'counteddeletedmessages' => $counteddeletedmessages, 'countedsentmessages' => $countedsentmessages));
		 
	}

public function postSingleViewReply()
	{	
		//Ovjde kupim sve podatke sa stranice iz fildova
		Input::merge(array_map('trim', Input::all()));


 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), MessagesEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
		$recieverEmployee = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('reciever'));
		$setSent = $this->repo->setSent($id);
		$senderEmployee = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('user_id'));
		$addNewEntry = $this->repo->addEntry(
			Input::get('user_id'), 
			Input::get('reciever'), 
			Input::get('subject'), 
			Input::get('message'),
			$recieverEmployee['employee']->first_name,
			$recieverEmployee['employee']->last_name,
			$senderEmployee['employee']->first_name,
			$senderEmployee['employee']->last_name
			);
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages_msg.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('messagesLanding')->with('success_message', Lang::get('messages_msg.msg_success_entry_added', array('title' => Input::get('title'))));
		}
	}
	// Post delete entry
	public function getDeleteEntry($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('membership.msg_error_getting_entry'));
		}

		$message = MessagesEntry::getSingleMessagesEntry($id);
		if ($message['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('membership.msg_error_getting_entry'));
		}

		if (!is_object($message['message']))
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('membership.msg_error_getting_entry'));
		}

  
		$deleteMessage = $this->repo->deleteMessage($id);

		if ($deleteMessage['status'] == 1)
		{
			return Redirect::route('InboxMessages')->with('success_message', Lang::get('messages_msg.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('InboxMessages')->with('error_message', Lang::get('messages_msg.msg_error_deleting_entry'));
		}
	}


	
}
