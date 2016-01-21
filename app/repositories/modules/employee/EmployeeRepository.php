<?php
/*
*	Employee Repository
*
*	Handles functions:
*/



class EmployeeRepository
{
 
    public function __construct(){

    }

 
		// New employee  
	public function addEntry($employee_id, $first_name, $last_name, $mobile_number, $employee_description, $email, $password, $franchisee_id, $user_group)
	{
 
		try
		{ 
			DB::beginTransaction(); 
			
	        $entry = new EmployeeEntry;
			$entry->employee_id = $employee_id;
			$entry->first_name = $first_name;
			$entry->last_name = $last_name;
			$entry->mobile_number = $mobile_number;
			$entry->employee_description = $employee_description;
			$entry->email = $email;
			$entry->user_group = 'employee';
 
			if ($password != '' || $password != null)
			{
				$entry->password = Hash::make($password);
			}

			$entry->save();
  
			$newEmployeeFranchisee = new EmployeeFranchisee;
			$newEmployeeFranchisee->employee_id = $entry->employee_id;
			$newEmployeeFranchisee->franchisee_id = $franchisee_id;

			$newEmployeeFranchisee->save();
 
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
	public function postEditEntry($id, $employee_id, $first_name, $last_name, $mobile_number, $employee_description, $email, $password, $franchisee_id, $employee_franchisee)
	{
		 try
		{
			DB::beginTransaction(); 
			$entry = EmployeeEntry::find($id); 
			$entry->employee_id = $employee_id; 
			$entry->first_name = $first_name;  
			$entry->last_name = $last_name;
			$entry->mobile_number = $mobile_number; 
			$entry->employee_description = $employee_description;  
			$entry->email = $email; 

			if ($password != '' || $password != null)
			{
				$entry->password = Hash::make($password);
			}   
			$entry->save();



			   // Delete all connections with modules
			DB::table('employee_franchisee')
			->where('employee_franchisee.id', '=', $employee_franchisee)
			->delete();
 
			$newEmployeeFranchisee = new EmployeeFranchisee;
			$newEmployeeFranchisee->employee_id = $entry->employee_id;
			$newEmployeeFranchisee->franchisee_id = $franchisee_id;

			$newEmployeeFranchisee->save();

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
	public function deleteEntry($id)
	{
		try
		{ 
			$entry = EmployeeEntry::find($id); 
			$entry->delete();

		
			return array('status' => 1);
		} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} 
	}


}
