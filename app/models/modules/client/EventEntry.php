<?php

class EventEntry extends Eloquent
{
	protected $table = 'client_tracking';



	// New entry validation
	public static $new_entry_rules = array(
		'event'		=>	'required'

	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'			=>	'required|integer'

	);


	public static function getSingleClientEvent()
	{
		try
		{
			$entry = DB::table('client_tracking')
				
				->select(
					'client_tracking.membership_id AS membership_id',
					'client_tracking.event AS event',
					'client_tracking.additional_notes AS additional_notes'
					
				);
			
			if ($entry_id != null)
			{
				$entry = $entry->where('client_tracking.id', '=', $entry_id)
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
			$entries = DB::table('client_tracking')
				->select(
					'client_tracking.membership_id AS membership_id',
					'client_tracking.event AS event',
					'client_tracking.additional_notes AS additional_notes'
					
				)
				->get();

			return array('status' => 1, 'entries' => $entries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	
 
}
