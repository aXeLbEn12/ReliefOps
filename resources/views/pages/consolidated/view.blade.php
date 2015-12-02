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
				<strong>Consolidated Report List</strong>
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
					<h1>Consolidated Report - {{ $originalReport->incident_name }} Incident #{{ $originalReport->incident_number }}</h1>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('consolidated')}}" class="btn btn-primary pull-right">Return</a>
					<!-- <a href="{{ url('reports/new')}}" class="btn btn-primary"><i class="icon-plus"></i> New Report</a><br /><br /> -->
					@if (Session::has('success'))
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{{ Session::get('success') }}</p>
						</div>
					@endif

					<?php $dataTable = json_decode($version->table_data); ?>
					<table class="table table-hover no-margins">
						<tbody>
							<?php $currentValueHead = ''; ?>
							@foreach ( $dataTable as $currentRow )
								<tr>
									<?php $i = 0; ?>
									@foreach ( $currentRow as $currentCell )
										@if ( $currentCell != '' && $i == 0 )
											<?php $currentValueHead = $currentCell; ?>
										@endif
										@if ( $i == 0 && $currentCell == '' )
											<td>{{ $currentValueHead }}</td>
										@else
											<td>{{ $currentCell }}</td>
										@endif
										
										<?php $i++; ?>
									@endforeach
									
								</tr>
							@endforeach
						</tbody>
					</table>
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
<div class="clearfix"></div>
@endsection