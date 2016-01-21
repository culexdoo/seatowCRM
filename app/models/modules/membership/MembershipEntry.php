<?php

class MembershipEntry extends Eloquent
{
	protected $table = 'membership_entries';



	// New entry validation
	public static $new_entry_rules = array(
		'title'					=>	'required',
		'description'			=>	'required',
		'normal_price'			=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'				=>	'required|integer',
		'title'					=>	'required',
		'description'			=>	'required',
		'normal_price'			=>	'required'
	);


	/*
	*	Get classifiedoffer_entries  
	*	
	*	$entry_id 		->	integer or null	->	if ID, retrieve specific entry (with first)
	*	$category_id	->	integer or null	->	if ID, retrieve all by specific category
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getSingleMembershipEntry($entry_id = null, $items = 10)
	{
		try
		{
			$entry = DB::table('membership_entries')
				->select(
					'membership_entries.id AS entry_id',
					'membership_entries.title AS title',
					'membership_entries.description AS description',
					'membership_entries.normal_price AS normal_price',
					'membership_entries.promo_price_1 AS promo_price_1',
					'membership_entries.promo_price_2 AS promo_price_2',
					'membership_entries.created_at AS created_at',
					'membership_entries.updated_at AS updated_at',
					'membership_entries.promo_period_1_from AS promo_period_1_from',
					'membership_entries.promo_period_1_to AS promo_period_1_to',
					'membership_entries.promo_period_2_from AS promo_period_2_from',
					'membership_entries.promo_period_2_to AS promo_period_2_to'
				);
			
			if ($entry_id != null)
			{
				$entry = $entry->where('membership_entries.id', '=', $entry_id)
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
	public static function getAllMemberships()
	{
		

		try
		{
			$entries = DB::table('membership_entries')
			
				->select(
					'membership_entries.id AS entry_id',
					'membership_entries.title AS title',
					'membership_entries.description AS description',
					'membership_entries.normal_price AS normal_price',
					'membership_entries.promo_price_1 AS promo_price_1',
					'membership_entries.promo_price_2 AS promo_price_2',
					'membership_entries.created_at AS created_at',
					'membership_entries.updated_at AS updated_at',
					'membership_entries.promo_period_1_from AS promo_period_1_from',
					'membership_entries.promo_period_1_to AS promo_period_1_to',
					'membership_entries.promo_period_2_from AS promo_period_2_from',
					'membership_entries.promo_period_2_to AS promo_period_2_to'
				)
				->orderBy('membership_entries.created_at', 'DESC')
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
