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
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Incident Name:</label>
								<input id="incident_name" name="incident_name" class="form-control" value="{{ $report->incident_name }}" placeholder="Incident Name" required />
							</div> <!-- form-group end -->

							<div class="form-group">
								<label>Incident Number:</label>
								<input id="incident_number" name="incident_number" class="form-control" value="{{ $report->incident_number }}" placeholder="Incident Number" required />
							</div> <!-- form-group end -->
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Incident Date:</label>
								<input id="report_date" name="report_date" class="form-control" value="{{ $report->report_date }}" placeholder="Incident Date" required />
							</div> <!-- form-group end -->
							<div class="form-group">
								<label>Configuration:</label>
								<select name="config_id" id="config_id" required class="form-control" disabled="disabled">
									<option value="">
										--- Please select a Configuration ---
									</option>
									@foreach ( $config_list as $config )
									<option value="{{ $config->config_id }}"
										@if ( $config->config_id == $report->config_id )
											selected="selected"
										@endif
									>
										{{ $config->configuration_name }}
									</option>
									@endforeach
								</select>
							</div> <!-- form-group end -->

						</div>
					</div>
					
					<div class="row">
							<h2>Add/Update File</h2>
							{!! Form::open(array('url'=>'reports/addfileversion/'.$report->report_id,'method'=>'POST', 'files'=>true, 'class'=>'', 'enctype'=>'multipart/form-data', 'id'=>'crud-form-addupdatefile')) !!}
							
							<div class="col-md-6">
								<div class="form-group">
									<label>File:</label>
									<div class="dropzone dropzone-previews dz-clickable my-awesome-dropzone" id="my-awesome-dropzone">
										<div class="dz-message text-center">
										<h1>Drop file here</h1>
										<div class="drop-btn drop-bg">or choose file to upload</div>
										</div>
									</div>
									<input type="hidden" name="uploadedfile" class="uploadedfile" id="uploadedfile" value="" />
								</div> <!-- form-group end -->
								<div class="form-group">
									<label>File to Update:</label>
									<select name="file_id" id="file_id" class="form-control" required>
										<option value="new_file"> --- Add new File --- </option>
										<?php $m=1; ?>
										@foreach ( $report_files as $file )
										<option value="{{ $file->file_id }}">
											File {{ $m }}<?php $m++; ?>
										</option>
										@endforeach
									</select>
								</div>
								<div class="text-left">
									<input type="hidden" name="config_id" value="{{ $report->config_id }}" />
									<input type="hidden" name="report_id" value="{{ $report->report_id }}" />
									
									<input type="submit" class="btn btn-primary btn-xs" name="update_file" value="Save File" />
								</div>
							</div>

							{!! Form::close() !!}
					</div> <!-- row end -->
					<div class="row">
					@if ( $report_files )
						<h2>Files</h2>
						<ul id="fileTab" class="nav nav-tabs">
							<?php $i=1; ?>
							@foreach ( $report_files as $file )
								<li class="<?php echo ($i==1) ? 'active':''; ?>"><a href="#file{{ $i }}" data-toggle="tab">File {{ $i }}</a></li>
								
								<?php $i++; ?>
							@endforeach
						</ul>
						
						<div id="fileTabContent" class="tab-content">
						<?php $i=1; ?>
						@foreach ( $report_files as $file )
							<div class="tab-pane <?php echo ($i==1) ? 'active':''; ?> spreadsheet" id="file{{ $i }}">
								
								@if ( $file->reportSheets && count($file->reportSheets) > 0 )
									<div class="row" style="margin-bottom: 3%;">
										<div class="col-md-6">
											<h5>Version History</h5>
											<ul>
											@foreach ( $file->allFileVersion as $currentVersion )
												<li>
													<a href="#">
														Version <?php echo str_replace(" ", "_", $currentVersion->created_at); ?>
													</a>
													@if ( $currentVersion->flag_current_version == 1 )
														<button class="btn btn-default btn-xs">[Active]</button>
													@endif
												</li>
											@endforeach
											</ul>
										</div>
										
									</div> <!-- row end -->
								@endif
								
								<div class="accordion" id="reportFileAccordion{{ $file->file_id }}">
									<?php $n = 1; ?>
									@foreach ( $file->reportSheets as $currentSheet )
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#reportFileAccordion{{ $file->file_id }}" href="#sheet{{ $currentSheet->sheet_id }}">
												<h3>Sheet {{ $n }}</h3>
											</a>
										</div>
										<div id="sheet{{ $currentSheet->sheet_id }}" class="accordion-body collapse sheet-contents <?php echo ($n == 1) ? 'in':''; ?>">

											<div class="accordion-inner">
												<div class="sheetContentPlaceholder">
													<table class="table table-hovered table-bordered sheetContents">
														<thead>
															<?php $data_table_columns = json_decode($currentSheet->data_table_columns); ?>
															@foreach ($data_table_columns as $data_table_columns)
															<tr>
																@foreach( $data_table_columns as $values )
																<td>{{ $values }}</td>
																@endforeach
															</tr>
															@endforeach
														</thead>
														<tbody>
															<?php $data_table = json_decode($currentSheet->data_table); ?>
															@foreach ($data_table as $data_values)
															<tr>
																@foreach( $data_values as $values )
																<td>{{ $values }}</td>
																@endforeach
															</tr>
															@endforeach
														</tbody>
													</table> <!-- sheetContents end -->
												</div> <!-- sheetContentPlaceholder end -->
											</div>
										</div>
									</div>
									<?php $n++; ?>
									@endforeach
								</div>
							</div>
							<?php $i++; ?>
						@endforeach
						</div> <!-- fileTabContent end -->
					@endif
					</div> <!-- row end -->
					
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
</script>
@endsection