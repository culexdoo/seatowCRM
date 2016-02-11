<?php
/*
*	Franchisee Repository
*
*	Handles functions:
*/



class FranchiseeRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($id, $address, $franchisee_id, $city, $country, $zip, $franchisee_short, $franchisee_long, $state)
	{
		try
		{   
			$entry = new FranchiseeEntry;
			$entry->id = $id;
			$entry->address = $address;
			$entry->franchisee_id = $franchisee_id;
			$entry->city = $city;
			$entry->country = $country;
			$entry->zip = $zip;
			$entry->franchisee_short = $franchisee_short;
			$entry->franchisee_long = $franchisee_long;
			$entry->state = $state;

			$entry->save();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


	// Editing new entry into database
	public function postEditEntry($entry_id, $address, $franchisee_id, $city, $country, $zip, $franchisee_short, $franchisee_long, $state)
	{
	/*	 try
		{  */

			$entry = FranchiseeEntry::find($entry_id); 
			$entry->address = $address;
			$entry->franchisee_id = $franchisee_id;
			$entry->city = $city;
			$entry->country = $country;
			$entry->zip = $zip;
			$entry->franchisee_short = $franchisee_short;
			$entry->franchisee_long = $franchisee_long;
			$entry->state = $state;


			$entry->save();

			return array('status' => 1);
	/*	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  */
	}

	// Delete the entry item
	public function deleteEntry($id)
	{
		try
		{ 
			$entry = FranchiseeEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
