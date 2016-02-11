
 <section class="content-header">
          <h1>
          {{ Lang::get('invoice.list_all_invoice') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
              
              <div class="box box-black">
                    <div class="box-header padding-clients">
                 <div class="col-md-9"> <h3 class="box-title"> {{ Lang::get('client.list_of_all_clients') }}</h3>
                </div>
                <div class="col-md-3">

                <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('ClientGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('client.add_client') }}</a>
                <!-- BUTTON EXPORT TO PDF -->
            <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            
          
                    
                    <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

               </div>
               </div>
                <!-- /.box-header -->
                <div clasee="box-body">
                 @if (count($invoicesdata) > 0) 
                  <table id="list-invoice" class="table">
                    <thead>
                      <tr>
                        
                        <th>
                          <div class="row">
                            <div class="col-md-2">
                              {{ Lang::get('invoice.invoice') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.total') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.employee') }}:
                            </div>
                            <div class="col-md-2">
                           {{ Lang::get('invoice.client') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.payment_due') }}:
                            </div>
                            <div class="col-md-1">
                             {{ Lang::get('invoice.total') }}:
                            </div>
                            
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tfoot>
                    <tr>
                      <th>
                        <div class="row">
                            <div class="col-md-2">
                              {{ Lang::get('invoice.invoice') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.total') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.employee') }}:
                            </div>
                            <div class="col-md-2">
                           {{ Lang::get('invoice.client') }}:
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('invoice.payment_due') }}:
                            </div>
                            <div class="col-md-1">
                             {{ Lang::get('invoice.total') }}:
                            </div>
                            
                          </div>
                      </th>
                    </tr>
                    </tfoot>
                    <tbody>


                       @foreach($invoicesdata as $entry)
                      <tr>
                        <td>
                          <div class="box box-no-border collapsed-box no-margin">
                                      <div class="box-header">
                                        <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                                          </button>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-2">
                                            Invoice #007612
                                          </div>
                                          <div class="col-md-2">
                                            {{ $entry['entry']->total_sum }}€
                                          </div>
                                          <div class="col-md-2">
                                        {{ $entry['employeeinfo']->employee_first_name }}  {{ $entry['employeeinfo']->employee_last_name }}
                                          </div>
                                          <div class="col-md-2">
                                             {{ $entry['entry']->first_name }} {{ $entry['entry']->last_name }}
                                          </div>
                                          <div class="col-md-2">
                                           {{ $entry['entry']->payment_due }}
                                          </div>
                                          <div class="col-md-1">
                                           {{ $entry['entry']->invoice_total }}
                                          </div>
                                                <div class="col-md-2 pull-right">
                                          <a href="{{ URL::route('InvoiceCreatePdf', array('entry_id' => $entry['entry']->entry_id)) }}"><span class="label label-primary">{{ Lang::get('invoice.pdf') }}</span></a>
                                          &nbsp; 

                                            <a data-toggle="modal" data-target="#myModal" href=""><span class="label label-success">{{ Lang::get('invoice.send_email') }}</span></a>
                                          &nbsp; 

                                            <a href="{{ URL::route('InvoiceGetEditEntry', array('entry_id' => $entry['entry']->entry_id)) }}"><span class="label label-warning">{{ Lang::get('invoice.edit_invoice') }}</span></a>

                                           &nbsp; 
                                            <a href="{{ URL::route('InvoiceGetDeleteEntry', array('entry_id' => $entry['entry']->entry_id)) }}"><span class="label label-danger">{{ Lang::get('invoice.delete_invoice') }}</span></a>
                                          <div class="box-tools pull-right">
                                         
                                        </div>

                                           
                                          </div>
                                        </div>
                                        
                                      </div>
                                      
                              <div class="box-body colored-div">
                                        <section class="content invoice">
                                          
                                          <!-- title row -->
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <h2 class="page-header">
                                              <img src="img/core/seatow-logo-invoice.png"></img> Sea Tow Europe Operations Ltd. <small class="pull-right">Date: 2/10/2014</small></h2>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- info row -->
                                          <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                              From
                                              <address>
                                                <strong> {{ $entry['employeeinfo']->employee_first_name }}  {{ $entry['employeeinfo']->employee_last_name }}</strong><br>
                                                {{ $entry['employeeinfo']->franchisee_address }}, {{ $entry['employeeinfo']->franchisee_zip }}<br>
                                                {{ $entry['employeeinfo']->franchisee_country }}, {{ $entry['employeeinfo']->franchisee_city }}<br>

                                                Phone: {{ $entry['employeeinfo']->employee_mobile_number }}<br>
                                                Email: {{ $entry['employeeinfo']->employee_email }}
                                              </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                              To
                                              <address>
                                                <strong>{{ $entry['entry']->first_name }} {{ $entry['entry']->last_name }}</strong><br>
                                                {{ $entry['entry']->address }}<br>
                                                {{ $entry['entry']->city }}, {{ $entry['entry']->zip }}<br>
                                                Phone: {{ $entry['entry']->mobile_number }}<br>
                                                Email: {{ $entry['entry']->email }}
                                              </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                              <b>{{ Lang::get('invoice.invoice') }} #007612</b><br>
                                              <br>
                                              <b>{{ Lang::get('invoice.membership_id') }}:</b> {{ $entry['entry']->membership_id }}<br>
                                              <b>{{ Lang::get('invoice.order_id') }}:</b> 4F3S8J<br>
                                              <b>{{ Lang::get('invoice.payment_due') }}:</b> {{ $entry['entry']->payment_due }}<br>
                                              <b>{{ Lang::get('invoice.account') }}:</b> 968-34567
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                          <!-- Table row -->
                                          <div class="row">
                                            <div class="col-xs-12 table-responsive">
                                              <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>{{ Lang::get('invoice.product') }}</th>
                                                    <th>{{ Lang::get('invoice.tax') }}</th>
                                                    <th>Price</th>
                                                    <th>QTY</th>
                                                    <th class="col-md-2">Cost by product</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($entry['productsperinvoice'] as $singleproduct)
                                                  <tr>
                                                    <td>{{ $singleproduct->product_name }}</td>
                                                    <td>{{ $singleproduct->tax }}%</td>
                                                    <td>{{ $singleproduct->price }}€</td>
                                                    <td>{{ $singleproduct->qty }}</td>
                                                    <td>{{ $singleproduct->price_qty }}€</td>
                                                  </tr>
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                          <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-6">
                                              <p class="lead">Payment Methods:</p>
                                              
                                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                               Here goes description about payment method.
                                              </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                              <p class="lead">Amount Due 2/22/2014</p>
                                              <div class="table-responsive">
                                                <table class="table">
                                                  <tbody>
                                                  <tr>
                                                    <th>Total:</th>
                                                    <td class="col-md-2">{{ $entry['entry']->total_sum }}€</td>
                                                  </tr>
                                                </tbody></table>
                                              </div>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                          <!-- this row will not appear when printing -->
                                          <div class="row no-print">
                                            <div class="col-xs-12">
                                              <button class="btn btn-default"  data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o"></i> Send to email</button>
                                              <!-- Modal -->
                                            
                                              <button href="{{ URL::route('InvoiceCreatePdf', array('entry_id' => $entry['entry']->entry_id)) }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                                              <i class="fa fa-download"></i> Print to PDF
                                              </button>
                                            </div>
                                          </div>
                                        
                                      </section>
                                    
                              </div>
                      </div>
                    </td>
                  </tr>
               @endforeach
            </tbody>
          </table>
           @endif
        </div>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Enter e-mail</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form-group">
                                              <label>Send to email:</label>
                                              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="ivan.rakic@myself.com">
                                            </div>
                                            <div class="form-group">
                                              <label>Email message:</label>
                                              <textarea class="form-control" rows="3" placeholder="Dear Mr.Ivan Rakic, I'm sending you an Invoice number in attachment."></textarea>
                                            </div>
                                            
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send</button>
                                          </div>
                                        </div>
                                      </div>
          </div>

      </div>
    </div>
  </div>
  </section><!-- /.content -->
   <script>
          $(function () {
          $("#list-invoice").DataTable();

          });
          $('#myModal').modal({
  keyboard: false
})
          </script>