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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //



		// Get module landing data
		$entries = InvoiceEntry::getAllInvoices();
	
		
		$invoicesData = array();

		foreach($entries['entries'] as $entry)
		{
			$employeeinfo = EmployeeEntry::getSingleEmployeeEntryByID($entry->employee_id);
			$productsperinvoice = InvoiceEntry::getProductsPerInvoice($entry->entry_id);
			$invoicesData[] = array('entry' => $entry, 'employeeinfo' => $employeeinfo['employee'], 'productsperinvoice' => $productsperinvoice['productsperinvoice']);
		}
		
		//goDie($invoicesData);

		
  
		if ($entries['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('invoice.msg_error_getting_entry'));
		}

		$this->layout->title = 'List Invoice';


				$this->layout->css_files = array( 
			'plugins/datatables/dataTables.bootstrap.css'
		);

		$this->layout->js_header_files = array( 
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js'
			);

		$this->layout->content = View::make('modules.invoice.entryList', array('title' => 'List Invoice', 'user' => $user['user'], 'invoicesdata' => $invoicesData));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)

		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //

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
		//////////////////////////////////////////////////////////
		$allEmployeeList = array();

		$employeeList = User::getAllEmployees(null);
		
		if ($employeeList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($employeeList['employees'] as $employee)
		{
			$allEmployeeList[$employee->id] = $employee->first_name . " " . $employee->last_name;
		}
		/////////////////////////////////////////////////////////////



		$this->layout->title = 'Add Invoice';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.invoice.entry', array('mode' => 'add',
		'postRoute' => 'InvoicePostAddEntry', 'title' => 'Add Invoice', 'user' => $user['user'], 'clients' => $allClientList, 'employees' => $allEmployeeList));
 	
	}



	// Post add classifiedoffer
	public function postAddEntry()
	{	
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		
		
		// - AUTHORITY CHECK ENDS HERE - //
		//Input::merge(array_map('trim', Input::all()));

		$product_name = array();
		$tax = array();
		$price = array();
		$qty = array();
		$price_qty = array();
		$product_name = Input::get('product_name');
		$tax = Input::get('tax');
		$price = Input::get('price');
		$qty = Input::get('qty');
		$price_qty = Input::get('price_qty');


		
		foreach($product_name as $key => $n ) {

		$arrData[] = array(
			"product_name"=>$product_name[$key],
			"tax"=>$tax[$key],
			"price"=>$price[$key],
			"qty"=>$qty[$key],
			"price_qty"=>$qty[$key]*($price[$key]*($tax[$key]/100)+$price[$key]),
			);
		}




 		//projverva dali sam popunio sve fildove
		$entryValidator = Validator::make(Input::all(), InvoiceEntry::$new_entry_rules);
		

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 		$clientinfo = ClientEntry::getSingleClientEntryByMembershipID(Input::get('client_id'));
 		
 		$employeeinfo = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('employee_id'));


		$addNewEntry = $this->repo->addEntry(
			Input::get('employee_id'), 
			Input::get('client_id'), 
			Input::get('payment_due'), 
			Input::get('billing_tax'),
			Input::get('payment_method'),
			Input::get('total_sum'),
			$employeeinfo['employee']->employee_first_name,
			$employeeinfo['employee']->employee_last_name,
			$clientinfo['entry']->entry_id,
			$arrData

			);
		

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('invoiceLanding')->with('success_message', Lang::get('invoice.msg_success_entry_added', array('title' => Input::get('title'))));
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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		$entry = InvoiceEntry::getSingleInvoiceEntry($entry_id);

		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('invoiceLanding')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
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
		//////////////////////////////////////////////////////////
		$allEmployeeList = array();

		$employeeList = User::getAllEmployees(null);
		
		if ($employeeList['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('core.msg_error_getting_entries'));
		}
		foreach ($employeeList['employees'] as $employee)
		{
			$allEmployeeList[$employee->id] = $employee->first_name . " " . $employee->last_name;
		}
		/////////////////////////////////////////////////////////////

		$this->layout->title = 'Edit Invoice';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.invoice.entry', array('mode' => 'edit',
		'postRoute' => 'InvoicePostEditEntry', 'title' => 'Edit Invoice', 'entry' => $entry['entry'],'user' => $user['user'], 'clients' => $allClientList, 'employees' => $allEmployeeList));

	}




	// Post edit entry page
	public function postEditEntry()
	{
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		
		Input::merge(array_map('trim', Input::all()));


		$entryValidator = Validator::make(Input::all(), InvoiceEntry::$edit_entry_rules);

	

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 		$clientinfo = ClientEntry::getSingleClientEntryByMembershipID(Input::get('client_id'));
 		
 		$employeeinfo = EmployeeEntry::getSingleEmployeeEntryByID(Input::get('employee_id'));


		$editNewEntry = $this->repo->postEditEntry(
			Input::get('entry_id'),
			Input::get('employee_id'), 
			Input::get('client_id'), 
			Input::get('payment_due'), 
			Input::get('billing_tax'),
			Input::get('price'),
			Input::get('invoice_membership'),
			Input::get('service_name'),
			Input::get('service_description'),
			Input::get('payment_method'),
			Input::get('invoice_total'),
			Input::get('shipping_tax'),
			$employeeinfo['employee']->employee_first_name,
			$employeeinfo['employee']->employee_last_name,
			$clientinfo['entry']->entry_id
			);
 				

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('franchisee.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('invoiceLanding')->with('success_message', Lang::get('franchisee.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}


	// Post delete entry
	public function getDeleteEntry($id = null)
	{

		$user = User::getUserInfos(Auth::user()->id);
		if ($id == null)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('franchisee.msg_error_getting_entry'));
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
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.unauthorized_access'));
		}

		if ($hasAuthority == false)
		{
			return Redirect::route('invoiceLanding')->with('error_message', Lang::get('messages.unauthorized_access'));
		}
		// - AUTHORITY CHECK ENDS HERE - //
		$entry = InvoiceEntry::getSingleInvoiceEntry($id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('invoiceLanding')->with('error_message', Lang::get('messages.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('invoiceLanding')->with('success_message', Lang::get('messages.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('invoiceLanding')->with('error_message', Lang::get('messages.msg_error_deleting_entry'));
		}
	}
//create pdf
	public function createPdf($id)
	{
		//check report id
		if (isset($id))
		{

			$invoice = InvoiceEntry::getSingleInvoiceEntry($id);

			$productsperinvoice = InvoiceEntry::getProductsPerInvoice($invoice['entry']->entry_id);

			$employeeinfo = EmployeeEntry::getSingleEmployeeEntryByID($invoice['entry']->employee_id);

			$invoicesData[] = array('invoice' => $invoice, 'employeeinfo' => $employeeinfo['employee'], 'productsperinvoice' => $productsperinvoice['productsperinvoice']);

		//goDie($invoicesData);

			
			if ($invoice['status'] == 0)
			{
				return Redirect::back()->with('error_message', Lang::get('messages.msg_error_getting_entry'));
			}

			//goDie($invoicesData);

			$currdate = date('d-m-Y');

			$pdfname = 'invoice-report-' . $invoice['entry']->entry_id . '-' . $currdate;

			$pdfreportfullpath = public_path() . "/uploads/modules/invoices/pdfreports/" . $pdfname . '.pdf';

			//call createPdf method to create pdf



			$pdf = PDF::loadView('modules.invoice.invoicespdf', array('invoicesdata' => $invoicesData, 'productsperinvoice' => $productsperinvoice))->save( $pdfreportfullpath );
			return $pdf->stream();

		}

		else
		{
			$this->layout->content = View::make('general.errors.error');
		}
	}


  
}
