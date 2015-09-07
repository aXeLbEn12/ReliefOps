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
				<strong>Report List</strong>
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
					<h5>Preparedness Response Reports</h5>
				</div>
			
				<div class="ibox-content">
					<!-- <a href="{{ url('preparedness_response/new')}}" class="btn btn-primary"><i class="icon-plus"></i> New Report</a><br /><br /> -->
					@if (Session::has('success'))
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{{ Session::get('success') }}</p>
						</div>
					@endif

					<table class="table table-hover no-margins">
						<thead>
							<tr>
								<th>ID</th>
								<th>Report Name</th>
								<th>File</th>
								<th>Date Added</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $records as $record )
							<tr>
								<td>{{ $record->report_id }}</td>
								<td>{{ $record->report_oldname }}</td>
								<td>
									<!--<a href="#">-->
									{{ $record->report_filename }}
									<!--</a>-->
								</td>
								<td>{{ $record->created_at }}</td>
								<td>
									<a href="{{ url('preparedness_response/view', [$record->report_id])}}" class="btn btn-white btn-xs"><i class="fa fa-folder"></i> View </a>
									<a class="btn btn-white btn-xs" href="{{ url('preparedness_response/delete', [$record->report_id])}}"><i class="fa fa-times-circle"></i> Delete </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="pagination-holder">
						<?php echo $records->render(); ?>
					</div>
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->

@endsection