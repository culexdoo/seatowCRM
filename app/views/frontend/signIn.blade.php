                                       

              <div class="login-box">
                <div class="login-logo">
                  <a href="{{ URL::route('getFrontendLanding') }}"><b>{{ Lang::get('core.app_title') }}</b></a>
                </div><!-- /.login-logo -->
                <div class="login-box-body">
                  <p class="login-box-msg">  Login to your account </p>
                {{ Form::open(array('route' => 'postSignIn', 'autocomplete' => 'on', 'role' => 'form', 'class' => 'form-container')) }}
                    <div class="form-group has-feedback"> 
                    <label for="sign_in_email">Your email:</label>
                      {{ Form::email('sign_in_email', null, array('id' => 'sign_in_email', 'class' => 'form-control', 'required', 'autofocus')) }}
                       <small class="text-danger">{{ $errors->first('sign_in_email') }}</small>
                     </div>
                                        
                    <div class="form-group has-feedback">
                         <label for="sign_in_password">Your password</label>
                        {{ Form::password('sign_in_password', array('id' => 'sign_in_password', 'class' => 'form-control', 'required')) }}
                        <small class="text-danger">{{ $errors->first('sign_in_password') }}</small>
                    </div>
                    <div class="row">
                      <div class="col-xs-8">
                        
                      </div><!-- /.col -->
                      <div class="col-xs-4">
                      {{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.submit'), array('class' => 'btn btn-primary btn-block btn-flat', 'type' => 'submit')) }}
                       
                      </div><!-- /.col -->
                    </div>
                    {{ Form::close() }}

                  <!--<a href="#">I forgot my password</a><br>-->
                  <a href="{{ URL::route('getRegister') }}" class="text-center">Register a new membership</a>

                </div><!-- /.login-box-body -->
              </div><!-- /.login-box -->
             <script>
              $(function () {
                $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' // optional
                });
              });
            </script>