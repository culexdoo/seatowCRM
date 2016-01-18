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
           <span class="icon icon-block"></span>{{ Lang::get('boats.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('boats.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
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
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Ivan Rakic, ID: 152</option>
                        <option>Maja Sisak, ID: 184</option>
                        <option>Ivana Laki, ID: 251</option>
                        <option>Saki Babic, ID: 321</option>
                      </select>
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
                      <label for="exampleInputPassword1">{{ Lang::get('boats.registration_no') }}:</label>
                      {{ Form::text('registration_no', isset($entry->registration_no) ? $entry->registration_no : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ Lang::get('boats.federal_doc_no') }}:</label>
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
                      <label>Hull:</label>
                      <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Aluminium</option>
                        <option>Carbon Fiber</option>
                        <option>Fiberglass</option>
                        <option>Kevlar</option>
                        <option>Other</option>
                        <option>Steel</option>
                        <option>Wood</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Make:</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">ALBEMARILE</option>
                        <option>ALBIN</option>
                        <option>ALLGLASS</option>
                        <option>ANACAPRI</option>
                        <option>ANGLER</option>
                        <option>APOLLO</option>
                        <option>AQUASPORT</option>
                        <option>AZIMUT</option>
                        <option>BAJA</option>
                        <option>BANKS COVE</option>
                      </select>
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
                      <label for="exampleInputEmail1">Fuel Type:</label>
                      <div class="form-group">
                        <input type="radio" class="minimal" name="fuel-type" value="diesel">&nbsp Diesel
                        <input type="radio" class="minimal" name="fuel-type" value="gasoline">&nbsp Gasoline
                      </div>
                    </div>
                      <div class="form-group">
                      <label>Engine Brand:</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Engine Brand">
                    </div>
                    <div class="form-group">
                      <label>Engine Type:</label>
                      <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">N/A</option>
                        <option>InBoard</option>
                        <option>In/Out Board</option>
                        <option>OutBoard</option>
                        <option>Sail</option>
                        <option>Jet</option>
                      </select>
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
