
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
                 @if (count($invoicesdata) > 0) 
                  <table id="list-invoice-hidden" class="table hidden">
                    <thead>
                      <th>

                          <td>  {{ Lang::get('invoice.from') }}  </td>

                          <td>  {{ Lang::get('invoice.to')  }}  </td>

                          <td>  {{ Lang::get('invoice.invoice') }}  </td>

                          <td>  {{ Lang::get('invoice.membership_id') }}  </td>

                          <td>  {{ Lang::get('invoice.order_id') }} </td>

                          <td>  {{ Lang::get('invoice.payment_due') }}  </td>

                          <td>  {{ Lang::get('invoice.account') }}  </td>
                          
                          <td>  {{ Lang::get('invoice.amount_due') }} </td>

                          <td>  {{ Lang::get('boats.total_sum') }}  </td>

                          <td>  {{ Lang::get('invoice.payment_methods') }} </td>

                        </th>
                    </thead>

                    <tbody>
                         @foreach($invoicesdata as $entry)
                      <tr>
                            <td>
                                <p>{{ $entry['employeeinfo']->employee_first_name }}  {{ $entry['employeeinfo']->employee_last_name }}</p><br>
                                <p>{{ $entry['employeeinfo']->franchisee_address }}, {{ $entry['employeeinfo']->franchisee_zip }} </p><br>
                                <p>{{ $entry['employeeinfo']->franchisee_country }}, {{ $entry['employeeinfo']->franchisee_city }}</p><br>
                                <p>{{ Lang::get('invoice.phone') }}: {{ $entry['employeeinfo']->employee_mobile_number }}</p><br>
                                <p>{{ Lang::get('invoice.email') }}: {{ $entry['employeeinfo']->employee_email }}</p>
                            </td>
                             <td>
                                {{ $entry['entry']->first_name }} {{ $entry['entry']->last_name }}</r>
                                {{ $entry['entry']->address }}</r>
                                {{ $entry['entry']->city }}, {{ $entry['entry']->zip }}</r>
                                {{ Lang::get('invoice.phone') }}: {{ $entry['entry']->mobile_number }}</r>
                                {{ Lang::get('invoice.email') }}: {{ $entry['entry']->email }}
                            </td>

                            <td>  <p>#007612</p>  </td>
                               
                            <td>  <p> {{ $entry['entry']->client_id }} </p>   </td>   

                            <td>  <p>4F3S8J</p>  </td>

                            <td>  <p> {{ $entry['entry']->payment_due }} </p>   </td>   

                            <td> 
                                                 @foreach($entry['productsperinvoice'] as $singleproduct)
                                                 {{ Lang::get('invoice.product_name') }}: {{ $singleproduct->product_name }} 
                                                 {{ Lang::get('invoice.product_tax') }}: {{ $singleproduct->tax }}% 
                                                 {{ Lang::get('invoice.product_price') }}: {{ $singleproduct->price }}€ 
                                                 {{ Lang::get('invoice.product_qty') }}: {{ $singleproduct->qty }} 
                                                 {{ Lang::get('invoice.product_price_qty') }}:  {{ $singleproduct->price_qty }}€ 
                                                  @endforeach     
                            </td>   
                            <td>  <p> {{ $entry['entry']->payment_due }} </p>   </td> 

                            <td>  <p> {{ $entry['entry']->total_sum }} </p>   </td> 

                            <td>  <p> {{ $entry['entry']->total_sum }} </p>   </td> 
                             <td>  <p> {{ $entry['entry']->total_sum }} </p>   </td> 
                                


                      </tr>
     
                    @endforeach
                    </tbody>
                  </table>
                    @endif
          
                    
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

                                            <a data-toggle="modal" data-target="#sendMailModal" href=""><span class="label label-success">{{ Lang::get('invoice.send_email') }}</span></a>
                                          &nbsp; 

                                        <!--    <a href="{{ URL::route('InvoiceGetEditEntry', array('entry_id' => $entry['entry']->entry_id)) }}"><span class="label label-warning">{{ Lang::get('invoice.edit_invoice') }}</span></a> 

                                           &nbsp; -->
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
                                              <div class="page-header">
                                               
                                              <img src="img/core/seatow-logo-invoice.png"/> {{ Lang::get('invoice.sea_tow_europe_operations') }} <small class="pull-right">{{ Lang::get('invoice.date') }}: UPDATED DATE</small>

                                              </div>
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

                                                {{ Lang::get('invoice.phone') }}: {{ $entry['employeeinfo']->employee_mobile_number }}<br>
                                                {{ Lang::get('invoice.email') }}: {{ $entry['employeeinfo']->employee_email }}
                                              </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                              To
                                              <address>
                                                <strong>{{ $entry['entry']->first_name }} {{ $entry['entry']->last_name }}</strong><br>
                                                {{ $entry['entry']->address }}<br>
                                                {{ $entry['entry']->city }}, {{ $entry['entry']->zip }}<br>
                                                {{ Lang::get('invoice.phone') }}: {{ $entry['entry']->mobile_number }}<br>
                                                {{ Lang::get('invoice.email') }}: {{ $entry['entry']->email }}
                                              </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                              <b>{{ Lang::get('invoice.invoice') }} #007612</b><br>
                                              <br>
                                              <b>{{ Lang::get('invoice.membership_id') }}:</b> {{ $entry['entry']->client_id }}<br>
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
                                                    <th>{{ Lang::get('invoice.price') }}</th>
                                                    <th>{{ Lang::get('invoice.qty') }}</th>
                                                    <th class="col-md-2">{{ Lang::get('invoice.cost_by_product') }}</th>
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
                                              <p class="lead">{{ Lang::get('invoice.payment_methods') }}:</p>
                                              
                                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                               Here goes description about payment method.
                                              </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                              <p class="lead">{{ Lang::get('invoice.amount_due') }} {{ $entry['entry']->payment_due }}</p>
                                              <div class="table-responsive">
                                                <table class="table">
                                                  <tbody>
                                                  <tr>
                                                    <th>{{ Lang::get('invoice.total') }}:</th>
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
                                              <button class="btn btn-default"  data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o"></i>{{ Lang::get('invoice.send_to_email') }}</button>
                                              <!-- Modal -->
                                            
                                              <button href="{{ URL::route('InvoiceCreatePdf', array('entry_id' => $entry['entry']->entry_id)) }}" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                                              <i class="fa fa-download"></i> {{ Lang::get('invoice.print_to_pdf') }}
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



 <div class="modal fade" id="sendMailModal" tabindex="-1" role="dialog" aria-labelledby="sendMailModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modalSendMailCloseButton" data-dismiss="modal" aria-label="{{ Lang::get('core.close') }}"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get('invoice.send_email') }}</h4>
      </div>
      <div class="modal-body">

        <p>Choose recipient:</p>

        {{ Form::open(array('route' => 'InvoicesPostEmail', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true )) }}

     
        {{ Form::hidden('invoice_id', $entry['entry']->entry_id, array('id' => 'invoice_id')) }}

        <div class="form-group">
 
          <div class="col-xs-12">
            <div class="mt10" id="managersContainer">
       {{ Form::select('client_id', $clients, isset($entry->client_id) ? $entry->client_id : null, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <div class="note_cotainer">
              {{ Form::textarea('message_content', null, array('class' => 'form-control mb20', 'id' => 'message_content')) }}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12 text-right">
          <label for="sendPDFInMailCheck" class="">{{ Lang::get('invoice.send_pdf_check') }}
            {{ Form::checkbox('sendPDFInMailCheck', '1') }}</label>
          </div>
        </div>

        <div class="form-group mt40">
          <div class="col-xs-12 text-center">
            {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('invoice.modal_report_send_email_button'), array('id' => 'sendEmail', 'name' => 'sendEmail', 'type' => 'submit', 'class' => 'btn btn-success sendEmailElement')) }}
          </div>
        </div>

      {{ Form::close() }}

      </div>
      <div class="modal-footer">


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
           <script>
                      $(document).ready(function() {
                         $('#list-invoice-hidden').DataTable( {
                           dom: 'Brt',
                           buttons: [
                           'copy', 'csv', 'excel'
                                    ]
                               } );
                                } );

          </script>

