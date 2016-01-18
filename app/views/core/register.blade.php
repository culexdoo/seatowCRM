{{-- CityHub - Register --}}

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 form-carrier">

			{{ Form::open(array('route' => 'postRegister', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-container')) }}

				<div class="form-group text-center">
					<h2>{{ Lang::get('register.title') }}</h2>
				</div>
				
				<div class="form-group text-center sign-in-logo">
					<a href="{{ URL::route('getHome') }}"><img src="{{ URL::asset('img/core/logo.svg') }}" alt="{{ Lang::get('core.cityhub') }}"></a>
				</div>

				<div class="form-group">
					<label for="email">{{ Lang::get('register.label_email') }}:</label>
					{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'required', 'autofocus')) }}
					@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
					<p><small>{{ $errors->first('email') }}</small></p>
					@endif
				</div>
				
				<div class="form-group">
					<label for="password">{{ Lang::get('register.label_password') }}</label>
					{{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('password') != '' || $errors->first('password') != null))
					<p><small>{{ $errors->first('password') }}</small></p>
					@endif
				</div>

				<div class="form-group">
					<label for="repeat_password">{{ Lang::get('register.label_repeat_password') }}</label>
					{{ Form::password('repeat_password', array('id' => 'repeat_password', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('repeat_password') != '' || $errors->first('repeat_password') != null))
					<p><small>{{ $errors->first('repeat_password') }}</small></p>
					@endif
				</div>

				<hr>

				<div class="form-group">
					<label for="first_name">{{ Lang::get('register.label_first_name') }}</label>
					{{ Form::text('first_name', null, array('id' => 'first_name', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('first_name') != '' || $errors->first('first_name') != null))
					<p><small>{{ $errors->first('first_name') }}</small></p>
					@endif
				</div>

				<div class="form-group">
					<label for="last_name">{{ Lang::get('register.label_last_name') }}</label>
					{{ Form::text('last_name', null, array('id' => 'last_name', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('last_name') != '' || $errors->first('last_name') != null))
					<p><small>{{ $errors->first('last_name') }}</small></p>
					@endif
				</div>

				<hr>

				<div class="form-group">
					<label for="language">{{ Lang::get('register.label_language') }}</label>
					{{ Form::select('language', $languages, null, array('id' => 'language', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('language') != '' || $errors->first('language') != null))
					<p><small>{{ $errors->first('language') }}</small></p>
					@endif
				</div>

				<hr>

				<div class="form-group">
					<p class="text-center"><a href="{{ URL::route('getSignIn') }}">{{ Lang::get('register.already_have_account') }}</a></p>
				</div>
				
				<div class="form-group">
					<p class="text-center">{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('register.submit_button'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}</p>
				</div>

				<hr>

				<div class="form-group text-center mt10 mb10">
					<a href="{{ URL::route('getConnectFacebook') }}" class="btn btn-sm btn-primary">{{ Lang::get('register.connect_via_facebook') }}</a>
				</div>

				<div class="form-group text-center mt10 mb10">
					<a href="{{ URL::route('getConnectGoogle') }}" class="btn btn-sm btn-danger">{{ Lang::get('register.connect_via_google') }}</a>
				</div>
				
			{{ Form::close() }}

		</div>
	</div>
</div>
