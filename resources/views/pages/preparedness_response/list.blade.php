@extends('main')

@section('content')
<section class="content-placer col-md-9">
	<div class="header">


		<h1 class="page-title">Reports: Preparedness Reponse</h1>
	</div>
	
	<ul class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li class="active">Preparedness Response</li>
	</ul>
	
	<div id="content-Articles">
		<a href="{{ url('preparedness_response/new')}}" class="btn btn-primary"><i class="icon-plus"></i> New Report</a>
		@if (Session::has('success'))
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<p>{{ Session::get('success') }}</p>
			</div>
		@endif
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Report Name</th>
					<th>File</th>
					<th>Date Added</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $records as $record )
				<tr>
					<td>{{ $record->report_id }}</td>
					<td>{{ $record->report_oldname }}</td>
					<td>
						<a href="#">
						{{ $record->report_filename }}
						</a>
					</td>
					<td>{{ $record->created_at }}</td>
					<td>
						<a href="{{ url('preparedness_response/view', [$record->report_id])}}" class="list-action-btn" title="View User Info"><i class="fa fa-eye"></i> View</a> |
						<a href="{{ url('preparedness_response/delete', [$record->report_id])}}" class="list-action-btn" title="Delete User"><i class="fa fa-trash-o"></i> Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pagination-holder">
			<?php echo $records->render(); ?>
		</div>
	</div>
	
	<div class="clearfix"></div>
</section> <!-- content-cont end -->
@endsection