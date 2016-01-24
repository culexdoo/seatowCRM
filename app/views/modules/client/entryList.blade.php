    <?php
 //   goDie($clientsdata['country_name']);
    ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          {{ Lang::get('client.list_all_clients') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
              
              <div class="box box-black">
                <div class="box-header">
                 <div class="col-md-6"> <h3 class="box-title"> {{ Lang::get('client.list_of_all_clients') }}</h3>
                </div>
                <div class="col-md-6">

                <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('ClientGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('client.add_client') }}</a>
                <!-- BUTTON EXPORT TO PDF -->
                 <a class="btn btn-info btn-flat pull-right" href="{{ URL::route('ClientGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('client.export_to_pdf') }}</a>

                   <a class="btn btn-info btn-flat pull-right" href="{{ URL::route('ClientGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('client.export_to_csv') }}</a>
               </div>
               </div>

                <div clasee="box-body">
                @if (count($entries) > 0) 
                  <table id="list-clients" class="table">
                    <thead>
                      <tr>
                        
                        <th>
                          <div class="row">
                            <div class="col-md-1">
                             {{ Lang::get('client.membership_id') }}
                            </div>
                             <div class="col-md-1">
                             {{ Lang::get('client.title') }}
                            </div>
                            <div class="col-md-1">
                              {{ Lang::get('client.first_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('client.last_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('client.status') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('boats.boat_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('boats.registration_no') }}
                            </div> 
                            <div class="col-md-1">
                               {{ Lang::get('client.franchisee_id') }}
                            </div>
                             <div class="col-md-2">
                               {{ Lang::get('client.membership_expiriation_date') }}
                            </div>
                            <div class="col-md-1">
                              {{ Lang::get('client.quick_options') }}
                            </div>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tfoot>
                    <tr>
                             <th>
                          <div class="row">
                            <div class="col-md-1">
                             {{ Lang::get('client.membership_id') }}
                            </div>
                             <div class="col-md-1">
                             {{ Lang::get('client.title') }}
                            </div>
                            <div class="col-md-1">
                              {{ Lang::get('client.first_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('client.last_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('client.status') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('boats.boat_name') }}
                            </div>
                            <div class="col-md-1">
                               {{ Lang::get('boats.registration_no') }}
                            </div> 
                            <div class="col-md-1">
                               {{ Lang::get('client.franchisee_id') }}
                            </div>
                             <div class="col-md-2">
                               {{ Lang::get('client.membership_expiriation_date') }}
                            </div>
                            <div class="col-md-1">
                              {{ Lang::get('client.quick_options') }}
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
                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                                </button>
                              </div>
                              <div class="row">
                                <div class="col-md-1">
                                  {{ $entry->membership_id }}
                                </div>
                                <div class="col-md-1">
                                    @if ($entry->title == '1')
                                    <p> 
                                    Mr.
                                    </p>
                                    @elseif ($entry->title == '2')
                                    <p>
                                    Ms.
                                    </p>
                                    @elseif ($entry->title == '3')
                                    <p>
                                    Mrs.
                                    </p>
                                    @elseif ($entry->title == '4')
                                    <p>
                                    Miss.
                                    </p>
                                    @elseif ($entry->title == '5')
                                    <p>
                                    Dr.
                                    </p>
                                    @elseif ($entry->title == '6')
                                    <p>
                                    Capt.
                                    </p>
                                    @elseif ($entry->title == '7')
                                    <p>
                                    Co.
                                    </p>
                                    @elseif ($entry->title == '8')
                                    <p>
                                    Inc.
                                    </p>
                                    @elseif ($entry->title == '9')
                                    <p>
                                    Corp.
                                    </p>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                  {{ $entry->first_name }}
                                </div>
                                <div class="col-md-1">
                                  {{ $entry->last_name }}
                                </div>
                                <div class="col-md-1">
                                 @if ($entry->status == '1')
                                    <p> 
                                    Active
                                    </p>
                                    @elseif ($entry->status == '2')
                                    <p>
                                    Inactive
                                    </p>
                                    @elseif ($entry->status == '3')
                                    <p>
                                    Expired
                                    </p>
                                    @elseif ($entry->status == '4')
                                    <p>
                                    Deleted
                                    </p>
                                    @endif
                                </div>
                                 <div class="col-md-1">
                                  {{ $entry->boat_name }}
                                </div>
                                 <div class="col-md-1">
                                  {{ $entry->registration_no }}
                                </div>
                                <div class="col-md-1">
                              {{ $entry->franchisee_id }}
                                </div>
                                <div class="col-md-2">
                                 {{ $entry->membership_to }}
                                </div>

                                

                                 <div class="col-md-2 pull-right">
                                 
                                  <a href="{{ URL::route('ClientGetAddEvent', array('entry_id' => $entry->entry_id)) }}">
                                  <span class="label label-primary">
                                  {{ Lang::get('client.add_event') }}</span></a>

                                 &nbsp; 

                                 <a href="{{ URL::route('ClientGetEditEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('client.edit_client') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('ClientGetDeleteEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('client.delete_client') }}</span></a>

                              
                                </div>
                              </div>
                              
                            </div>
                            <div class="box-body colored-div">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-10">
                                  <div class="col-md-2">
                                    <div class="form-group">
                                    <p><label>{{ Lang::get('client.client_information') }}</label></p>
                                      <label>{{ Lang::get('client.company') }}:</label>
                                      <p>{{ $entry->company }}</p>
                                      <label>{{ Lang::get('client.address') }}:</label>
                                      <p>{{ $entry->address }}</p>
                                      <label>{{ Lang::get('client.country') }}:</label>
                                      <p>{{ $entry->country_name }}</p>
                                      <label>{{ Lang::get('client.state') }}:</label>
                                      <p>{{ $entry->state }}</p>
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                     <p><label>{{ Lang::get('client.client_information') }}</label></p>
                                      <label>{{ Lang::get('client.city') }}:</label>
                                      <p>{{ $entry->city }}</p>
                                      <label>{{ Lang::get('client.zip_code') }}:</label>
                                      <p>{{ $entry->zip }}</p>
                                      <label>{{ Lang::get('client.mobile_number') }}:</label>
                                      <p>{{ $entry->mobile_number }}</p>
                                      <label>{{ Lang::get('client.email') }}:</label>
                                      <p>{{ $entry->email }}</p>
                                    </div>
                                  </div>
                                   <div class="col-md-2">
                                    <div class="form-group">
                                     <p><label>{{ Lang::get('client.membership_information') }}</label></p>
                                      <label>{{ Lang::get('client.member_since') }}:</label>
                                      <p>{{ $entry->member_since }}</p>
                                      <label>{{ Lang::get('client.membership_period') }}:</label>
                                      <p>{{ $entry->membership_from }} - {{ $entry->membership_to }}</p>
                                      <label>{{ Lang::get('client.member_type') }}:</label>
                                  
                                         @if ($entry->member_type == '1')
                                    <p> 
                                    Bpdemsee
                                    </p>
                                    @elseif ($entry->member_type == '2')
                                    <p>
                                    Bodensee Skifahren
                                    </p>
                                    @elseif ($entry->member_type == '3')
                                    <p>
                                    Charter Passenger
                                    </p>
                                    @elseif ($entry->member_type == '4')
                                    <p>
                                    Commercial
                                    </p>
                                    @elseif ($entry->member_type == '5')
                                    <p>
                                    Gold Card
                                    </p>
                                    @elseif ($entry->member_type == '6')
                                    <p>
                                    Seasonal < 1
                                    </p>
                                    @elseif ($entry->member_type == '7')
                                    <p>
                                    Seasonal > 1
                                    </p>
                                    @elseif ($entry->member_type == '8')
                                    <p>
                                    Skipper
                                    </p>
                                    @elseif ($entry->member_type == '9')
                                    <p>
                                    Trailer Boat
                                    </p>
                                    @elseif ($entry->member_type == '10')
                                    <p>
                                    Trailer Passanger
                                    </p>
                                    @elseif ($entry->member_type == '11')
                                    <p>
                                    VIP
                                    </p>
                                    @endif

                                    
                                      <label>{{ Lang::get('client.homeport') }}:</label>
                                      <p>{{ $entry->homeport }}</p>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                     <p><label>{{ Lang::get('client.detail_information') }}</label></p>
                                      <label>{{ Lang::get('client.home_no') }}:</label>
                                      <p>{{ $entry->home_number }}</p>
                                      <label>{{ Lang::get('client.bus_no') }}:</label>
                                      <p>{{ $entry->bus_no }}</p>
                                      <label>{{ Lang::get('client.summer_no') }}:</label>
                                      <p>{{ $entry->summer_no }}</p>
                                      <label>{{ Lang::get('client.fax_no') }}:</label>
                                      <p>{{ $entry->fax_no }}</p>
                                   </div>
                                  </div>
                                       <div class="col-md-2">
                                    <div class="form-group">
                                     <p><label>{{ Lang::get('boats.boat_information') }}</label></p>
                                      <label>{{ Lang::get('boats.make') }}:</label>
                                      <p>{{ $entry->make_name }}</p>
                                      <label>{{ Lang::get('boats.hull') }}:</label>
                                      <p>{{ $entry->hull_name }}</p>
                                      <label>{{ Lang::get('boats.year') }}:</label>
                                      <p>{{ $entry->year }}</p>
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
                                       <div class="col-md-2">
                                    <div class="form-group">
                                     <p><label>{{ Lang::get('boats.boat_information') }}</label></p>
                                      <label>{{ Lang::get('boats.color') }}:</label>
                                      <p>{{ $entry->boat_color }}</p>
                                      <label>{{ Lang::get('boats.lenght') }}:</label>
                                      <p>{{ $entry->lenght }}</p>
                                      <label>{{ Lang::get('boats.fuel_type') }}:</label>
                                      <p>{{ $entry->fuel_type }}</p>
                                      <label>{{ Lang::get('boats.federal_doc_no') }}:</label>
                                      <p>{{ $entry->federal_doc_no }}</p>
                                   </div>
                                  </div>
                                     </div>
                                     <div class="col-md-2">
                                        <div class="img-responsive">
                                          <img src="uploads/modules/client/thumbs/{{ $entry->image }}" alt="User Image"/>
                                        </div>
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
          </section><!-- /.content -->
                      <script>
                      $(function () {
                      $("#list-clients").DataTable();
                      });
                      </script>