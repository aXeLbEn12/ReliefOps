<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConfigurationSheet;
use Input;

class ConsolidatedReports extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'report_consolidated';
	protected static $table_name = 'report_consolidated';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'consolidated_id';
	
	
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
		return self::where('consolidated_id', $id)->first();
	}
	
	/**
	 * Get Active Reports
	 *
	 * @return object
	 */
	public static function getList () {
		return self::where('status', '!=', 'Deleted')
			->orderBy('consolidated_id', 'desc')
			->paginate(15);
	}
	
	public static function saveConsolidatedReport ( $_fields = array() )
	{
		$report = new ConsolidatedReports();
		$report->report_id = $_fields['report_id'];
		$report->status = $_fields['status'];
		$report->generated_by = $_fields['generated_by'];
		$report->save();
		
		return $report;
	}
	
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
