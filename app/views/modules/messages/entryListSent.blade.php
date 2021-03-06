 <section class="content-header">
          <h1>
         {{ Lang::get('messages_msg.my_messages') }}
          </h1>
          
        </section>
        
    <!-- Content Header (Page header) -->
    {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ URL::route('messagesLanding') }}" class="btn btn-primary btn-block margin-bottom">{{ Lang::get('messages_msg.compose') }}</a>

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
                <li><a href="{{ URL::route('InboxMessages') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $countedunreadmessages['countedunreadmessages'] }}</span></a></li>
                <li class="active"><a href="{{ URL::route('SentMessages') }}"><i class="fa fa-envelope-o"></i> Sent<span class="label label-primary pull-right">{{ $countedsentmessages['countedsentmessages'] }}</span></a></a>
                </li>
                
                <li><a href="{{ URL::route('TrashMessages') }}"><i class="fa fa-trash-o"></i> Trash<span class="label label-primary pull-right">{{ $counteddeletedmessages['counteddeletedmessages'] }}</span></a></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header">
              
             
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
             
              <div class="table-responsive mailbox-messages">
                <table id="messagesTable" class="table">
                
                  <thead>
                  <tr>
                  <th>{{ Lang::get('messages_msg.status') }}:</th>
                  <th>{{ Lang::get('messages_msg.to') }}:</th>
                  <th>{{ Lang::get('messages_msg.subject') }}:</th>
                  <th>{{ Lang::get('messages_msg.messages') }}:</th>
                  <th>Sent:</th>
                  <th class="pull-right">{{ Lang::get('messages_msg.quick_action') }}:</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($entries['entries'] as $message)

                  <tr>
                  <td><b>{{ Lang::get('messages_msg.sent') }}</td>
                    <td>{{ $message->reciever_first_name }} {{ $message->reciever_last_name }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->created_at }}</td>
                    <td> 

                    <span class="label label-danger pull-right">
                    <a class="text-white" href="{{ URL::route('DeleteSingleMessage', array('entries' => $message->id)) }}">
                    {{ Lang::get('messages_msg.delete') }}
                    </a></span>

                    <span class="label label-success pull-right">
                    <a class="text-white" href="{{ URL::route('SingleView', array('entries' => $message->id)) }}">
                    {{ Lang::get('messages_msg.view') }}
                    </a></span>

                    </td>
                    
                    
                    
                  </tr>
                 @endforeach
                 </tbody>
               
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<script>

   

     $(function () {
       $("#messagesTable").DataTable();
      });
  </script>