{{-- CityHub - Dashboard (user) --}}

<div class="container">
	<div class="row">
		<h3 class="text-center">{{ Lang::get('dashboard.user_title') }}</h3>
		<hr>
	</div>

	{{-- Communal Service --}}
	@if ($data['communalService']['status'] == 1)
	<div class="row">
		<div class="col-xs-12">
			@if ($data['communalService']['module']->is_active == true)
			<div class="row mb20">
				<div class="col-xs-6">
					<h3>{{ Lang::get($data['communalService']['module']->identifier . '.module_name') }}</h3>
				</div>
				<div class="col-xs-6">
					<div class="text-right">
						<a href="{{ URL::route($data['communalService']['module']->landing_fn) }}" class="btn btn-sm btn-success mt20">{{ Lang::get('dashboard.link_my_reports') }}</a>
					</div>
				</div>
			</div>
				@if ($data['communalServiceData']['status'] == 1)
					@if (count($data['communalServiceData']['reports']) > 0)
			<table class="table table-cityhub">
				<thead>
					<tr>
						<th>{{ Lang::get('communalService.header_id') }}</th>
						<th>{{ Lang::get('communalService.header_date_time') }}</th>
						<th>{{ Lang::get('communalService.header_type') }}</th>
						<th>{{ Lang::get('communalService.header_priority') }}</th>
						<th>{{ Lang::get('communalService.header_description') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($data['communalServiceData']['reports'] as $report)
					<tr>
						<td>{{ $report->id }}</td>
						<td>{{ $report->report_date }}</td>
						<td>{{ $report->type }}, {{ $report->subtype }}</td>
						<td>{{ Lang::get('communalService.' . $report->priority) }}</td>
						<td>{{ $report->report_description }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
					@else
			<div class="bordered-warning">
				<h3 class="text-center mt10 mb10">{{ Lang::get('dashboard.no_communalservice_reports') }}</h3>
			</div>
					@endif
				@else
			<div class="bordered-danger">
				<h3 class="text-center mt10 mb10">{{ Lang::get('dashboard.msg_error_communalservice_data') }}</h3>
			</div>
				@endif
			@else
			<div class="bordered-warning">
				<h3 class="text-center mt10 mb10">{{ Lang::get('dashboard.msg_error_communalservice_inactive') }}</h3>
			</div>
			@endif
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-xs-12">
			<div class="bordered-danger">
				<h3 class="text-center mt10 mb10">{{ Lang::get('dashboard.msg_error_communalservice_data') }}</h3>
			</div>
		</div>
	</div>
	@endif
	{{-- END Communal Service --}}
</div>
