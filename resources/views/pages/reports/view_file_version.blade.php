@extends('blank')

@section('content')
<div class="row">
	<div class="col-md-12">
	@if ( $report_files )
		<h2>File Version {{ $current_file_version }}</h2>
		<?php $i=1; ?>
		@foreach ( $report_files as $file )
			<div class="tab-pane <?php echo ($i==1) ? 'active':''; ?> spreadsheet" id="file{{ $i }}">
				
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
	@endif
	</div>
</div> <!-- row end -->
@endsection