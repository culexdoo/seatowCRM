 <!-- Content Header (Page header) -->



        <section class="content-header">
          <h1>
          {{ Lang::get('franchisee.list_all_franchisee') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
              
              <div class="box box-black">
                <div class="box-header">
                <div clas="row">
                 <div class="col-md-6">
                  <h3 class="box-title">{{ Lang::get('franchisee.list_of_all_franchisee') }}</h3>
                </div>
                <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('FranchiseeGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('franchisee.add_franchisee') }}</a>
                 </div>
                  </div>
                <!-- /.box-header -->
                <div clasee="box-body">
                   @if (count($entries) > 0) 
                  <table id="list-franchisees" class="table">
                    <thead>
                      <tr>
                        
                        <th>
                          <div class="row">
                            <div class="col-md-2">
                             {{ Lang::get('franchisee.franchisee_id') }}
                            </div>
                             <div class="col-md-2 pull-right">
                           {{ Lang::get('franchisee.quick_options') }}
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
                           {{ Lang::get('franchisee.franchisee_id') }}
                          </div>
                          <div class="col-md-2 pull-right">
                            {{ Lang::get('franchisee.quick_options') }}
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
                                <label> {{ $entry->franchisee_id }}</label>
                                </div>
                               
                                <div class="col-md-2 pull-right">
                                 <a href="{{ URL::route('FranchiseeGetEditEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('franchisee.edit_franchisee') }}</span></a>

                                 &nbsp; 

                                  <a href="{{ URL::route('FranchiseeGetDeleteEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('franchisee.delete_franchisee') }}</span></a>

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
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>{{ Lang::get('franchisee.city') }}:</label><p>{{ $entry->city }}</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>{{ Lang::get('franchisee.state') }}:</label><p></p>
                                    </div>
                                  </div>
                                   <div class="col-md-3">
                                    <div class="form-group">
                                      <label>{{ Lang::get('franchisee.employees') }}:</label><p></p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>{{ Lang::get('franchisee.franchisee_short') }}:</label>
                                      <p>{{ $entry->franchisee_short }}</p>
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