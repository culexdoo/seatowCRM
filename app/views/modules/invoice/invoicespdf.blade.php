<html>

	<head>
   			<meta http-equiv="content-type" content="text/html; charset=utf-8">
	 		<title>Invoice report {{ $invoicesdata['0']['invoice']['entry']->entry_id }}</title>
			<style>
			body {
				font-size: 12px;
				font-weight: normal !important;
			    font-family: Helvetica, Arial, sans-serif;
			}
			b {
				font-weight: bold !important;
			}
		      h3 {
		      	font-weight: bold;
		      }
   			</style>
	</head>
	
<body>
   	<table style="width:100%;" id="pdfreport">
    <tbody>
        <tr>
            <td style="width:200px;">
                <h3>
                    <img src="img/core/seatow-logo-invoice.png" width="200" height="auto" />
                </h3>
            </td>
            <td style="width:300px;">
                <h3>Sea Tow Europe Operations Ltd.</h3>
            </td>
            <td>
                <h3 style="text-align:right; color:#808080;">Date: 2/10/2014</h3>
            </td>
        </tr>
    </tbody>
</table>
<hr style="color:#ddd;">
<table style="width:100%;">
    <tbody>
        <tr>
            <td style="color:#595959;">From</td>
            <td style="color:#595959;">To</td>
            <td style="color:#595959;">Invoice #007612</td>
        </tr>
        <tr>
            <td style="color:#000000;">{{ $invoicesdata['0']['employeeinfo']->employee_first_name }} {{ $invoicesdata['0']['employeeinfo']->employee_last_name }}</td>
            <td style="color:#000000;">{{ $invoicesdata['0']['invoice']['entry']->first_name }} {{ $invoicesdata['0']['invoice']['entry']->first_name }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="color:#595959;">{{ $invoicesdata['0']['employeeinfo']->franchisee_address }}</td>
            <td style="color:#595959;">{{ $invoicesdata['0']['invoice']['entry']->address }}</td>
            <td style="color:#595959;">Mebership ID:{{ $invoicesdata['0']['invoice']['entry']->client_id }}</td>
        </tr>
        <tr>
            <td style="color:#595959;">{{ $invoicesdata['0']['employeeinfo']->franchisee_country }}, {{ $invoicesdata['0']['employeeinfo']->franchisee_zip }}
            <td style="color:#595959;">{{ $invoicesdata['0']['invoice']['entry']->country_name }}, {{ $invoicesdata['0']['invoice']['entry']->zip }}</td>
            <td style="color:#595959;">Order ID: 4F3S8J </td>
        </tr>
        <tr>
            <td style="color:#595959;">Phone: {{ $invoicesdata['0']['employeeinfo']->employee_mobile_number }}</td>
            <td style="color:#595959;">Phone: {{ $invoicesdata['0']['invoice']['entry']->mobile_number }}</td>
            <td style="color:#595959;">Payment Due: 0000-00-00</td>
        </tr>
        <tr>
            <td style="color:#595959;">Email: {{ $invoicesdata['0']['employeeinfo']->employee_email }}</td>
            <td style="color:#595959;">Email: {{ $invoicesdata['0']['invoice']['entry']->email }}</td>
            <td style="color:#595959;">Account: 968-34567</td>
        </tr>
    </tbody>
</table>
<br>
<br>
<table style="width:100%;">
    <thead>
        <tr style="background:#ddd;">
            <th style="color:#595959; text-align:left;">Product:</th>
            <th style="color:#595959;">TAX:</th>
            <th style="color:#595959;">Price:</th>
            <th style="color:#595959;">QTY:</th>
            <th style="color:#595959;">Cost by product:</th>
        </tr>
    </thead>
    <tbody>

    
    @foreach($productsperinvoice['productsperinvoice'] as $singleproduct)
        <tr>
            <td style="text-align:left;">{{ $singleproduct->product_name }}</td>
            <td style="text-align:center;">{{ $singleproduct->tax }}%</td>
            <td style="text-align:center;">{{ $singleproduct->price }}€</td>
            <td style="text-align:center;">{{ $singleproduct->qty }}</td> 
            <td style="text-align:center;">{{ $singleproduct->price_qty }}€</td> 
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<table style="width:100%;">
    <tbody>
        <tr style="background:#ddd;">
            <td style="color:#595959; width:500px;">Payment Methods</td>
            <td style="color:#595959; text-align:right;">Amount Due {{ $invoicesdata['0']['invoice']['entry']->payment_due }}</td>
        </tr>
        <tr>
            <td>Here goes description about payment method.</td>
            <td>
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td>Total:</td>
                            <td style="text-align: right;">{{ $invoicesdata['0']['invoice']['entry']->total_sum }}&euro;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

</body> 
</html>


