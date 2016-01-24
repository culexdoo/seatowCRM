   <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';
          }

          ?>
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
           <a href="{{ URL::route('boatsLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('core.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
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
                  <h3 class="box-title">{{ Lang::get('boats.basic_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">
                    <div class="form-group">
                   
                      <label>{{ Lang::get('boats.boat_owner') }}:</label>
                       @if ($mode == 'edit')
                       {{ Form::select('client_id', $clients, isset($entry->client_id) ? $entry->client_id : $preselected_client, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
                       @elseif ($mode == 'add')
                        {{ Form::select('client_id', $clients, isset($entry->client_id) ? $entry->client_id : null, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
                        @endif

                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_brand') }}:</label>
                     {{ Form::text('boat_brand', isset($entry->boat_brand) ? $entry->boat_brand : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_name') }}:</label>
                    {{ Form::text('boat_name', isset($entry->boat_name) ? $entry->boat_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.year') }}:</label>
                    {{ Form::text('year', isset($entry->year) ? $entry->year : null, ['class' => 'form-control']) }}
                    </div>
                    
                    
                    
                    <div class="form-group">
                      <label>{{ Lang::get('boats.registration_no') }}:</label>
                      {{ Form::text('registration_no', isset($entry->registration_no) ? $entry->registration_no : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.federal_doc_no') }}:</label>
                     {{ Form::text('federal_doc_no', isset($entry->federal_doc_no) ? $entry->federal_doc_no : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
              
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('boats.boat_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                    @if ($mode == 'edit')
                        <label for="hull_id">{{ Lang::get('boats.hull_name') }}:</label> 
                        {{ Form::select('hull_id', $hull_entries, isset($entry->hull_id) ? $entry->hull_id : $preselected_hull, array('class' => 'form-control', 'id' => 'hull_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('hull_id') != '' || $errors->first('hull_id') != null))
                        <p><small>{{ $errors->first('hull_id') }}</small></p>
                        @endif
                    @elseif ($mode == 'add')
                        <label for="hull_id">{{ Lang::get('boats.hull_name') }}:</label> 
                        {{ Form::select('hull_id', $hull_entries, isset($entry->hull_id) ? $entry->hull_id : null, array('class' => 'form-control', 'id' => 'hull_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('hull_id') != '' || $errors->first('hull_id') != null))
                        <p><small>{{ $errors->first('hull_id') }}</small></p>
                        @endif
                    @endif

                    </div>
                    <div class="form-group">
                     @if ($mode == 'edit')
                     <label for="make_id">{{ Lang::get('boats.make_name') }}:</label> 
                        {{ Form::select('make_id', $make_entries, isset($entry->make_id) ? $entry->make_id : $preselected_make, array('class' => 'form-control', 'id' => 'make_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('make_id') != '' || $errors->first('make_id') != null))
                        <p><small>{{ $errors->first('make_id') }}</small></p>
                        @endif
                     @elseif ($mode == 'add')
                        <label for="make_id">{{ Lang::get('boats.make_name') }}:</label> 
                        {{ Form::select('make_id', $make_entries, isset($entry->make_id) ? $entry->make_id : null, array('class' => 'form-control', 'id' => 'make_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('make_id') != '' || $errors->first('make_id') != null))
                        <p><small>{{ $errors->first('make_id') }}</small></p>
                        @endif
                     @endif
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_color') }}:</label>
                     {{ Form::text('boat_color', isset($entry->boat_color) ? $entry->boat_color : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.lenght') }}:</label>
                     {{ Form::text('lenght', isset($entry->lenght) ? $entry->lenght : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>Fuel Type:</label>
                      <div class="form-group">
                       @if ($mode == 'add')
                             {{ Form::radio('fuel_type', 'Diesel', true) }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline') }} Gasoline
                          @elseif ($mode == 'edit') 
                          @if ($entry->fuel_type == 'Diesel')
                             {{ Form::radio('fuel_type', 'Diesel', true) }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline') }} Gasoline
                          @elseif ($entry->fuel_type == 'Gasoline')
                             {{ Form::radio('fuel_type', 'Diesel') }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline', true) }} Gasoline
                          @endif
                       @endif
                      </div>
                    </div>
                      <div class="form-group">
                      <label>Engine Brand:</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Engine Brand">
                    </div>
                    <div class="form-group">
                      <label>Engine Type:</label>
                      @if ($mode == 'add')
                            {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->engine_type_id == '1')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '2')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '3')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '4')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '5')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'5',['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
                  </div>
               
              </div>
              
            </div>
            
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('boats.additional_information') }}:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  
                  <div class="box-body">
                    
                    
                    <div class="form-group">
                      <label>{{ Lang::get('boats.description') }}:</label>
                       {{ Form::textarea('description', isset($entry->description) ? $entry->description : null, array('class' => 'form-control description','id' => 'description')) }}
                    </div>
                    
                    
                  </div>
          
              </div>
                {{ Form::close() }}
            </div>
          </div>
          </section><!-- /.content -->
          <script type="text/javascript">
          $('select').select2();
          </script>
