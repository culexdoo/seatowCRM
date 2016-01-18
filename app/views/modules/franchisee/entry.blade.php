

   <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';
          }

          ?>
            <!-- Content Header (Page header) -->
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
            {{ Form::hidden('entry_id', $entry->entry_id, array('entry_id' => 'entry_id')) }}
            @endif
		 <div class="col-md-6">
           <a href="{{ URL::route('franchiseeLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('franchisee.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('franchisee.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
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
                  <h3 class="box-title">{{ Lang::get('franchisee.information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">
                    
                    
                    <div class="form-group">
                      <label for="exampleInputtext">{{ Lang::get('franchisee.franchisee') }}:</label>
                     {{ Form::text('franchisee_id', isset($entry->franchisee_id) ? $entry->franchisee_id : null, ['class' => 'form-control']) }}
                         <small class="text-danger">{{ $errors->first('id') }}</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputtext">{{ Lang::get('franchisee.city') }}:</label>
                       {{ Form::text('city', isset($entry->city) ? $entry->city : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputtext">{{ Lang::get('franchisee.state') }}:</label>
                          <div class="form-group">
                            
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                              <option selected="selected">{{ Lang::get('franchisee.state') }}</option>
                              
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>{{ Lang::get('franchisee.zip') }}:</label>
                           {{ Form::text('zip', isset($entry->zip) ? $entry->zip : null, ['class' => 'form-control']) }}
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>{{ Lang::get('franchisee.franchisee') }}:</label>
                          {{ Form::textarea('franchisee_short', isset($entry->franchisee_short) ? $entry->franchisee_short : null, array('class' => 'form-control franchisee_short','id' => 'franchisee_short')) }}
          <small class="text-danger">{{ $errors->first('content') }}</small>
                      </div>
                    </div>
                  </div>
            
              </div>
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('franchisee.additional_information') }}:</h3>

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  
                  <div class="box-body">
                    <div class="form-group">
                      <label>{{ Lang::get('franchisee.description') }}:</label>
                      {{ Form::textarea('franchisee_long', isset($entry->franchisee_long) ? $entry->franchisee_long : null, array('class' => 'form-control description','id' => 'franchisee_long')) }}
          <small class="text-danger">{{ $errors->first('content') }}</small>
                    </div>
                  </div>
                </div>
              </div>
            {{ Form::close() }}
          </div>
      </section><!-- /.content -->