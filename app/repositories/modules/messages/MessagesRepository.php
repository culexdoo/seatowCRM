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



}
