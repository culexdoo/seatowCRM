<?php

class Language extends Eloquent
{
	protected $table = 'languages';



	// Get language informations
	public static function getLanguage($id = null)
	{
		try
		{
			$language = DB::table('languages');

			if ($id != null)
			{
				$language = $language->where('languages.id', '=', $id)->first();

				return array('status' => 1, 'language' => $language);
			}
			else
			{
				$languages = $language->orderBy('id', 'ASC')->get();

				return array('status' => 1, 'languages' => $languages);
			}
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}
	
}
