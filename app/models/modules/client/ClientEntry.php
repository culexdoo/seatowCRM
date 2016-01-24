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
	public static function getSingleClientEntry($entry_id = null, $items = 10)
	{
		try
		{  
			$entry = DB::table('boats_entries')
				//->join('countries', 'countries.id', '=', 'users.country_id')
				->join('boat_hull', 'boat_hull.id', '=', 'boats_entries.hull_id')
				->join('boat_make', 'boat_make.id', '=', 'boats_entries.make_id')
				->join('users', 'users.membership_id', '=', 'boats_entries.membership_id')

				->select(
					'users.country_name AS country_name',
					'users.image AS image',
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.country_id AS country_id',
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
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to',
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
					//'countries.id AS country_id',
					//'countries.country_name AS country_name',
					'boats_entries.id AS boat_id',
					'boats_entries.boat_brand AS boat_brand',
					'boats_entries.boat_name AS boat_name',
					'boats_entries.year AS year',
					'boats_entries.registration_no AS registration_no',
					'boats_entries.federal_doc_no AS federal_doc_no',
					'boats_entries.boat_color AS boat_color',
					'boats_entries.lenght AS lenght',
					'boats_entries.description AS description',
					'boats_entries.engine_type_id AS engine_type_id',
					'boats_entries.fuel_type AS fuel_type',
					'boat_hull.hull_name AS hull_name',
					'boat_make.make_name AS make_name',
					'boat_hull.id AS hull_id',
					'boat_make.id AS make_id'

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
			$entries = DB::table('boats_entries')
				
				->join('boat_hull', 'boat_hull.id', '=', 'boats_entries.hull_id')
				->join('boat_make', 'boat_make.id', '=', 'boats_entries.make_id')
				->join('users', 'users.membership_id', '=', 'boats_entries.membership_id')

				->select(
					'users.image AS image',
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.country_id AS country_id',
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
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to',
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
					'users.country_name AS country_name',
					'boats_entries.id AS boat_id',
					'boats_entries.boat_brand AS boat_brand',
					'boats_entries.boat_name AS boat_name',
					'boats_entries.year AS year',
					'boats_entries.registration_no AS registration_no',
					'boats_entries.federal_doc_no AS federal_doc_no',
					'boats_entries.boat_color AS boat_color',
					'boats_entries.lenght AS lenght',
					'boats_entries.description AS description',
					'boats_entries.engine_type_id AS engine_type_id',
					'boats_entries.fuel_type AS fuel_type',
					'boat_hull.hull_name AS hull_name',
					'boat_make.make_name AS make_name',
					'boat_hull.id AS hull_id',
					'boat_make.id AS make_id'
				)
				->where('users.user_group', '=', 'client')
				->where('users.is_active', '=', '1')
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
	public static function getLastClients($number)
	{
	  
		try
		{  
			$lastClients = DB::table('users')
				->select(
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.created_at AS created_at',
					'users.membership_id AS membership_id'

				)
				->where('users.is_active', '=', '1')
				->where('users.user_group', '=', 'client')
				->take($number)
				->get();

			return array('status' => 1, 'lastclients' => $lastClients);
	 	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}


	
	public static function getCountClients()
	{
		
		try
		{
			$countedUsers = DB::table('users')
 				->select(
					'users.id AS id'
 				)
 				->where('user_group', '=', 'client')
				->where('users.is_active', '=', '1')
				->get();

			return array('status' => 1, 'counted_user_number' => count($countedUsers));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

 
}
