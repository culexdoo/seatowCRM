<div class="register-box">
	      <div class="register-logo">
	         <a href="{{ URL::route('getFrontendLanding') }}"><b>{{ Lang::get('core.app_title') }}</b></a>
	      </div>

	      <div class="register-box-body">
  			<p class="login-box-msg">Register a new membership</p>
	      	{{ Form::open(array('route' => 'postRegister', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-container')) }}

				<div class="form-group has-feedback">
					<label for="first_name">{{ Lang::get('register.label_first_name') }}</label>
					{{ Form::text('first_name', null, array('id' => 'first_name', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('first_name') != '' || $errors->first('first_name') != null))
					<p><small>{{ $errors->first('first_name') }}</small></p>
					@endif
				</div>

				<div class="form-group has-feedback">
					<label for="last_name">{{ Lang::get('register.label_last_name') }}</label>
					{{ Form::text('last_name', null, array('id' => 'last_name', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('last_name') != '' || $errors->first('last_name') != null))
					<p><small>{{ $errors->first('last_name') }}</small></p>
					@endif
				</div>
				<div class="form-group has-feedback">
					<label for="email">{{ Lang::get('register.label_email') }}:</label>
					{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'required', 'autofocus')) }}
					@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
					<p><small>{{ $errors->first('email') }}</small></p>
					@endif
				</div>  
	          <div class="form-group has-feedback">
					<label for="password">{{ Lang::get('register.label_password') }}</label>
					{{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('password') != '' || $errors->first('password') != null))
					<p><small>{{ $errors->first('password') }}</small></p>
					@endif
			 </div>

			 <div class="form-group has-feedback">
					<label for="repeat_password">{{ Lang::get('register.label_repeat_password') }}</label>
					{{ Form::password('repeat_password', array('id' => 'repeat_password', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('repeat_password') != '' || $errors->first('repeat_password') != null))
					<p><small>{{ $errors->first('repeat_password') }}</small></p>
					@endif
			 </div>
	          <div class="row">
	            <div class="col-xs-8">
	              
	            </div><!-- /.col -->
	            <div class="col-xs-4">
	              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
	            </div><!-- /.col -->
	          </div>
			{{ Form::close() }}
	        <a href="{{ URL::route('getSignIn') }}" class="text-center">I already have a membership</a>
	      </div><!-- /.form-box -->
    </div>