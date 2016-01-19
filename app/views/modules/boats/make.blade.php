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
                  <h3 class="box-title">{{ Lang::get('boats.make_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">

                   
                    
            
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ Lang::get('boats.make_name') }}:</label>
                     {{ Form::text('make_name', isset($entry->make_name) ? $entry->make_name : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
              
              </div>
              
            </div>
             <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('boats.make_list') }}</h3>
                </div>
                  <div class="box-body">
                  @if (count($make_entries) > 0) 
                   <table id="list-boats" class="table">
                    <thead>
                       <tr>
                        <th>
                          <div class="row">
                           
                          </div>
                        </th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach($make_entries as $entry)
                      <tr>
                        <td>
                          <div class="box box-no-border collapsed-box no-margin">
                            <div class="box-header">
                             
                              <div class="row">
                                <div class="col-md-4">
                                  {{ $entry->make_name }}
                                </div>

                               <div class="col-md-2 pull-right">
                                 <a href="{{ URL::route('BoatsGetEditMake', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('core.edit') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('BoatsGetDeleteMake', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('core.delete') }}</span></a>

                           

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

                 