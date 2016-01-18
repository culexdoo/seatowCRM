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
	public function addEntry($boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description)
	{
		/*try
		{ */ 
 			$entry = new BoatsEntry;
			$entry->boat_brand = $boat_brand;
			$entry->boat_name = $boat_name;
			$entry->year = $year;
			$entry->registration_no = $registration_no;
			$entry->federal_doc_no = $federal_doc_no;
			$entry->boat_color = $boat_color;
			$entry->lenght = $lenght;
			$entry->description = $description;

			$entry->save();

			return array('status' => 1);
	/*	} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  */
	}


	// Editing new entry into database
	public function postEditEntry($entry_id, $boat_brand, $boat_name, $year, $registration_no, $federal_doc_no, $boat_color, $lenght, $description)
	{
		/* try
		{   */

			$entry = BoatsEntry::find($entry_id); 
			$entry->boat_brand = $boat_brand;
			$entry->boat_name = $boat_name;
			$entry->year = $year;
			$entry->registration_no = $registration_no;
			$entry->federal_doc_no = $federal_doc_no;
			$entry->boat_color = $boat_color;
			$entry->lenght = $lenght;
			$entry->description = $description;


			$entry->save();

			return array('status' => 1);
		/* } 
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
			$entry = BoatsEntry::find($id); 
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
