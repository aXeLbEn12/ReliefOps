// form validation
$('#crud-form').validate();

// add spreadsheet
var btnAddSheet = $('#btnAddSheet');
btnAddSheet.on('click.btnAddSheet', function () {
	var spreadsheet_count = $('#spreadsheet_count').val();
		spreadsheet_count++;
	$('#spreadsheet_count').val(spreadsheet_count)

	// add tab header
    $('#sheetTab').append('<li><a href="#sheet'+spreadsheet_count+'" data-toggle="tab">Sheet '+spreadsheet_count+'</a></li>');
	
	// add tab content
	$('#sheetTabContent').append('<div class="tab-pane spreadsheet" id="sheet'+spreadsheet_count+'"><h3>Sheet '+spreadsheet_count+'</h3><div class="form-group"><div class="form-group"><label>Sheet Name:</label><input type="text" name="sheet_name[sheet'+spreadsheet_count+']" class="form-control" placeholder="Sheet Name" /></div> <!-- form-group end --><label>Data Table Columns:</label><input type="text" name="data_table_columns[sheet'+spreadsheet_count+']" class="form-control" placeholder="Data Table Columns" /></div> <!-- form-group end --><div class="form-group"><label>Data Table Range:</label><input type="text" id="data_table" name="data_table[sheet'+spreadsheet_count+']" class="form-control" placeholder="Data Table Range" /></div> <!-- form-group end --><div><label>Excel Info:</label><div class="cell-info-config"></div><div class="clearfix"></div><div><a href="#" class="btn btn-white btn-xs add-cell-config">Add</a></div></div></div>');
	
	$('#sheet' + spreadsheet_count).tab('show');
	
	addCellConfigDetails();
});

// add cell config
function addCellConfigDetails () {
	var addCellConfig = $('.add-cell-config');
	addCellConfig.unbind('click');
	
	addCellConfig.on('click.addCellConfig', function () {
		var spreadsheet = $(this).parents('div.spreadsheet');
		var sheetId = spreadsheet.attr('id');
		var configZone = spreadsheet.first('.cell-info-config');
		
		var configInput = $('<label class="col-xs-3">Cell: </label><div class="col-xs-4"><input type="text" name="config['+sheetId+'][]" class="col-xs-3 form-control" placeholder="Label" /></div><div class="col-xs-2"><input type="text" name="column['+sheetId+'][]" class="form-control config-column" placeholder="Column" /></div><div class="col-xs-2"><input type="text" name="row['+sheetId+'][]" class=" form-control config-row" placeholder="Row" /></div>');
		
		
		configZone.append(configInput);
		return false;
	});
}
addCellConfigDetails();