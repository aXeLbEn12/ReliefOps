<?php namespace App\Libraries;

# Excel classes
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Cell;
use PHPExcel_Cell_DataType;
use PHPExcel_Cell_IValueBinder;
use PHPExcel_Cell_DefaultValueBinder;

# Others
use Input, Session;


class ExcelExporter {
	

	/**
	 * Generates exported excel files
	 *
	 * @return excel file
	 */
	public static function exportFile ()
	{
		Excel::create('Filename_here', function($excel) {

			$excel->sheet('Sheetname', function($sheet) {

				$sheet->fromArray(array(
					array('data1', 'data2'),
					array('data3', 'data4')
				));

			});

		})->export('xls');
	}
	

	/**
	 * Generates exported excel files
	 *
	 * @return excel file
	 */
	public static function exportFileTest ( $reportArray = array() )
	{
		Excel::create('Filename_here', function($excel) use ( $reportArray ) {

			$excel->sheet('Sheetname', function($sheet) use ( $reportArray ) {

				$sheet->fromArray($reportArray);

			});

		})->export('xls');
	}
	
	public static function formatFileArrays ( $reports = array() )
	{
		$reformattedReport = array();
		
		foreach ( $reports as $report ) {
			$currentRow = array();
			foreach ( $report as $row ) {
				$currentRow[] = $row;
			}
			$report = $currentRow;
			$reformattedReport[] = $report;
		}
		
		return $reformattedReport;
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
