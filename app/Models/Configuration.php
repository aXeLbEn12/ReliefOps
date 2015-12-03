<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConfigurationSheet;
use Input;

class Configuration extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'configuration';
	protected static $table_name = 'configuration';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'config_id';
	
	
	/**
	 * Returns table name
	 *
	 * @return string
	 */
	public static function getTableName () {
		return self::$table_name;
	}
	
	/**
	 * Get Report by report_id
	 *
	 * @return object
	 */
	public static function getById ( $id = 0 ) {
		return self::where('config_id', $id)->first();
	}
	
	/**
	 * Get Active Reports
	 *
	 * @return object
	 */
	public static function getConfigList () {
		return self::where('status', '!=', 'Deleted')
			->orderBy('config_id', 'desc')
			->paginate(15);
	}
	
	/**
	 * Parses configuration then save to database
	 *
	 * @return object
	 */
	public static function saveConfiguration () {self::print_this($_POST, '$_POST');
		$config = Input::get('config');
		$rows = Input::get('row');
		$columns = Input::get('column');
		
		
		// create a report, then save
		$config_id = self::createConfigurationTable();
		
		// add spreadsheets
		ConfigurationSheet::addReportSheet($config_id);
	}
	
	public static function createConfigurationTable ()
	{
		$configTable = new Configuration();
		$configTable->configuration_name = Input::get('configuration_name');
		$configTable->status = 'Active';
		$configTable->save();
		
		return $configTable->config_id;
	}
	
	/**
	 * Updates record
	 *
	 * @return object
	 */
	public static function updateConfiguration () {
		$config = Input::get('config');
		$rows = Input::get('row');
		$columns = Input::get('column');
		
		/*$config_string = array();
		if ( $config && count ($config) > 0 ) {
			for ( $i=0; $i<count($config); $i++ ) {
				$config_string[$i]['config_name'] = $config[$i];
				$config_string[$i]['column'] = $columns[$i];
				$config_string[$i]['row'] = $rows[$i];
			}
		}

		$config_string = json_encode($config_string);*/
		self::print_this($_POST, '$_POST');exit;
		// save to database
		$configTable = self::where('config_id', Input::get('config_id'))
			->first();self::print_this($configTable, '$configTable');
		$configTable->configuration_name = Input::get('configuration_name');
		//$configTable->data_table = json_encode(Input::get('data_table'));
		//$configTable->data_table_columns = json_encode(Input::get('data_table_columns'));
		//$configTable->configuration_string = $config_string;
		$configTable->save();
		
		
		// then save the sheets
		$sheet_id = Input::get('sheet_id');
		$sheet_name = Input::get('sheet_name');
		$data_table_columns = Input::get('data_table_columns');
		$data_table = Input::get('data_table');
		for ( $i = 0; $i<count($sheet_id); $i++ ) {
			$_fields = array();
			$_fields['sheet_id'] = $sheet_id[$i];
			//$_fields['configuration_string'] = $configuration_string[$i];
			$_fields['data_table'] = $data_table[$i];
			$_fields['data_table_columns'] = $data_table_columns[$i];
			updateConfigSheet($_fields);
		}
		
		self::print_this($configTable, '$configTable');exit;
		
		
		return $configTable;
	}
	
	/**
	 * Delete record
	 *
	 * @return object
	 */
	protected static function deleteRecord ( $id = 0 ) {
		$user = self::where('config_id', $id)
			->first();
		
		$user->status = 'Deleted';
		$user->deleted_at = date('Y-m-d H:i:s');
		$user->save();
		
		return $user;
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
