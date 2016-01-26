
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          {{ $title or null }}
          </h1>

        </section>
        <section class="content">
          <div class="row">
            <div class="col-md-3">
             
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">


                <li><a href="{{ URL::route('InboxMessages') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">24</span></a></li>
                <li><a href="messages-sent.html"><i class="fa fa-envelope-o"></i> Sent<span class="label label-primary pull-right">2</span></a></a>
                </li>
                <li><a href="messages-drafts.html"><i class="fa fa-file-text-o"></i> Drafts<span class="label label-primary pull-right">0</span></a></a></li>
                <li><a href="messages-trash.html"><i class="fa fa-trash-o"></i> Trash<span class="label label-primary pull-right">2</span></a></a></li>
              </ul>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /. box -->
              
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>

                </div>
                  {{ Form::open(array('route' => $postRoute, 'role' => 'form', 'autocomplete' => 'off', 'files' => false)) }}
                <!-- /.box-header -->
                {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
                <div class="box-body">
                 <div class="form-group">
                 {{ Lang::get('messages.send_to') }}
                 {{ Form::select('reciever', $entries, isset($entry->reciever) ? $entry->reciever : null, array('class' => 'form-control', 'id' => 'reciever', 'required')) }}
                 </div>
                  
                  <div class="form-group">
                  {{ Lang::get('messages.subject') }}
                     {{ Form::text('subject', isset($entry->subject) ? $entry->subject : null, ['class' => 'form-control']) }}
                  </div>
                  {{ Lang::get('messages.message') }}
                  {{ Form::textarea('message', isset($entry->message) ? $entry->message : null, array('class' => 'form-control message','id' => 'message')) }}
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-black">
                <div class="pull-right">
                 {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('client.send'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
                </div>
              </div>
              <!-- /.box-footer -->
            </div>
            {{ Form::close() }}
          </div>
        </section>
