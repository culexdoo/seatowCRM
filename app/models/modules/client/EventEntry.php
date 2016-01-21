<?php

class EventEntry extends Eloquent
{
	protected $table = 'users';



	// New entry validation
	public static $new_entry_rules = array(
		'first_name'		=>	'required',
		'last_name'			=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'			=>	'required|integer',
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
	public static function getSingleClientEvent($entry_id = null, $items = 10)
	{
		try
		{
			$entry = DB::table('users')
				->join('countries', 'countries.id', '=', 'users.country_id')
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
					'users.additional_notes AS additional_notes',
					'users.membership_id AS membership_id',
					'users.title AS title',
					'users.status AS status',
					'users.franchisee_id AS franchisee_id',
					'users.member_since AS member_since',
					'users.event as event',
					//mailing entries 11
					'users.mailing_title AS mailing_title',
					'users.mailing_first_name AS mailing_first_name',
					'users.mailing_last_name AS mailing_last_name',
					'users.mailing_company AS mailing_company',
					'users.mailing_address AS mailing_address',
					'users.mailing_country AS mailing_country',
					'users.mailing_state AS mailing_state',
					'users.mailing_city AS mailing_city',
					'users.mailing_zip AS mailing_zip',
					'users.mailing_mobile_number AS mailing_mobile_number',
					'users.mailing_email AS mailing_email',
					'countries.id AS country_id',
					'countries.country_name AS country_name',
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to'
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
	public static function getAllEvents()
	{
		

		try
		{ 
			$entries = DB::table('users')
				->join('countries', 'countries.id', '=', 'users.country_id')
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
					'users.additional_notes AS additional_notes',
					'users.membership_id AS membership_id',
					'users.title AS title',
					'users.status AS status',
					'users.franchisee_id AS franchisee_id',
					'users.member_since AS member_since',
					'users.event AS event',
					//mailing entries 11
					'users.mailing_title AS mailing_title',
					'users.mailing_first_name AS mailing_first_name',
					'users.mailing_last_name AS mailing_last_name',
					'users.mailing_company AS mailing_company',
					'users.mailing_address AS mailing_address',
					'users.mailing_country AS mailing_country',
					'users.mailing_state AS mailing_state',
					'users.mailing_city AS mailing_city',
					'users.mailing_zip AS mailing_zip',
					'users.mailing_mobile_number AS mailing_mobile_number',
					'users.mailing_email AS mailing_email',
					'countries.id AS country_id',
					'countries.country_name AS country_name',
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to'
				)
				->where('users.user_group', '=', 'client')
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
