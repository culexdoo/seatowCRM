
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
            Dashboard
            </h1>
            
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>{{ $counted_user_number['counted_user_number'] }}</h3>
                    <p>Clients</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="{{ URL::route('clientLanding') }}" class="small-box-footer">More info <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>{{ $counted_boats_number['counted_boats_number'] }}</h3>
                    <p>Boats</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ship"></i>
                  </div>
                  <a href="{{ URL::route('boatsLanding') }}" class="small-box-footer">More info <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>{{ $counted_franchisee_number['counted_franchisee_number'] }}</h3>
                    <p>Franchises</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                  </div>
                  <a href="{{ URL::route('franchiseeLanding') }}" class="small-box-footer">More info <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>3</h3>
                    <p>Invoices</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ URL::route('invoiceLanding') }}" class="small-box-footer">More info <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <div class="row">
              <section class="content col-lg-6">
                <div class="box box-black">
                  <div class="box-header with-border">
                    <h3 class="box-title">Last 10 clients</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tbody>
                     
                      <tr>
                        <th>ClientID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Added</th>
                        <th class="call-md-2">Quick Actions</th>
                      </tr>
                       @foreach($lastclients['lastclients'] as $client)
                      <tr>
                        <td>{{ $client->membership_id }}</td>
                        <td>{{ $client->first_name }}</td>
                        <td>{{ $client->last_name }}</td>
                        <td>{{ $client->created_at }}</td>
                        <td>
                          <a href="{{ URL::route('EventGetAddEvent', array('entry_id' => $client->entry_id)) }}">
                          <span class="label label-primary">
                          {{ Lang::get('client.add_event') }}</span></a>

                        &nbsp; 
                        <a href="{{ URL::route('ClientGetEditEntry', array('entry_id' => $client->entry_id)) }}"><span class="label label-warning">{{ Lang::get('client.edit_client') }}</span></a>

                        &nbsp; 
                        <a href="{{ URL::route('ClientGetDeleteEntry', array('entry_id' => $client->entry_id)) }}"><span class="label label-danger">{{ Lang::get('client.delete_client') }}</span></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
            <section class="content col-lg-6">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3  class="box-title">Recent Actions</h3>
                  
                </div>
                <!-- /.box-header -->
                <div  class="box-body recent-actions">
               
                  <ul class="products-list product-list-in-box">
                     @foreach($trackingdata['trackingdata'] as $trackdata)
                    <li class="item">
                      <div class="product-img">

                        
                        @if ($trackdata->action == 'created')
                                <i class="fa-green fa fa-plus fa-3x"></i>

                                @elseif ($trackdata->action == 'edited')
                                <i class="fa-blue fa fa-check-square-o fa-3x"></i>

                                 @elseif ($trackdata->action == 'membership_service')
                                 <i class="fa-pencil-mem-color fa fa-pencil-square-o fa-3x"></i>
                              
                                </span>
                                @elseif ($trackdata->action == 'non_membership_service')
                                  <i class="fa-pencil-nonmem-color fa fa-pencil-square-o fa-3x"></i>
                              
                                </span>
                                @elseif ($trackdata->action == 'deleted')
                                 <i class="fa-red fa-red fa fa-trash fa-3x"></i>
                               
                                
                                @endif
                      </div>
                      <div class="product-info">
                        <a>{{ $trackdata->employee_first_name }} {{ $trackdata->employee_last_name }}
                          @if ($trackdata->action == 'created')
                                <span class="label label-success pull-right"> 
                               {{ Lang::get('client.created') }}
                                </span>
                                @elseif ($trackdata->action == 'edited')
                                 <span class="label label-warning pull-right"> 
                               {{ Lang::get('client.edited') }}
                                </span>
                                 @elseif ($trackdata->action == 'membership_service')
                                  <span class="label mem-color pull-right"> 
                               {{ Lang::get('client.trackdata_membership_service') }}
                                </span>
                                @elseif ($trackdata->action == 'non_membership_service')
                                  <span class="label nonmem-color pull-right"> 
                               {{ Lang::get('client.trackdata_non_membership_service') }}
                                </span>
                                @elseif ($trackdata->action == 'deleted')
                                  <span class="label label-danger pull-right"> 
                               {{ Lang::get('client.deleted') }}
                                </span>
                                @endif
                              </a>
                          <span class="product-description">
                            
                             @if ($trackdata->action == 'created')
                                
                               {{ Lang::get('client.created') }}
                                
                                @elseif ($trackdata->action == 'edited')
                                
                               {{ Lang::get('client.edited') }}
                               
                                 @elseif ($trackdata->action == 'membership_service')
                                  
                               {{ Lang::get('client.trackdata_membership_service') }}
                                
                                @elseif ($trackdata->action == 'non_membership_service')
                                 
                               {{ Lang::get('client.trackdata_non_membership_service') }}
                               
                                @elseif ($trackdata->action == 'deleted')
                                  
                               {{ Lang::get('client.deleted') }}
                                
                                @endif


                            <b>Client: </b>

                            <a href"#">{{ $trackdata->first_name }} {{ $trackdata->last_name }}</a> 
                            <b>Date:</b>
                             {{ $trackdata->created_at }}
                          </span>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                   
                  </div>

              </div>
            </section>
          </div>
          </section><!-- /.content -->
          <script>
                    
           