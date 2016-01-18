<?php

class apiCore extends \ResponseController {
    
        protected $followRepo;

	public function __construct() {

		$this->repo = new CoreRepository;
		$this->api = new apiRepository;



	}

	public function login() {

		if (Auth::check()) {

			$user = Auth::user();
            //print_r($user);

				return $this->response(1, 'Login sucess, user');

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}
    
    public function getPushData(){

        $user = Auth::user();
        $user_id=$user->id;
               
            $userFollows=User::find($user_id)->follow;
            if($userFollows){
                $userFollows=trim($userFollows, ',');
                     $usserFollow=explode(',', $userFollows);

                    $pushdata=array(
                                   'following'=>$usserFollow,
                                   );

              return $this->response(1, $pushdata);             
                
            }
            else { 
               $pushdata=array(
                                   'following'=>array(),
                                   );
                return $this->response(1, $pushdata); 
            }
           

    }
 
 
    	public function follow() {
            $user = Auth::user();
            $follow = Request::input('followId');
            
            
            $user=User::find($user->id);
            
            if(array_pop($follow)=='unsubscribe') $unsubscribe=true;
            else $unsubscribe=false;   
            $this->saveFollowId($user->id, $follow, $unsubscribe);

            return $this->response(1, 'Successfully subscribed');

        }
    public function saveFollowId($user_id, $followId, $unsubscribe=false)
  {
            
            if(!$unsubscribe){                
                $juzer= User::find($user_id);
                               
                $nufid=$followId[0].',';
             if(strpos($juzer->follow, $nufid)===false) {
                    $juzer->follow.=$nufid;
                    $juzer->save();
                }
            }
            else{
                $juzer= User::find($user_id);
                $juzer->follow=str_replace($followId[0].',', '', $juzer->follow );
                $juzer->save();                
            }
          //echo 'juzer prati ove follow_idje: <pre>'; print_r ( $juzer->follow); echo '</pre>';

      return $juzer->id;

  }   
        public function saveToken() {
            $user = Auth::user();
            $token = Request::input('token');
            
            
            $user_id=$user->id;
            
            $juzer=User::find($user->id);
            $juzer->push_token=$token;
            $juzer->save();
                
            return $this->response(1, 'Token saved');

        }

	public function socialLogin() {

		$userData = Input::json()->all();

		$user = $userData['user'];

		if ($userData['social'] == 'facebook') {

			$validate = Validator::make($user, User::$register_email_only_rules);

			if ($validate->fails()) {

				$addFBIDtoEmail = $this->repo->addFacebookToUser($user['email'], $user['id']);

				if ($addFBIDtoEmail['status'])
				{

					return $this->response(1, 'Login sucess, Facebook user');

				} else {

					return $this->response(0, 'Login error, Error while adding Facebook ID to user');

				}
				
			} else {

				// create new user
				$newUser = $this->repo->registerUserWithoutPassword($user['email'], $user['first_name'], $user['last_name'], $user['id'], null);

				if ($newUser['status']) {
					
					return $this->response(1, 'Login sucess, Facebook user');

				} else {

					return $this->response(0, 'Login error, Error while registering new user with Facebook');

				}

			}
			
		} elseif ($userData['social'] == 'google') {

			$validate = Validator::make($user, User::$register_email_only_rules);

			if ($validate->fails()) {

				$addGIDtoEmail = $this->repo->addGoogleToUser($user['email'], $user['id']);

				if ($addGIDtoEmail['status'])
				{

					return $this->response(1, 'Login sucess, Google user');

				} else {

					return $this->response(0, 'Login error, Error while adding Google ID to user');

				}

			} else {

				// create new user
				$newUser = $this->repo->registerUserWithoutPassword($user['email'], $user['given_name'], $user['family_name'], null, $user['id']);

				if ($newUser['status']) {
					
					return $this->response(1, 'Login sucess, Google user');

				} else {

					return $this->response(0, 'Login error, Error while registering new user with Google');

				}

			}

		}

	}

	public function register() {

		$registerData = Input::json()->all();

		$userValidator = Validator::make($registerData, User::$register_rules);

		if ($userValidator->fails()) {
			
			return Response::json($userValidator->messages());

		} else {

			//check if user seected language
			if (array_key_exists('language', $registerData)) {
				
				$language = $registerData['language'];

			} else {

				$language = 1;

			}

			$tryNewUser = $this->repo->registerUser($registerData['email'], $registerData['password'], $registerData['first_name'], $registerData['last_name'], $language);

			if ($tryNewUser['status']) {

				return 1;
				
			} else {

				return 0;

			} 

		}

	}

	public function recover() {

		$data = Input::json()->all();
		$email = $data['email'];

		$response = Password::remind(array('email' => $email), function($message) use ($email) {
			$message->subject(Lang::get('forgotPassword.password_reset_email_title'));
			$message->to($email);
		});

		switch ($response)
		{
			case Password::INVALID_USER:
				return 0;
				break;

			case Password::REMINDER_SENT:
				return 1;
				break;
		}

	}

	public function getLanguages() {

		$languagesList = Language::getLanguage();

		if ($languagesList['status']) {

			return Response::json($languagesList['languages']);

		} else {

			return 0;

		}

	}

	public function checkCurrentCity() {

		if (Auth::check()) {
			
			$user = Auth::user();

			$postData = Input::get();

			$lat = $postData['lat'];
			$lon = $postData['lon'];

			$cityId = $this->api->checkCurrentCity($user->id, $lat, $lon);

			if($cityId['status']) {

				return $this->response(1, $cityId['city']);
				
			} else {

				return $this->response(0, $cityId['message']);

			}

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

    
	public function getCities() {

		$data = Input::get();

		if (array_key_exists('city', $data)) {

			$city = $data['city'];

		} else {

			$city = false;

		}

		if (Auth::check()) {
			
			$citiesList = $this->api->getCities($city);

			if ($citiesList['status']) {
				
				return $this->response($citiesList['status'], $citiesList['data']);

			} else {

				return $this->response($citiesList['status'], $citiesList['message']);

			}

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

}
