<?php

class ClassifiedsSubCategory extends Eloquent
{
	public $table = 'classifieds_subcategories';

  
	/*
	*	Get Classifieds subcategory
	*
	*	$subcategory_id 		->	integer or null	->	if ID, retrieve specific subcategory (with first)
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getSubCategory($subcategory_id = null, $paginate = false, $items = 10)
	{
		 try
		{  
			$subcategory = DB::table('classifieds_subcategories')
 				->select(
					'classifieds_subcategories.subcategory_id AS subcategory_id',
					'classifieds_subcategories.subcategory_name AS subcategory_name'
				);
			$subcategories = $subcategory;

			if ($subcategory_id != null)
			{
				$subcategory = $subcategory->where('classifieds_subcategories.subcategory_id', '=', $subcategory_id)
					->first();

				return array('status' => 1, 'subcategory' => $subcategory);
			}
			 
			if ($paginate == false)
			{
				$subcategories = $subcategories->get();
			}
			else
			{
				$subcategories = $subcategories->paginate($items);
			}

			return array('status' => 1, 'subcategories' => $subcategories);
		 }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 
 
}
