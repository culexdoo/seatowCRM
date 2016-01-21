<?php
/*
*	Frontend controller
*
*	Serves the following:
*	- example page
*/


class FrontendController extends BaseController

{

	// Enviroment variables
	protected $layout;
    protected $repo;

	// Constructing default values
	public function __construct() {

		$this->layout = "frontend";
	    $this->repo = new FrontendRepository;

    }

 
   	// Show Home page (landing)
	public function getLanding()
	{

		// Get module landing data
		$classifiedsdemands = ClassifiedDemandEntry::getLastClassifiedsDemands(4);
		$classifiedsoffers = ClassifiedOfferEntry::getLastClassifiedsOffers(4);
 		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);


		$this->layout->css_files = array(
			'css/frontend/frontend.css',
		);
		$this->layout->js_header_files = array(

		);
 		$this->layout->content = View::make('frontend.home', array('title' => 'Mrkva+ portal', 'classifiedsoffers' => $classifiedsoffers, 'classifiedsdemands' => $classifiedsdemands, 'allcategories' => $classifiedsCategories ));
	}
 


 	public function getSingleOfferEntry($entry_id)
	{
	 
 
		$entry = ClassifiedOfferEntry::getSingleOfferEntry($entry_id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}
 
	 
		$classifiedsoffers = ClassifiedOfferEntry::getLastClassifiedsOffers(4);

		$categoriesList = array();  

		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);
 
		foreach ($classifiedsCategories['categories'] as $category)
		{
			$categoriesList[$category->category_id] = $category->category_name;
		}
 
  
		$this->layout->title = $entry['entry']->title;


		$this->layout->css_files = array(
			'css/frontend/frontend.css',
		);
		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('frontend.singleoffer', array('title' => $entry['entry']->title, 'entry' => $entry['entry'], 'categories' => $categoriesList, 'classifiedsoffers' => $classifiedsoffers, 'allcategories' => $classifiedsCategories));

	}

	public function getSingleDemandEntry($entry_id)
	{
	 
 
		$entry = ClassifiedOfferEntry::getSingleDemandEntry($entry_id);
		if ($entry['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}
 
	 
		$classifiedsdemands = ClassifiedOfferEntry::getLastClassifiedsDemands(4);

		$categoriesList = array();

		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);
 
		foreach ($classifiedsCategories['categories'] as $category)
		{
			$categoriesList[$category->category_id] = $category->category_name;
		}
 

		$this->layout->title = $entry['entry']->title;


		$this->layout->css_files = array(
			'css/frontend/frontend.css',
		);
		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('frontend.singledemand', array('title' => $entry['entry']->title, 'entry' => $entry['entry'], 'categories' => $categoriesList, 'classifiedsdemands' => $classifiedsdemands, 'allcategories' => $classifiedsCategories));

	}

 	public function getOfferCategoryClassifieds($category_id)
	{
	  
		$categoryclassifieds = ClassifiedsCategory::getOfferCategoryClassifieds($category_id);
		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);
		if ($categoryclassifieds['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}
 
		$this->layout->css_files = array(
			'css/frontend/frontend.css',
		);
		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('frontend.category_offer', array('title' => 'Ponude iz kategorije', 'categoryclassifieds' => $categoryclassifieds, 'allcategories' => $classifiedsCategories));

	}

 	public function getDemandCategoryClassifieds($category_id)
	{
	  
		$categoryclassifieds = ClassifiedsCategory::getDemandCategoryClassifieds($category_id);
		// Get categories  
		$classifiedsCategories = ClassifiedsCategory::getCategory(null);
		if ($categoryclassifieds['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('classifieds.msg_error_getting_entry'));
		}
 
		$this->layout->css_files = array(
			'css/frontend/frontend.css',
		);
		$this->layout->js_header_files = array( 
		);
	 

		$this->layout->content = View::make('frontend.category_demand', array('title' => 'Ponude iz kategorije', 'categoryclassifieds' => $categoryclassifieds, 'allcategories' => $classifiedsCategories));

	}

 

	// Show Sign in page
	public function getSignIn()
	{


 		$this->layout->css_files = array(
 			'css/core/custom/custom.css',
		);
		$this->layout->js_footer_files = array(
			'js/core/icheck.min.js'
		);
		$this->layout->content = View::make('frontend.signIn');

	}


	/*
	 *	Sign in / out segment
	 */




	// Post sign in
	public function postSignIn()
	{
		Input::merge(array_map('trim', Input::all()));

		if (Auth::attempt(array('email' => Input::get('sign_in_email'), 'password' => Input::get('sign_in_password'))))
		{
			$user_language = 'en';

			Session::put('lang', $user_language);

			App::setLocale($user_language);

		 

				return Redirect::route('getDashboard')->with('success_message', Lang::get('messages.sign_in_success'));

		}
		else
		{
			return Redirect::route('getSignIn')->with('error_message', Lang::get('messages.sign_in_error'));
		}
	}



	/*
	 *	Forgot password segment
	 */



	// Show Forgot password page
	public function getForgotPassword()
	{
		$this->layout->css_files = array(
			'css/core/forgotPassword.css',
		);
		$this->layout->content = View::make('core.forgotPassword');
	}



	// Submit forgot password
	public function postForgotPassword()
	{
		$response = Password::remind(Input::only('email'), function($message)
		{
			$message->subject(Lang::get('forgotPassword.password_reset_email_title'));
		});

		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error_message', Lang::get($response));
				break;

			case Password::REMINDER_SENT:
				return Redirect::back()->with('success_message', Lang::get($response));
				break;
		}
	}



	/*
	 *	Register segment
	 */



	// Show register page
	public function getRegister()
	{ 

 		$this->layout->css_files = array(
 			'css/core/custom/custom.css',
		);
		$this->layout->js_footer_files = array(
			'js/core/icheck.min.js'
		);
		$this->layout->content = View::make('frontend.register');
	}



	// Post register
	public function postRegister()
	{
		Input::merge(array_map('trim', Input::all()));

		$userValidator = Validator::make(Input::all(), User::$register_rules);

		if ($userValidator->fails())
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_validating_registration'))->withErrors($userValidator)->withInput();
		}

		$tryNewUser = $this->repo->registerUser(Input::get('email'), Input::get('password'), Input::get('first_name'), Input::get('last_name'));

		if ($tryNewUser['status'] == 0)
		{
			return Redirect::back()->with('error_message', Lang::get('messages.error_creating_new_user'))->withErrors($userValidator)->withInput();
		}

		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
			Mail::send('emails.register', array('name' => Input::get('first_name'), 'password' => Input::get('password')), function($message)
			{
				$message->from('info@betaware.hr', 'Mrkvaapp+');
				$message->subject('Hvala na registraciji');
				$message->to(Input::get('email'));
			});

 
		 
		    return Redirect::intended('dashboard')->with('success_message', Lang::get('messages.sign_in_success'));
	 

			Session::put('lang', 'hr');
			App::setLocale('hr');

			return Redirect::intended('dashboard')->with('success_message', Lang::get('messages.sign_in_success'));
		}
		else
		{
			return Redirect::back()->with('error_message', Lang::get('messages.sign_in_error'))->withInput();
		}
	}



}