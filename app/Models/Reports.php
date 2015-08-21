<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PreparednessResponseRow;

class Reports extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reports';
	protected static $table_name = 'reports';
	
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
	 * Parses report then save to database
	 *
	 * @return object
	 */
	public static function parsePreparednessResponse ( $file, $report ) {
        try {
            Excel::load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    //self::print_this($row, '$row');
					if ( $row['regionfilter'] != '' && $row['regionfilter'] != 'region_provincemunicipalitycity' ) {
						PreparednessResponseRow::addReportRow($row, $report);
					}
                }
            });
            
        } catch (\Exception $e) {
			return $e->getMessage();
        }
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
