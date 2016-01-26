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

            {{ Form::hidden('employee_first_name', $user->first_name, array('id' => 'employee_first_name')) }}

            {{ Form::hidden('employee_last_name', $user->last_name, array('id' => 'employee_last_name')) }}
           
           {{ Form::hidden('membership_id', $entries['entry']->membership_id, array('id' => 'membership_id')) }}
         


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

                            {{ Form::select('action', array(
                              'membership_service'=>'Membership service',
                              'non_membership_service'=>'NonMembership service',
                              ),'membership_service', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label>{{ Lang::get('client.additional_notes') }}:</label>
                     {{ Form::textarea('additional_note', isset($entry->additional_note) ? $entry->additional_note : null, array('class' => 'form-control additional_note','id' => 'additional_note')) }}
                    </div>
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
