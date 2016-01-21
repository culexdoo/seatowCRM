<?php
/*
*	Messages Repository
*
*	Handles functions:
*/



class MessagesRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry()
	{
		try
		{
			$entry = new MessagesEntry;


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
			$entry = MessagesEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		/*} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


}
