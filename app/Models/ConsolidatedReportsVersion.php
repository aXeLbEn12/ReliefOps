<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConfigurationSheet;
use Input;

class ConsolidatedReportsVersion extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'report_consolidated_version';
	protected static $table_name = 'report_consolidated_version';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'version_id';
	
	
	public static function getById ( $id = 0 ) {
		return self::where('consolidated_id', $id)->first();
	}
	
	/**
	 * Returns table name
	 *
	 * @return string
	 */
	public static function getTableName () {
		return self::$table_name;
	}
	
	public static function saveConsolidatedReportVersion ( $_fields = array() )
	{
		$version = new ConsolidatedReportsVersion();
		$version->consolidated_id = $_fields['consolidated_id'];
		$version->table_data = $_fields['table_data'];
		$version->flag_current_version = $_fields['flag_current_version'];
		$version->save();
		
		return $version;
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
