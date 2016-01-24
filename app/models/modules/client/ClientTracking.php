<?php

class ClientTracking extends Eloquent
{
	protected $table = 'client_tracking';

		public static function getAllTracks($membership_id)
	{
		try
		{   
			$trackingData = DB::table('client_tracking')
			->join('users', 'users.id', '=', 'client_tracking.user_id')

				->select(
					'client_tracking.id AS id',
					'client_tracking.action AS action',
					'client_tracking.created_at AS created_at',
					'client_tracking.additional_note AS additional_note',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.image AS image'
				);
			
			if ($membership_id != null)
			{
				$trackingData = $trackingData->where('client_tracking.membership_id', '=', $membership_id)
					->get();

				return array('status' => 1, 'trackingdata' => $trackingData);
			}

			// Default return
			$trackingdata = $trackingData;


		  
			
			return array('status' => 1, 'trackingdata' => $trackingData);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}

	public static function getAllTracksDashboard()
	{
		try
		{   
			$trackingData = DB::table('client_tracking')
			->join('users', 'users.membership_id', '=', 'client_tracking.membership_id')

				->select(
					'client_tracking.id AS id',
					'client_tracking.action AS action',
					'client_tracking.created_at AS created_at',
					'client_tracking.additional_note AS additional_note',
					'client_tracking.employee_last_name AS employee_last_name',
					'client_tracking.employee_first_name AS employee_first_name',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.image AS image'
				)
			->orderBy('client_tracking.created_at', 'DESC')
			->take(20)
			->get();
			
			
			// Default return
			$trackingdata = $trackingData;


		  
			
			return array('status' => 1, 'trackingdata' => $trackingData);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
 
?>
