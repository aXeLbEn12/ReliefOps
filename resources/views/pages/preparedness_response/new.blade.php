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
					{!! Form::open(array('url'=>'preparedness_response/upload','method'=>'POST', 'files'=>true, 'class'=>'dropzone', 'enctype'=>'multipart/form-data', 'id'=>'my-awesome-dropzone')) !!}
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

@section('footer_scripts')
<script>
	$(document).ready(function(){
		Dropzone.autoDiscover = false;

		Dropzone.options.myAwesomeDropzone = {
			paramName: "report", 
			maxFilesize: 10, // MB
			parallelUploads: 2, //limits number of files processed to reduce stress on server
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
			}
		};

		// Manually init dropzone on our element.
		var myAwesomeDropzone = new Dropzone("#my-awesome-dropzone", {
			url: "{{ url('preparedness_response/upload') }}"
		});

	});
</script>
@endsection