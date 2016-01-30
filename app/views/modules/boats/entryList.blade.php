
        <section class="content-header">
          <h1>
         {{ Lang::get('boats.list_all_boats') }}
          </h1>
      
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
            <div>


              <div class="box box-black padding-clients">
                <div class="box-header">
                 <div class="col-md-9"> <h3 class="box-title"> {{ Lang::get('boats.list_of_all_boats') }}</h3>
                </div>
                <div class="col-md-3">


               <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('ClientGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('boats.add_boat') }}</a>
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                @if (count($entries) > 0) 
                  <table id="list-boats-hidden" class="table hidden">
                    <thead>
                        <th>
                         
                          
                    <td>{{ Lang::get('boats.membership_id') }}</td>
                    <td>{{ Lang::get('boats.boat_name') }}</td>
                    <td>{{ Lang::get('boats.owner') }} </td>
                    <td>{{ Lang::get('boats.registration_no') }} </td>
                    <td>{{ Lang::get('boats.employee') }}</td>
                    <td>{{ Lang::get('boats.quick_options') }}</td>
                    <td>{{ Lang::get('boats.lenght') }}</td>
                    <td>{{ Lang::get('boats.federal_doc_no') }}</td>
                    <td>{{ Lang::get('boats.registration_no') }}</td>
                    <td>{{ Lang::get('boats.make') }}</td>
                    <td>{{ Lang::get('boats.hull') }}</td>
                    <td>{{ Lang::get('boats.boat_color') }}</td>
                    <td>{{ Lang::get('boats.year') }}</td>
                    <td>{{ Lang::get('boats.fuel_type') }}</td>
                    <td>{{ Lang::get('boats.engine_type') }}</td>
                    <td>{{ Lang::get('boats.additional_description') }}</td>
                          
                  
                        </th>
                      
                    </thead>

                    <tbody>
                       @foreach($entries as $entry)
                      <tr>
                                <td></td>
                                <td>{{ $entry->membership_id }}</td>
                                <td>{{ $entry->boat_name }}</td>
                                <td>{{ $entry->first_name }}</td>
                                <td>{{ $entry->last_name }}</td>
                                <td>{{ $entry->registration_no }}</td>

                                <td>Tu ce biti employee </td>

                                <td>{{ $entry->lenght }}m</td>
                                <td>{{ $entry->federal_doc_no }}</td>
                                <td>{{ $entry->registration_no }}</td>
                                <td>{{ $entry->make_name }}</td>
                                <td>{{ $entry->hull_name }}</td>
                                <td>{{ $entry->boat_color }}</td>
                                <td>{{ $entry->year }}</td>
                                <td>{{ $entry->fuel_type }}</td>
                                <td>
                                          @if ($entry->engine_type_id == '1')
                                          <p> 
                                          In Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '2')
                                          <p>
                                          In/Out Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '3')
                                          <p>
                                          Out Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '4')
                                          <p>
                                          Sail
                                          </p>
                                          @elseif ($entry->engine_type_id == '5')
                                          <p>
                                           Jet
                                          </p>
                                          @endif
                                </td>
                                <td>{{ $entry->description }}</td>
                        
                      
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                     @endif

               <!--//////////////////////////////////////-->
               </div>
               </div>
                <!-- /.box-header -->

                <div class="box-body">
                 @if (count($entries) > 0) 
                  <table id="list-boats" class="table">
                    <thead>
                      <tr>
                        
                        <th>
                          <div class="row">
                            <div class="col-md-2">
                              {{ Lang::get('boats.membership_id') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.boat_name') }}
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('boats.owner') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.registration_no') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.employee') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.quick_options') }}
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
                              {{ Lang::get('boats.membership_id') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.boat_name') }}
                            </div>
                            <div class="col-md-2">
                             {{ Lang::get('boats.owner') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.registration_no') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.employee') }}
                            </div>
                            <div class="col-md-2">
                               {{ Lang::get('boats.quick_options') }}
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
                             
                              <div class="row">
                                <div class="col-md-2">
                                 {{ $entry->membership_id }}
                                </div>
                                <div class="col-md-2">
                                  {{ $entry->boat_name }}
                                </div>
                                <div class="col-md-2">
                                {{ $entry->first_name }}
                                {{ $entry->last_name }}
                                </div>
                                <div class="col-md-2">
                                 {{ $entry->registration_no }}
                                </div>
                                <div class="col-md-2">
                                 Tu ce biti employee
                                </div>



                               <div class="col-md-2 pull-right">
                                 <a href="{{ URL::route('BoatsGetEditEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('boats.edit_boats') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('BoatsGetDeleteEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('boats.delete_boats') }}</span></a>

                                   <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                                </button>
                              </div>

                                </div>
                              </div>
                              
                            </div>
                            <div class="box-body colored-div">
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      
                                      <label>{{ Lang::get('boats.lenght') }}:</label>
                                      <p>{{ $entry->lenght }}m</p>
                                      <label>{{ Lang::get('boats.federal_doc_no') }}:</label>
                                      <p>{{ $entry->federal_doc_no }}</p>
                                      <label>{{ Lang::get('boats.registration_no') }}:</label>
                                      <p>{{ $entry->registration_no }}</p>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>{{ Lang::get('boats.make') }}:</label>
                                      <p>{{ $entry->make_name }}</p>
                                      <label>{{ Lang::get('boats.hull') }}:</label>
                                      <p>{{ $entry->hull_name }}</p>
                                      <label>{{ Lang::get('boats.boat_color') }}:</label>
                                      <p>{{ $entry->boat_color }}</p>
                                      
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>{{ Lang::get('boats.year') }}:</label><p>{{ $entry->year }}</p>
                                      <label>{{ Lang::get('boats.fuel_type') }}:</label>
                                      <p>{{ $entry->fuel_type }}</p>
                                      <label>{{ Lang::get('boats.engine_type') }}:</label>

                                          @if ($entry->engine_type_id == '1')
                                          <p> 
                                          In Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '2')
                                          <p>
                                          In/Out Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '3')
                                          <p>
                                          Out Board
                                          </p>
                                          @elseif ($entry->engine_type_id == '4')
                                          <p>
                                          Sail
                                          </p>
                                          @elseif ($entry->engine_type_id == '5')
                                          <p>
                                          Jet
                                          </p>
                                          @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="div-md-2">
                                  <div class="form-group">
                                    <label>{{ Lang::get('boats.additional_description') }}:</label>
                                    <p>{{ $entry->description }}</p>
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
                   
                <!-- /.box-body -->
            
            </div>
          </div>
          </div>
          </div>
          </div>
          </section><!-- /.content -->
           <script>
                      $(function () {
                      $("#list-boats").DataTable();
                      });
                      </script>
                       <script>
                      $(document).ready(function() {
                         $('#list-boats-hidden').DataTable( {
                           dom: 'Brt',
                           buttons: [
                           'copy', 'csv', 'excel'
                                    ]
                               } );
                                } );
                      </script>
