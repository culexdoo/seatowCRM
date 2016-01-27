
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ Lang::get('messages_msg.read_mail') }}
      </h1>
     
    </section>
     
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
         <a href="messages_send.html" class="btn btn-primary btn-block margin-bottom">{{ Lang::get('messages_msg.compose') }}</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{ Lang::get('messages_msg.folders') }}</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ URL::route('InboxMessages') }}"><i classs="fa fa-inbox"></i>{{ Lang::get('messages_msg.inbox') }}
                  <span class="label label-primary pull-right">{{ $countedunreadmessages['countedunreadmessages'] }}</span></a></li>
                <li><a href="{{ URL::route('SentMessages') }}"><i class="fa fa-envelope-o"></i>{{ Lang::get('messages_msg.sent') }}
                <span class="label label-primary pull-right">{{ $countedsentmessages['countedsentmessages'] }}</span></a></li>
                <li><a href="{{ URL::route('TrashMessages') }}"><i class="fa fa-trash-o"></i> {{ Lang::get('messages_msg.trash') }}
                <span class="label label-primary pull-right">{{ $counteddeletedmessages['counteddeletedmessages'] }}</span></a></li>
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
              <h3 class="box-title">{{ Lang::get('messages_msg.read_mail') }}</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>Message {{ $message['message']->subject }}</h3>
                <h5>From: {{ $message['message']->sender_first_name }} {{ $message['message']->sender_last_name }}
                  <span class="mailbox-read-time pull-right">{{ $message['message']->created_at }}</span></h5>
              </div>
            
              <div class="mailbox-read-message">

                <p>{{ $message['message']->message }}</p>

              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
     
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <a href="{{ URL::route('SingleViewReplyAdd', array('id' => $message['message']->sender)) }}"><span class="btn btn-default"><i class="fa fa-share"></i> {{ Lang::get('messages_msg.reply') }}</span></a>
              </div>
             
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
