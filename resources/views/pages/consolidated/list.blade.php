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
					<h1>Consolidated Reports</h1>
				</div>
			
				<div class="ibox-content">
					<!-- <a href="{{ url('reports/new')}}" class="btn btn-primary"><i class="icon-plus"></i> New Report</a><br /><br /> -->
					@if (Session::has('success'))
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{{ Session::get('success') }}</p>
						</div>
					@endif

					<table class="table table-hover no-margins">
						<thead>
							<tr>
								<th>Generated By</th>
								<th>Report</th>
								<th>Date Added</th>
								<th>Date Updated</th>
								<th>Action(s)</th>
							</tr>
						</thead>
						<tbody>
							@if ( count($records) > 0 )
								@foreach( $records as $record )
								<tr>
									<td>{{ $record->generated_by }}</td>
									<td>{{ $record->incident_report }}</td>
									<td>{{ $record->created_at }}</td>
									<td>{{ $record->updated_at }}</td>
									<td>
										<a href="{{ url('consolidated/view', [$record->consolidated_id])}}" class="btn btn-white btn-xs"><i class="fa fa-folder"></i> [View] </a>
									
										<a class="btn btn-white btn-xs" href="#" data-toggle="modal" data-target="#confirmDelete{{$record->consolidated_id}}"><i class="fa fa-times-circle"></i> Delete </a>
										<a class="btn btn-white btn-xs" href="{{ url('consolidated/download/'.$record->consolidated_id) }}"><i class="fa fa-download"></i> Download </a>
										<!--<a class="btn btn-white btn-xs" href="#"><i class="fa fa-download"></i> Download </a>-->
										
										<div class="modal fade" id="confirmDelete{{$record->consolidated_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														DELETE <strong>{{ $record->incident_name }}</strong>
													</div>
													<div class="modal-body">
														Are you sure you want to DELETE this record?
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														<a class="btn btn-danger btn-ok" href="{{ url('consolidated/delete', [$record->consolidated_id])}}">Delete</a>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							@else
								<tr><td colspan="5">No record/s found</td></tr>
							@endif
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
<div class="clearfix"></div>
@endsection