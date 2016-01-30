
        <section class="content-header">
          <h1>
         {{ Lang::get('employee.list_employees') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div>

                 <div class="box box-black">
                <div class="box-header">
                 <div class="col-md-9"> <h3 class="box-title">{{ Lang::get('employee.list_of_all_employees') }}</h3>
                </div>
                <div class="col-md-3">



               <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('EmployeeGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('employee.add_employee') }}</a>
                  <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                @if (count($entries) > 0) 
                  <table id="list-employees-hiden" class="table hidden">
                <thead>
                  <th> 
                    <td>{{ Lang::get('employee.employee_id') }}</td>
                    <td>{{ Lang::get('employee.first_name') }}</td>
                    <td>{{ Lang::get('employee.last_name') }}</td>
                    <td>{{ Lang::get('employee.mobile_number') }}</td>
                    <td>{{ Lang::get('employee.city') }}</td>
                    <td>{{ Lang::get('employee.franchisee_id') }}</td>
                    <td>{{ Lang::get('employee.employee_description') }}</td>
                  </th>  
                </thead>

                    <tbody>
                     @foreach($entries as $entry)
  
                            <tr>
                                <td></td>
                                <td>{{ $entry->employee_id }}</td>
                                <td>{{ $entry->first_name }}</td>
                                <td>{{ $entry->last_name }}</td>
                                <td>{{ $entry->mobile_number }}</td>
                                <td>{{ $entry->city }}</td>
                                <td>{{ $entry->franchisee_id }}</td>
                                <td>{{ $entry->employee_description }}</td>
                            </tr>
  
                       @endforeach
                
                      
                      
                    </tbody>
                    </table>
                     @endif
                            <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
               </div>
               </div>

                <!-- /.box-header -->

                <div class="box-body">
                 @if (count($entries) > 0) 
                  <table id="list-employees" class="table">
                    <thead>
                      <tr>
                        
                       <th>
                          <div class="row">
                           <div class="col-md-2">
                          {{ Lang::get('employee.employee_id') }}
                          </div>
                          <div class="col-md-2">
                           {{ Lang::get('employee.first_name') }}:
                          </div>
                          <div class="col-md-2">
                          {{ Lang::get('employee.last_name') }}:
                          </div>
                          <div class="col-md-2">
                           {{ Lang::get('employee.mobile_number') }}
                          </div>
                          <div class="col-md-2 pull-right">
                          {{ Lang::get('employee.quick_options') }}
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
                          {{ Lang::get('employee.employee_id') }}
                          </div>
                          <div class="col-md-2">
                           {{ Lang::get('employee.first_name') }}:
                          </div>
                          <div class="col-md-2">
                          {{ Lang::get('employee.last_name') }}:
                          </div>
                          <div class="col-md-2">
                           {{ Lang::get('employee.mobile_number') }}
                          </div>
                          <div class="col-md-2 pull-right">
                          {{ Lang::get('employee.quick_options') }}
                          </div>
                          </div>
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                     @foreach($entries as $entry)
  
                        <tr>
                        <td>
                          <div class="box box-no-border collapsed-box no-margin">
                            <div class="box-header">
                                 
                                <div class="col-md-2 pull-right">
                                 <a href="{{ URL::route('EmployeeGetEditEntry', array('employee_id' => $entry->employee_id)) }}"><span class="label label-warning">{{ Lang::get('employee.edit_employee') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('EmployeeGetDeleteEntry', array('employee_id' => $entry->employee_id)) }}"><span class="label label-danger">{{ Lang::get('employee.delete_employee') }}</span></a>

                                   <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                                </button>
                              </div>

                                </div>
                              <div class="row">
                                <div class="col-md-2">
                                 {{ $entry->employee_id }}
                                </div>
                                <div class="col-md-2">
                                  {{ $entry->first_name }}
                                </div>
                                <div class="col-md-2">
                                 {{ $entry->last_name }}
                                </div>
                                <div class="col-md-2">
                                 {{ $entry->mobile_number }}
                                </div>
                               
                              </div>
                              
                            </div>
                            <div class="box-body colored-div">
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <h4><span class="bolded">{{ Lang::get('employee.city') }}: </span>{{ $entry->city }}</h4>
                                     
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <h4><span class="bolded">{{ Lang::get('employee.employee_description') }}: </span>{{ $entry->employee_description }}</h4>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <h4><span class="bolded">{{ Lang::get('employee.franchisee_id') }}:</span>
                                    {{ $entry->franchisee_id }}</h4>
                                   </div>
                                  </div>
                                </div>
                                <div class="div-md-2">
                                  <div class="form-group pull-right border-img">
                                  <img src="uploads/modules/client/thumbs/{{ $entry->image }}" alt="User Image"/>
                                  </div>
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
                
                <!-- /.box-body -->
              </div>
              </div>
            </div>
          </div>
          </section>
           <script>
                   $(function () {
                      $("#list-employees").DataTable();
                      });
                      </script><!-- /.content -->
                      <script>
                      $(document).ready(function() {
                         $('#list-employees-hiden').DataTable( {
                           dom: 'Brt',
                           buttons: [
                           'copy', 'csv', 'excel'
                                    ]
                               } );
                                } );
                      </script>
