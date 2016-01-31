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
          {{ Form::open(array('route' => 'SuperAdminPostAddEntry', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
            

            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
        
        
         

           <div class="col-md-6">
    
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </a>
          </div>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Make admin</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  
                  <div class="box-body">
                
                    <div class="form-group">
                      <label>Choose user:</label>
                      {{ Form::select('client_id', $allusers, isset($entry->client_id) ? $entry->client_id : null, array('class' => 'form-control', 'id' => 'client_id', 'required')) }}
                    </div>
                    <div class="form-group">
                      <label>Choose group:</label>
                       @if ($mode == 'add')
                            {{ Form::select('user_group', 
                              array(
                              'admin'=>'admin',
                              'employee'=>'employee',
                              'client'=>'client'
                              ),'admin', 
                              ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->user_group == 'admin')
                               {{ Form::select('user_group', 
                              array(
                              'admin'=>'admin',
                              'employee'=>'employee',
                              'client'=>'client'
                              ),'admin', 
                              ['class' => 'form-control']) }}
                          @elseif ($entry->user_group == 'employee')
                              {   {{ Form::select('user_group', 
                              array(
                              'admin'=>'admin',
                              'employee'=>'employee',
                              'client'=>'client'
                              ),'employee', 
                              ['class' => 'form-control']) }}
                          @elseif ($entry->user_group == 'client')
                                {{ Form::select('user_group', 
                              array(
                              'admin'=>'admin',
                              'employee'=>'employee',
                              'client'=>'client'
                              ),'client', 
                              ['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
                    
                  </div>
                
              </div>
              {{ Form::close() }}
            </div>

                 <div class="col-md-8">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Admin list</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  
                  <div class="box-body">
                
                  
                @if (count($alladmins) > 0) 
                  <table id="list-admins" class="table">
                <thead>
                  <th> 
                    <td>{{ Lang::get('core.first_name') }}</td>
                    <td>{{ Lang::get('core.last_name') }}</td>
                    <td>{{ Lang::get('core.entry_id') }}</td>
                    <td>{{ Lang::get('core.user_group') }}</td>
                  </th>  
                </thead>

                    <tbody>
                     @foreach($alladmins as $entry)
  
                            <tr>
                                <td></td>
                                <td>{{ $entry->first_name }}</td>
                                <td>{{ $entry->last_name }}</td>
                                <td>{{ $entry->entry_id }}</td>
                                <td>{{ $entry->user_group }}</td>
                            </tr>
  
                       @endforeach
                
                      
                      
                    </tbody>
                    </table>
                     @endif
                    
                  </div>
                
              </div>
              {{ Form::close() }}
            </div>
            
            
            
          </div>
          </section><!-- /.content -->
           <script type="text/javascript">
          $('select').select2();
          </script>
