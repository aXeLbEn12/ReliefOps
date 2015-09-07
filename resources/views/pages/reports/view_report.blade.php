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
					<h5>Report</h5>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('reports/list')}}" class="btn btn-primary pull-right">Return</a>
					<h3>Report Info</h3>
					@foreach( $config_string as $config )
						<strong>{{ $config->config_name }}: </strong>{{ $config->cell_value }}<br />
					@endforeach
					
					<br /><br /><br />
					<h3>Report Data Table</h3>
					
					<table class="table table-hover no-margins">
						@foreach ($data_table as $data_values)
						<tr>
							@foreach( $data_values as $values )
							<td>{{ $values }}</td>
							@endforeach
						</tr>
						@endforeach
					</table>
				</div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
@endsection