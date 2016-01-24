 
          <section class="content-header">     
	          <h1>
	          My profile<button class="btn btn-success pull-right"> <i class="fa fa-floppy-o"> Save </i></button>
	          </h1>  
          </section>

             <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('core.basic_information') }}</h3>
		                    </div>
		                    <div class="box-body">
										{{ Form::open(array('route' => 'postProfile', 'role' => 'form',  'autocomplete' => 'off')) }}
										<div class="form-group">
											<label for="email">{{ Lang::get('core.email') }}</label>
												{{ Form::email('email', $user->email, array('id' => 'email', 'class' => 'form-control')) }} 
												@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
												<p><small class="error">{{ $errors->first('email') }}</small></p>
												@endif
										</div>
						   
										<div class="form-group">
											<label for="first_name">{{ Lang::get('core.first_name') }}</label>
												{{ Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control')) }}
												@if (isset($errors) && ($errors->first('first_name') != '' || $errors->first('first_name') != null))
												<p><small class="error">{{ $errors->first('first_name') }}</small></p>
												@endif
									    </div>
										 

										<div class="form-group"> 
											<label for="last_name">{{ Lang::get('core.last_name') }}</label>
												{{ Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control')) }}
												@if (isset($errors) && ($errors->first('last_name') != '' || $errors->first('last_name') != null))
												<p><small class="error">{{ $errors->first('last_name') }}</small></p>
												@endif
										</div>
						   

										<div class="form-group">
											<label for="old_password">{{ Lang::get('core.old_password') }}</label>
												{{ Form::password('old_password', array('id' => 'old_password', 'class' => 'form-control')) }}
												<?php
												if(isset($errors))
												{
													foreach ($errors->get('old_password') as $error)
													{
														?>
												<p><small class="error">{{ $error }}</small></p>
														<?php
													}
												}
												?>
									    </div>

										<div class="form-group"> 
											<label for="new_password">{{ Lang::get('core.new_password') }}</label>
												{{ Form::password('new_password', array('id' => 'new_password', 'class' => 'form-control')) }}
												<?php
												if(isset($errors))
												{
													foreach ($errors->get('new_password') as $error)
													{
														?>
												<p><small class="error">{{ $error }}</small></p>
														<?php
													}
												}
												?>
										</div>

										<div class="form-group">
											<label for="repeat_new_password" style="padding-top: 0;">{{ Lang::get('core.repeat_new_password') }}</label>
												{{ Form::password('repeat_new_password', array('id' => 'repeat_new_password', 'class' => 'form-control')) }}
											<?php
											if(isset($errors))
											{
												foreach ($errors->get('repeat_new_password') as $error)
												{
													?>
											<p><small class="error">{{ $error }}</small></p>
													<?php
												}
											}
											?>
										</div>
						 

											<div class="form-group">
												<div class="col-xs-12 text-right">
													<a href="{{ URL::route('getDashboard') }}" class="btn btn-danger"><span class="icon icon-block"></span> Odustani</a>
													{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}

												</div>
											</div>
    					</div>
						{{ Form::close() }}
					</div>
				
				</div>

				</div>
			</section>

