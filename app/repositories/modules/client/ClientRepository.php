<?php
/*
*	Client Repository
*
*	Handles functions:
*/



class ClientRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id)
	{
		try
		{  
 			$entry = new ClientEntry;
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->state = $state;
			$entry->city = $city;
			$entry->zip = $zip;
			$entry->mobile_number = $mobile_number;
			$entry->email = $email;
			$entry->mobile_number_2 = $mobile_number_2;
			$entry->email_2 = $email_2;
			$entry->home_number = $home_number;
			$entry->bus_no = $bus_no;
			$entry->summer_no = $summer_no;
			$entry->fax_no = $fax_no;
			$entry->homeport = $homeport;
			$entry->additional_city = $additional_city;
			$entry->additional_state = $additional_state;
			$entry->notes = $notes;
			$entry->additional_notes = $additional_notes;
			$entry->membership_id = $membership_id;
			$entry->user_group = 'client';

			$entry->save();

			return array('status' => 1);
	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 


	// Editing new entry into database
	public function postEditEntry($entry_id, $first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id)
	
	{
		 try
		{   

			$entry = ClientEntry::find($entry_id); 
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->state = $state;
			$entry->city = $city;
			$entry->zip = $zip;
			$entry->mobile_number = $mobile_number;
			$entry->email = $email;
			$entry->mobile_number_2 = $mobile_number_2;
			$entry->email_2 = $email_2;
			$entry->home_number = $home_number;
			$entry->bus_no = $bus_no;
			$entry->summer_no = $summer_no;
			$entry->fax_no = $fax_no;
			$entry->homeport = $homeport;
			$entry->additional_city = $additional_city;
			$entry->additional_state = $additional_state;
			$entry->notes = $notes;
			$entry->additional_notes = $additional_notes;
			$entry->membership_id = $membership_id;


			$entry->save();

			return array('status' => 1);
		 } 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}

	// Delete the entry item
	public function deleteEntry($id)
	{
		try
		{ 
			$entry = ClientEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
