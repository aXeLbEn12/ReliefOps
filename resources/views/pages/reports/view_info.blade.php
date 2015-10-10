<div class="row">
	<div class="col-md-12">
		<h2>Report Info</h2>
	</div>
	
	{!! Form::open(array('url'=>'reports/update_report/'.$report->report_id,'method'=>'POST', 'files'=>true, 'class'=>'')) !!}
	<div class="col-md-6">
		<div class="form-group">
			<label>Incident Name:</label>
			<input id="incident_name" name="incident_name" class="form-control" value="{{ $report->incident_name }}" placeholder="Incident Name" required />
		</div> <!-- form-group end -->

		<div class="form-group">
			<label>Incident Number:</label>
			<input id="incident_number" name="incident_number" class="form-control" value="{{ $report->incident_number }}" placeholder="Incident Number" required />
		</div> <!-- form-group end -->
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Incident Date:</label>
			<input id="report_date" name="report_date" class="form-control" value="{{ $report->report_date }}" placeholder="Incident Date" required />
		</div> <!-- form-group end -->
		<div class="form-group">
			<label>Configuration:</label>
			<select name="config_id" id="config_id" required class="form-control" disabled="disabled">
				<option value="">
					--- Please select a Configuration ---
				</option>
				@foreach ( $config_list as $config )
				<option value="{{ $config->config_id }}"
					@if ( $config->config_id == $report->config_id )
						selected="selected"
					@endif
				>
					{{ $config->configuration_name }}
				</option>
				@endforeach
			</select>
		</div> <!-- form-group end -->
		
		<div class="pull-right">
			<input type="hidden" name="report_id" id="report_id" value="{{ $report->report_id }}" />
			<input name="submit" type="submit" class="btn btn-primary" id="submit" value="Save" />
		</div>
	</div>
	{!! Form::close() !!}
</div>