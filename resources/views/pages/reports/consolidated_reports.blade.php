<div class="row">
	<div class="col-md-12">
	@if ( $report_files )
		<h2>Consolidated Report</h2>
		<div class="sheetContentPlaceholder">
			<table class="table table-hovered table-bordered sheetContents2">
				<thead>
					<?php $tableHeaders = isset($report_files[0]->reportSheets[0]) ? $report_files[0]->reportSheets[0] : false; ?>
					<?php
						if ( $tableHeaders ):
						$data_table_columns = json_decode($tableHeaders->data_table_columns);
					?>
						<thead>
							@foreach ($data_table_columns as $data_table_columns)
							<tr>
								@foreach( $data_table_columns as $values )
								<td>{{ $values }}</td>
								@endforeach
							</tr>
							@endforeach
						</thead>
					<?php
						endif;
					?>

				</thead>
				<tbody>
				@foreach ( $report_files as $file )
					@foreach ( $file->reportSheets as $currentSheet )
						<?php $data_table = json_decode($currentSheet->data_table); ?>
						@foreach ($data_table as $data_values)
						<tr>
							@foreach( $data_values as $values )
							<td>{{ $values }}</td>
							@endforeach
						</tr>
						@endforeach	
					@endforeach
					
				@endforeach
				</tbody>
			</table> <!-- sheetContents end -->
		</div>
	@endif
	</div>
</div> <!-- row end -->