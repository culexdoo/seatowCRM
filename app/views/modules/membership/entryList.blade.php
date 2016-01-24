
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          {{ Lang::get('membership.list_all_membership') }}
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
              
              <div class="box box-black">
                <div class="box-header">
                <div clas="row">
                 <div class="col-md-6"> <h3 class="box-title">{{ Lang::get('membership.list_all_membership') }}</h3>
                 </div>
                 <div class="col-md-6">
                 <a class="btn btn-success btn-flat pull-right" href="{{ URL::route('MembershipGetAddEntry') }}"><i class="fa fa-plus"></i>{{ Lang::get('membership.add_membership') }}</a>
                 </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div clasee="box-body">
                  @if (count($entries) > 0) 
            
                  <table id="list-memberships" class="table">
                    <thead>
                      <tr>
                        
                        <th>
                          <div class="row">
                            <div class="col-md-2">
                                {{ Lang::get('membership.membership_name') }}
                            </div>
                             <div class="col-md-2 pull-right">
                           {{ Lang::get('membership.quick_options') }}
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
                          {{ Lang::get('membership.membership_name') }}
                          </div>
                           <div class="col-md-2 pull-right">
                           {{ Lang::get('membership.quick_options') }}
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
                               <label> {{ $entry->title }} </label>
                                </div>
                                <div class="col-md-2 pull-right">
                                  <a href="{{ URL::route('MembershipGetEditEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-warning">{{ Lang::get('membership.edit_membership') }}</span></a>

                                 &nbsp; 
                                  <a href="{{ URL::route('MembershipGetDeleteEntry', array('entry_id' => $entry->entry_id)) }}"><span class="label label-danger">{{ Lang::get('membership.delete_membership') }}</span></a>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                                </button>
                              </div>

                                 
                                </div>
                              </div>
                              
                            </div>
                            
                            <div class="box-body colored-div">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <span class="bolded"><label> {{ Lang::get('membership.normal_price') }}:</label> </span>

                                    <p>{{ $entry->normal_price }}€</p>
                                    
                                    <span class="bolded"><label>{{ Lang::get('membership.promo_price') }}:</label> </span>
                                    <p>{{ $entry->promo_price_1 }}€</p>
                                    <span class="bolded"><label>{{ Lang::get('membership.promo_period_1') }} </label></span>
                                    <p>{{ $entry->promo_period_1_from }}-{{ $entry->promo_period_1_to }}</p>
                                    <h4><span class="bolded"><label>{{ Lang::get('membership.promo_price') }} </label></span>
                                    <p>{{ $entry->promo_price_2 }}€</p>
                                    <h4><span class="bolded"><label>{{ Lang::get('membership.promo_period_2') }} </label></span>
                                    <p>{{ $entry->promo_period_2_from }}-{{ $entry->promo_period_2_to }}</p>
                                    
                                    
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <label>{{ Lang::get('membership.description') }} </label>
                                  <p>{{ $entry->description }}</p>
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
                      $("#list-memberships").DataTable();
                      });
                      </script>
 