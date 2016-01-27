<?php

class MessagesEntry extends Eloquent
{
	protected $table = 'messages';



	// New entry validation
	public static $new_entry_rules = array(
		'subject'	=>	'required',
		'message'	=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'entry_id'		=>	'required|integer'
	);


	public static function getSingleMessagesEntry($entry_id)
	{
	/*	try
		{  */
			$message = DB::table('messages')
				->select(
					'messages.id AS entry_id',
					'messages.sender AS sender',
					'messages.reciever AS reciever',
					'messages.subject AS subject',
					'messages.message AS message',
					'messages.reciever_first_name AS reciever_first_name',
					'messages.reciever_last_name AS reciever_last_name',
					'messages.sender_first_name AS sender_first_name',
					'messages.sender_last_name AS sender_last_name',
					'messages.created_at AS created_at',
					'messages.updated_at AS updated_at'
				);
			
			if ($entry_id != null)
			{
				$message = $message->where('messages.id', '=', $entry_id)
					->first();

				return array('status' => 1, 'message' => $message);
			}

			// Default return
			$entries = $message;

		  
			
			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


	// Get last classifieds entries for a user, defaults to 10
	public static function getAllMessages()
	{
		

	/*	try
		{ */
			$entries = DB::table('messages')
			
				->select(
					'messages.id AS entry_id',
					'messages.sender AS sender',
					'messages.reciever AS reciever',
					'messages.subject AS subject',
					'messages.message AS message',
					'messages.created_at AS created_at',
					'messages.updated_at AS updated_at'
				)
				//->where('messages.id', '=', 'messages.reciver')
				->orderBy('messages.created_at', 'DESC')
				->get();

			return array('status' => 1, 'entries' => $entries);

/*		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}

	public static function getAllInboxMessages($user_id)
	{
	/*	try
		{  */
			$entries = DB::table('messages')
				->select(
					'messages.id AS id',
					'messages.sender AS sender',
					'messages.reciever AS reciever',
					'messages.subject AS subject',
					'messages.message AS message',
					'messages.is_read AS is_read',
					'messages.reciever_first_name AS reciever_first_name',
					'messages.reciever_last_name AS reciever_last_name',
					'messages.sender_first_name AS sender_first_name',
					'messages.sender_last_name AS sender_last_name',
					'messages.created_at AS created_at',
					'messages.updated_at AS updated_at'

				);
			
			if ($user_id != null)
			{
				$entries = $entries->where('messages.reciever', '=', $user_id)
				->where('messages.is_active', '=', '1')
				->orderBy('messages.created_at', 'DESC')
					->get();

				return array('status' => 1, 'entries' => $entries);
			}

			// Default return
			$entries = $entries;

		  
			
			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}
	public static function getAllSentMessages($user_id)
	{
	/*	try
		{  */
			$entries = DB::table('messages')
				->select(
					'messages.id AS id',
					'messages.sender AS sender',
					'messages.reciever AS reciever',
					'messages.subject AS subject',
					'messages.message AS message',
					'messages.is_read AS is_read',
					'messages.reciever_first_name AS reciever_first_name',
					'messages.reciever_last_name AS reciever_last_name',
					'messages.sender_first_name AS sender_first_name',
					'messages.sender_last_name AS sender_last_name',
					'messages.created_at AS created_at',
					'messages.updated_at AS updated_at'

				);
			
			if ($user_id != null)
			{
				$entries = $entries->where('messages.sender', '=', $user_id)
				->where('messages.is_sent', '=', '1')
				->orderBy('messages.created_at', 'DESC')
					->get();

				return array('status' => 1, 'entries' => $entries);
			}

			// Default return
			$entries = $entries;

		  
			
			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}
		public static function getAllTrashMessages($user_id)
	{
	/*	try
		{  */
			$entries = DB::table('messages')
				->select(
					'messages.id AS id',
					'messages.sender AS sender',
					'messages.reciever AS reciever',
					'messages.subject AS subject',
					'messages.message AS message',
					'messages.is_read AS is_read',
					'messages.reciever_first_name AS reciever_first_name',
					'messages.reciever_last_name AS reciever_last_name',
					'messages.sender_first_name AS sender_first_name',
					'messages.sender_last_name AS sender_last_name',
					'messages.created_at AS created_at',
					'messages.updated_at AS updated_at'

				);
			
			if ($user_id != null)
			{
				$entries = $entries->where('messages.reciever', '=', $user_id)
				->where('messages.is_active', '=', '0')
				->orderBy('messages.created_at', 'DESC')
					->get();

				return array('status' => 1, 'entries' => $entries);
			}

			// Default return
			$entries = $entries;

		  
			
			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}
	public static function getCountUnreadMessages($id)
	{
		
		try
		{
			$countedunreadmessages = DB::table('messages')
 				->select(
					'messages.id AS id'
 				)
				->where('messages.is_read', '=', '0')
				->where('messages.reciever', '=', $id)
				->get();

			return array('status' => 1, 'countedunreadmessages' => count($countedunreadmessages));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}
	public static function getCountDeletedMessages($id)
	{
		
		try
		{
			$counteddeletedmessages = DB::table('messages')
 				->select(
					'messages.id AS id'
 				)
				->where('messages.is_active', '=', '0')
				->where('messages.reciever', '=', $id)
				->get();

			return array('status' => 1, 'counteddeletedmessages' => count($counteddeletedmessages));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}
	public static function getCountSentMessages($id)
	{
		
		try
		{
			$countedsentmessages = DB::table('messages')
 				->select(
					'messages.id AS id'
 				)
				->where('messages.is_sent', '=', '1')
				->where('messages.sender', '=', $id)
				->get();

			return array('status' => 1, 'countedsentmessages' => count($countedsentmessages));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



 
}
