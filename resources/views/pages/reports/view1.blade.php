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
				<strong>Report</strong>
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
					<h2>Reports - {{ $report->incident_name }}</h2>
				</div>
			
				<div class="ibox-content">
					<a href="{{ url('reports/list')}}" class="btn btn-primary pull-right">Return</a>
					<div class="clearfix"></div>
					
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
					@if ( count($incidentErrors) > 0 )
						<div class="alert alert-dismissible alert-warning">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{!! Session::get('incident_warning') !!}</p>
							
								@foreach ( $incidentErrors as $currentError )
									<p>{{$currentError}}</p>
								@endforeach
							
						</div>
					@endif
					
					
					<div>

						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#viewInfo" aria-controls="viewInfo" role="tab" data-toggle="tab">Report Info</a></li>
							<li role="presentation"><a href="#updateFiles" aria-controls="updateFiles" role="tab" data-toggle="tab">Add/Update Files</a></li>
							<!--<li role="presentation"><a href="#consolidatedFiles" aria-controls="consolidatedFiles" role="tab" data-toggle="tab">Consolidated Report</a></li>-->
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="viewInfo">
								@include('pages.reports.report_inside.view_info')
								@include('pages.reports.report_inside.view_files')
							</div>
							<div role="tabpanel" class="tab-pane" id="updateFiles">
								@include('pages.reports.report_inside.update_files')
							</div>
							<!--<div role="tabpanel" class="tab-pane" id="consolidatedFiles">
								@include('pages.reports.report_inside.consolidated_reports')
							</div>-->
						</div>

					</div>
					
					<div class="clearfix"></div>
				</div><!--/.ibox-content-->
			</div><!--/.ibox float-e-margins-->
		</div><!--Col-lg-12-->
	</div><!--Row-->
</div><!--Wrapper-->
<div class="clearfix"></div>
@endsection

@section('footer_scripts')
<script>
	$('#crud-form-addupdatefile').validate();
	$('.sheetContents').DataTable();
	
		// dropzone
		Dropzone.autoDiscover = false;

		Dropzone.options.myAwesomeDropzone = {
			paramName: "report", 
			maxFilesize: 50, // MB
			parallelUploads: 1, //limits number of files processed to reduce stress on server
			addRemoveLinks: true,
			maxFiles:1,
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
					var allfiles = $('#uploadedfile');
					allfiles.val(obj.filename);
				}
			}
		};

		// Manually init dropzone on our element.
		var myAwesomeDropzone = new Dropzone("#my-awesome-dropzone", {
			url: "{{ url('reports/upload') }}"
		});
		
		// fancybox
		$(".fancybox").fancybox();
		
		// download link
		var downloadFile = $('.download-excel');
		downloadFile.on('click.downloadFile', function () {
			var download = $(this).attr('data-download');
			window.location = download;
			
			return false;
		});
</script>
@endsection