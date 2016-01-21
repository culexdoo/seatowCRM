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
	public function addEntry($country_id, $first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id, $title, $status, $franchisee_id, $member_since, $member_type, $mailing_title, $mailing_first_name, $mailing_last_name, $mailing_company, $mailing_address, $mailing_country, $mailing_state, $mailing_city, $mailing_zip, $mailing_mobile_number, $mailing_email, $short_team_member)
	{
		try
		{   
 			$entry = new ClientEntry;
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->country_id = $country_id;
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
			$entry->title = $title;
			$entry->status = $status;
			$entry->franchisee_id = $franchisee_id;
			$entry->member_since = $member_since;
			$entry->member_type = $member_type;
			$entry->short_team_member = $short_team_member;
			//-- mailing list -- 11 entries
			$entry->mailing_title = $mailing_title;
			$entry->mailing_first_name = $mailing_first_name;
			$entry->mailing_last_name = $mailing_last_name;
			$entry->mailing_company = $mailing_company;
			$entry->mailing_address = $mailing_address;
			$entry->mailing_country = $mailing_country;
			$entry->mailing_state = $mailing_state;
			$entry->mailing_city = $mailing_city;
			$entry->mailing_zip = $mailing_zip;
			$entry->mailing_mobile_number = $mailing_mobile_number;
			$entry->mailing_email = $mailing_email;
			//-- countries


			$entry->save();

			return array('status' => 1);
	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 


	// Editing new entry into database
	public function postEditEntry($entry_id, $first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id, $title, $status, $franchisee_id, $member_since, $member_type, $mailing_title, $mailing_first_name, $mailing_last_name, $mailing_company, $mailing_address, $mailing_country, $mailing_state, $mailing_city, $mailing_zip, $mailing_mobile_number, $mailing_email, $country_id, $event, $short_team_member)
	
	{ 
		 try
		{   

			$entry = ClientEntry::find($entry_id); 
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->country_id = $country_id;
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
			$entry->title = $title;
			$entry->status = $status;
			$entry->franchisee_id = $franchisee_id;
			$entry->member_since = $member_since;
			$entry->member_type = $member_type;
			$entry->event = $event;
			$entry->short_team_member = $short_team_member;
			//-- mailing list -- 11 entries
			$entry->mailing_title = $mailing_title;
			$entry->mailing_first_name = $mailing_first_name;
			$entry->mailing_last_name = $mailing_last_name;
			$entry->mailing_company = $mailing_company;
			$entry->mailing_address = $mailing_address;
			$entry->mailing_country = $mailing_country;
			$entry->mailing_state = $mailing_state;
			$entry->mailing_city = $mailing_city;
			$entry->mailing_zip = $mailing_zip;
			$entry->mailing_mobile_number = $mailing_mobile_number;
			$entry->mailing_email = $mailing_email;


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
