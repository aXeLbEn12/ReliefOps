@extends('main')

@section('content')

	<div class="col-lg-10">
		<h2>Reports</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/reports') }}">Reports</a>
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
					<h1>Reports</h1>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			
				<div class="ibox-content">
					{!! Form::open(array('url'=>'reports/savereport','method'=>'POST', 'files'=>true, 'class'=>'dropzone', 'enctype'=>'multipart/form-data', 'id'=>'crudForm')) !!}
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
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Incident Name:</label>
								<input id="incident_name" name="incident_name" class="form-control" value="" placeholder="Incident Name" required />
							</div> <!-- form-group end -->

							<div class="form-group">
								<label>Report Number:</label>
								<input id="incident_number" name="incident_number" class="form-control" value="" placeholder="Report Number" required />
							</div> <!-- form-group end -->
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Report Date:</label>
								<input id="report_date" name="report_date" class="form-control" value="" placeholder="Report Date" required />
							</div> <!-- form-group end -->
							<div class="form-group">
								<label>Configuration:</label>
								<select name="config_id" id="config_id" required class="form-control">
									<option value="">
										--- Please select a Configuration ---
									</option>
									@foreach ( $config_list as $config )
									<option value="{{ $config->config_id }}">
										{{ $config->configuration_name }}
									</option>
									@endforeach
								</select>
							</div> <!-- form-group end -->

						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Upload File</label>
									<p class="errors">{!!$errors->first('image')!!}</p>
									<div class="dropzone dropzone-previews dz-clickable" id="my-awesome-dropzone">
										<div class="dz-message text-center">
										<h1>Drop files here</h1>
										<div class="drop-btn drop-bg">or choose files to upload</div>
										</div>
									</div>				
								</div>
								
								<input type="hidden" name="allfiles" id="allfiles" value="" />
								<input type="submit" name="submit" id="submit" name="Submit" class="btn btn-primary drop-bg pull-right" />
							</div>							
						</div>
						
					{!! Form::close() !!}
					
					<div class="clearfix"></div>
				<div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->

@endsection

@section('footer_scripts')
<script>
	$(document).ready(function(){
		// validation
		$('#crudForm').validate();
		
		// datetimepicker
		$('#report_date').datetimepicker({
				mask:'9999-19-39 29:59:59',
				format:'Y-m-d H:i:s'
		});
		
		// dropzone
		Dropzone.autoDiscover = false;

		Dropzone.options.myAwesomeDropzone = {
			paramName: "report", 
			maxFilesize: 50, // MB
			parallelUploads: 10, //limits number of files processed to reduce stress on server
			addRemoveLinks: true,
			accept: function(file, done) {
			// TODO: Image upload validation
				done();
			},
			sending: function(file, xhr, formData) {
				// Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
				formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
			},
			init: function() {
				this.on("success", function(file, response) {
					//redirect('preparedness_response');
				});
			},
			success: function( file, response ){
				obj = JSON.parse(response);
				if ( obj.filename ) {
					var allfiles = $('#allfiles');
					if ( allfiles.val() == '' ) {
						allfiles.val(obj.filename);
					} else {
						allfiles.val( allfiles.val() + ',' + obj.filename);
					}
				}
			}
		};

		// Manually init dropzone on our element.
		var myAwesomeDropzone = new Dropzone("#my-awesome-dropzone", {
			url: "{{ url('reports/upload') }}"
		});

	});
</script>
@endsection