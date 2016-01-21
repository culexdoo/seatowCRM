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
          <a href="{{ URL::route('getDashboard') }}" class="btn btn-danger pull-right"><span class="icon icon-block"></span>{{ Lang::get('membership.cancel') }}</a>

          <a class="pull-right">
          {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('membership.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
          </div>
          </a>

          </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title"> {{ Lang::get('membership.basic_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
               
                  
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ Lang::get('membership.membership_program') }}:</label>
                      {{ Form::text('title', isset($entry->title) ? $entry->title : null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('membership.description') }}:</label>
                      {{ Form::textarea('description', isset($entry->description) ? $entry->description : null, array('class' => 'form-control description','id' => 'description')) }}
          <small class="text-danger">{{ $errors->first('content') }}</small>
                    </div>
                   
                  </div>
               
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('membership.membership_information') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
                  
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputtext">{{ Lang::get('membership.normal_price') }}:</label>
                       {{ Form::text('normal_price', isset($entry->normal_price) ? $entry->normal_price : null, ['class' => 'form-control']) }}
                         <small class="text-danger">{{ $errors->first('normal_price') }}</small>
                    </div>
                    
                     <div class="form-group">
                     <div class="row">
                     <div class="col-md-6">
                      <label>{{ Lang::get('membership.promo_price_1') }}:</label>
                       {{ Form::text('promo_price_1', isset($entry->promo_price_1) ? $entry->promo_price_1 : null, ['class' => 'form-control']) }}
                     
                      </div>
                      <div class="col-md-6">
                       <label>{{ Lang::get('membership.promo_price_2') }}:</label>
                       {{ Form::text('promo_price_2', isset($entry->promo_price_2) ? $entry->promo_price_2 : null, ['class' => 'form-control']) }}
                     
                    </div>
                    </div>
                    </div>
                     <div class="form-group">
                     <div class="row">
                     <div class="col-md-6">
                      <label>{{ Lang::get('membership.promo_period_1_from') }}:</label>
                       {{ Form::text('promo_period_1_from', isset($entry->promo_period_1_from) ? $entry->promo_period_1_from : null, ['class' => 'form-control']) }}
                    
                      </div>
                      <div class="col-md-6">
                        <label>{{ Lang::get('membership.promo_period_2_from') }}:</label>
                       {{ Form::text('promo_period_2_from', isset($entry->promo_period_2_from) ? $entry->promo_period_2_from : null, ['class' => 'form-control']) }}
                    </div>
                    </div>
                     <div class="row">
                     <div class="col-md-6">
                      <label>{{ Lang::get('membership.promo_period_1_to') }}:</label>
                       {{ Form::text('promo_period_1_to', isset($entry->promo_period_1_to) ? $entry->promo_period_1_to : null, ['class' => 'form-control']) }}
                    
                      </div>
                      <div class="col-md-6">
                        <label>{{ Lang::get('membership.promo_period_2_to') }}:</label>
                       {{ Form::text('promo_period_2_to', isset($entry->promo_period_2_to) ? $entry->promo_period_2_to : null, ['class' => 'form-control']) }}
                    </div>
                    </div>
                    </div>
                   
                    
                  </div>
           
              </div>
              
            </div>
            {{ Form::close() }}
            
          </div>
          </section><!-- /.content -->
