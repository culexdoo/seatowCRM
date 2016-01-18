<?php


class EmployeeFranchisee extends Eloquent
{

		protected $table = 'employee_franchisee';


			public static function getEmployeeFranchisee($employee_id)
			{
				try
				{
					$employee_franchisee = DB::table('employee_franchisee')
						->select(
							'employee_franchisee.id AS id'
						);
					
					if ($employee_id != null)
					{
						$employee_franchisee = $employee_franchisee->where('employee_franchisee.employee_id', '=', $employee_id)
							->first();

						return array('status' => 1, 'employee_franchisee' => $employee_franchisee);
					}
				
					// Default return
					$employee_franchisee_entry = $employee_franchisee;

				  
					
					return array('status' => 1, 'employee_franchisee_entry' => $employee_franchisee_entry);
				}
				catch (Exception $exp)
				{
					return array('status' => 0, 'reason' => $exp->getMessage());
				}
			}

		}
		