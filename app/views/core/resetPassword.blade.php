{{-- CityHub - Reset password --}}

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 form-carrier">

			{{ Form::open(array('route' => 'postResetPassword', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-container')) }}

				{{ Form::hidden('token', $token) }}

				<div class="form-group text-center forgotten-password-logo">
					<a href="{{ URL::route('getHome') }}"><img src="{{ URL::asset('img/core/logo.svg') }}" alt="{{ Lang::get('core.cityhub') }}"></a>
				</div>

				<div class="form-group">
					<p class="text-center">{{ Lang::get('forgotPassword.reset_password_text') }}</p>
				</div>

				<div class="form-group">
					<label for="email">{{ Lang::get('forgotPassword.forgot_password_email') }}:</label>
					{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'required', 'autofocus', 'placeholder' => Lang::get('forgotPassword.forgot_password_email'))) }}
					@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
					<p><small>{{ $errors->first('email') }}</small></p>
					@endif
				</div>

				<div class="form-group">
					<label for="password">{{ Lang::get('forgotPassword.reset_password_new_password') }}:</label>
					{{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'required', 'placeholder' => Lang::get('forgotPassword.reset_password_new_password'))) }}
					@if (isset($errors) && ($errors->first('password') != '' || $errors->first('password') != null))
					<p><small>{{ $errors->first('password') }}</small></p>
					@endif
				</div>

				<div class="form-group">
					<label for="password_confirmation">{{ Lang::get('forgotPassword.reset_password_new_password_confirm') }}:</label>
					{{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'required', 'placeholder' => Lang::get('forgotPassword.reset_password_new_password_confirm'))) }}
					@if (isset($errors) && ($errors->first('password_confirmation') != '' || $errors->first('password_confirmation') != null))
					<p><small>{{ $errors->first('password_confirmation') }}</small></p>
					@endif
				</div>

				<div class="form-group">
					<p class="text-center"><a href="{{ URL::route('getSignIn') }}">{{ Lang::get('forgotPassword.sign_in_link') }}</a></p>
				</div>
				
				<div class="form-group">
					<p class="text-center">{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('forgotPassword.forgot_password_submit'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}</p>
				</div>
				
			{{ Form::close() }}

		</div>
	</div>
</div>
