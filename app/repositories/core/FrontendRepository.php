<?php
/*
*	Frontend Repository
*
*	Handles functions:
*/



class FrontendRepository
{
 
    public function __construct(){

    }



	// Register user
	public function registerUser($email, $password, $first_name, $last_name)
	{
		try
		{
			$newUser = new User;
			$newUser->email = $email;

			$newUser->password = Hash::make($password);

			$newUser->first_name = $first_name;
			$newUser->last_name = $last_name;
 
			$newUser->save(); 

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



}
