{{-- CityHub - Add / edit user --}}

<?php

// If no mode is selected, default to add
if (!isset($mode))
{
	$mode = 'add';
}

?>
<div class="container">
	<div class="row mt30">
		<div class="col-xs-12">
			{{ Form::open(array('route' => $postRoute, 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'user-form')) }}

				<div class="form-group">
					<div class="col-xs-12">
						<h2>{{ $title }}</h2>
						<hr class="mt30">
					</div>
				</div>

				@if ($mode == 'edit')
				{{ Form::hidden('id', $user->id, array('id' => 'id')) }}
				@endif

				<div class="form-group">
					<div class="col-xs-12 col-sm-6">
						<div class="row">
							<label for="email" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_email') }}:*</label>
							<div class="col-xs-12 col-sm-8 col-md-9">
								{{ Form::text('email', isset($user->email) ? $user->email : null, array('id' => 'email', 'class' => 'form-control')) }}
								@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
								<p><small class="error">{{ $errors->first('email') }}</small></p>
								@endif
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="row">
							<label for="password" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ ($mode == 'add') ? Lang::get('user.label_password') : Lang::get('user.label_new_password') }}:*</label>
							<div class="col-xs-12 col-sm-8 col-md-9">
							@if ($mode == 'add')
								{{ Form::password('password', array('id' => 'password', 'class' => 'form-control')) }}
							@else
								{{ Form::password('password', array('id' => 'password', 'class' => 'form-control')) }}
							@endif
							@if (isset($errors) && ($errors->first('password') != '' || $errors->first('password') != null))
								<p><small class="error">{{ $errors->first('password') }}</small></p>
							@endif
							</div>
						</div>
					</div>
				</div>

				@if ($superadmin == true)
				<div class="form-group">
					<div class="col-xs-12 col-sm-4">
						<div class="row">
							<label for="email_is_verified" class="col-xs-12 col-sm-6 control-label">{{ Lang::get('user.label_email_is_verified') }}:</label>
							<div class="col-xs-12 col-sm-6">
								<?php
								if (isset($user))
								{
									if ($user->email_is_verified == true)
									{
										$verified_yes = true;
										$verified_no = null;
									}
									else
									{
										$verified_yes = null;
										$verified_no = true;
									}
								}
								else
								{
									$verified_yes = null;
									$verified_no = true;
								}
								?>
								<label class="radio-inline">
									{{ Form::radio('email_is_verified', 0, $verified_no) }} <span class="text-danger">{{ Lang::get('core.no') }}</span>
								</label>
								<label class="radio-inline pl30">
									{{ Form::radio('email_is_verified', 1, $verified_yes) }} <span class="text-success">{{ Lang::get('core.yes') }}</span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="row">
							<label for="is_banned" class="col-xs-12 col-sm-6 control-label">{{ Lang::get('user.label_is_banned') }}:</label>
							<div class="col-xs-12 col-sm-6">
								<?php
								if (isset($user))
								{
									if ($user->is_banned == true)
									{
										$banned_yes = true;
										$banned_no = null;
									}
									else
									{
										$banned_yes = null;
										$banned_no = true;
									}
								}
								else
								{
									$banned_yes = null;
									$banned_no = true;
								}
								?>
								<label class="radio-inline">
									{{ Form::radio('is_banned', 0, $banned_no) }} <span class="text-success">{{ Lang::get('core.no') }}</span>
								</label>
								<label class="radio-inline pl30">
									{{ Form::radio('is_banned', 1, $banned_yes) }} <span class="text-danger">{{ Lang::get('core.yes') }}</span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="row">
							<label for="is_deleted" class="col-xs-12 col-sm-6 control-label">{{ Lang::get('user.label_is_deleted') }}:</label>
							<div class="col-xs-12 col-sm-6">
								<?php
								if (isset($user))
								{
									if ($user->is_deleted == true)
									{
										$deleted_yes = true;
										$deleted_no = null;
									}
									else
									{
										$deleted_yes = null;
										$deleted_no = true;
									}
								}
								else
								{
									$deleted_yes = null;
									$deleted_no = true;
								}
								?>
								<label class="radio-inline">
									{{ Form::radio('is_deleted', 0, $deleted_no) }} <span class="text-success">{{ Lang::get('core.no') }}</span>
								</label>
								<label class="radio-inline pl30">
									{{ Form::radio('is_deleted', 1, $deleted_yes) }} <span class="text-danger">{{ Lang::get('core.yes') }}</span>
								</label>
							</div>
						</div>
					</div>
				</div>

				@endif
				<hr>

				<div class="form-group">
					<label for="first_name" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_first_name') }}:*</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('first_name', isset($user->first_name) ? $user->first_name : null, array('id' => 'first_name', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('first_name') != '' || $errors->first('first_name') != null))
						<p><small class="error">{{ $errors->first('first_name') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group">
					<label for="last_name" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_last_name') }}:*</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('last_name', isset($user->last_name) ? $user->last_name : null, array('id' => 'last_name', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('last_name') != '' || $errors->first('last_name') != null))
						<p><small class="error">{{ $errors->first('last_name') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group">
					<label for="address" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_address') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('address', isset($user->address) ? $user->address : null, array('id' => 'address', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('address') != '' || $errors->first('address') != null))
						<p><small class="error">{{ $errors->first('address') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group">
					<label for="city" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_city') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('city', isset($user->city) ? $user->city : null, array('id' => 'city', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('city') != '' || $errors->first('city') != null))
						<p><small class="error">{{ $errors->first('city') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group">
					<label for="phone" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_phone') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('phone', isset($user->phone) ? $user->phone : null, array('id' => 'phone', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('phone') != '' || $errors->first('phone') != null))
						<p><small class="error">{{ $errors->first('phone') }}</small></p>
					@endif
					</div>
				</div>

				<hr>

				<div class="form-group">
					<label for="job_title" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_job_title') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::text('job_title', isset($user->job_title) ? $user->job_title : null, array('id' => 'job_title', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('job_title') != '' || $errors->first('job_title') != null))
						<p><small class="error">{{ $errors->first('job_title') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group">
					<label for="biography" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_biography') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::textarea('biography', isset($user->biography) ? $user->biography : null, array('id' => 'biography', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('biography') != '' || $errors->first('biography') != null))
						<p><small class="error">{{ $errors->first('biography') }}</small></p>
					@endif
					</div>
				</div>

				<hr>

				@if ($mode == 'edit')
				<div class="form-group">
					<div class="col-xs-12 col-sm-6">
						<p class="no-margin">{{ Lang::get('user.label_facebook_id') }}: <?php if (isset($user->facebook_id)) { ?> <span class="text-success">{{ $user->facebook_id }}</span> <?php } else { ?> <span id="facebookStatus" class="text-danger">{{ Lang::get('core.not_connected') }}</span> <?php } if (isset($user->facebook_id)) { ?><button class="btn btn-sm btn-danger ml20" id="removeFacebook"><span id="facebookLoader"></span> {{ Lang::get('user.remove_facebook') }}</button><?php } ?></p>
					</div>
					<div class="col-xs-12 col-sm-6">
						<p class="no-margin">{{ Lang::get('user.label_google_id') }}: <?php if (isset($user->google_id)) { ?> <span class="text-success">{{ $user->google_id }}</span> <?php } else { ?> <span id="googleStatus" class="text-danger">{{ Lang::get('core.not_connected') }}</span> <?php } if (isset($user->google_id)) { ?><button class="btn btn-sm btn-danger ml20" id="removeGoogle" type="button"><span id="googleLoader"></span>{{ Lang::get('user.remove_google') }}</button><?php } ?></p>
					</div>
				</div>

				<hr>
				@endif

				<div class="form-group">
					<label for="language" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_language') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::select('language', $languages, isset($user->language_id) ? $user->language_id : null, array('id' => 'language', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('language') != '' || $errors->first('language') != null))
						<p><small class="error">{{ $errors->first('language') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group" id="roleSelect">
					<label for="role" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_role') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						{{ Form::select('role', $roles, isset($user->role_id) ? $user->role_id : null, array('id' => 'role', 'class' => 'form-control')) }}
					@if (isset($errors) && ($errors->first('role') != '' || $errors->first('role') != null))
						<p><small class="error">{{ $errors->first('role') }}</small></p>
					@endif
					</div>
				</div>

				<div class="form-group" id="citiesList">
					<label for="cities" class="col-xs-12 col-sm-4 col-md-3 control-label">{{ Lang::get('user.label_active_cities') }}:</label>
					<div class="col-xs-12 col-sm-8 col-md-9">
						<div class="mt10">
						@foreach ($cities as $city)
						<div class="col-xs-4">
							<label class="pr20">{{ Form::checkbox('cities[' . $city['id'] . ']', $city['id'], $city['checked']); }} {{ $city['name'] }}</label>
						</div>
						@endforeach
						</div>
						<div class="col-xs-12">
						<p><small>{{ Lang::get('user.cities_warning') }}</small></p>
					</div>
				</div>
				</div>

				<hr>

				<div class="form-group mt40">
					<div class="col-xs-12 text-right">
						<a href="{{ URL::route('getUsersList') }}" class="btn btn-danger"><span class="icon icon-block"></span> {{ Lang::get('core.cancel') }}</a>
						{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
</div>

<script>
	var lang_city = '{{ Lang::get('core.city') }}';
	var lang_fail = '{{ Lang::get('messages.error_no_cities') }}';
	var lang_loading = '{{ Lang::get('core.loading') }}';
</script>
