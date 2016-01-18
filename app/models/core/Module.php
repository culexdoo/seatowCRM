<?php

class Module extends Eloquent
{
	protected $table = 'modules';



	// Change module rules (for edit module)
	public static $change_module_rules = array(
		'id'							=>	'required|integer',
		'module_active'					=>	'required|boolean',
		'module_mobile_active'			=>	'required|boolean',
		'module_maintenance_active'		=>	'required|boolean'
	);



	// Get module details or all modules
	public static function getModule($id = null)
	{
		try
		{
			$module = DB::table('modules')
				->select(
					'modules.id AS id',
					'modules.identifier AS identifier',
					'modules.is_active AS is_active',
					'modules.is_mobile_active AS is_mobile_active',
					'modules.is_under_maintenance AS is_under_maintenance',
					'modules.landing_fn AS landing_fn'
				);

			if ($id == null)
			{
				$modules = $module->get();

				return array('status' => 1, 'modules' => $modules);
			}
			else
			{
				$module = $module->where('modules.id', '=', $id)->first();
				return array('status' => 1, 'module' => $module);
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}
}
