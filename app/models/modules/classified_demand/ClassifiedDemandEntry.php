<?php

class ClassifiedDemandEntry extends Eloquent
{
	protected $table = 'classifieddemand_entries';



	// New entry validation
	public static $new_entry_rules = array(
		'category_id'			=>	'required|integer',
		'title'					=>	'required',
		'content'				=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'					=>	'required|integer',
 		'category_id'			=>	'required|integer',
		'name'					=>	'required',
  		'image'					=>	'image'
	);


	/*
	*	Get classifieddemand_entries  
	*	
	*	$entry_id 		->	integer or null	->	if ID, retrieve specific entry (with first)
	*	$category_id	->	integer or null	->	if ID, retrieve all by specific category
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getEntry($entry_id = null, $paginate = false, $items = 10)
	{
		try
		{
			$entry = DB::table('classifieddemand_entries')
				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifieddemand_entries.category_id')
				->select(
					'classifieddemand_entries.id AS entry_id',
					'classifieddemand_entries.title AS title',
					'classifieddemand_entries.content AS content',
					'classifieddemand_entries.category_id AS category_id',
					'classifieddemand_entries.user_id AS user_id',
					'classifieddemand_entries.image AS image',
					'classifieds_categories.category_name AS category_name' 
				);
			
			if ($entry_id != null)
			{
				$entry = $entry->where('classifieddemand_entries.id', '=', $entry_id)
					->first();

				return array('status' => 1, 'entry' => $entry);
			}

			// Default return
			$entries = $entry;

			if ($category != null)
			{
				$entries = $entry->where('classifieddemand_entries.category_id', '=', $category);
			}

		  
			if ($paginate == false)
			{
				$entries = $entries->get();
			}
			else
			{
				$entries = $entries->paginate($items);
			}

			return array('status' => 1, 'entries' => $entries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


 

	// Get last classifieds entries for a user, defaults to 10
	public static function getLastClassifiedsDemandsByUser($user = null, $number = 10)
	{
		 if ($user == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{  
			$entries = DB::table('classifieddemand_entries')
				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifieddemand_entries.category_id')
				->select(
					'classifieddemand_entries.id AS entry_id',
					'classifieddemand_entries.title AS title',
					'classifieddemand_entries.content AS content',
					'classifieddemand_entries.image AS image',
					'classifieddemand_entries.category_id AS category_id',
					'classifieds_categories.category_name AS category_name'
				)
				->where('classifieddemand_entries.user_id', '=', $user)
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
	public static function getCountClassifiedDemandEntriesByUser($id = null)
	{
		if ($id == null)
		{
			return array('status' => 0, 'reason' => 'No ID.');
		}

		try
		{
			$entries = DB::table('classifieddemand_entries')
 				->select(
					'classifieddemand_entries.id AS id'
 				)
				->where('classifieddemand_entries.user_id', '=', $id)
				->get();

			return array('status' => 1, 'number_entries' => count($entries));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

 
}
