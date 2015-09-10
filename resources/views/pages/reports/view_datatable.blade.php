@extends('main')

@section('content')


	<div class="col-lg-10">
		<h2>Reports</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a>Reports</a>
			</li>
			<li class="active">
				<strong>Report</strong>
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
					<h2>Reports - {{ $report->incident_name }}</h2>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('reports/list')}}" class="btn btn-primary pull-right">Return</a>
					
					<div class="row">
						<div class="col-md-12">
							<p>Incident Name: <strong>{{ $report->incident_name }}</strong></p>
							<p>Incident Number: <strong>{{ $report->incident_number }}</strong></p>
							<p>Incident Date: <strong>{{ $report->report_date }}</strong></p>
						</div>
					</div>
					
					@if ( count($config_string) > 0 )
					<h3>Report Info</h3>
						@foreach( $config_string as $config )
							<strong>{{ $config->config_name }}: </strong>{{ $config->cell_value }}<br />
						@endforeach
					@endif
					
					@if ( count($data_table) > 0 )
						<br /><br /><br />
						<h3>Report Data Table</h3>
						
						<div class="datatable_container">
							<table class="table table-hover no-margins table-bordered" id="ReportDataTable">
								<thead>
									@foreach ($data_table_columns as $data_table_columns)
									<tr>
										@foreach( $data_table_columns as $values )
										<td>{{ $values }}</td>
										@endforeach
									</tr>
									@endforeach
								</thead>
								<tbody>
									@foreach ($data_table as $data_values)
									<tr>
										@foreach( $data_values as $values )
										<td>{{ $values }}</td>
										@endforeach
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
				</div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
<div class="clearfix"></div>
@endsection

@section('footer_scripts')
<script>
	$('#ReportDataTable').DataTable();
</script>
@endsection