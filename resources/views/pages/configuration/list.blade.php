@extends('main')

@section('content')

	<div class="col-lg-10">
		<h2>Configuration</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a>Configuration</a>
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
					<h5>Report Configuration</h5>
				</div>
			
				<div class="ibox-content">
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
								<th>Configuration Name</th>
								<th>Date Added</th>
								<th>Date Updated</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $records as $record )
							<tr>
								<td>{{ $record->id }}</td>
								<td>{{ $record->configuration_name }}</td>
								<td>{{ $record->created_at }}</td>
								<td>{{ $record->updated_at }}</td>
								<td>
									<a href="{{ url('configuration/view', [$record->id])}}" class="btn btn-white btn-xs"><i class="fa fa-folder"></i> View </a>
									<a class="btn btn-white btn-xs" href="{{ url('configuration/delete', [$record->id])}}"><i class="fa fa-times-circle"></i> Delete </a>
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