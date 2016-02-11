<?php

class InvoiceEntry extends Eloquent
{
	protected $table = 'invoice_entries';



	// New entry validation
	public static $new_entry_rules = array(
		'employee_id'	=>	'required'
	);



	// Edit entry validation
	public static $edit_entry_rules = array(
		'employee_id'	=>	'required'
	);


	/*
	*	Get classifiedoffer_entries  
	*	
	*	$entry_id 		->	integer or null	->	if ID, retrieve specific entry (with first)
	*	$category_id	->	integer or null	->	if ID, retrieve all by specific category
 	*	$paginate	->	boolean			->	true - use paginate, false - use get
	*	$items		->	integer			->	items to retrieve if $paginate == true, default 10
	*/
	public static function getSingleInvoiceEntry($entry_id = null, $items = 10)
	{
	/*	try
		{  */
			$entry = DB::table('invoice_entries')
				->join('users', 'users.membership_id', '=', 'invoice_entries.client_id')
				
				->select(
					'users.country_name AS country_name',
					'users.image AS image',
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.country_id AS country_id',
					'users.city AS city',
					'users.zip AS zip',
					'users.mobile_number AS mobile_number',
					'users.email AS email',
					'users.mobile_number_2 AS mobile_number_2',
					'users.email_2 AS email_2',
					'users.home_number AS home_number',
					'users.bus_no AS bus_no',
					'users.summer_no AS summer_no',
					'users.fax_no AS fax_no',
					'users.homeport AS homeport',
					'users.additional_city AS additional_city',
					'users.additional_state AS additional_state',
					'users.notes AS notes',
					'users.additional_notes AS additional_notes',
					'users.membership_id AS membership_id',
					'users.title AS title',
					'users.status AS status',
					'users.franchisee_id AS franchisee_id',
					'users.member_since AS member_since',
					'users.event as event',
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to',
					//mailing entries 11
					'users.mailing_title AS mailing_title',
					'users.mailing_first_name AS mailing_first_name',
					'users.mailing_last_name AS mailing_last_name',
					'users.mailing_company AS mailing_company',
					'users.mailing_address AS mailing_address',
					'users.mailing_country AS mailing_country',
					'users.mailing_state AS mailing_state',
					'users.mailing_city AS mailing_city',
					'users.mailing_zip AS mailing_zip',
					'users.mailing_mobile_number AS mailing_mobile_number',
					'users.mailing_email AS mailing_email',
					//INVOICE ENTRIES
					'invoice_entries.id AS entry_id',
					'invoice_entries.employee_id AS employee_id',
					'invoice_entries.client_id AS client_id',
					'invoice_entries.payment_due AS payment_due',
					'invoice_entries.billing_tax AS billing_tax',
					'invoice_entries.payment_method AS payment_method',
					'invoice_entries.invoice_total AS invoice_total',
					'invoice_entries.membership_id AS membership_id',
					'invoice_entries.total_sum AS total_sum'

				);

			
			
			if ($entry_id != null)
			{
				$entry = $entry->where('invoice_entries.id', '=', $entry_id)
					->first();

				return array('status' => 1, 'entry' => $entry);
			}

		

			// Default return
			$entries = $entry;

		  
			
			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


	// Get last classifieds entries for a user, defaults to 10
	public static function getAllInvoices()
	{
	/*	try
		{  */

			$entries = DB::table('invoice_entries')
				->join('users', 'users.membership_id', '=', 'invoice_entries.client_id')
				->select(
					'users.country_name AS country_name',
					'users.image AS image',
					'users.id AS entry_id',
					'users.first_name AS first_name',
					'users.last_name AS last_name',
					'users.company AS company',
					'users.address AS address',
					'users.state AS state',
					'users.country_id AS country_id',
					'users.city AS city',
					'users.zip AS zip',
					'users.mobile_number AS mobile_number',
					'users.email AS email',
					'users.mobile_number_2 AS mobile_number_2',
					'users.email_2 AS email_2',
					'users.home_number AS home_number',
					'users.bus_no AS bus_no',
					'users.summer_no AS summer_no',
					'users.fax_no AS fax_no',
					'users.homeport AS homeport',
					'users.additional_city AS additional_city',
					'users.additional_state AS additional_state',
					'users.notes AS notes',
					'users.additional_notes AS additional_notes',
					'users.membership_id AS membership_id',
					'users.title AS title',
					'users.status AS status',
					'users.franchisee_id AS franchisee_id',
					'users.member_since AS member_since',
					'users.event as event',
					'users.member_type AS member_type',
					'users.short_team_member AS short_team_member',
					'users.membership_from AS membership_from',
					'users.membership_to AS membership_to',
					//mailing entries 11
					'users.mailing_title AS mailing_title',
					'users.mailing_first_name AS mailing_first_name',
					'users.mailing_last_name AS mailing_last_name',
					'users.mailing_company AS mailing_company',
					'users.mailing_address AS mailing_address',
					'users.mailing_country AS mailing_country',
					'users.mailing_state AS mailing_state',
					'users.mailing_city AS mailing_city',
					'users.mailing_zip AS mailing_zip',
					'users.mailing_mobile_number AS mailing_mobile_number',
					'users.mailing_email AS mailing_email',
					//INVOICE ENTRIES
					'invoice_entries.id AS entry_id',
					'invoice_entries.employee_id AS employee_id',
					'invoice_entries.client_id AS client_id',
					'invoice_entries.payment_due AS payment_due',
					'invoice_entries.billing_tax AS billing_tax',
					'invoice_entries.payment_method AS payment_method',
					'invoice_entries.invoice_total AS invoice_total',
					'invoice_entries.membership_id AS membership_id',
					'invoice_entries.total_sum AS total_sum'


				)
				->orderBy('invoice_entries.created_at', 'DESC')
				->get();

			return array('status' => 1, 'entries' => $entries);
	/*	}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


	public static function getCountInvoices()
	{
		
		try
		{
			$countedInvoices = DB::table('invoice_entries')
 				->select(
					'invoice_entries.id AS id'
 				)
				->get();

			return array('status' => 1, 'counted_invoice_number' => count($countedInvoices));
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

	public static function getLastInvoiceID()
	{
		
		try
		{
			$lastinvoice = DB::table('invoice_entries')
 				->select(
					'invoice_entries.id AS id'
 				)
 				->orderBy('invoice_entries.created_at', 'DESC')
				->first();

			return array('status' => 1, 'lastinvoice' => $lastinvoice);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}

		public static function getProductsPerInvoice($invoice_id)
	{
		
		try
		{
			$productsperinvoice = DB::table('product_invoices')
 				->select(
 					'product_invoices.id AS id',
					'product_invoices.invoice_id AS invoice_id',
					'product_invoices.product_name AS product_name',
					'product_invoices.tax AS tax',
					'product_invoices.price AS price',
					'product_invoices.qty AS qty',
					'product_invoices.price_qty AS price_qty'

 				)
 				->where('product_invoices.invoice_id', '=', $invoice_id)
				->get();

			return array('status' => 1, 'productsperinvoice' => $productsperinvoice);
		}
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		}
	}



 
}
