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
	public function addEntry($user_id, $user_first_name, $user_last_name, $image = null, $membership_from, $membership_to, $country_name, $first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id, $title, $status, $franchisee_id, $member_since, $member_type, $mailing_title, $mailing_first_name, $mailing_last_name, $mailing_company, $mailing_address, $mailing_country, $mailing_state, $mailing_city, $mailing_zip, $mailing_mobile_number, $mailing_email, $short_team_member, $boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description, $hull_id, $make_id, $engine_type_id, $fuel_type)
	{
		try
		{   
			DB::beginTransaction(); 

 			$entry = new ClientEntry;
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->country_name = $country_name;
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
			$entry->membership_from = $membership_from;
			$entry->membership_to = $membership_to;
			//-- countries
			if ($image != null)
			{
				// Image data
				$largeImagePath = public_path() . "/uploads/modules/client/";
				$thumbImagePath = public_path() . "/uploads/modules/client/thumbs/";

				// Image name is the same in thumbs and full size image
				$extension = $image->getClientOriginalExtension(); // getting image extension
				$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

				$uploadSuccess = Image::make($image->getRealPath())
					->orientate()
					->fit(768, 1024)
					->save($largeImagePath . $imagename) // original
					->crop(768, 768)
					->resize(200, 200)
					->save($thumbImagePath . $imagename) // thumb
					->destroy();

				if ($uploadSuccess)
				{
					$entry->image = $imagename;
				}
			}
			$entry->save(); 			
			// ADDING BOAT INFORMATION
			$newBoatEntry = new BoatsEntry;
			$newBoatEntry->boat_brand = $boat_brand;
			$newBoatEntry->boat_name = $boat_name;
			$newBoatEntry->year = $year;
			$newBoatEntry->registration_no = $registration_no;
			$newBoatEntry->federal_doc_no = $federal_doc_no;
			$newBoatEntry->boat_color = $boat_color;
			$newBoatEntry->lenght = $lenght;
			$newBoatEntry->description = $description;
			$newBoatEntry->hull_id = $hull_id;
			$newBoatEntry->make_id = $make_id; 
			$newBoatEntry->engine_type_id = $engine_type_id;
			$newBoatEntry->fuel_type = $fuel_type;
			$newBoatEntry->membership_id = $membership_id;

			$newBoatEntry->save();

			// ADDING CLIENT TRACKING

			$newClientTracking = new ClientTracking;
			$newClientTracking->membership_id = $membership_id;
			$newClientTracking->employee_first_name = $user_first_name;
			$newClientTracking->employee_last_name = $user_last_name;
			$newClientTracking->user_id = $user_id;
			$newClientTracking->action = 'created';

			$newClientTracking->save();

			DB::commit();

			

			return array('status' => 1);
	} 
		catch (Exception $exp)
		{	
			DB::rollback();
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 


	// Editing new entry into database
	public function postEditEntry($user_id, $user_first_name, $user_last_name, $boat_id, $image = null, $entry_id, $first_name, $last_name, $company, $address, $state, $city, $zip, $mobile_number, $email, $mobile_number_2, $email_2, $home_number, $bus_no, $summer_no, $fax_no, $homeport, $additional_city, $additional_state, $notes, $additional_notes, $membership_id, $title, $status, $franchisee_id, $member_since, $member_type, $mailing_title, $mailing_first_name, $mailing_last_name, $mailing_company, $mailing_address, $mailing_country, $mailing_state, $mailing_city, $mailing_zip, $mailing_mobile_number, $mailing_email, $country_name, $event, $short_team_member, $membership_from, $membership_to, $boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description, $hull_id, $make_id, $engine_type_id, $fuel_type)
	
	{ 
		 try
		{   
			DB::beginTransaction(); 

			$entry = ClientEntry::find($entry_id);
			$oldImage = $entry->image; 
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->company = $company;
			$entry->address = $address;
			$entry->country_name = $country_name;
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
			$entry->membership_from = $membership_from;
			$entry->membership_to = $membership_to;

			if ($image != null)
			{
				// Image data
				$largeImagePath = public_path() . "/uploads/modules/client/";
				$thumbImagePath = public_path() . "/uploads/modules/client/thumbs/";

				// Image name is the same in thumbs and full size image
				$extension = $image->getClientOriginalExtension(); // getting image extension
				$imagename = (substr(md5(rand(1, 999999)), 0, 20)) . '-' . date("Y-m-d.") . $extension; // renaming image

				$uploadSuccess = Image::make($image->getRealPath())
					->orientate()
					->fit(768, 1024)
					->save($largeImagePath . $imagename) // original
					->crop(768, 768)
					->resize(200, 200)
					->save($thumbImagePath . $imagename) // thumb
					->destroy();

				if ($uploadSuccess)
				{
					$largeOldImagePath = public_path() . "/uploads/modules/client/" . $oldImage;
					$thumbOldImagePath = public_path() . "/uploads/modules/client/"  . $oldImage;

					if (File::exists($largeOldImagePath))
					{
						File::delete($largeOldImagePath);
					}
					if (File::exists($thumbOldImagePath))
					{
						File::delete($thumbOldImagePath);
					}

					$entry->image = $imagename;
				}
			}


			$entry->save();

			// ADDING BOAT INFORMATION
			$newBoatEntry = BoatsEntry::find($boat_id);
			$newBoatEntry->boat_brand = $boat_brand;
			$newBoatEntry->boat_name = $boat_name;
			$newBoatEntry->year = $year;
			$newBoatEntry->registration_no = $registration_no;
			$newBoatEntry->federal_doc_no = $federal_doc_no;
			$newBoatEntry->boat_color = $boat_color;
			$newBoatEntry->lenght = $lenght;
			$newBoatEntry->description = $description;
			$newBoatEntry->hull_id = $hull_id;
			$newBoatEntry->make_id = $make_id; 
			$newBoatEntry->engine_type_id = $engine_type_id;
			$newBoatEntry->fuel_type = $fuel_type;
			$newBoatEntry->membership_id = $membership_id;

			$newBoatEntry->save();

			// ADDING CLIENT TRACKING

			$newClientTracking = new ClientTracking;
			$newClientTracking->membership_id = $membership_id;
			$newClientTracking->employee_first_name = $user_first_name;
			$newClientTracking->employee_last_name = $user_last_name;
			$newClientTracking->user_id = $user_id;
			$newClientTracking->action = 'edited';

			$newClientTracking->save();

			DB::commit();


			return array('status' => 1);
		 } 
		catch (Exception $exp)
		{	
			DB::rollback();
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}

	// Delete the entry item
	public function deleteEntry($id, $membership_id, $user_id, $user_first_name, $user_last_name, $boat_id)
	{
		try
		{   
			DB::beginTransaction(); 
			
			$entry = ClientEntry::find($id);
			$entry->is_active = '0';
			$entry->save();
			$boat = BoatsEntry::find($boat_id);
			$boat->is_active = '0';
			$boat->save();
			// ADDING CLIENT TRACKING

			$newClientTracking = new ClientTracking;
			$newClientTracking->membership_id = $membership_id;
			$newClientTracking->employee_first_name = $user_first_name;
			$newClientTracking->employee_last_name = $user_last_name;
			$newClientTracking->user_id = $user_id;
			$newClientTracking->action = 'deleted';

			$newClientTracking->save();

			DB::commit();
			return array('status' => 1);
		} 

		catch (Exception $exp)
		{
			DB::rollback();
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	} 


}
