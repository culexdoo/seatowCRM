<?php

class Countries extends Eloquent
{
	protected $table = 'countries';



	public static function getAllCountries()
	{
		

		try
		{ 
			$countries = DB::table('countries')
			
				->select(
					'countries.id AS id',
					'countries.country_name AS country_name'
				)
				->get();

			return array('status' => 1, 'countries' => $countries);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

}
