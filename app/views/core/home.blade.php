
          <section class="content-header">
               <div class="row">
                  <div class="col-md-9">
                   <h3>
                 	  Administracija ponuda
                   </h3>
                  </div>

                  <div class="col-md-3 text-right">
                    <a class="btn btn-success btn-flat" href="{{ URL::route('ClassifiedsOfferGetAddEntry') }}"><i class="fa fa-plus"></i> Ponudi proizvod</a> 
                    <a class="btn btn-success btn-flat" href="{{ URL::route('ClassifiedsDemandGetAddEntry') }}"><i class="fa fa-plus"></i> Zatraži proizvod</a>
                  </div>
              
               </div>
            </section>
             <section class="content"> 
				<div class="row">  
	            	<!-- fix for small devices only -->
	           		<div class="clearfix visible-sm-block"></div> 
		            <div class="col-md-3 col-sm-6 col-xs-12">
		              <div class="info-box">
		                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
		                <div class="info-box-content">
		                  <span class="info-box-text">Zatraženih proizvoda</span>
		                  <span class="info-box-number">{{ $number_entries_demand['number_entries'] }}</span>
		                </div><!-- /.info-box-content -->
		              </div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-3 col-sm-6 col-xs-12">
		              <div class="info-box">
		                <span class="info-box-icon bg-red"><i class="fa fa-bookmark-o"></i></span>
		                <div class="info-box-content">
		                  <span class="info-box-text"> Ponuđenih proizvoda</span>
		                  <span class="info-box-number">{{ $number_entries_offer['number_entries'] }}</span>
		                </div><!-- /.info-box-content -->
		              </div><!-- /.info-box -->
		            </div><!-- /.col -->
	         	 </div>
	          @if (count($classifiedsdemands['entries']) > 0) 
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Pregled zatraženih proizvoda</h3>
                    
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover">
                        <tbody><tr>
                          <th class="text-center">ID</th>
                          <th>Slika</th>
                          <th>Naslov</th>
                          <th>Sadržaj</th>
                          <th>Kategorija</th>
                          <th class="text-center">Akcija</th>

                        </tr>
                         @foreach($classifiedsdemands['entries'] as $classifiedsdemand)
                          <tr>
                          <td class="text-center">{{ $classifiedsdemand->entry_id }}</td>
                          <td>
                          @if ($classifiedsdemand->image != '' || $classifiedsdemand->image != null)
                          <img src="{{ url('/') }}/uploads/modules/classifieddemand/{{ $classifiedsdemand->image }}" class="classifiedsdemand-thumb-dashboard img-responsive">
                          @endif
                          </td>
                          <td>{{ $classifiedsdemand->title }}</td>
                          <td>{{ $classifiedsdemand->content }}</td>
                          <td>{{ $classifiedsdemand->category_name }}</td>
                           <td class="text-center">
                            <a href="{{ URL::route('ClassifiedsDemandGetEditEntry', array('entry_id' => $classifiedsdemand->entry_id)) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                            <a href="{{ URL::route('ClassifiedsDemandGetDeleteEntry', array('entry_id' => $classifiedsdemand->entry_id)) }}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                          </td>
                          <!-- <td class="text-center"></td> -->
                        </tr>
                        @endforeach
                      </tbody>
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div>
              </div>
              @else  
	           	 <div class="row">
	                <div class="col-xs-12">
	                  <div class="box"> 
	                    <div class="box-body">
	                    	<div class="col-lg-9">
	                    		<h3>Niste zatražili niti jedan proizvod.</h3>
    						</div>
	    					<div class="col-lg-3 text-right">
	 		   					<a class="btn btn-success btn-flat mt20" href="{{ URL::route('ClassifiedsDemandGetAddEntry') }}"><i class="fa fa-plus"></i> Zatraži proizvod </a>
	    					</div>
	                    </div>
	                  </div>
	                </div>
	              </div> 
           	 @endif
           	 @if (count($classifiedsoffers['entries']) > 0)
               <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Pregled ponuđenih proizvoda</h3>
                    
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                      <table class="table table-hover">
                        <tbody><tr>
                          <th class="text-center">ID</th>
                          <th>Slika</th>
                          <th>Naslov</th>
                          <th>Sadržaj</th>
                          <th>Kategorija</th>
                          <th>Kratki opis</th>
                          <th>Boja</th>
                          <th>Materijal</th>
                          <th class="text-center">Akcija</th>

                        </tr>
                         @foreach($classifiedsoffers['entries'] as $classifiedsoffer)
                          <tr>
                          <td class="text-center">{{ $classifiedsoffer->entry_id }}</td>
                          <td>
                          @if ($classifiedsoffer->image != '' || $classifiedsoffer->image != null)
                          <img src="{{ url('/') }}/uploads/modules/classifiedoffer/{{ $classifiedsoffer->image }}" class="classifiedsoffer-thumb-dashboard img-responsive">
                          @endif
                          </td>
                          <td>{{ $classifiedsoffer->title }}</td>
                          <td class="col-md-1">{{ $classifiedsoffer->content }}</td>
                          <td>{{ $classifiedsoffer->short_description }}</td>
                          <td>{{ $classifiedsoffer->color }}</td>
                          <td>{{ $classifiedsoffer->material }}</td>
                          <td>{{ $classifiedsoffer->category_name }}</td>
                           <td class="text-center">
                            <a href="{{ URL::route('ClassifiedsOfferGetEditEntry', array('entry_id' => $classifiedsoffer->entry_id)) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                            <a href="{{ URL::route('ClassifiedsOfferGetDeleteEntry', array('entry_id' => $classifiedsoffer->entry_id)) }}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                          </td>
                          <!-- <td class="text-center"></td> -->
                        </tr>
                        @endforeach
                      </tbody>
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div>
              </div> 
       		@else  
           	 <div class="row">
                <div class="col-xs-12">
                  <div class="box"> 
                    <div class="box-body">
                    	<div class="col-lg-9">
	                    	<h3>Niste ponudili niti jedan proizvod.</h3>
    					</div>
    					<div class="col-lg-3 text-right">
 		   					<a class="btn btn-success btn-flat mt20" href="{{ URL::route('ClassifiedsDemandGetAddEntry') }}"><i class="fa fa-plus"></i> Ponudi proizvod </a>
    					</div>
                    </div>
                  </div>
                </div>
              </div> 
              @endif
            </section>





















  
  