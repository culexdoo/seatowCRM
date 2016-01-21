<?php
/*
*	Membership Repository
*
*	Handles functions:
*/



class MembershipRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($title, $description, $normal_price, $promo_price_1, $promo_price_2, $promo_period_1_from, $promo_period_1_to, $promo_period_2_from, $promo_period_2_to)
	{
		try
		{
			$entry = new MembershipEntry;
			$entry->title = $title;
			$entry->description = $description;
			$entry->normal_price = $normal_price;
			$entry->promo_price_1 = $promo_price_1;
			$entry->promo_price_2 = $promo_price_2;
			$entry->promo_period_1_from = $promo_period_1_from;
			$entry->promo_period_1_to = $promo_period_1_to;
			$entry->promo_period_2_from = $promo_period_2_from;
			$entry->promo_period_2_to = $promo_period_2_to;


			$entry->save();

			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


	// Editing new entry into database
	public function postEditEntry($entry_id, $title, $description, $normal_price, $promo_price_1, $promo_price_2, $promo_period_1_from, $promo_period_1_to, $promo_period_2_from, $promo_period_2_to)
	{
		 try
		{   

			$entry = MembershipEntry::find($entry_id); 
			$entry->title = $title;
			$entry->description = $description;
			$entry->normal_price = $normal_price;
			$entry->promo_price_1 = $promo_price_1;
			$entry->promo_price_2 = $promo_price_2;
			$entry->promo_period_1_from = $promo_period_1_from;
			$entry->promo_period_1_to = $promo_period_1_to;
			$entry->promo_period_2_from = $promo_period_2_from;
			$entry->promo_period_2_to = $promo_period_2_to;


			$entry->save();

			return array('status' => 1);
		 }
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  
	}

	// Delete the entry item
	public function deleteEntry($id)
	{
		try
		{
			$entry = MembershipEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}


}
