<?php

class BoatsEntry extends Eloquent
{
	protected $table = 'boats_entries';



	// New entry validation
	public static $new_entry_rules = array(
		'boat_brand'		=>	'required',
		'boat_name'			=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'			=>	'required|integer',
		'boat_brand'		=>	'required',
		'boat_name'			=>	'required'
	);


	/*
	*	Get classifiedoffer_entries  
	*	
	*	$entry_id 		->	integer or null	->	if ID, retrieve specific entry (with first)
	*	$category_id	->	integer or null	->	if ID, retrieve all by specific category
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getSingleBoatsEntry($entry_id = null, $items = 10)
	{
		try
		{   
			$entry = DB::table('boats_entries')
			->join('boat_hull', 'boat_hull.id', '=', 'boats_entries.hull_id')
			->join('boat_make', 'boat_make.id', '=', 'boats_entries.make_id')
			->join('users', 'users.membership_id', '=', 'boats_entries.membership_id')

				->select(
					'boats_entries.id AS entry_id',
					'boats_entries.boat_brand AS boat_brand',
					'boats_entries.boat_name AS boat_name',
					'boats_entries.year AS year',
					'boats_entries.registration_no AS registration_no',
					'boats_entries.federal_doc_no AS federal_doc_no',
					'boats_entries.boat_color AS boat_color',
					'boats_entries.lenght AS lenght',
					'boats_entries.description AS description',
					'boat_hull.hull_name AS hull_name',
					'boat_make.make_name AS make_name',
					'boat_hull.id AS hull_id',
					'boat_make.id AS make_id',
					'boats_entries.engine_type_id AS engine_type_id',
					'boats_entries.fuel_type AS fuel_type',
					'users.membership_id AS membership_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name'
				);
			
			if ($entry_id != null)
			{
				$entry = $entry->where('boats_entries.id', '=', $entry_id)
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
	public static function getAllBoats()
	{
		

		try
		{   
			$entries = DB::table('boats_entries')

			->join('boat_hull', 'boat_hull.id', '=', 'boats_entries.hull_id')
			->join('boat_make', 'boat_make.id', '=', 'boats_entries.make_id')
			->join('users', 'users.membership_id', '=', 'boats_entries.membership_id')
				->select(
					'boats_entries.id AS entry_id',
					'boats_entries.boat_brand AS boat_brand',
					'boats_entries.boat_name AS boat_name',
					'boats_entries.year AS year',
					'boats_entries.registration_no AS registration_no',
					'boats_entries.federal_doc_no AS federal_doc_no',
					'boats_entries.boat_color AS boat_color',
					'boats_entries.lenght AS lenght',
					'boats_entries.description AS description',
					'boat_hull.hull_name AS hull_name',
					'boat_make.make_name AS make_name',
					'boat_hull.id AS hull_id',
					'boat_make.id AS make_id',
					'boats_entries.engine_type_id AS engine_type_id',
					'boats_entries.fuel_type AS fuel_type',
					'users.membership_id AS membership_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.id AS id',
					'users.email AS email',
					'users.email_2 AS email_2',
					'users.username AS username',
					'users.company AS company',
					'users.state AS state',
					'users.zip AS zip',
					'users.mobile_number AS mobile_number',
					'users.mobile_number_2 AS mobile_number_2',
					'users.profile_image AS profile_image',
					'users.home_number AS home_number',
					'users.bus_no AS bus_no',
					'users.summer_no AS summer_no',
					'users.fax_no AS fax_no',
					'users.homeport AS homeport',
					'users.additional_city AS additional_city',
					'users.additional_state AS additional_state',
					'users.additional_notes AS additional_notes',
					'users.notes AS notes',
					'users.address AS address',
					'users.city AS city',
					'users.created_at AS created_at',
					'users.updated_at AS updated_at'

				)
				->where('boats_entries.is_active', '=', '1')
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

	public static function getCountBoats()
	{
		
		try
		{
			$countedBoats = DB::table('boats_entries')
 				->select(
					'boats_entries.id AS id'
 				)
				->where('boats_entries.is_active', '=', '1')
				->get();

			return array('status' => 1, 'counted_boats_number' => count($countedBoats));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

 
}
