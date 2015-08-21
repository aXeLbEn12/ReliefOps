@extends('main')

@section('content')
<section class="content-placer col-md-9">
	<div class="header">


		<h1 class="page-title">Reports: Preparedness Reponse</h1>
	</div>
	
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a></li>
		<li class="active">Preparedness Response</li>
	</ul>
	
	<div id="content-Articles">
		<div class="text-left">
			<a href="{{ url('preparedness_response/list')}}" class="btn btn-primary">Return</a>
		</div>
		<table class="table table-bordered">
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
	</div>
	
	<div class="clearfix"></div>
</section> <!-- content-cont end -->
@endsection