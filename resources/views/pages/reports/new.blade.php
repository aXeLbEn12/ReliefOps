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
				<strong>Report Upload</strong>
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
					<h5>Report Dropzone Area</h5>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			
				<div class="ibox-content">
					{!! Form::open(array('url'=>'reports/upload','method'=>'POST', 'files'=>true, 'class'=>'dropzone', 'enctype'=>'multipart/form-data', 'id'=>'my-awesome-dropzone')) !!}
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
						
						<div class="form-group">
							<label>Configuration:</label>
							<select name="config_id" id="config_id" required class="form-control">
								@foreach ( $config_list as $config )
								<option value="{{ $config->id }}">
									{{ $config->configuration_name }}
								</option>
								@endforeach
							</select>
						</div> <!-- form-group end -->
						
						<div class="form-group">
							<label>Data Table Row Number:</label>
							<input type="file" name="report" id="report" />
						</div> <!-- form-group end -->
						
						<div class="dropzone-previews"></div>
						<button type="submit" class="btn btn-primary pull-right">Submit this report</button>
						<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
					{!! Form::close() !!}
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->

@endsection

