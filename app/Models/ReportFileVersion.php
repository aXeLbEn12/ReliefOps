<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Input;

class ReportFileVersion extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'report_file_version';
	protected static $table_name = 'report_file_version';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'version_id';
	
	
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
			->orderBy('version_id', 'desc')
			->get();
	}
	
	/**
	 * Get Report by version_id
	 *
	 * @return object
	 */
	public static function getReportById ( $version_id = 0 ) {
		return self::where('version_id', $version_id)->first();
	}
	
	/**
	 * Get Report versions by file_id
	 *
	 * @return object
	 */
	public static function getCurrentVersion ( $file_id = 0 ) {
		return self::where('file_id', $file_id)
			->where('flag_current_version', 1)
			->first();
	}
	
	public static function deactivateActiveVersion ( $file_id = 0 ) {
		$currentVersion = self::where('file_id', $file_id)
			->where('flag_current_version', 1)
			->first();
		
		if ( $currentVersion && count($currentVersion) > 0 ) {
			$currentVersion->flag_current_version = 0;
			$currentVersion->save();
		}
	}
	
	/**
	 * Get all file versions by file_id
	 *
	 * @return object
	 */
	public static function getAllVersion ( $file_id = 0 ) {
		return self::where('file_id', $file_id)
			->orderBy('flag_current_version', 'desc')
			->orderBy('created_at', 'desc')
			->get();
	}
	
	/**
	 * Inserts New Report
	 *
	 * @return object
	 */
	public static function addReportFileVersion ( $data = array() ) {
		$report = new ReportFileVersion();
		$report->file_id = $data['file_id'];
		$report->flag_current_version = $data['flag_current_version'];
		$report->report_filename = $data['report_filename'];
		$report->save();
		
		return $report;
	}

	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
