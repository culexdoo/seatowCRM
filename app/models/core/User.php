<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface
{

	use UserTrait, RemindableTrait;
	use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');



	// Register rules
	public static $register_rules = array(
		'email'					=>	'required|unique:users,email|email',
		'password'				=>	'required',
		'repeat_password'		=>	'required|same:password',
		'first_name'			=>	'required',
		'last_name'				=>	'required'
	);


	// Update password for social networks rules
	public static $update_password_rules = array(
		'password'			=>	'required',
		'repeat_password'	=>	'required|same:password',
		'language'			=>	'required|integer',
	);



	// Edit profile rules
	public static function edit_profile_rules($id)
	{
		return array(
			'email'					=>	'required|unique:users,email,'. $id .'|email',
			'first_name'			=>	'required',
			'last_name'				=>	'required',
			'old_password'			=>	'required_with:new_password',
			'new_password'			=>	array('required_with_all:old_password,repeat_new_password', 'same:repeat_new_password'),
			'repeat_new_password'	=>	'required_with_all:old_password,new_password|same:new_password'
		);
	}



	// New user rules (superadmin)
	public static $new_user_rules_superadmin = array(
		'email'					=>	'required|unique:users|email',
		'password'				=>	'required',
		'email_is_verified' 	=>	'required|boolean',
		'is_banned' 			=>	'required|boolean',
		'is_deleted' 			=>	'required|boolean',
		'first_name'			=>	'required',
		'last_name'				=>	'required',
		'language'				=>	'required|integer',
		'role'					=>	'required|integer'
	);



	// Edit user rules (superadmin)
	public static function edit_user_rules_superadmin($id)
	{
		return array(
			'id'					=>	'required|integer',
			'email'					=>	'required|email|unique:users,email,'. $id .'|email',
			'email_is_verified' 	=>	'required|boolean',
			'is_banned' 			=>	'required|boolean',
			'is_deleted' 			=>	'required|boolean',
			'first_name'			=>	'required',
			'last_name'				=>	'required',
			'language'				=>	'required|integer',
			'role'					=>	'required|integer'
		);
	}



	// New user rules (admin)
	public static $new_user_rules_admin = array(
		'email'					=>	'required|unique:users|email',
		'password'				=>	'required',
		'first_name'			=>	'required',
		'last_name'				=>	'required',
		'language'				=>	'required|integer',
		'role'					=>	'required|integer'
	);



	// Edit user rules (admin)
	public static function edit_user_rules_admin($id)
	{
		return array(
			'id'					=>	'required|integer',
			'email'					=>	'required|email|unique:users,email,'. $id .'|email',
			'first_name'			=>	'required',
			'last_name'				=>	'required',
			'language'				=>	'required|integer',
			'role'					=>	'required|integer'
		);
	}



	// Forgotten password rules
	public static $forgotten_password_rules = array(
		'email'		=>	'required|email|exists:users,email'
	);



	/*
	*	Retrieve user's informations
	*
	*	Uses:
	*	$id			-	null for all, integer for user
 	*/
	public static function getUserInfos($id = null)
	{
		if ($id != null)
		{
			// Retrieve specific user informations
			try
			{
				$user = DB::table('users')
 					->select(
						'users.id AS id',
						'users.email AS email',
						'users.first_name AS first_name',
						'users.last_name AS last_name'
						)
					->where('users.id', '=', $id)
					->first();

				return array('status' => 1, 'user' => $user);
			}
			catch (Exception $exp)
			{
				return array('status' => 0, 'reason' => $exp->getMessage());
			}
		}
	  
	}



	// Get user by e-mail
	public static function getUserByEmail($email = null)
	{
		if ($email != null)
		{
			// Retrieve specific user informations
			try
			{
				$user = DB::table('users')
					->select(
						'users.id AS id',
						'users.email AS email',
						'users.first_name AS first_name',
						'users.last_name AS last_name',
						'users.address AS address',
						'users.city AS city',
						'users.phone AS phone',
						'users.job_title AS job_title',
						'users.biography AS biography',
						'users.profile_image AS profile_image',
						'users.facebook_id AS facebook_id',
						'users.google_id AS google_id',
						'users.is_banned AS is_banned',
						'users.is_deleted AS is_deleted',
						'users.email_is_verified AS email_is_verified',
						'users.created_at AS created_at',
						'users.updated_at AS updated_at',
						'users.language AS language_id'
						)
					->where('users.email', '=', $email)
					->first();

				return array('status' => 1, 'user' => $user);
			}
			catch (Exception $exp)
			{
				return array('status' => 0, 'reason' => $exp->getMessage());
			}
		}
		else
		{
			return array('status' => 0, 'reason' => 'No e-mail entered.');
		}
	}



	// Get user by Google ID
	public static function getUserByGoogle($id = null)
	{
		if ($id != null)
		{
			// Retrieve specific user informations
			try
			{
				$user = DB::table('users')
					->select(
						'users.id AS id',
						'users.email AS email',
						'users.first_name AS first_name',
						'users.last_name AS last_name',
						'users.address AS address',
						'users.city AS city',
						'users.phone AS phone',
						'users.job_title AS job_title',
						'users.biography AS biography',
						'users.profile_image AS profile_image',
						'users.facebook_id AS facebook_id',
						'users.google_id AS google_id',
						'users.is_banned AS is_banned',
						'users.is_deleted AS is_deleted',
						'users.email_is_verified AS email_is_verified',
						'users.created_at AS created_at',
						'users.updated_at AS updated_at',
						'users.language AS language_id'
						)
					->where('users.google_id', '=', $id)
					->first();

				return array('status' => 1, 'user' => $user);
			}
			catch (Exception $exp)
			{
				return array('status' => 0, 'reason' => $exp->getMessage());
			}
		}
		else
		{
			return array('status' => 0, 'reason' => 'No ID entered.');
		}
	}



	// Get user by Facebook ID
	public static function getUserByFacebook($id = null)
	{
		if ($id != null)
		{
			// Retrieve specific user informations
			try
			{
				$user = DB::table('users')
					->select(
						'users.id AS id',
						'users.email AS email',
						'users.first_name AS first_name',
						'users.last_name AS last_name',
						'users.address AS address',
						'users.city AS city',
						'users.phone AS phone',
						'users.job_title AS job_title',
						'users.biography AS biography',
						'users.profile_image AS profile_image',
						'users.facebook_id AS facebook_id',
						'users.google_id AS google_id',
						'users.is_banned AS is_banned',
						'users.is_deleted AS is_deleted',
						'users.email_is_verified AS email_is_verified',
						'users.created_at AS created_at',
						'users.updated_at AS updated_at',
						'users.language AS language_id'
						)
					->where('users.facebook_id', '=', $id)
					->first();

				return array('status' => 1, 'user' => $user);
			}
			catch (Exception $exp)
			{
				return array('status' => 0, 'reason' => $exp->getMessage());
			}
		}
		else
		{
			return array('status' => 0, 'reason' => 'No ID entered.');
		}
	}

	public static function userStats()
    {
        try
        {
            $users = array();
            $users['total'] = User::count();
            return array('status' => 1, 'stats' => $users);
        }
        catch(Exception $exp)
        {
            return array('status' => 0);
        }
    }
}
