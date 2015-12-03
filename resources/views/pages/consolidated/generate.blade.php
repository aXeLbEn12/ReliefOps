@extends('main')

@section('content')


	<div class="col-lg-10">
		<h2>Consolidated Reports</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a>Consolidated Reports</a>
			</li>
			<li class="active">
				<strong>Generate</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div><!--Opening div located at main.blade.php-->


<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h2>Generate Consolidated Reports</h2>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('consolidated')}}" class="btn btn-primary pull-right">Return</a>
					<div class="clearfix"></div>
					
					@if (Session::has('success'))
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{{ Session::get('success') }}</p>
						</div>
					@endif
					@if(Session::has('error'))
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{!! Session::get('error') !!}</p>
						</div>
					@endif

					
					
					<div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Please choose Report to consolidate:</label>
									<select name="report_id" id="report_id" required class="form-control">
										<option value="">
											--- Please select a Report ---
										</option>
										@foreach ( $reports as $currentReport )
										<option value="{{ $currentReport->report_id }}"
											@if ( isset($report->report_id) && $currentReport->report_id == $report->report_id )
												selected="selected"
											@endif
										>
											{{ $currentReport->incident_name }} - Incident # {{ $currentReport->incident_number }}
										</option>
										@endforeach
									</select>
								</div> <!-- form-group end -->
							</div>
						</div>
						<hr />
						
						@if ( count($report_files) > 0 )
						<div class="row">
							<div class="col-md-12">
							@include('pages.consolidated.view_files')
							</div>
						</div>
						@endif
						

					</div>
					
					<div class="clearfix"></div>
				</div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
<div class="clearfix"></div>
@endsection

@section('footer_scripts')
<script>
	var report_id = $('#report_id');
	report_id.on('change.report_id', function () {
		var currentReportId = $(this).val();
		window.location = "{{ url('consolidated/generate') }}/"+currentReportId;
	});
</script>
@endsection