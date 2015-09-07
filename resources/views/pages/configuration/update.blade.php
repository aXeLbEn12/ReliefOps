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
					<h5>Report Dropzone Area</h5>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			
				<div class="ibox-content">
					{!! Form::open(array('url'=>'configuration/update/'.$config->id,'method'=>'POST', 'files'=>true, 'class'=>'', 'enctype'=>'multipart/form-data', 'id'=>'crud-form')) !!}
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
							<label>Configuration Name:</label>
							<input type="text" id="configuration_name" name="configuration_name" class="form-control" required placeholder="Configuration Name" value="{{ $config->configuration_name }}" />
						</div> <!-- form-group end -->
						
						<div class="form-group">
							<label>Data Table Row Number:</label>
							<input type="text" id="data_table" name="data_table" class="form-control" placeholder="Data Table" value="{{ $config->data_table }}" />
						</div> <!-- form-group end -->
						
						<div>
							<label>Excel Info:</label>
							<div class="cell-info-config">
								@foreach( $config_string as $string )
									<label class="col-xs-3">Cell: </label>
									<div class="col-xs-4">
										<input type="text" name="config[]" class="col-xs-3 form-control" placeholder="Label" value="{{ $string->config_name }}" />
									</div>
									<div class="col-xs-2">
										<input type="text" name="column[]" class="form-control config-column" placeholder="Column" value="{{ $string->column }}" />
									</div>
									<div class="col-xs-2">
										<input type="text" name="row[]" class=" form-control config-row" placeholder="Row" value="{{ $string->row }}" />
									</div>
								@endforeach
							</div>
							<div class="clearfix"></div>
							<div>
								<a href="#" class="btn btn-white btn-xs add-cell-config">
								Add
								</a>
							</div>
						</div>
						
						<input type="hidden" id="id" name="id" value="{{ $config->id }}" />
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