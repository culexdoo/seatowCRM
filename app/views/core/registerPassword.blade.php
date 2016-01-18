{{-- Register - enter password and language only --}}

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 form-carrier">

			{{ Form::open(array('route' => 'postUpdatePassword', 'autocomplete' => 'off', 'role' => 'form', 'class' => 'form-container')) }}

				<div class="form-group text-center">
					<h2>{{ Lang::get('register.title_update_password') }}</h2>
				</div>
				
				<div class="form-group text-center sign-in-logo">
					<a href="{{ URL::route('getHome') }}"><img src="{{ URL::asset('img/core/logo.svg') }}" alt="{{ Lang::get('core.cityhub') }}"></a>
				</div>

				<div class="form-group">
					<p>{{ Lang::get('register.text_update_password') }}</p>
				</div>
				
				<div class="form-group">
					<label for="password">{{ Lang::get('register.label_password') }}</label>
					{{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'required', 'autofocus')) }}
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
					<label for="language">{{ Lang::get('register.label_language') }}</label>
					{{ Form::select('language', $languages, null, array('id' => 'language', 'class' => 'form-control', 'required')) }}
					@if (isset($errors) && ($errors->first('language') != '' || $errors->first('language') != null))
					<p><small>{{ $errors->first('language') }}</small></p>
					@endif
				</div>

				<hr>
				
				<div class="form-group">
					<p class="text-center">{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('register.submit_button'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}</p>
				</div>
				
			{{ Form::close() }}

		</div>
	</div>
</div>
