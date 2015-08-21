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
	 * Add Report Row
	 *
	 * @return object
	 */
	public static function addReportRow ( $data = array(), $report = array() ) {
		$report = new PreparednessResponseRow();
		$report->report_id = $report->report_id;
		$report->regionfilter = $data['regionfilter'];
		$report->region_provincemunicipalitycity = $data['region_provincemunicipalitycity'];
		$report->nhts_pr_2011 = $data['nhts_pr_2011'];
		$report->nso_population_2010 = $data['nso_population_2010'];
		$report->no_of_pantawid_beneficiaries = $data['no_of_pantawid_beneficiaries'];
		$report->save();
		
		return $report;
	}

}
