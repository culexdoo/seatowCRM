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
                  <h3 class="box-title">{{ Lang::get('boats.hull_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">

                   
                    
            
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ Lang::get('boats.hull_name') }}:</label>
                     {{ Form::text('hull_name', isset($entry->hull_name) ? $entry->hull_name : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
              
              </div>
              
            </div>
             <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('boats.hull_information') }}</h3>
                </div>
                  <div class="box-body">
                  @if (count($hull_entries) > 0) 
                   <table id="list-boats" class="table">
                    <thead>
                       <tr>
                        <th>
                          <div class="row">
                            <div class="col-md-2">
                              {{ Lang::get('boats.membership_id') }}
                            </div>
                          </div>
                        </th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach($hull_entries as $entry)
                      <tr>
                        <td>
                          <div class="box box-no-border collapsed-box no-margin">
                            <div class="box-header">
                             
                              <div class="row">
                                <div class="col-md-4">
                                  {{ $entry->hull_name }}
                                </div>

                               <div class="col-md-2 pull-right">
                                 <a href="{{ URL::route('BoatsGetEditHull', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('boats.edit_boats') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('BoatsGetDeleteHull', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('boats.delete_boats') }}</span></a>

                           

                                </div>
                              </div>
                              
                            </div>
                        
                            </div>
                          
                        </td>
                      </tr>
            @endforeach

                    </tbody>
                  </table>

 @endif
                  </div>
              
              </div>
              
            </div>


                {{ Form::close() }}
       
          </div>
          </section><!-- /.content -->

                 