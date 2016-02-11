

          <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';
          }

          ?>
  {{ Form::open(array('route' => $postRoute, 'role' => 'form', 'autocomplete' => 'off', 'files' => true)) }}
            <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
        <div class="col-md-6">
          <h1>
         {{ $title or null }}
          </h1>
     
          </div>
           
                         

            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
            @if ($mode == 'edit')

            {{ Form::hidden('entry_id', $entry->entry_id, array('entry_id' => 'entry_id')) }}
            @endif
         


           <div class="col-md-6">
           <a href="{{ URL::route('invoiceLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('client.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('client.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </a>

           

           </div>
          
          
         
          </div>
         
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">




              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('invoice.employee') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  
                  <div class="box-body">
                    
                    <div class="form-group">
                      
                     
                       @if ($mode == 'edit')
                       {{ Form::select('employee_id', $employees, isset($entry->employee_id) ? $entry->employee_id : $preselected_client, array('class' => 'form-control', 'id' => 'employee_id', 'required')) }}
                       @elseif ($mode == 'add')
                        {{ Form::select('employee_id', $employees, isset($entry->employee_id) ? $entry->employee_id : null, array('class' => 'form-control', 'id' => 'employee_id', 'required')) }}
                        @endif
                    </div>
                  </div>
                
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('invoice.client') }}:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  
                  <div class="box-body">
                    <div class="form-group">
                      
                     @if ($mode == 'edit')
                       {{ Form::select('client_id', $clients, isset($entry->client_id) ? $entry->client_id : $preselected_client, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
                       @elseif ($mode == 'add')
                        {{ Form::select('client_id', $clients, isset($entry->client_id) ? $entry->client_id : null, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
                        @endif
                    </div>
                  </div>
                
              </div>
              
            </div>
            
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('invoice.payment_due') }}:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                
                  
                  <div class="box-body">
                    <div class="form-group">
                      
                      {{ Form::text('payment_due', isset($entry->payment_due) ? $entry->payment_due : null, ['class' => 'form-control', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask'=>""]) }}
                    </div>
                    
                    
                    
                  </div>
                
              </div>
              
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-6">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>{{ Lang::get('invoice.product') }}:</label>
          
                </div>
              </div>
              <div class="col-md-2">
                <label>{{ Lang::get('invoice.tax') }}:</label>
               @if ($mode == 'add')
                            {{ Form::select('shipping_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'11', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->shipping_tax == '1')
                              {{ Form::select('shipping_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->shipping_tax == '2')
                              {{ Form::select('shipping_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->shipping_tax == '3')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->shipping_tax == '4')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'4',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '5')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'5',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '6')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'6',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '7')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'7',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '8')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'8',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '9')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'9',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '10')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'10',['class' => 'form-control']) }}
                                @elseif ($entry->shipping_tax == '11')
                              {{ Form::select('shipping_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'11',['class' => 'form-control']) }}
                          @endif
                        @endif
              </div>
              <div class="col-md-4">
                <label>{{ Lang::get('invoice.price') }}:</label>
                  
                      {{ Form::text('price', isset($entry->price) ? $entry->price : null, ['class' => 'form-control', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask'=>""]) }}
              </div>

              <div class="col-md-1">
                <button type="button" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> {{ Lang::get('invoice.add') }}
                </button>
              </div>
            </div>
            </div>
                 
            <div class="col-md-6">
            <div class="row">
              <div class="col-md-11">
                
                <div class="form-group">
                  <label>{{ Lang::get('invoice.membership') }}:</label>
                 @if ($mode == 'add')
                            {{ Form::select('invoice_membership', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->invoice_membership == '1')
                              {{ Form::select('invoice_membership', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->invoice_membership == '2')
                              {{ Form::select('invoice_membership', array(
                            '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->invoice_membership == '3')
                              {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->invoice_membership == '4')
                              {{ Form::select('invoice_membership', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->invoice_membership == '5')
                              {{ Form::select('invoice_membership', array(
                            '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'5',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '6')
                              {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'6',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '7')
                              {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'7',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '8')
                              {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'8',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '9')
                              {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'9',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '10')
                               {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'10',['class' => 'form-control']) }}
                               @elseif ($entry->invoice_membership == '11')
                               {{ Form::select('invoice_membership', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'11',['class' => 'form-control']) }}
                          @endif
                        @endif
                </div>
              </div>
              <div class="col-md-1">
                <button type="buttonpull-right" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> {{ Lang::get('invoice.add') }}
                </button>
              </div>
            </div>
            </div>
          </div>

              <div class="form-group">
              <div class="container">
                <div class="row">
                  <input type="hidden" name="count" value="1" />
                    <div class="control-group" id="fields">
                      <label class="control-label" for="field1">Nice Multiple Form Fields</label>
                        <div class="controls" id="profs"> 
                          
                          <div id="field"><input autocomplete="off" class="input" id="field1" name="prof1" type="text" placeholder="Type something" data-items="8"/><button id="b1" class="btn add-more" type="button">+</button></div>
                          
                        <br>
                      <small>Press + to add another form field :)</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           <div class="row">
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>{{ Lang::get('invoice.service_name') }}:</label>
                      {{ Form::text('service_name', isset($entry->service_name) ? $entry->service_name : null, ['class' => 'form-control', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask'=>""]) }}
                </div>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
              
            
            </div>
            </div>
          </div>
             <div class="row">
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>{{ Lang::get('invoice.service_description') }}:</label>
                 {{ Form::textarea('service_description', isset($entry->service_description) ? $entry->service_description : null, array('class' => 'form-control service_description','id' => 'service_description')) }}
                </div>
              </div>
            </div>
            </div>
          
          <div class="col-md-12">
            <div class="row">
              <div class="col-xs-6">
                <label>{{ Lang::get('invoice.payment_method') }}:</label>
                 <div class="form-group">
                      
                      @if ($mode == 'add')
                            {{ Form::select('payment_method', array(
                              '1'=>'SEPA',
                              '2'=>'BANK TRANSFER',
                              '3'=>'CREDIT CARD',
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->payment_method == '1')
                              {{ Form::select('payment_method', array(
                              '1'=>'SEPA',
                              '2'=>'BANK TRANSFER',
                              '3'=>'CREDIT CARD',
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->payment_method == '2')
                              {{ Form::select('payment_method', array(
                              '1'=>'SEPA',
                              '2'=>'BANK TRANSFER',
                              '3'=>'CREDIT CARD',
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->payment_method == '3')
                              {{ Form::select('payment_method', array(
                              '1'=>'SEPA',
                              '2'=>'BANK TRANSFER',
                              '3'=>'CREDIT CARD',
                              ),'3',['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
              </div>
             
               <div class="col-xs-6">
                          <div class="col-md-2">
                             <label>{{ Lang::get('invoice.tax') }}:</label>
                          </div>
                          
                            <div class="form-group">
                            
               @if ($mode == 'add')
                            {{ Form::select('billing_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'11', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->billing_tax == '1')
                              {{ Form::select('billing_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->billing_tax == '2')
                              {{ Form::select('billing_tax', array(
                              '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->billing_tax == '3')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->billing_tax == '4')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'4',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '5')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'5',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '6')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'6',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '7')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'7',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '8')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'8',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '9')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'9',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '10')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'10',['class' => 'form-control']) }}
                                @elseif ($entry->billing_tax == '11')
                              {{ Form::select('billing_tax', array(
                               '1'=>'0%',
                              '2'=>'5%',
                              '3'=>'10%',
                              '4'=>'15%',
                              '5'=>'17%',
                              '6'=>'20%',
                              '7'=>'21%',
                              '8'=>'22%',
                              '9'=>'23%',
                              '10'=>'24%',
                              '11'=>'25%',
                              ),'11',['class' => 'form-control']) }}
                          @endif
                        @endif
                            </div>
                            {{ Form::close() }}
                          </div>
                           </div>

          </section><!-- /.content -->

<script type="text/javascript">
  
$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});


</script>


       