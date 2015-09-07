<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
	protected $primaryKey = 'id';
	
	
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
		return self::where('id', $id)->first();
	}
	
	/**
	 * Get Active Reports
	 *
	 * @return object
	 */
	public static function getConfigList () {
		return self::where('configuration_name', '!=', '')
			->paginate(15);
	}
	
	/**
	 * Parses configuration then save to database
	 *
	 * @return object
	 */
	public static function saveConfiguration () {
		$config = Input::get('config');
		$rows = Input::get('row');
		$columns = Input::get('column');
		
		$config_string = array();
		if ( $config && count ($config) > 0 ) {
			for ( $i=0; $i<count($config); $i++ ) {
				$config_string[$i]['config_name'] = $config[$i];
				$config_string[$i]['column'] = $columns[$i];
				$config_string[$i]['row'] = $rows[$i];
			}
		}
		
		$config_string = json_encode($config_string);
		
		// save to database
		$configTable = new Configuration();
		$configTable->configuration_name = Input::get('configuration_name');
		$configTable->data_table = Input::get('data_table');
		$configTable->configuration_string = $config_string;
		$configTable->save();
		
		return $configTable;
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
		
		$config_string = array();
		if ( $config && count ($config) > 0 ) {
			for ( $i=0; $i<count($config); $i++ ) {
				$config_string[$i]['config_name'] = $config[$i];
				$config_string[$i]['column'] = $columns[$i];
				$config_string[$i]['row'] = $rows[$i];
			}
		}

		$config_string = json_encode($config_string);
		
		// save to database
		$configTable = self::where('id', Input::get('id'))
			->first();
		$configTable->configuration_name = Input::get('configuration_name');
		$configTable->data_table = Input::get('data_table');
		$configTable->configuration_string = $config_string;
		$configTable->save();
		
		return $configTable;
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
