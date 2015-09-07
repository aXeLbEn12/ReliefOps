<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PreparednessResponseRow;

use PHPExcel_Cell;
use PHPExcel_Cell_DataType;
use PHPExcel_Cell_IValueBinder;
use PHPExcel_Cell_DefaultValueBinder;

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
	public static function getList () {
		return self::where('report_filename', '!=', '')
			->paginate(15);
	}
	
	/**
	 * Get Report by report_id
	 *
	 * @return object
	 */
	public static function getReportById ( $report_id = 0 ) {
		return self::where('report_id', $report_id)->first();
	}
	
	/**
	 * Inserts New Report
	 *
	 * @return object
	 */
	public static function addNewReport ( $fileData = array() ) {
		$report = new Reports();
		$report->report_oldname = $fileData['originalName'];
		$report->report_filename = $fileData['fileName'];
		$report->status = 'Active';
		$report->save();
		
		return $report;
	}
	
	/**
	 * Parses report then save to database
	 *
	 * @return object
	 */
	public static function parsePreparednessResponse ( $file, $report ) {
        try {
            Excel::load($file, function ($reader) use($report) {

                foreach ($reader->toArray() as $row) {
					if ( $row['regionfilter'] != '' ) {
						PreparednessResponseRow::addReportRow($row, $report->report_id);
					}
                }
            });
            
        } catch (\Exception $e) {
			echo 'error here: '.$e->getMessage();
			return $e->getMessage();
        }
	}
	
	/**
	 * Parses report then save to database
	 *
	 * @return object
	 */
	public static function parseReport ( $file, $report, $config ) {
		
        try {
            Excel::load($file, function ($reader) use($report, $config) {
				// Select the right sheet
				$config_string = json_decode($config->configuration_string);
				$new_config_string = array();
				
				for ( $i=0; $i<count($config_string); $i++ ) {
					$currentCell = $reader->getActiveSheet()->getCell("{$config_string[$i]->column}{$config_string[$i]->row}")->getValue();
					$new_config_string[$i] = $config_string[$i];
					$new_config_string[$i]->cell_value = $currentCell;
				}
				$new_config_string = json_encode($new_config_string);
				
				// data table
				$data_table = $reader->getActiveSheet(0)->rangeToArray($config->data_table);
				$data_table = json_encode($data_table);
				
				self::updateDataTabe($new_config_string, $data_table, $report->report_id);
            });
            
        } catch (\Exception $e) {
			echo 'error here: '.$e->getMessage();
			return $e->getMessage();
        }
	}
	
	protected static function updateDataTabe ( $config_string, $data_table, $report_id ) {
		
		$currentReport = self::where('report_id', $report_id)
			->first();
		$currentReport->data_table = $data_table;
		$currentReport->excel_info = $config_string;
		$currentReport->save();
		
		return $currentReport;
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
