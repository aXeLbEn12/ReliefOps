<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Input;

class ReportFile extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'report_file';
	protected static $table_name = 'report_file';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'file_id';
	
	
	/**
	 * Returns table name
	 *
	 * @return string
	 */
	public static function getTableName () {
		return self::$table_name;
	}
	
	
	/**
	 * Get Active Reports
	 *
	 * @return object
	 */
	public static function getList () {
		return self::where('status', '!=', 'Deleted')
			->orderBy('file_id', 'desc')
			->get();
	}
	
	/**
	 * Get Report by file_id
	 *
	 * @return object
	 */
	public static function getReportFilesById ( $report_id = 0 ) {
		return self::where('report_id', $report_id)->get();
	}
	
	/**
	 * Inserts New Report
	 *
	 * @return object
	 */
	public static function addReportFile ( $data = array() ) {
		$report = new ReportFile();
		$report->report_id = $data['report_id'];
		$report->save();
		
		return $report;
	}

	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
