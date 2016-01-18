

            <section class="content-header">
               <div class="row">
                  <div class="col-md-9">
                   <h3>
                    Pregled oglasa
                   </h3>
                  </div>

                  <div class="col-md-3 text-right">
                    <a class="btn btn-success btn-flat" href="{{ URL::route('ClassifiedsDemandGetAddEntry') }}"><i class="fa fa-plus"></i>     Dodaj oglas</a>
                  </div>
              
              
               </div>
            </section>



            <section class="content"> 
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
                          <th>Kratki opis</th>
                          <th>Boja</th>
                          <th>Materijal</th>
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
                          <td class="col-md-1">{{ $classifiedsdemand->content }}</td>
                          <td>{{ $classifiedsdemand->category_name }}</td>
                          <td>{{ $classifiedsdemand->short_description }}</td>
                          <td>{{ $classifiedsdemand->color }}</td>
                          <td>{{ $classifiedsdemand->material }}</td>

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
                  <a class="btn btn-success btn-flat mt20" href="{{ URL::route('ClassifiedsOfferGetAddEntry') }}"><i class="fa fa-plus"></i> Zatraži proizvod </a>
                </div>
                      </div>
                    </div>
                  </div>
                </div> 
             @endif
            </section>
