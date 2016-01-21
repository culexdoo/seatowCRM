<?php
/*
*	Invoice Repository
*
*	Handles functions:
*/



class InvoiceRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry()
	{
		try
		{
			$entry = new FranchiseeEntry;


			$entry->save();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	// Editing new entry into database
	public function postEditEntry()
	{
		/* try
		{  */ 




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
		/*try
		{ */
			$entry = FranchiseeEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		/*} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


}
