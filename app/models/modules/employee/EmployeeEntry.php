<?php

class EmployeeEntry extends Eloquent
{
	protected $table = 'users';



	// New entry validation
	public static $new_entry_rules = array(
		'employee_id'		=>	'required',
		'first_name'		=>	'required',
		'last_name'			=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'employee_id'		=>	'required',
		'first_name'		=>	'required',
		'last_name'			=>	'required'
	);


	/*
	*	Get classifiedoffer_entries  
	*	
	*	$entry_id 		->	integer or null	->	if ID, retrieve specific entry (with first)
	*	$category_id	->	integer or null	->	if ID, retrieve all by specific category
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getSingleEmployeeEntry($employee_id = null, $items = 10)
	{
		try
		{
			$entry = DB::table('users')
				->select(
					'users.id AS id',
					'users.employee_id AS employee_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.mobile_number AS mobile_number',
					'users.employee_description AS employee_description',
					'users.email AS email',
					'users.password AS password',
					'users.city AS city'
				);
			
			if ($employee_id != null)
			{
				$entry = $entry->where('users.employee_id', '=', $employee_id)
					->first();

				return array('status' => 1, 'entry' => $entry);
			}

			// Default return
			$entries = $entry;

		  
			
			return array('status' => 1, 'entries' => $entries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

	public static function getSingleEmployeeEntryByID($user_id = null, $items = 10)
	{
		try
		{
			$employee = DB::table('users')
				->join('franchisee_entries', 'franchisee_entries.franchisee_id', '=', 'users.franchisee_id')
				->select(
					'users.id AS id',
					'users.employee_id AS employee_id',
					'users.first_name AS employee_first_name',
					'users.last_name AS employee_last_name',
					'users.address AS employee_address',
					'users.mobile_number AS employee_mobile_number',
					'users.employee_description AS employee_description',
					'users.email AS employee_email',
					'users.city AS city',
					'franchisee_entries.city AS franchisee_city',
					'franchisee_entries.country AS franchisee_country',
					'franchisee_entries.zip AS franchisee_zip',
					'franchisee_entries.country AS franchisee_country',
					'franchisee_entries.franchisee_id AS franchisee_id',
					'franchisee_entries.address AS franchisee_address',
					'franchisee_entries.state AS franchisee_state'
					);
			
			if ($user_id != null)
			{
				$employee = $employee->where('users.id', '=', $user_id)
					->first();

				return array('status' => 1, 'employee' => $employee);
			}

			// Default return
			$entries = $employee;

		  
			
			return array('status' => 1, 'entries' => $entries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	// Get last classifieds entries for a user, defaults to 10
	public static function getAllEmployees()
	{
		

		try
		{
			$entries = DB::table('users')
			
				->select(
					'users.id AS id',
					'users.employee_id AS employee_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.mobile_number AS mobile_number',
					'users.employee_description AS employee_description',
					'users.email AS email',
					'users.password AS password',
					'users.city AS city',
					'users.mobile_number AS mobile_number',
					'users.franchisee_id AS franchisee_id',
					'users.image AS image',
					'users.employee_description AS employee_description'
				)
				->where('users.user_group', '=', 'employee')
				->orderBy('users.created_at', 'DESC')
				->get();

			return array('status' => 1, 'entries' => $entries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



	// Get last classifieds entries 8
	public static function getLastClassifiedsOffers($number)
	{
	  
		try
		{  
			$entries = DB::table('classifiedoffer_entries')
				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifiedoffer_entries.category_id')
				->select(
					'classifiedoffer_entries.id AS entry_id',
					'classifiedoffer_entries.title AS title',
					'classifiedoffer_entries.content AS content',
					'classifiedoffer_entries.short_description AS short_description',
					'classifiedoffer_entries.color AS color',
					'classifiedoffer_entries.material AS material',
					'classifiedoffer_entries.image AS image',
					'classifiedoffer_entries.category_id AS category_id',
					'classifieds_categories.category_name AS category_name'
				)
 				->orderBy('classifiedoffer_entries.created_at', 'DESC')
				->take($number)
				->get();

			return array('status' => 1, 'entries' => $entries);
	 	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}


	// Get last classifieds entries 8
	public static function getLastClassifiedsDemands($number)
	{
	  
		try
		{  
			$entries = DB::table('classifieddemand_entries')
				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifieddemand_entries.category_id')
				->select(
					'classifieddemand_entries.id AS entry_id',
					'classifieddemand_entries.title AS title',
					'classifieddemand_entries.content AS content',
					'classifieddemand_entries.short_description AS short_description',
					'classifieddemand_entries.color AS color',
					'classifieddemand_entries.material AS material',
					'classifieddemand_entries.image AS image',
					'classifieddemand_entries.category_id AS category_id',
					'classifieds_categories.category_name AS category_name'
				)
 				->orderBy('classifieddemand_entries.created_at', 'DESC')
				->take($number)
				->get();

			return array('status' => 1, 'entries' => $entries);
	 	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}


	// Count entries per user
	public static function getCountClassifiedOfferEntriesByUser($id = null)
	{
		if ($id == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{
			$entries = DB::table('classifiedoffer_entries')
 				->select(
					'classifiedoffer_entries.id AS id'
 				)
				->where('classifiedoffer_entries.user_id', '=', $id)
				->get();

			return array('status' => 1, 'number_entries' => count($entries));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}
 
}
