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
	public function addEntry($user_id, $reciever, $subject, $message, $reciever_first_name, $reciever_last_name, $sender_first_name, $sender_last_name)
	{
	/*	try
		{  */
			$entry = new MessagesEntry;
			$entry->is_sent = '1';
			$entry->sender = $user_id;
			$entry->reciever = $reciever;
			$entry->subject = $subject;
			$entry->message = $message;
			$entry->reciever_first_name = $reciever_first_name;
			$entry->reciever_last_name = $reciever_last_name;
			$entry->sender_first_name = $sender_first_name;
			$entry->sender_last_name = $sender_last_name;
			$entry->save();

			return array('status' => 1);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}

	// Inserting new entry into database
	public function setEntryRead($id)
	{
	/*	try
		{  */
			$entry = MessagesEntry::find($id); 
			$entry->is_read = '1';

			$entry->save();

			return array('status' => 1);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}
		public function deleteMessage($id)
	{
	/*	try
		{  */
			$entry = MessagesEntry::find($id); 
			$entry->is_active = '0';

			$entry->save();

			return array('status' => 1);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}

}
