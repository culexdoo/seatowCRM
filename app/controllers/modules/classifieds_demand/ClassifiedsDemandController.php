<?php
/*
*	Classifieds demand Module controller
*/

class ClassifiedsDemandController extends CoreController {

	// Enviroment variables
	protected $repo;
	protected $moduleInfo;



	// Constructing default values
	public function __construct()
	{
		// Call CoreController constructor to get Layout and other variables
		parent::__construct();

		// Make module variables
		$this->repo = new ClassifiedsDemandRepository;
 
	}

	public function getLanding()
	{
		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		// Get module landing data
		$classifiedsdemands = ClassifiedDemandEntry::getLastClassifiedsDemandsByUser(Auth::user()->id);

		if ($classifiedsdemands['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		} 

		$this->layout->title = 'Pregled oglasa "tražim"';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.classifieds_demand.entryList', array('title' => 'Pregled oglasa "tražim"', 'user' => $user['user'], 'classifiedsdemands' => $classifiedsdemands ));
		 
	}


	// Get add entry
	public function getAddEntry()
	{

		 
		$user = User::getUserInfos(Auth::user()->id);



		if ($user['status'] == 0)
		{
			return Redirect::route('getDashboard')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}
  


		$categoriesList = array();

		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);

		if ($classifiedsCategories['status'] == 0)
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('error_message', Lang::get('classifieds.msg_error_getting_categories'));
		}
		foreach ($classifiedsCategories['categories'] as $category)
		{
			$categoriesList[$category->category_id] = $category->category_name;
		}

 

		$this->layout->title = 'Zatraži proizvod';


		$this->layout->css_files = array( 
		);

		$this->layout->js_header_files = array( 
		);

		$this->layout->content = View::make('modules.classifieds_demand.entry', array('mode' => 'add',
		'postRoute' => 'ClassifiedsDemandPostAddEntry', 'title' => 'Zatraži proizvod', 'categories' => $categoriesList, 'user' => $user['user']));
 	
	}



	// Post add classifieddemand
	public function postAddEntry()
	{
		Input::merge(array_map('trim', Input::all()));
 
		$entryValidator = Validator::make(Input::all(), ClassifiedDemandEntry::$new_entry_rules);

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_demand.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 

		$addNewEntry = $this->repo->addEntry(Input::get('title'), Input::get('content'), Input::get('category_id'), Input::get('user_id'), Input::file('image'));

		if ($addNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classified_demand.msg_error_adding_entry'))->withErrors($entryValidator)->withInput();
		}
		else
		{
			return Redirect::route('getDashboard')->with('success_message', Lang::get('classified_demand.msg_success_entry_added', array('name' => Input::get('name'))));
		}
	}



	// Display edit entry page
	public function getEditEntry($entry_id)
	{
		$user = User::getUserInfos(Auth::user()->id);
		if ($user['status'] == 0)
		{
			return Redirect::route('ClassifiedsDemandGetLanding')->with('error_message', Lang::get('messages.error_getting_user_info'));
		}

		  
		$entry = ClassifiedDemandEntry::getEntry($entry_id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}


		$categoriesList = array();

		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);

		if ($classifiedsCategories['status'] == 0)
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('error_message', Lang::get('classifieds.msg_error_getting_categories'));
		}
		foreach ($classifiedsCategories['categories'] as $category)
		{
			$categoriesList[$category->category_id] = $category->category_name;
		}
 

		$this->layout->title = 'Uredi unos';
		$this->layout->css_files = array( 
 		);

		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('modules.classifieds_demand.entry', array('mode' => 'edit',
		'postRoute' => 'ClassifiedsDemandPostEditEntry', 'title' => 'Uredi oglas', 'entry' => $entry['entry'], 'categories' => $categoriesList, 'user' => $user['user']));

	}




	// Post edit entry page
	public function postEditEntry()
	{

		/*
		Input::merge(array_map('trim', Input::all()));
 
		$entryValidator = Validator::make(Input::all(), ClassifiedOfferEntry::$edit_entry_rules);

		if ($entryValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('classified_offer.msg_error_validating_entry'))->withErrors($entryValidator)->withInput();
		}
 
 			*/
		$editNewEntry = $this->repo->postEditEntry(Input::get('entry_id'), Input::get('title'), Input::get('content'), Input::get('category_id'), Input::file('image'));

		if ($editNewEntry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_editing_entry'))->withErrors($entryValidator)->withInput();
		}

		else
		{
			return Redirect::route('getDashboard')->with('success_message', Lang::get('classifieds.msg_success_editing_entry', array('name' => Input::get('name'))));
		}
	}


	// Post delete entry
	public function getDeleteEntry($id = null)
	{
		if ($id == null)
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}

		$entry = ClassifiedDemandEntry::getEntry($id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}

		if (!is_object($entry['entry']))
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}

  
		$deleteEntry = $this->repo->deleteEntry($id);

		if ($deleteEntry['status'] == 1)
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('success_message', Lang::get('classifieds.msg_success_entry_deleted'));
		}
		else
		{
			return Redirect::route('ClassifiedsDemandLanding')->with('error_message', Lang::get('classifieds.msg_error_deleting_entry'));
		}
	}




  
}
