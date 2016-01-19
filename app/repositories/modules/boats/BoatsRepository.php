<?php
/*
*	Boats Repository
*
*	Handles functions:
*/



class BoatsRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description, $hull_id, $make_id, $engine_type_id, $fuel_type, $membership_id)
	{
		try
		{  	
			
 			$entry = new BoatsEntry;


			$entry->boat_brand = $boat_brand;
			$entry->boat_name = $boat_name;
			$entry->year = $year;
			$entry->registration_no = $registration_no;
			$entry->federal_doc_no = $federal_doc_no;
			$entry->boat_color = $boat_color;
			$entry->lenght = $lenght;
			$entry->description = $description;
			$entry->hull_id = $hull_id;
			$entry->make_id = $make_id; 
			$entry->engine_type_id = $engine_type_id;
			$entry->fuel_type = $fuel_type;
			$entry->membership_id = $membership_id;
			

			$entry->save();

		

			return array('status' => 1);
	} 
		catch (Exception $exp)
		{

			

			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}


	// Editing new entry into database
	public function postEditEntry($entry_id, $boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description, $hull_id, $make_id, $engine_type_id, $fuel_type, $membership_id)
	{
		 try
		{   
			

			$entry = BoatsEntry::find($entry_id); 
			$entry->boat_brand = $boat_brand;
			$entry->boat_name = $boat_name;
			$entry->year = $year;
			$entry->registration_no = $registration_no;
			$entry->federal_doc_no = $federal_doc_no;
			$entry->boat_color = $boat_color;
			$entry->lenght = $lenght;
			$entry->description = $description;
			$entry->hull_id = $hull_id;
			$entry->make_id = $make_id;
			$entry->engine_type_id = $engine_type_id;
			$entry->fuel_type = $fuel_type;
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
			$entry = BoatsEntry::find($id); 
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}
//TIHS IS ABOUT HULL ------ THIS IS ABOUT HULL --------- THIS IS ABOUT HULL----------
	public function addHullEntry($hull_name)
	{
	   try
		{  
 			$entry = new HullEntry;
			$entry->hull_name = $hull_name;

			$entry->save();

			return array('status' => 1);

	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}
public function postEditHullEntry($entry_id, $hull_name)
	{
		 try
		{   

			$entry = HullEntry::find($entry_id); 
			$entry->hull_name = $hull_name;



			$entry->save();

			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}

	// Delete the entry item
	public function deleteHullEntry($id)
	{
		try
		{ 
			$entry = HullEntry::find($id); 
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}
//---------THIS IS ABOUT MAKE ----------- THIS IS ABOUT MAKE-------------THIS IS ABOUT MAKE---
	public function addMakeEntry($make_name)
	{
	   try
		{  
 			$entry = new MakeEntry;
			$entry->make_name = $make_name;

			$entry->save();

			return array('status' => 1);

	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}
public function postEditMakeEntry($entry_id, $make_name)
	{
		 try
		{   

			$entry = MakeEntry::find($entry_id); 
			$entry->make_name = $make_name;



			$entry->save();

			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}

	// Delete the entry item
	public function deleteMakeEntry($id)
	{
		try
		{ 
			$entry = MakeEntry::find($id); 
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
