<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;

class ConfigurationSheet extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'configuration_sheet';
	protected static $table_name = 'configuration_sheet';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'sheet_id';
	
	
	/**
	 * Returns table name
	 *
	 * @return string
	 */
	public static function getTableName () {
		return self::$table_name;
	}
	
	
	/**
	 * Get Config Sheets by config_id
	 *
	 * @return object
	 */
	public static function getByConfigId ( $id = 0 ) {
		return self::where('config_id', $id)->get();
	}
	
	public static function updateConfigSheet ( $_fields = array() )
	{
		$sheet = self::where('config_id', $_fields['sheet_id'])
			->first();
		$sheet->sheet_name = $_fields['sheet_name'];
		//$sheet->configuration_string = $_fields['configuration_string'];
		$sheet->data_table = $_fields['data_table'];
		$sheet->data_table_columns = $_fields['data_table_columns'];
		$sheet->save();
	}
	
	/**
	 * Get Config Sheets by config_id
	 *
	 * @return object
	 */
	public static function getArrangedSheets ( $id = 0 ) {
		$arrangedSheets = array();
		$sheets = self::getByConfigId($id);
		
		for ( $i=0; $i<count($sheets); $i++ ) {
			$arrangedSheets["sheet".($i + 1)]['sheet_id'] = $sheets[$i]->sheet_id;
			$arrangedSheets["sheet".($i + 1)]['config_id'] = $sheets[$i]->config_id;
			$arrangedSheets["sheet".($i + 1)]['sheet_name'] = $sheets[$i]->sheet_name;
			$arrangedSheets["sheet".($i + 1)]['configuration_string'] = $sheets[$i]->configuration_string;
			$arrangedSheets["sheet".($i + 1)]['data_table'] = $sheets[$i]->data_table;
			$arrangedSheets["sheet".($i + 1)]['data_table_columns'] = $sheets[$i]->data_table_columns;
		}
		
		return $arrangedSheets;
	}
	
	public static function addReportSheet ( $config_id = 0 )
	{
		$sheet_name = Input::get('sheet_name');
		
		foreach ( $sheet_name as $sheetKey => $sheetData ) {
			$config_string = array();
			
			$data_table_columns = Input::get('data_table_columns');
			$data_table = Input::get('data_table');
			$config = Input::get('config');
				$config = $config[$sheetKey];
			$rows = Input::get('row');
				$rows = $rows[$sheetKey];
			$columns = Input::get('column');
				$columns = $columns[$sheetKey];
			
			// config string here
			$config_string = array();
			if ( $config && count ($config) > 0 ) {
				for ( $i=0; $i<count($config); $i++ ) {
					$config_string[$i]['config_name'] = $config[$i];
					$config_string[$i]['column'] = $columns[$i];
					$config_string[$i]['row'] = $rows[$i];
				}
			}
			
			$config_string = json_encode($config_string);
			
			
			$sheet = new ConfigurationSheet();
			$sheet->config_id = $config_id;
			$sheet->sheet_name = $sheet_name[$sheetKey];
			$sheet->configuration_string = $config_string;
			$sheet->data_table = $data_table[$sheetKey];
			$sheet->data_table_columns = $data_table_columns[$sheetKey];
			$sheet->save();

		}
	}
	
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
