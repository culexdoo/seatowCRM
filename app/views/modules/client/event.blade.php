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
