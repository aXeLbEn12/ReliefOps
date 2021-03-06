<div class="row">
	<div class="col-md-12">
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
			<div class="tab-pane <?php echo ($i==1) ? 'active':''; ?> spreadsheet pikachu" id="file{{ $i }}">
				
				@if ( $file->reportSheets && count($file->reportSheets) > 0 )
					<div class="row" style="margin-bottom: 3%;">
						<div class="col-md-6">
							<h5>Version History</h5>
							<ul>
							@foreach ( $file->allFileVersion as $currentVersion )
								<li>
									<a href="{{ url('reports/view_file_version/'.$file->file_id.'/'.$currentVersion->version_id) }}" class="fancybox" data-fancybox-type="iframe">
										Version <?php $version = str_replace(" ", "_", $currentVersion->created_at); ?>
										{{ $version }}
									</a>
									@if ( $currentVersion->flag_current_version == 1 )
										<button class="btn btn-default btn-xs">[Active]</button>
										<a class="btn btn-white btn-xs download-excel" href="#" data-download="{{ url('reports/download/'.$file->currentFileVersion->report_filename.'/'.$report->incident_number.'-'.$report->incident_name.'-'.$version) }}"><i class="fa fa-download"></i> Download </a>
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
											
											<?php $currentValueHead = ''; ?>
											@foreach ($data_table as $data_values)
											<tr>
												<?php $m = 0; ?>
												@foreach( $data_values as $values )
													@if ( $values != '' && $m == 0 )
														<?php $currentValueHead = $values; ?>
													@endif
													@if ( $m == 0 && $values == '' )
														<td>{{ $currentValueHead }}</td>
													@else
														<td>{{ $values }}</td>
													@endif
													
													<?php $m++; ?>
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
	</div>
</div> <!-- row end -->

@section('footer_scripts')
<script>
	$('.sheetContents').DataTable();
</script>
@endsection