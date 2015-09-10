@extends('main')

@section('content')

	<div class="col-lg-10">
		<h2>Reports</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/reports') }}">Reports</a>
			</li>
			<li class="active">
				<strong>Report Upload</strong>
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
					<h1>Reports</h1>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			
				<div class="ibox-content">
					{!! Form::open(array('url'=>'reports/upload','method'=>'POST', 'files'=>true, 'class'=>'', 'enctype'=>'multipart/form-data', 'id'=>'crudForm')) !!}
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
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Incident Name:</label>
								<input id="incident_name" name="incident_name" class="form-control" value="" placeholder="Incident Name" required />
							</div> <!-- form-group end -->

							<div class="form-group">
								<label>Incident Number:</label>
								<input id="incident_number" name="incident_number" class="form-control" value="" placeholder="Incident Number" required />
							</div> <!-- form-group end -->
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Incident Date:</label>
								<input id="report_date" name="report_date" class="form-control" value="" placeholder="Incident Date" required />
							</div> <!-- form-group end -->
							<div class="form-group">
								<label>Configuration:</label>
								<select name="config_id" id="config_id" required class="form-control">
									<option value="">
										--- Please select a Configuration ---
									</option>
									@foreach ( $config_list as $config )
									<option value="{{ $config->id }}">
										{{ $config->configuration_name }}
									</option>
									@endforeach
								</select>
							</div> <!-- form-group end -->
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Please upload your report here:</label>
								<input type="file" name="report" id="report" required />
							</div> <!-- form-group end -->
						</div><br />
						
						
						<button type="submit" class="btn btn-primary pull-right">Submit this report</button>
						
					{!! Form::close() !!}
					
					<div class="clearfix"></div>
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->

@endsection



@section('footer_scripts')
<script>
	// validation
	$('#crudForm').validate();
	
	// datetimepicker
	//$('#report_date').datetimepicker();
$('#report_date').datetimepicker({
		mask:'9999-19-39 29:59:59',
		format:'Y-m-d H:i:s'
});
</script>
@endsection