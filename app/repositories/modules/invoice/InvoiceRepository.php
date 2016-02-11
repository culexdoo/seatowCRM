<?php
/*
*	Invoice Repository
*
*	Handles functions:
*/



class InvoiceRepository
{
 
    public function __construct(){

    }

 
	// Inserting new entry into database
	public function addEntry($employee_id, $client_id, $payment_due, $billing_tax, $payment_method, $total_sum, $employee_first_name, $employee_last_name, $user_id, $arrData)

	{
	/*	try
		{   */
			
			DB::beginTransaction(); 
			$entry = new InvoiceEntry;
			$entry->employee_id = $employee_id;
			$entry->client_id = $client_id;
			$entry->payment_due = $payment_due;
			$entry->billing_tax = $billing_tax;
			$entry->payment_method = $payment_method;
			$entry->total_sum = $total_sum;

			$entry->save();

			$invoice_id = InvoiceEntry::getLastInvoiceID();
			$invoice_id = $invoice_id['lastinvoice']->id;
			

			// ADDING Invoice Product
			if ($arrData != null)
				{
                  
						foreach ($arrData as $key=>$value)
						{
							
								$newInvoiceProduct = new InvoiceProducts;
								$newInvoiceProduct->invoice_id = $invoice_id;
								$newInvoiceProduct->product_name = $arrData[$key]['product_name'];
								$newInvoiceProduct->tax = $arrData[$key]['tax'];
								$newInvoiceProduct->price = $arrData[$key]['price'];
								$newInvoiceProduct->qty = $arrData[$key]['qty'];
								$newInvoiceProduct->price_qty = $arrData[$key]['price_qty'];
								$newInvoiceProduct->save();						
						} 
				}

			// ADDING CLIENT TRACKING
			$newClientTracking = new ClientTracking;
			$newClientTracking->membership_id = $client_id;
			$newClientTracking->employee_first_name = $employee_first_name;
			$newClientTracking->employee_last_name = $employee_last_name;
			$newClientTracking->user_id = $user_id;
			$newClientTracking->action = 'created_invoice';

			$newClientTracking->save();

			DB::commit();

			return array('status' => 1);
	/*	}
		catch (Exception $exp)
		{
			DB::rollback();
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


	// Editing new entry into database
	public function postEditEntry($entry_id, $employee_id, $client_id, $payment_due, $billing_tax, $price, $invoice_membership, $service_name, $service_description, $payment_method, $invoice_total, $shipping_tax, $employee_first_name, $employee_last_name, $user_id)
	{
		/* try
		{  */ 
			DB::beginTransaction(); 
			$entry = InvoiceEntry::find($entry_id);
			$entry->employee_id = $employee_id;
			$entry->client_id = $client_id;
			$entry->payment_due = $payment_due;
			$entry->billing_tax = $billing_tax;
			$entry->payment_method = $payment_method;
			$entry->invoice_membership = $invoice_membership;
			$entry->service_name = $service_name;
			$entry->service_description = $service_description;
			$entry->price = $price;
			$entry->invoice_total = $invoice_total;
			$entry->shipping_tax = $shipping_tax;



			$entry->save();


			// ADDING CLIENT TRACKING

			$newClientTracking = new ClientTracking;
			$newClientTracking->membership_id = $client_id;
			$newClientTracking->employee_first_name = $employee_first_name;
			$newClientTracking->employee_last_name = $employee_last_name;
			$newClientTracking->user_id = $user_id;
			$newClientTracking->action = 'edited_invoice';

			$newClientTracking->save();
			DB::commit();

			return array('status' => 1);
		/* } 
		catch (Exception $exp)
		{
			DB::rollback();
			return array('status' => 0, 'reason' => $exp->getMessage());
		}  */
	}

	// Delete the entry item
	public function deleteEntry($id)
	{
		/*try
		{ */
			$entry = InvoiceEntry::find($id);
			$entry->delete();

		
			return array('status' => 1);
		/*} 
		catch (Exception $exp)
		{
			return array('status' => 0, 'reason' => $exp->getMessage());
		} */
	}


}
