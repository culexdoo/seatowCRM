

            <section class="content-header">
               <div class="row">
                  <div class="col-md-9">
                   <h3>
                    Pregled oglasa
                   </h3>
                  </div>

                  <div class="col-md-3 text-right">
                    <a class="btn btn-success btn-flat" href="{{ URL::route('ClassifiedsOfferGetAddEntry') }}"><i class="fa fa-plus"></i>     Dodaj oglas</a>
                  </div>
              
              
               </div>
            </section>






            <section class="content"> 
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
                          <th>Kratki Opis</th>
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
                          <td>{{ $classifiedsoffer->category_name }}</td>
                          <td>{{ $classifiedsoffer->short_description }}</td>
                          <td>{{ $classifiedsoffer->color }}</td>
                          <td>{{ $classifiedsoffer->material }}</td>

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
