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
                      {{ Form::select('franchisee_id', $entries, isset($entry->franchisee_id) ? $entry->franchisee_id : null, array('class' => 'form-control', 'id' => 'franchisee_id', 'required')) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.title') }}:</label>
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
                              ),'1', ['class' => 'form-control']) }}
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
                       {{ Form::select('country_id', $countries, isset($entry->country_id) ? $entry->country_id : null, array('class' => 'form-control', 'id' => 'country_id', 'required')) }}
                       @elseif ($mode == 'edit')
                       {{ Form::select('country_id', $countries, isset($entry->country_id) ? $entry->country_id : $preselected_country_id, array('class' => 'form-control', 'id' => 'country_id', 'required')) }}
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
                         {{ Form::text('membership_from', isset($entry->membership_from) ? $entry->membership_from : null, ['class' => 'form-control', 'data-inputmask' => '99999']) }}
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
                         <label>{{ Lang::get('client.mailing_title') }}:</label>
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
                        <div class="form-group">
                          <label>{{ Lang::get('client.country') }}:</label>
                           @if ($mode == 'add')
                       {{ Form::select('mailing_country', $countries, isset($entry->mailing_country) ? $entry->mailing_country : null, array('class' => 'form-control', 'id' => 'mailing_country', 'required')) }}
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
            <!-- THIS IS ADD EVENENT BOX -->
            <div class="col-md-4">
              <div class="box box-black">
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
                       @if ($mode == 'add')
                            {{ Form::select('event', array(
                              '1'=>'Towed',
                              '2'=>'Gas',
                              '3'=>'Engine',
                              '4'=>'Other',
                              ),'1', ['class' => 'form-control']) }}
                        @elseif ($mode == 'edit')
                          @if ($entry->event == '1')
                              {{ Form::select('event', array(
                             '1'=>'Towed',
                              '2'=>'Gas',
                              '3'=>'Engine',
                              '4'=>'Other',
                              ),'1', ['class' => 'form-control']) }}
                          @elseif ($entry->event == '2')
                              {{ Form::select('event', array(
                            '1'=>'Towed',
                              '2'=>'Gas',
                              '3'=>'Engine',
                              '4'=>'Other',
                              ),'2',['class' => 'form-control']) }}
                          @elseif ($entry->event == '3')
                              {{ Form::select('event', array(
                             '1'=>'Towed',
                              '2'=>'Gas',
                              '3'=>'Engine',
                              '4'=>'Other',
                              ),'3',['class' => 'form-control']) }}
                          @elseif ($entry->event == '4')
                              {{ Form::select('event', array(
                             '1'=>'Towed',
                              '2'=>'Gas',
                              '3'=>'Engine',
                              '4'=>'Other',
                              ),'4',['class' => 'form-control']) }}
                          @endif
                        @endif
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

                            <script type="text/javascript">
                              $('select').select2();
                            </script>
                            <script type="text/javascript">
                            $('.inputmask').inputmask({
                            mask: '999-99-999-9999-9'
                            })
                            </script>
