{{-- CityHub - Forgot password --}}

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 form-carrier">

			{{ Form::open(array('route' => 'postForgotPassword', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-container')) }}

				<div class="form-group text-center">
					<h2>{{ Lang::get('forgotPassword.forgot_password_title') }}</h2>
				</div>

				<div class="form-group text-center forgotten-password-logo">
					<a href="{{ URL::route('getHome') }}"><img src="{{ URL::asset('img/core/logo.svg') }}" alt="{{ Lang::get('core.cityhub') }}"></a>
				</div>

				<div class="form-group">
					<p>{{ Lang::get('forgotPassword.forgot_password_text') }}</p>
				</div>

				<div class="form-group">
					<label for="email">{{ Lang::get('forgotPassword.forgot_password_email') }}:</label>
					{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'required', 'autofocus', 'placeholder' => Lang::get('forgotPassword.forgot_password_email'))) }}
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
