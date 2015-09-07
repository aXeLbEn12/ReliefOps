// form validation
$('#crud-form').validate();

// add cell config
var addCellConfig = $('.add-cell-config');
addCellConfig.on('click.addCellConfig', function () {
	var configZone = $('.cell-info-config');
	var configInput = $('<label class="col-xs-3">Cell: </label><div class="col-xs-4"><input type="text" name="config[]" class="col-xs-3 form-control" placeholder="Label" /></div><div class="col-xs-2"><input type="text" name="column[]" class="form-control config-column" placeholder="Column" /></div><div class="col-xs-2"><input type="text" name="row[]" class=" form-control config-row" placeholder="Row" /></div>');
	
	
	configZone.append(configInput);
	return false;
});