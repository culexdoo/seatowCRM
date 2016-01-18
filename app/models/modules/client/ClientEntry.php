<?php

class ClientEntry extends Eloquent
{
	protected $table = 'users';



	// New entry validation
	public static $new_entry_rules = array(
		'first_name'		=>	'required',
		'last_name'			=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'				=>	'required|integer',
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
	public static function getSingleClientEntry($entry_id = null, $items = 10)
	{
		try
		{
			$entry = DB::table('users')
				->select(
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.city AS city',
					'users.zip AS zip',
					'users.mobile_number AS mobile_number',
					'users.email AS email',
					'users.mobile_number_2 AS mobile_number_2',
					'users.email_2 AS email_2',
					'users.home_number AS home_number',
					'users.bus_no AS bus_no',
					'users.summer_no AS summer_no',
					'users.fax_no AS fax_no',
					'users.homeport AS homeport',
					'users.additional_city AS additional_city',
					'users.additional_state AS additional_state',
					'users.notes AS notes',
					'users.additional_notes AS additional_notes'
				);
			
			if ($entry_id != null)
			{
				$entry = $entry->where('users.id', '=', $entry_id)
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


	// Get last classifieds entries for a user, defaults to 10
	public static function getAllClients()
	{
		

		try
		{ 
			$entries = DB::table('users')
			
				->select(
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.city AS city',
					'users.zip AS zip',
					'users.mobile_number AS mobile_number',
					'users.email AS email',
					'users.mobile_number_2 AS mobile_number_2',
					'users.email_2 AS email_2',
					'users.home_number AS home_number',
					'users.bus_no AS bus_no',
					'users.summer_no AS summer_no',
					'users.fax_no AS fax_no',
					'users.homeport AS homeport',
					'users.additional_city AS additional_city',
					'users.additional_state AS additional_state',
					'users.notes AS notes',
					'users.additional_notes AS additional_notes'
				)
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