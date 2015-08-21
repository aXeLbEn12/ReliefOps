<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreparednessResponseRow extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'preparedness_response_rows';
	protected static $table_name = 'preparedness_response_rows';
	
	/**
	 * Override primary key used by model
	 *
	 * @var int
	 */
	protected $primaryKey = 'row_id';
	
	
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
	public static function getReportRowsByReportId ( $report_id = 0 ) {
		return self::where('report_id', $report_id)
			->paginate(500);
	}
	
	/**
	 * Add Report Row
	 *
	 * @return object
	 */
	public static function addReportRow ( $data = array(), $report_id ) {
		$report = new PreparednessResponseRow();
		$report->report_id = $report_id;
		$report->regionfilter = $data['regionfilter'];
		$report->region_provincemunicipalitycity = $data['region_provincemunicipalitycity'];
		$report->nhts_pr_2011 = $data['nhts_pr_2011'];
		$report->nso_population_2010 = $data['nso_population_2010'];
		$report->no_of_pantawid_beneficiaries = $data['no_of_pantawid_beneficiaries'];
		$report->save();
		
		return $report;
	}

	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}
}
