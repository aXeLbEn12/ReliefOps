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
				<strong>New</strong>
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
					<h1>Report Configuration</h1>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			
				<div class="ibox-content">
					{!! Form::open(array('url'=>'configuration/store','method'=>'POST', 'files'=>true, 'class'=>'', 'enctype'=>'multipart/form-data', 'id'=>'crud-form')) !!}
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
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Configuration Name:</label>
									<input type="text" id="configuration_name" name="configuration_name" class="form-control" required placeholder="Configuration Name" />
								</div> <!-- form-group end -->
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Status:</label>
									<select name="status" id="status" class="form-control">
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
								</div> <!-- form-group end -->
							</div>
						</div>
						
						<hr />
						
						
						<a href="#" id="btnAddSheet" role="button" class="btn btn-default">Add Sheet</a>
						
						<ul id="sheetTab" class="nav nav-tabs">
							<li class="active"><a href="#sheet1" data-toggle="tab">Sheet 1</a></li>
						</ul>
						<div id="sheetTabContent" class="tab-content">
							<div class="tab-pane active spreadsheet" id="sheet1">
								<h3>Sheet 1</h3>
								
								<div class="form-group">
									<label>Sheet Name:</label>
									<input type="text" name="sheet_name[sheet1]" class="form-control" placeholder="Sheet Name" />
								</div> <!-- form-group end -->
								
								<div class="form-group">
									<label>Data Table Columns:</label>
									<input type="text" name="data_table_columns[sheet1]" class="form-control" placeholder="Data Table Columns" />
								</div> <!-- form-group end -->
								
								<div class="form-group">
									<label>Data Table Range:</label>
									<input type="text" id="data_table" name="data_table[sheet1]" class="form-control" placeholder="Data Table Range" />
								</div> <!-- form-group end -->
								
								<div>
									<label>Excel Info:</label>
									<div class="cell-info-config">
										
									</div>
									<div class="clearfix"></div>
									<div>
										<a href="#" class="btn btn-white btn-xs add-cell-config">
										Add
										</a>
									</div>
								</div>
							</div>
						</div>
						
						<hr />
						
						<input type="hidden" id="spreadsheet_count" name="spreadsheet_count" value="1" />
						<button type="submit" class="btn btn-primary pull-right">Submit this report</button>
						<div class="clearfix"></div>
					{!! Form::close() !!}
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->

@endsection


@section('footer_scripts')
<script src="{{ URL::asset('assets/dist/js/pages/configuration/new.js') }}"></script>
@endsection