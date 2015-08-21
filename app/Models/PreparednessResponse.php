<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreparednessResponse extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'preparedness_response';
	protected static $table_name = 'preparedness_response';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'report_id';
	
	
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
	public static function getActiveReports () {
		return self::where('status', '!=', 'Deleted')
			->paginate(15);
	}
	
	/**
	 * Inserts New Report
	 *
	 * @return object
	 */
	public static function addNewReport ( $fileData = array() ) {
		$report = new PreparednessResponse();
		$report->report_oldname = $fileData['originalName'];
		$report->report_filename = $fileData['fileName'];
		$report->status = 'Active';
		$report->save();
		
		return $report;
	}

}
