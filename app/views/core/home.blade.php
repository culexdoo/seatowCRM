
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
                    <p>{{ Lang::get('core.dashboard') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="{{ URL::route('clientLanding') }}" class="small-box-footer">{{ Lang::get('core.more_info') }}<i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>{{ $counted_boats_number['counted_boats_number'] }}</h3>
                    <p>{{ Lang::get('core.boats') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ship"></i>
                  </div>
                  <a href="{{ URL::route('boatsLanding') }}" class="small-box-footer">{{ Lang::get('core.more_info') }} <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>{{ $counted_franchisee_number['counted_franchisee_number'] }}</h3>
                    <p>{{ Lang::get('core.franchises') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                  </div>
                  <a href="{{ URL::route('franchiseeLanding') }}" class="small-box-footer">{{ Lang::get('core.more_info') }} <i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>3</h3>
                    <p>{{ Lang::get('core.invoices') }}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ URL::route('invoiceLanding') }}" class="small-box-footer">{{ Lang::get('core.more_info') }}<i class="fa fa-eye"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <div class="row">
            </section>
              <section class="content col-lg-6">
                <div class="box box-black">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{ Lang::get('core.last_10_clients') }}</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tbody>
                     
                      <tr>
                        <th>{{ Lang::get('core.client_id') }}</th>
                        <th>{{ Lang::get('core.first_name') }}</th>
                        <th>{{ Lang::get('core.last_name') }}</th>
                        <th>{{ Lang::get('core.added') }}</th>
                        <th class="call-md-2">{{ Lang::get('core.quick_action') }}</th>
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
                  <h3  class="box-title">{{ Lang::get('core.recent_action') }}</h3>
                  
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
                                
                                 
                                  @elseif ($trackdata->action == 'non_membership_service')
                                    <i class="fa-pencil-nonmem-color fa fa-pencil-square-o fa-3x"></i>
                                
                               
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


                              <b>{{ Lang::get('core.client') }}</b>

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
            

          <div class="col-md-12">
        <canvas id="buyers"  width="1920" height="700"></canvas>
        </div>
        
        
        <div class="col-md-12">
        <div class="col-md-6">
         <canvas id="income" width="600" height="400"></canvas>
         </div>
         <div class="col-md-6">
         <canvas id="countries" width="600" height="400"></canvas>
         </div>
         </div>
          
         
 <script>
 var buyerData = {
  labels : ["January","February","March","April","May","June"],
  datasets : [
    { 
      fillColor : "rgba(254,153,0,0.2)",
      strokeColor : "#FE9900",
      pointColor : "#FE9900",
      pointStrokeColor : "#FE9900",
      data : [5,5,6,5,6,{{ $counted_franchisee_number['counted_franchisee_number'] }}]
    },
     {
      fillColor : "rgba(38,117,25,0.2)",
      strokeColor : "#267519",
      pointColor : "#267519",
      pointStrokeColor : "#267519",
      data : [45,96,124,160,130,{{ $counted_boats_number['counted_boats_number'] }}]
    },
    {
      fillColor : "rgba(91,192,209,0.2)",
      strokeColor : "#5BC0D1",
      pointColor : "#5BC0D1",
      pointStrokeColor : "#5BC0D1",
      data : [120,90,49,46,57,{{ $counted_user_number['counted_user_number'] }}]
    }
  ]
}
    var buyers = document.getElementById('buyers').getContext('2d');
    new Chart(buyers).Line(buyerData);



var barData = {
  labels : ["January","February","March","April","May","June"],
  datasets : [
    {
      fillColor : "#48A497",
      strokeColor : "#48A4D1",
      data : [456,479,324,569,702,600]
    },
    {
      fillColor : "rgba(73,188,170,0.4)",
      strokeColor : "rgba(72,174,209,0.4)",
      data : [364,504,605,400,345,320]
    }

  ]
}
    var income = document.getElementById("income").getContext("2d");
new Chart(income).Bar(barData);

var pieData = [
  {
    value: 20,
    color:"#878BB6"
  },
  {
    value : 40,
    color : "#4ACAB4"
  },
  {
    value : 10,
    color : "#FF8153"
  },
  {
    value : 30,
    color : "#FFEA88"
  }
];
var pieOptions = {
  segmentShowStroke : false,
  animateScale : true
}
var countries= document.getElementById("countries").getContext("2d");
new Chart(countries).Pie(pieData, pieOptions);
</script>



     

                    
           