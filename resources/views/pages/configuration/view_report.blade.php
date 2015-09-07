@extends('main')

@section('content')


	<div class="col-lg-10">
		<h2>Preparedness Response</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a>Preparedness Response</a>
			</li>
			<li class="active">
				<strong>Report List { Name of Report Here }</strong>
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
					<h5>Report Name Here</h5>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('preparedness_response/list')}}" class="btn btn-primary pull-right">Return</a>
					<table class="table table-hover no-margins">
						<thead>
							<tr>
								<th>Region Filter</th>
								<th>REGION/ PROVINCE/MUNICIPALITY/CITY</th>
								<th>NHTS-PR, 2011</th>
								<th>NSO Population, 2010</th>
								<th>No. of Pantawid Beneficiaries</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $reportRows as $row )
							<tr>
								<td>{{ $row->regionfilter }}</td>
								<td>{{ $row->region_provincemunicipalitycity }}</td>
								<td>{{ $row->nhts_pr_2011 }}</td>
								<td>{{ $row->nso_population_2010 }}</td>
								<td>{{ $row->no_of_pantawid_beneficiaries }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
@endsection