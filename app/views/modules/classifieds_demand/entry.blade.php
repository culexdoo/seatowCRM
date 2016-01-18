 
<?php
// If no mode is selected, default to add
if (!isset($mode))
{
	$mode = 'add';
}

?>
<div class="container-fluid">
	<div class="row mt30 mb20">
		<div class="col-xs-12">
			<h2>{{ $title or null }}</h2>
			<hr class="mt30">
		</div>
	</div>
</div>

<div class="entry-box">

	<div class="row">
		<div class="col-lg-6">
			{{ Form::open(array('route' => $postRoute, 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true)) }}

			{{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
			@if ($mode == 'edit')
			{{ Form::hidden('entry_id', $entry->entry_id, array('entry_id' => 'entry_id')) }}
			@endif

			<div class="form-group">
				 
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="title">Naslov oglasa:</label>  
					{{ Form::text('title', isset($entry->title) ? $entry->title : null, ['class' => 'form-control', 'placeholder' => 'Naslov oglasa']) }}
					<small class="text-danger">{{ $errors->first('title') }}</small>
				</div>
			</div>

		 

			<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12"> 
 					<label for="content">Sadržaj oglasa:</label> 
 					{{ Form::textarea('content', isset($entry->content) ? $entry->content : null, array('class' => 'form-control content', 'placeholder' => 'Sadržaj oglasa','id' => 'content')) }}
					<small class="text-danger">{{ $errors->first('content') }}</small> 
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="category_id">Kategorija:</label>
 					{{ Form::select('category_id', $categories, isset($entry->category_id) ? $entry->category_id : null, array('class' => 'form-control', 'id' => 'category_id', 'required')) }}
					@if (isset($errors) && ($errors->first('category_id') != '' || $errors->first('category_id') != null))
					<p><small>{{ $errors->first('category_id') }}</small></p>
					@endif
				 
			</div>

		 
			<div class="form-group">
				<label for="image">Slika oglasa:</label>
 					{{ Form::file('image', array('class' => 'form-control'))  }}
					@if (isset($errors) && ($errors->first('image') != '' || $errors->first('image') != null))
					<small class="text-danger">{{ $errors->first('image') }}</small>
					@endif
 			</div>

			@if ($mode == 'edit')
			@if ($entry->image != null || $entry->image != '')
			<div class="form-group">
				<label for="image" style="padding-top: 10px;">Trenutna slika:</label>
 					{{ HTML::image(URL::to('/') . '/uploads/modules/classifieddemand/thumbs/' . $entry->image, $entry->title) }}
			</div>
			@endif
			@endif
 
		</div>

		<div class="col-lg-12">
			<div class="form-group text-right clearfix mb0">
				<a href="{{ URL::route('getDashboard') }}" class="btn btn-danger"><span class="icon icon-block"></span> Odustani</a>
				{{ Form::button('<span class="icon icon-done"></span> ' . Lang::get('core.save'), array('type' => 'submit', 'class' => 'btn btn-success')) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
 
 
