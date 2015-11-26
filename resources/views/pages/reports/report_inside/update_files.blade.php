<div class="row">
		<div class="col-md-12">
			<h2>Add/Update File</h2>
		</div>
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
				<label>Configuration:</label>
				<select name="config_id" id="config_id" required class="form-control">
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
				<input type="hidden" name="report_id" value="{{ $report->report_id }}" />
				
				<input type="submit" class="btn btn-primary btn-xs" name="update_file" value="Save File" />
			</div>
		</div>

		{!! Form::close() !!}
</div> <!-- row end -->