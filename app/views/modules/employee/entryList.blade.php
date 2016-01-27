
        <section class="content-header">
          <h1>
         {{ Lang::get('employee.list_employees') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
                 <div class="box box-black">
                <div class="box-header">
                 <div class="col-md-6"> <h3 class="box-title">{{ Lang::get('employee.list_of_all_employees') }}</h3>
                </div>
                <div class="col-md-6">
               <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('EmployeeGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('employee.add_employee') }}</a>
               </div>
               </div>
                <!-- /.box-header -->
                <div clasee="box-body">
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
                                      <h4><span class="bolded">City: </span>Osijek</h4>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <h4><span class="bolded">Mobile Number: </span>095/558-98-98</h4>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                        <label>Franchisee</label>
                        <textarea class="form-control" rows="4" placeholder="Damlatia South (105) - [ +49 (0) 700-00-SEATOW]"></textarea>
                      </div>
                                  </div>
                                </div>
                                <div class="div-md-2">
                                  <div class="form-group pull-right border-img">
                                    <img src="dist/img/user1-128x128.jpg" alt="User Image">
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
          </section>
           <script>
                   $(function () {
                      $("#list-employees").DataTable();
                      });
                      </script><!-- /.content -->
