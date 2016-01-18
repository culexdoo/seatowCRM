<?php

class ClassifiedsCategory extends Eloquent
{
	 public $table = 'classifieds_categories';

  
	/*
	*	Get Classifieds category
	*
	*	$category_id 		->	integer or null	->	if ID, retrieve specific category (with first)
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getCategory($category_id = null, $paginate = false, $items = 10)
	{
		try
		{  
			$category = DB::table('classifieds_categories')
 				->select(
					'classifieds_categories.category_id AS category_id',
					'classifieds_categories.category_name AS category_name',
					'classifieds_categories.category_image AS category_image' 
				);
			// Defaulting
			$categories = $category;

			if ($category_id != null)
			{
				$category = $category->where('classifieds_categories.category_id', '=', $category_id)
					->first();

				return array('status' => 1, 'category' => $category);
			}
			 
			if ($paginate == false)
			{
				$categories = $categories->get();
			}
			else
			{
				$categories = $categories->paginate($items);
			}

			return array('status' => 1, 'categories' => $categories);
		  }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 

	public static function getAllCategories($paginate = false, $items = 10)
	{
	/*	try
		{  */  
			$category = DB::table('classifieds_categories')
 				->select(
					'classifieds_categories.category_id AS category_id',
					'classifieds_categories.category_name AS category_name',
					'classifieds_categories.category_image AS category_image' 
				); 

				return array('status' => 1, 'category' => $category);
		 
			 
			if ($paginate == false)
			{
				$categories = $categories->get();
			}
			else
			{
				$categories = $categories->paginate($items);
			}

			return array('status' => 1, 'categories' => $categories);
	/*	  }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  */
	} 


	public static function getOfferCategoryClassifieds($category_id, $paginate = false, $items = 10)
	{
		try
		{  
			$category = DB::table('classifiedoffer_entries')
 				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifiedoffer_entries.category_id') 
 				->select(
					'classifieds_categories.category_id AS category_id',
					'classifieds_categories.category_name AS category_name',
					'classifieds_categories.category_image AS category_image',
					'classifiedoffer_entries.id AS entry_id',
					'classifiedoffer_entries.title AS title',
					'classifiedoffer_entries.content AS content',
					'classifiedoffer_entries.image AS image',
					'classifiedoffer_entries.category_id AS category_id'
				);
			// Defaulting
			$categories = $category;

			if ($category_id != null)
			{
				$category = $category->where('classifieds_categories.category_id', '=', $category_id)
					->get();

				return array('status' => 1, 'category' => $category);
			}
			 
			if ($paginate == false)
			{
				$categories = $categories->get();
			}
			else
			{
				$categories = $categories->paginate($items);
			}

			return array('status' => 1, 'categories' => $categories);
		  }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 

	public static function getDemandCategoryClassifieds($category_id, $paginate = false, $items = 10)
	{
		try
		{  
			$category = DB::table('classifieddemand_entries')
 				->join('classifieds_categories', 'classifieds_categories.category_id', '=', 'classifieddemand_entries.category_id') 
 				->select(
					'classifieds_categories.category_id AS category_id',
					'classifieds_categories.category_name AS category_name',
					'classifieds_categories.category_image AS category_image',
					'classifieddemand_entries.id AS entry_id',
					'classifieddemand_entries.title AS title',
					'classifieddemand_entries.content AS content',
					'classifieddemand_entries.image AS image',
					'classifieddemand_entries.category_id AS category_id'
				);
			// Defaulting
			$categories = $category;

			if ($category_id != null)
			{
				$category = $category->where('classifieds_categories.category_id', '=', $category_id)
					->get();

				return array('status' => 1, 'category' => $category);
			}
			 
			if ($paginate == false)
			{
				$categories = $categories->get();
			}
			else
			{
				$categories = $categories->paginate($items);
			}

			return array('status' => 1, 'categories' => $categories);
		  }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	} 
 
}
