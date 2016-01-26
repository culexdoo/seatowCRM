<?php
/*
*	Event Repository
*
*	Handles functions:
*/



class EventRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEvent($membership_id, $action, $additional_note, $employee_first_name, $employee_last_name, $user_id)
	{
		try
		{   

 			$entry = new EventEntry;
			$entry->membership_id = $membership_id;
			$entry->action = $action;
			$entry->additional_note = $additional_note;
			$entry->employee_first_name = $employee_first_name;
			$entry->employee_last_name = $employee_last_name;
			$entry->user_id = $user_id;

			$entry->save(); 			


			return array('status' => 1);
	} 
		catch (Exception $exp)
		{	
			
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 

}
