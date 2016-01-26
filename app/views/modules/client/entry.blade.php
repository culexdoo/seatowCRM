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
               {{ Form::open(array('route' => $postRoute, 'role' => 'form', 'autocomplete' => 'off', 'files' => true)) }}

            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
            @if ($mode == 'edit')
            {{ Form::hidden('entry_id', $entry->entry_id, array('entry_id' => 'entry_id')) }}
            {{ Form::hidden('boat_id', $entry->boat_id, array('boat_id' => 'boat_id'))  }}
            @endif
         


           <div class="col-md-6">
           <a href="{{ URL::route('clientLanding') }}" class="btn btn-danger pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('client.cancel') }}</a>
          
           <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('client.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </a>

           @if ($mode == 'edit')
           <a href="{{ URL::route('EventGetAddEvent', array('entry_id' => $entry->entry_id)) }}" class="btn btn-primary pull-right">
           <span class="icon icon-block"></span>{{ Lang::get('client.add_event') }}</a>
           @endif

           </div>
          
          
         
          </div>
         
        </section>

        <section class="content">
          <div class="row">
          <!-- THIS IS CLIENT INFROMATION BOX -->
            <div class="col-md-4">
              <div class="box box-black collapsed-box">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.client_information') }}:</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
                </div>
               
                  <div class="box-body">
                    <label>{{ Lang::get('client.title') }}:</label>
                    <div class="form-group">
                     
                      @if ($mode == 'add')
                            {{ Form::select('title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'1', ['class' => 'form-control widith-100']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->title == '1')
                              {{ Form::select('title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->title == '2')
                              {{ Form::select('title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->title == '3')
                              {{ Form::select('title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->title == '4')
                              {{ Form::select('title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->title == '5')
                              {{ Form::select('title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'5',['class' => 'form-control']) }}
                               @elseif ($entry->title == '6')
                              {{ Form::select('title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'6',['class' => 'form-control']) }}
                               @elseif ($entry->title == '7')
                              {{ Form::select('title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'7',['class' => 'form-control']) }}
                               @elseif ($entry->title == '8')
                              {{ Form::select('title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'8',['class' => 'form-control']) }}
                               @elseif ($entry->title == '9')
                              {{ Form::select('title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'9',['class' => 'form-control']) }}
                          @endif
                        @endif
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
                      @if ($mode == 'add')
                       {{ Form::select('country_name', $countries, isset($entry->country_name) ? $entry->country_name : null, array('class' => 'form-control', 'country_name' => 'country_name', 'required')) }}
                       @elseif ($mode == 'edit')
                       {{ Form::select('country_name', $countries, isset($entry->country_name) ? $entry->country_name : $preselected_country_name, array('class' => 'form-control', 'country_name' => 'country_name', 'required')) }}
                       @endif
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
              <!-- THIS IS ADDITIONAL INFROMATION BOX -->
              <div class="box box-black collapsed-box">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.additional_information') }}:</h3>
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
              <div class="box box-black collapsed-box">
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
                          {{ Form::text('member_since', isset($entry->member_since) ? $entry->member_since : null, ['class' => 'form-control']) }}
                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <label>{{ Lang::get('client.membership_period') }}:</label>
                        </div>

                        <div class="col-md-6">
                          <label>{{ Lang::get('client.starts_from') }}:</label>
                         {{ Form::text('membership_from', isset($entry->membership_from) ? $entry->membership_from : null, ['class' => 'form-control', 'data-mask' => '99999']) }}

                        </div>
                        <div class="col-md-6">
                          <label>{{ Lang::get('client.ends_on') }}:</label>
                         {{ Form::text('membership_to', isset($entry->membership_to) ? $entry->membership_to: null, ['class' => 'form-control', 'data-inputmask' => '99999']) }}
                        </div>
                      </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.status') }}:</label>
                      @if ($mode == 'add')
                            {{ Form::select('status', array(
                              '1'=>'Active',
                              '2'=>'Inactive',
                              '3'=>'Expired',
                              '4'=>'Deleted',
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->status == '1')
                              {{ Form::select('status', array(
                              '1'=>'Active',
                              '2'=>'Inactive',
                              '3'=>'Expired',
                              '4'=>'Deleted',
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->status == '2')
                              {{ Form::select('status', array(
                              '1'=>'Active',
                              '2'=>'Inactive',
                              '3'=>'Expired',
                              '4'=>'Deleted',
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->status == '3')
                              {{ Form::select('status', array(
                              '1'=>'Active',
                              '2'=>'Inactive',
                              '3'=>'Expired',
                              '4'=>'Deleted',
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->status == '4')
                              {{ Form::select('status', array(
                              '1'=>'Active',
                              '2'=>'Inactive',
                              '3'=>'Expired',
                              '4'=>'Deleted',
                              ),'4',['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
                  
                     <div class="form-group">
                      <label>{{ Lang::get('client.franchisee') }}:</label>
                      {{ Form::select('franchisee_id', $entries, isset($entry->franchisee_id) ? $entry->franchisee_id : null, array('class' => 'form-control', 'id' => 'franchisee_id', 'required')) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.member_type') }}:</label>
                        @if ($mode == 'add')
                            {{ Form::select('member_type', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->member_type == '1')
                              {{ Form::select('member_type', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->member_type == '2')
                              {{ Form::select('member_type', array(
                            '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->member_type == '3')
                              {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->member_type == '4')
                              {{ Form::select('member_type', array(
                              '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->member_type == '5')
                              {{ Form::select('member_type', array(
                            '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'5',['class' => 'form-control']) }}
                               @elseif ($entry->member_type == '6')
                              {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'6',['class' => 'form-control']) }}
                               @elseif ($entry->member_type == '7')
                              {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'7',['class' => 'form-control']) }}
                               @elseif ($entry->member_type == '8')
                              {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'8',['class' => 'form-control']) }}
                               @elseif ($entry->member_type == '9')
                              {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'9',['class' => 'form-control']) }}
                               {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'10',['class' => 'form-control']) }}
                               {{ Form::select('member_type', array(
                             '1'=>'Bodensee',
                              '2'=>'Bodensee Skifahren',
                              '3'=>'Charter Passenger',
                              '4'=>'Commercial',
                              '5'=>'Gold Card',
                              '6'=>'Seasonal < 1',
                              '7'=>'Seasonal > 1',
                              '8'=>'Skipper',
                              '9'=>'Trailer Boat',
                              '10'=>'Trailer Passanger',
                              '11'=>'VIP'
                              ),'11',['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.short_team_member_for') }}:</label>
                     {{ Form::text('short_team_member', isset($entry->short_team_member) ? $entry->short_team_member : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
               
              </div>
              <!-- THIS IS DETAIL INFROMATION BOX -->
              <div class="box box-black collapsed-box">
                <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.detail_information') }}:</h3>
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
                      <label>{{ Lang::get('client.mailing_title') }}:</label>
                        <div class="form-group">
                         
                      @if ($mode == 'add')
                            {{ Form::select('mailing_title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->mailing_title == '1')
                              {{ Form::select('mailing_title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->mailing_title == '2')
                              {{ Form::select('mailing_title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->mailing_title == '3')
                              {{ Form::select('mailing_title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->mailing_title == '4')
                              {{ Form::select('mailing_title', array(
                              '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->mailing_title == '5')
                              {{ Form::select('mailing_title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'5',['class' => 'form-control']) }}
                               @elseif ($entry->mailing_title == '6')
                              {{ Form::select('mailing_title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'6',['class' => 'form-control']) }}
                               @elseif ($entry->mailing_title == '7')
                              {{ Form::select('mailing_title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'7',['class' => 'form-control']) }}
                               @elseif ($entry->mailing_title == '8')
                              {{ Form::select('mailing_title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'8',['class' => 'form-control']) }}
                               @elseif ($entry->mailing_title == '9')
                              {{ Form::select('mailing_title', array(
                             '1'=>'Mr.',
                              '2'=>'Ms.',
                              '3'=>'Mrs.',
                              '4'=>'Miss.',
                              '5'=>'Dr.',
                              '6'=>'Capt.',
                              '7'=>'Co.',
                              '8'=>'Inc.',
                              '9'=>'Corp.'
                              ),'9',['class' => 'form-control']) }}
                          @endif
                        @endif
                        </div>
                        
                        <div class="form-group">
                          <label>{{ Lang::get('client.first_name') }}:</label>
                         {{ Form::text('mailing_first_name', isset($entry->mailing_first_name) ? $entry->mailing_first_name : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.last_name') }}:</label>
                          {{ Form::text('mailing_last_name', isset($entry->mailing_last_name) ? $entry->mailing_last_name : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.company') }}:</label>
                         {{ Form::text('mailing_company', isset($entry->mailing_company) ? $entry->mailing_company : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.address') }}:</label>
                          {{ Form::text('mailing_address', isset($entry->mailing_address) ? $entry->mailing_address : null, ['class' => 'form-control']) }}
                        </div>
                         <label>{{ Lang::get('client.country') }}:</label>
                        <div class="form-group">
                         
                           @if ($mode == 'add')
                       {{ Form::select('mailing_country', $countries, isset($entry->mailing_country) ? $entry->mailing_country : null, array('class' => 'form-control', 'id' => 'mailing_country', 'required'))}}
                       @elseif ($mode == 'edit')
                       {{ Form::select('mailing_country', $countries, isset($entry->mailing_country) ? $entry->mailing_country : $preselected_mailing_country, array('class' => 'form-control', 'id' => 'mailing_country', 'required')) }}
                       @endif
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.state') }}:</label>
                          {{ Form::text('mailing_state', isset($entry->mailing_state) ? $entry->mailing_state : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.city') }}:</label>
                          {{ Form::text('mailing_city', isset($entry->mailing_city) ? $entry->mailing_city : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.zip_code') }}:</label>
                          {{ Form::text('mailing_zip', isset($entry->mailing_zip) ? $entry->mailing_zip : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.mobile_number') }}:</label>
                          {{ Form::text('mailing_mobile_number', isset($entry->mailing_mobile_number) ? $entry->mailing_mobile_number : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label>{{ Lang::get('client.email') }}:</label>
                          {{ Form::text('mailing_email', isset($entry->mailing_email) ? $entry->mailing_email : null, ['class' => 'form-control']) }}
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
            <!-- THIS IS ADD PICTURE BOX -->
            <div class="col-md-4">
            <div class="box box-black collapsed-box">
              <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('client.add_image') }}:</h3>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
              </div>
                    <div class="box-body add-edit-image">
                      <div class="form-group">
                           <label for="image">{{ Lang::get('client.pick_image') }}:</label>
                          {{ Form::file('image', array('class' => 'form-control'))  }}
                          @if (isset($errors) && ($errors->first('image') != '' || $errors->first('image') != null))
                          <small class="text-danger">{{ $errors->first('image') }}</small>
                          @endif
                      </div>

                          @if ($mode == 'edit')
                          @if ($entry->image != null || $entry->image != '')
                      <div class="form-group">
                        <label for="image" style="padding-top: 10px;">{{ Lang::get('client.current_image') }}:</label>
                          {{ HTML::image(URL::to('/') . '/uploads/modules/client/thumbs/' . $entry->image, $entry->title) }}
                      </div>
                          @endif
                          @endif
                    </div>
            </div>
            <!-- THIS IS END OF ADD PICTURE BOX -->

            <!-- THIS IS ADD EVENENT BOX -->
            @if ($mode == 'edit')
             @if (count($trackingdata) > 0) 
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
                    @foreach($trackingdata['trackingdata'] as $event)
                    <li class="item">
                      <div class="product-img">
                        <img src="/uploads/modules/employee/thumbs/{{$event->image}}" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a class="product-title">{{$event->first_name }} {{$event->last_name}}
                              </a>
                              @if ($event->action == 'created')
                                          <span class="label label-success pull-right"> 
                                         {{ Lang::get('client.event_created') }}
                                          </span>
                                          @elseif ($event->action == 'edited')
                                           <span class="label label-warning pull-right"> 
                                         {{ Lang::get('client.event_edited') }}
                                          </span>
                                           @elseif ($event->action == 'membership_service')
                                            <span class="label label-primary pull-right"> 
                                         {{ Lang::get('client.event_membership_service') }}
                                          </span>
                                         <p> {{ Lang::get('client.additional_note') }} </p>
                                          {{$event->additional_note}}

                                          @elseif ($event->action == 'non_membership_service')
                                            <span class="label label-info pull-right"> 
                                         {{ Lang::get('client.trackdata_non_membership_service') }}
                                          </span>
                                         <p> {{ Lang::get('client.additional_note') }}</p>
                                          {{$event->additional_note}}
                                          @endif


                     
                          <span class="product-description">
                          <b>Date: </b>{{$event->created_at}}
                          </span>
                        </div>
                      </li>
                    @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              @endif
              @endif
      </section>
      <section class="content">
        <div class="row">
        <div class="col-md-6">
          <h1>
        {{ Lang::get('client.add_boat') }}
          </h1>
          </div>
          <div class="col-md-6">
             </div>
          </div>
         
            <div class="row">
            <div class="col-md-4">
              <div class="box box-black collapsed-box">
               
                 <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('boats.basic_information') }}:</h3>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
              </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">

                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_brand') }}:</label>
                     {{ Form::text('boat_brand', isset($entry->boat_brand) ? $entry->boat_brand : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_name') }}:</label>
                    {{ Form::text('boat_name', isset($entry->boat_name) ? $entry->boat_name : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.year') }}:</label>
                    {{ Form::text('year', isset($entry->year) ? $entry->year : null, ['class' => 'form-control']) }}
                    </div>
                    
                    
                    
                    <div class="form-group">
                      <label>{{ Lang::get('boats.registration_no') }}:</label>
                      {{ Form::text('registration_no', isset($entry->registration_no) ? $entry->registration_no : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.federal_doc_no') }}:</label>
                     {{ Form::text('federal_doc_no', isset($entry->federal_doc_no) ? $entry->federal_doc_no : null, ['class' => 'form-control']) }}
                    </div>
                  </div>
              
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black collapsed-box">
                   <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('boats.boat_information') }}:</h3>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
              </div>
            
                <!-- /.box-header -->
                <!-- form start -->
               
                  <div class="box-body">
                    <div class="form-group">
                    @if ($mode == 'edit')
                        <label for="hull_id">{{ Lang::get('boats.hull_name') }}:</label> 
                        {{ Form::select('hull_id', $hull_entries, isset($entry->hull_id) ? $entry->hull_id : $preselected_hull, array('class' => 'form-control', 'id' => 'hull_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('hull_id') != '' || $errors->first('hull_id') != null))
                        <p><small>{{ $errors->first('hull_id') }}</small></p>
                        @endif
                    @elseif ($mode == 'add')
                        <label for="hull_id">{{ Lang::get('boats.hull_name') }}:</label> 
                        {{ Form::select('hull_id', $hull_entries, isset($entry->hull_id) ? $entry->hull_id : null, array('class' => 'form-control', 'id' => 'hull_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('hull_id') != '' || $errors->first('hull_id') != null))
                        <p><small>{{ $errors->first('hull_id') }}</small></p>
                        @endif
                    @endif

                    </div>
                    <div class="form-group">
                     @if ($mode == 'edit')
                     <label for="make_id">{{ Lang::get('boats.make_name') }}:</label> 
                        {{ Form::select('make_id', $make_entries, isset($entry->make_id) ? $entry->make_id : $preselected_make, array('class' => 'form-control', 'id' => 'make_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('make_id') != '' || $errors->first('make_id') != null))
                        <p><small>{{ $errors->first('make_id') }}</small></p>
                        @endif
                     @elseif ($mode == 'add')
                        <label for="make_id">{{ Lang::get('boats.make_name') }}:</label> 
                        {{ Form::select('make_id', $make_entries, isset($entry->make_id) ? $entry->make_id : null, array('class' => 'form-control', 'id' => 'make_id', 'required')) }}
                        @if (isset($errors) && ($errors->first('make_id') != '' || $errors->first('make_id') != null))
                        <p><small>{{ $errors->first('make_id') }}</small></p>
                        @endif
                     @endif
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.boat_color') }}:</label>
                     {{ Form::text('boat_color', isset($entry->boat_color) ? $entry->boat_color : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('boats.lenght') }}:</label>
                     {{ Form::text('lenght', isset($entry->lenght) ? $entry->lenght : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>Fuel Type:</label>
                      <div class="form-group">
                       @if ($mode == 'add')
                             {{ Form::radio('fuel_type', 'Diesel', true) }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline') }} Gasoline
                          @elseif ($mode == 'edit') 
                          @if ($entry->fuel_type == 'Diesel')
                             {{ Form::radio('fuel_type', 'Diesel', true) }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline') }} Gasoline
                          @elseif ($entry->fuel_type == 'Gasoline')
                             {{ Form::radio('fuel_type', 'Diesel') }}  Diesel 
                             {{ Form::radio('fuel_type', 'Gasoline', true) }} Gasoline
                          @endif
                       @endif
                      </div>
                    </div>
                      <div class="form-group">
                      <label>Engine Brand:</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Engine Brand">
                    </div>
                    <div class="form-group">
                      <label>Engine Type:</label>
                      @if ($mode == 'add')
                            {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->engine_type_id == '1')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '2')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '3')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '4')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'4',['class' => 'form-control']) }}
                          @elseif ($entry->engine_type_id == '5')
                              {{ Form::select('engine_type_id', array(
                              '1'=>'InBoard',
                              '2'=>'In/Out Board',
                              '3'=>'OutBoard',
                              '4'=>'Sail',
                              '5'=>'Jet'
                              ),'5',['class' => 'form-control']) }}
                          @endif
                        @endif
                    </div>
                  </div>
               
              </div>
              
            </div>
            
            <div class="col-md-4">
              <div class="box box-black collapsed-box">
                    <div class="box-header">
                  <h3 class="box-title">{{ Lang::get('boats.additional_information') }}:</h3>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus red"></i>
                    </button>
                  </div>
              </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                  
                  <div class="box-body">
                    
                    
                    <div class="form-group">
                      <label>{{ Lang::get('boats.description') }}:</label>
                       {{ Form::textarea('description', isset($entry->description) ? $entry->description : null, array('class' => 'form-control description','id' => 'description')) }}
                    </div>
                    
                    
                  </div>
          
              </div>
                {{ Form::close() }}
            </div>
          </div>
  
      </section>
        <script type="text/javascript">
         $('select').select2();
         if ($(element).not(':visible')) {
        $('.select2-search__field').width("100%"); 
        </script>
