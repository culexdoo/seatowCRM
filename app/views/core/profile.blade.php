 
          <section class="content-header">
               <div class="row">
                  <div class="col-md-9">
                   <h3>
                 	 Korisničke postavke
                   </h3>
                  </div> 
               </div>
            </section>
             <section class="content"> 
				<div class="row">
			 		<div class="col-xs-12 col-lg-6">
						{{ Form::open(array('route' => 'postProfile', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
			 

							<div class="form-group" style="margin-bottom: 5px;">
								<label for="email">E-mail adresa:*</label>
									{{ Form::email('email', $user->email, array('id' => 'email', 'class' => 'form-control')) }} 
									@if (isset($errors) && ($errors->first('email') != '' || $errors->first('email') != null))
									<p><small class="error">{{ $errors->first('email') }}</small></p>
									@endif
							</div>
			   
							<div class="form-group">
								<label for="first_name">Ime:*</label>
									{{ Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control')) }}
									@if (isset($errors) && ($errors->first('first_name') != '' || $errors->first('first_name') != null))
									<p><small class="error">{{ $errors->first('first_name') }}</small></p>
									@endif
						    </div>
							 

							<div class="form-group"> 
								<label for="last_name">Prezime:*</label>
									{{ Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control')) }}
									@if (isset($errors) && ($errors->first('last_name') != '' || $errors->first('last_name') != null))
									<p><small class="error">{{ $errors->first('last_name') }}</small></p>
									@endif
							</div>
			   

							<div class="form-group">
								<label for="old_password">Stara lozinka:</label>
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
								<label for="new_password">Nova lozinka:</label>
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
								<label for="repeat_new_password" style="padding-top: 0;">Nova lozinka ponovo:</label>
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

						{{ Form::close() }}
					</div>
				</div>
			</section>

