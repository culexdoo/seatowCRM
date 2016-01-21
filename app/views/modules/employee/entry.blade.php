          <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';

          }

          ?><!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
        <div class="col-md-6">
          <h1>
         {{ $title or null }}
           </h1>
           </div>
            {{ Form::open(array('route' => $postRoute, 'role' => 'form', 'autocomplete' => 'off', 'files' => false)) }}

            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
            @if ($mode == 'edit')
            {{ Form::hidden('entry_id', $entry->id, array('entry_id' => 'entry_id')) }}
             {{ Form::hidden('employee_franchisee', $employee_franchisee['employee_franchisee']->id, array('employee_franchisee' => 'employee_franchisee')) }}
            @endif
            <div class="col-md-6">



            <a href="{{ URL::route('franchiseeLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('employee.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('employee.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </div>
          </a>
        </div>
        
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('employee.basic_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">
                  
                    <div class="form-group">
                      <label>{{ Lang::get('employee.employee_id') }}:</label>
                       {{ Form::text('employee_id', isset($entry->employee_id) ? $entry->employee_id : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('employee.first_name') }}:</label>
                       {{ Form::text('first_name', isset($entry->first_name) ? $entry->first_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('employee.last_name') }}:</label>
                      {{ Form::text('last_name', isset($entry->last_name) ? $entry->last_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('employee.mobile_number') }}:</label>
                       {{ Form::text('mobile_number', isset($entry->mobile_number) ? $entry->mobile_number : null, ['class' => 'form-control']) }}
                    </div>
                     <div class="form-group">
                      <label>{{ Lang::get('employee.email') }}:</label>
                       {{ Form::text('email', isset($entry->email) ? $entry->email : null, ['class' => 'form-control']) }}
                    </div>
                     <div class="form-group">
                      <label>{{ Lang::get('employee.password') }}:</label>
                       {{ Form::text('password', isset($entry->password) ? $entry->password : null, ['class' => 'form-control']) }}
                    </div>
                   
                    
                    
                  </div>
             
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('employee.franchisee_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
               
                  
                  <div class="box-body">
                             <div class="form-group"> 
          <label for="franchisee_id">{{ Lang::get('employee.franchisee') }}:</label> 
          {{ Form::select('franchisee_id', $entries, isset($entry->franchisee_id) ? $entry->franchisee_id : null, array('class' => 'form-control', 'id' => 'franchisee_id', 'required')) }}
          @if (isset($errors) && ($errors->first('franchisee_id') != '' || $errors->first('franchisee_id') != null))
          <p><small>{{ $errors->first('franchisee_id') }}</small></p>
          @endif
           
        </div>
                    <div class="form-group">
                      <label>Franchisee</label>
                      <textarea class="form-control" rows="3" placeholder="Damlatia South (105) - [ +49 (0) 700-00-SEATOW]"></textarea>
                    </div>
                  </div>
                
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('employee.additional_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
                    <div class="form-group">
                      <label>{{ Lang::get('employee.employee_description') }}</label>
                      {{ Form::textarea('employee_description', isset($entry->employee_description) ? $entry->employee_description : null, array('class' => 'form-control description','id' => 'employee_description')) }}
                       <small class="text-danger">{{ $errors->first('content') }}</small>
                    </div>
                    
                  </div>
                </div>
                
                
              </div>
           
          </div>
          
        </div>
        {{ Form::close() }}
      </div>
      </section><!-- /.content -->
