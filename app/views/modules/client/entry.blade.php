   <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';
          }

          ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="row">
        <div class="col-md-6">
          <h1>
         {{ $title or null }}
          </h1>
          </div>
               {{ Form::open(array('route' => $postRoute, 'role' => 'form', 'autocomplete' => 'off', 'files' => false)) }}

            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
            @if ($mode == 'edit')
            {{ Form::hidden('entry_id', $entry->entry_id, array('entry_id' => 'entry_id')) }}
            @endif
         


           <div class="col-md-6">
           <a href="{{ URL::route('clientLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('client.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('client.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </div>
          </a>
          
          
         
          </div>
         
        </section>

        <section class="content">
          <div class="row">
          <!-- THIS IS CLIENT INFROMATION BOX -->
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.client_information') }}</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
               
                  <div class="box-body">
                    <div class="form-group">
                      <label>{{ Lang::get('client.franchisee') }}:</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Kroatien</option>
                        <option>Bodensee</option>
                        <option>Deutschland</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.title') }}:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Mr.</option>
                        <option>Ms.</option>
                        <option>Mrs.</option>
                        <option>Miss.</option>
                        <option>Dr.</option>
                        <option>Capt.</option>
                        <option>Co.</option>
                        <option>Inc.</option>
                        <option>Corp.</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>{{ Lang::get('client.first_name') }}:</label>
                      {{ Form::text('first_name', isset($entry->first_name) ? $entry->first_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.last_name') }}:</label>
                    {{ Form::text('last_name', isset($entry->last_name) ? $entry->last_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.company') }}:</label>
                    {{ Form::text('company', isset($entry->company) ? $entry->company : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.address') }}:</label>
                     {{ Form::text('address', isset($entry->address) ? $entry->address : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.country') }}:</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.state') }}:</label>
                      {{ Form::text('state', isset($entry->state) ? $entry->state : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.city') }}:</label>
                      {{ Form::text('city', isset($entry->city) ? $entry->city : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.zip_code') }}:</label>
                      {{ Form::text('zip', isset($entry->zip) ? $entry->zip : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.mobile_number') }}:</label>
                      {{ Form::text('mobile_number', isset($entry->mobile_number) ? $entry->mobile_number : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.email_address') }}:</label>
                      {{ Form::text('email', isset($entry->email) ? $entry->email : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
                
              </div>
              <!-- THIS IS DETAIL INFROMATION BOX -->
              <div class="box box-black">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.detail_information') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
              
                  
                  <div class="box-body">
                  <div class="form-group">
                      <label>{{ Lang::get('client.additional_mobile_number') }}:</label>
                      {{ Form::text('mobile_number_2', isset($entry->mobile_number_2) ? $entry->mobile_number_2 : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.additional_email') }}:</label>
                      {{ Form::text('email_2', isset($entry->email_2) ? $entry->email_2 : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.home_no') }}:</label>
                      {{ Form::text('home_number', isset($entry->home_number) ? $entry->home_number : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.bus_no') }}:</label>
                      {{ Form::text('bus_no', isset($entry->bus_no) ? $entry->bus_no : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.summer_no') }}:</label>
                  {{ Form::text('summer_no', isset($entry->summer_no) ? $entry->summer_no : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.fax_no') }}:</label>
                      {{ Form::text('fax_no', isset($entry->fax_no) ? $entry->fax_no : null, ['class' => 'form-control']) }}
                    </div>
                   
                  </div>
           
              </div>
            </div>
            <!-- THIS IS MEMBERSHIP INFROMATION BOX -->
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.membership_information') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
               
                  <div class="box-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label>{{ Lang::get('client.memebership_number') }}:</label>
                         {{ Form::text('membership_id', isset($entry->membership_id) ? $entry->membership_id : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                          <label>{{ Lang::get('client.member_since') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="1994">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.membership_period') }}:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right active" id="reservation">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.status') }}:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Ative</option>
                        <option>Inactive</option>
                        <option>Expired</option>
                        <option>Deleted</option>
                      </select>
                    </div>
                  
                    
                    <div class="form-group">
                      <label>{{ Lang::get('client.member_type') }}:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Bodensee</option>
                        <option>Bodensee Skifahren</option>
                        <option>Charter Passenger</option>
                        <option>Commercial</option>
                        <option>Gold</option>
                        <option>Gold Card</option>
                        <option>Seasonal < 1</option>
                        <option>Seasonal > 1</option>
                        <option>Skipper</option>
                        <option>Trailer Boat</option>
                        <option>Trailer Passanger</option>
                        <option>VIP</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>{{ Lang::get('client.short_team_member_for') }}:</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Number of Days">
                    </div>
                  </div>
               
              </div>
              <!-- THIS IS ADDITIONAL INFROMATION BOX -->
              <div class="box box-black">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.additional_information') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
              

                  <div class="box-body">
                    <div class="box box-no-border collapsed-box">
                      <div class="box-header">
                        <h3 class="box-title">{{ Lang::get('client.mailing_address') }}:</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                          <label>{{ Lang::get('client.title') }}:</label>
                          <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Mr.</option>
                            <option>Ms.</option>
                            <option>Mrs.</option>
                            <option>Miss.</option>
                            <option>Dr.</option>
                            <option>Capt.</option>
                            <option>Co.</option>
                            <option>Inc.</option>
                            <option>Corp.</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          <label>{{ Lang::get('client.first_name') }}:</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.last_name') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.company') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Company">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.address') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.country') }}:</label>
                          <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.state') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter State">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.city') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.zip_code') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Zip Code">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.mobile_number') }}:</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile Phone Number">
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.email') }}:</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.homeport') }}:</label>
                        {{ Form::text('homeport', isset($entry->homeport) ? $entry->homeport : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.city') }}:</label>
                        {{ Form::text('additional_city', isset($entry->additional_city) ? $entry->additional_city : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.state') }}:</label>
                      {{ Form::text('additional_state', isset($entry->additional_state) ? $entry->additional_state : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.notes') }}:</label>
                    {{ Form::textarea('notes', isset($entry->notes) ? $entry->notes : null, array('class' => 'form-control notes','id' => 'notes')) }}
                    </div>
                  </div>
            
              </div>
            </div>
            <!-- THIS IS ADD EVENENT BOX -->
            <div class="col-md-4">
              <div class="box box-black collapsed-box">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.add_event') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
              
                  <div class="box-body">
                    <div class="form-group">
                      <label>{{ Lang::get('client.action') }}:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Towed</option>
                        <option>Gas</option>
                        <option>Engine</option>
                        <option>Parts</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.additional_notes') }}:</label>
                     {{ Form::textarea('additional_notes', isset($entry->additional_notes) ? $entry->additional_notes : null, array('class' => 'form-control additional_notes','id' => 'additional_notes')) }}
                    </div>
                  </div>
            
              </div>
              <div class="box box-black collapsed-box">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.event_viewer') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body recent-actions">
                  <ul class="products-list product-list-in-box">
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title">Serviser 1
                          <span class="label label-success pull-right">Finished</span></a>
                          <span class="product-description">
                            Towed boat into harobour. <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                          </span>
                        </div>
                      </li>
                      <!-- /.item -->
                      <li class="item">
                        <div class="product-img">
                          <img src="dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript::;" class="product-title">Serviser 2
                            <span class="label label-warning pull-right">In Action</span></a>
                            <span class="product-description">
                              Engine broke, need new parts. <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                            </span>
                          </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript::;" class="product-title">Serviser 3
                              <span class="label label-danger pull-right">Failed</span></a>
                              <span class="product-description">
                                Boat sinked<b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                              </span>
                            </div>
                          </li>
                          <!-- /.item -->
                          <li class="item">
                            <div class="product-img">
                              <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                              <a href="javascript::;" class="product-title">Serviser 4
                                <span class="label label-success pull-right">Finished</span></a>
                                <span class="product-description">
                                  Towed boat into harobour. <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                </span>
                              </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                              <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                              </div>
                              <div class="product-info">
                                <a href="javascript::;" class="product-title">Serviser 5
                                  <span class="label label-warning pull-right">In Action</span></a>
                                  <span class="product-description">
                                    Engine broke, need new parts. <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                  </span>
                                </div>
                              </li>
                              <!-- /.item -->
                              <li class="item">
                                <div class="product-img">
                                  <img src="dist/img/default-50x50.gif" alt="Product Image">
                                </div>
                                <div class="product-info">
                                  <a href="javascript::;" class="product-title">Serviser 6
                                    <span class="label label-danger pull-right">Failed</span></a>
                                    <span class="product-description">
                                      Boat sinked <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                    </span>
                                  </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                  <div class="product-img">
                                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                                  </div>
                                  <div class="product-info">
                                    <a href="javascript::;" class="product-title">Serviser 7
                                      <span class="label label-success pull-right">Finished</span></a>
                                      <span class="product-description">
                                        Towed boat into harobour.<b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                      </span>
                                    </div>
                                  </li>
                                  <!-- /.item -->
                                  <li class="item">
                                    <div class="product-img">
                                      <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                      <a href="javascript::;" class="product-title">Serviser 8
                                        <span class="label label-warning pull-right">In Action</span></a>
                                        <span class="product-description">
                                          Engine broke, need new parts. <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                        </span>
                                      </div>
                                    </li>
                                    <!-- /.item -->
                                    <li class="item">
                                      <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                      </div>
                                      <div class="product-info">
                                        <a href="javascript::;" class="product-title">Serviser 9
                                          <span class="label label-danger pull-right">Failed</span></a>
                                          <span class="product-description">
                                            Boat sinked <b>For client: </b><a href"#"="">Hans Dietrich</a> <b>Date:</b> 01-07-2015 | 17:50
                                          </span>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </section>
