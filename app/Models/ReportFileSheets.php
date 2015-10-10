<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Input;

class ReportFileSheets extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'report_file_sheets';
	protected static $table_name = 'report_file_sheets';
	
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
	 * Get Active Reports
	 *
	 * @return object
	 */
	public static function getList () {
		return self::where('status', '!=', 'Deleted')
			->orderBy('sheet_id', 'desc')
			->paginate(15);
	}
	
	/**
	 * Get Report by sheet_id
	 *
	 * @return object
	 */
	public static function getReportById ( $sheet_id = 0 ) {
		return self::where('sheet_id', $sheet_id)->first();
	}
	
	/**
	 * Get sheets by version_id
	 *
	 * @return object
	 */
	public static function getSheetsByVersionId ( $version_id = 0 ) {
		return self::where('version_id', $version_id)->get();
	}
	
	/**
	 * Inserts New Report
	 *
	 * @return object
	 */
	public static function addReportFileSheet ( $data = array() ) {
		$report = new ReportFileSheets();
		$report->version_id = $data['version_id'];
		$report->worksheet_number = $data['worksheet_number'];
		$report->data_table = $data['data_table'];
		$report->data_table_columns = $data['data_table_columns'];
		$report->excel_info = $data['excel_info'];
		$report->save();
		
		return $report;
	}

	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
