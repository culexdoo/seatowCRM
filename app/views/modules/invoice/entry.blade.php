

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


            <div class="form-group">       
              <div class="row">
                <input type="hidden" name="count" value="1" />
                  <div class="control-group">
                      <div class="controls" id="profs"> 
                        <div class="col-md-12">

                              <div class="row">
                                     <div class="col-md-push-11 col-md-1 add-button-invoice">
                                               <label>{{ Lang::get('invoice.add') }}:</label>
                                               <button id="b1" class="form-control btn-success btn add-more pull-right" type="button">+</button>
                                    </div>
                              </div>

                            
                           
                              <div id="field">
                              <div class="row">

                              <div class="col-md-5">
                              <label>{{ Lang::get('invoice.product') }}:</label>
                              <input autocomplete="off" class="form-control" id="product_name" name="product_name[]" type="text"/>
                              </div>

                              <div class="col-md-2">
                              <label>{{ Lang::get('invoice.tax') }}:</label>
                               <input autocomplete="off" class="form-control" id="tax" name="tax[]" type="text"/>
                              </div>

                              <div class="col-md-2">
                              <label>{{ Lang::get('invoice.price') }}:</label>
                              <input autocomplete="off" class="form-control" id="price" name="price[]" type="text"/>
                              </div>

                              <div class="col-md-2">
                              <label>{{ Lang::get('invoice.qty') }}:</label>
                              <input autocomplete="off" class="form-control" id="qty" name="qty[]" type="text"/>
                              </div>

                              </div>
                              </div>
                           
                       
                        

                          
                        </div>
                    </div>
                  </div>
                </div>
              </div>    
           
             
                
             
           
               




  <div class="row">
  <div class="col-md-2 pull-right">
  <label>{{ Lang::get('invoice.total_sum') }}:</label>
     <input autocomplete="off" class="form-control" id="total_sum" name="total_sum" type="text"/>
      </div> 
  </div>


       
       <div class="row">

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
    var next = 0;
    $(".add-more").click(function(e){
        e.preventDefault();


        var addto = "#field" + next;
        var addRemove = "#field" + (next); 

        var invoice_product = "{{ Lang::get('invoice.product') }}";
        var invoice_tax = "{{ Lang::get('invoice.tax') }}";
        var invoice_price = "{{ Lang::get('invoice.price') }}";
        var invoice_qty = "{{ Lang::get('invoice.qty') }}";
        next = next + 1;
        var newIn = '<div style="margin-top:10px; margin-bottom:10px; min-height:35px;" class="row" id="invoice_item_wrapper' + next + '"><div class="col-md-5"><input autocomplete="off" class="form-control" id="product_name[' + next + ']" name="product_name[' + next + ']" type="text"/></div><div class="col-md-2"><input autocomplete="off" class="form-control" id="tax[' + next + ']" name="tax[' + next + ']" type="text"/></div><div class="col-md-2"><input autocomplete="off" class="form-control" id="price[' + next + ']" name="price[' + next + ']" type="text"/></div><div class="col-md-2"><input autocomplete="off" class="form-control" id="qty[' + next + ']" name="qty[' + next + ']" type="text"/></div><div class="col-md-1">';
     
        var newInput = $(newIn);


        var removeBtn = '<button id="remove' + next + '" class="form-control btn btn-danger remove-me" >-</button>';
        var removeButton = $(removeBtn);
        var field = document.getElementById("field"); 
        field.innerHTML = field.innerHTML + newIn + removeBtn + '</div></div>';
 

        $(addto).after(newIn);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = next;
                var fieldID = "#invoice_item_wrapper" + fieldNum;
                 $(this).closest('.row').remove();
                $(fieldID).remove();
            });
    });
    

    
});

$(document).on('keyup', function(event) {

    //var total = 0;

    //$('input[id*="price"]').each(function() { total+= parseFloat( $(this).val() ); });

    //$('#total_sum').val( Math.floor( total ) );

        var sum = 0;
    var quantity = 0;
    var singleProduct,singleQuantity,singleTax;

    $('input[id*="price"]').each(function() {
      singleProduct = parseInt($(this).val());

      singleQuantity = parseInt($(this).parent().parent().find('input[id*="qty"]').val());
      singleTax = parseInt($(this).parent().parent().find('input[id*="tax"]').val());


      sum = sum+((singleProduct+(singleProduct*(singleTax/100)))*singleQuantity);
      quantity = quantity+singleQuantity;
    });
    console.log(sum+"-"+quantity);
    $('#total_sum').val(sum);
  

});

</script>


       