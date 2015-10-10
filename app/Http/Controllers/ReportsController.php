<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Reports, App\Models\ReportFile, App\Models\ReportFileVersion, App\Models\ReportFileSheets, App\Models\Configuration, App\Models\ConfigurationSheet;
use Input, Validator, Redirect, Request, Session, Form, View;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Cell;
use PHPExcel_Cell_DataType;
use PHPExcel_Cell_IValueBinder;
use PHPExcel_Cell_DefaultValueBinder;

class ReportsController extends Controller {
	
	protected $viewPath = 'pages.reports.';
	protected $moduleName = 'Reports';

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
	
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		# variables to share to all view
		View::share('moduleName', $this->moduleName);
	}
	

	/**
	 * Shows the list of reports
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array();
		$data['records'] = Reports::getList();
		
		return view($this->viewPath.'list', $data);
	}
	
	/**
	 * View report by id
	 *
	 * @return Response
	 */
	public function view_report ($id)
	{
		$data = array();
		$report = Reports::getReportById($id);
		$data['report'] = $report;
		$data['config_string'] = json_decode($report->excel_info);
		$data['data_table'] = json_decode($report->data_table);
		$data['data_table_columns'] = json_decode($report->data_table_columns);
		
		return view($this->viewPath.'view_report', $data);
	}
	
	public function view1 ( $id )
	{
		$data = array();
		
		# report
		$report = Reports::getReportById($id);
			$data['report'] = $report;
		
		# get all files under this report
		$reportFiles = ReportFile::getReportFilesById($report->report_id);
		
		# get all version and sheets under this report
		for ( $i=0; $i<count($reportFiles); $i++ ) {
			// get current version
			$currentFileVersion = ReportFileVersion::getCurrentVersion($reportFiles[$i]->file_id);
			$reportFiles[$i]->currentFileVersion = $currentFileVersion;
			
			// get all file versions
			$allFileVersion = ReportFileVersion::getAllVersion($reportFiles[$i]->file_id);
			$reportFiles[$i]->allFileVersion = $allFileVersion;
			
			// get sheets
			$reportSheets = ReportFileSheets::getSheetsByVersionId($currentFileVersion->version_id);
			$reportFiles[$i]->reportSheets = $reportSheets;
		}
		$data['report_files'] = $reportFiles;
		
		$data['config_list'] = Configuration::getConfigList();
		
		return view($this->viewPath.'view1', $data);
	}
	
	public function addfileversion ()
	{
		$file_id = Input::get('file_id');
		$report_id = Input::get('report_id');
		$uploadedfile = Input::get('uploadedfile');
		
		// get config
		$config = Configuration::getById(Input::get('config_id'));
		
		// get config sheets
		$configSheets = ConfigurationSheet::getArrangedSheets($config->config_id);
		
		
		
		// save file version
		
		if ( $file_id != 'new_file' ) { // make sure that if we're adding a new version of the file, we're deactivating the current active version
			ReportFileVersion::deactivateActiveVersion($file_id);
			
			$reportFileVersionData = array();
			$reportFileVersionData['file_id'] = $file_id;
			$reportFileVersionData['flag_current_version'] = 1;
			$reportFileVersionData['report_filename'] = $uploadedfile;
			$reportVersion = ReportFileVersion::addReportFileVersion($reportFileVersionData);
		} else { // add a new report
			// save file
			$reporfileData = array();
			$reporfileData['report_id'] = $report_id;
			$reportFile = ReportFile::addReportFile($reporfileData);
			
			// save file version
			$reportFileVersionData = array();
			$reportFileVersionData['file_id'] = $reportFile->file_id;
			$reportFileVersionData['flag_current_version'] = 1;
			$reportFileVersionData['report_filename'] = $uploadedfile;
			$reportVersion = ReportFileVersion::addReportFileVersion($reportFileVersionData);
		}
		
		

		
		$file = "uploads/{$uploadedfile}";
		Excel::load($file, function ($reader) use($reportVersion, $config, $configSheets) {
			foreach ($reader->getWorksheetIterator() as $worksheetNbr => $worksheet) {
				//echo 'Worksheet number - ', $worksheetNbr, PHP_EOL;
				
				$currentWorksheet = $worksheetNbr + 1;
				if ( isset( $configSheets["sheet{$currentWorksheet}"] ) ) {
					$currentConfig = $configSheets["sheet{$currentWorksheet}"];
					
					// data table columns
					$data_table_columns = $worksheet->rangeToArray($currentConfig['data_table_columns']);//self::print_this($data_table, '$data_table');exit;
					$data_table_columns = json_encode($data_table_columns);
					
					// data table
					$data_table = $worksheet->rangeToArray($currentConfig['data_table']);//self::print_this($data_table, '$data_table');exit;
					$data_table = json_encode($data_table);
					
					// excel info
					if ( $currentConfig['configuration_string'] != '' ) {
						$config_string = json_decode($currentConfig['configuration_string']);
						$new_config_string = array();
						
						for ( $i=0; $i<count($config_string); $i++ ) {
							$currentCell = $worksheet->getCell("{$config_string[$i]->column}{$config_string[$i]->row}")->getValue();
							$currentCellColor = $worksheet->getStyle("{$config_string[$i]->column}{$config_string[$i]->row}")->getFill()->getStartColor()->getARGB();
							$new_config_string[$i] = $config_string[$i];
							$new_config_string[$i]->cell_value = $currentCell;
							$new_config_string[$i]->cell_color = $currentCellColor;
						}
						$new_config_string = json_encode($new_config_string);
					} else { $new_config_string = ''; }
					
					// insert sheet
					$reportSheetData = array();
					$reportSheetData['version_id'] = $reportVersion->version_id;
					$reportSheetData['worksheet_number'] = $worksheetNbr;
					$reportSheetData['data_table'] = $data_table;
					$reportSheetData['data_table_columns'] = $data_table_columns;
					$reportSheetData['excel_info'] = $new_config_string;$this->print_this($reportSheetData, '$reportSheetData');
					
					
					ReportFileSheets::addReportFileSheet($reportSheetData);
				}
			}
		});
		
		Session::flash('success', 'Your report(s) has been successfully saved.');
		return Redirect::to('reports/view1/'.$report_id);
	}
	
	/**
	 * View report by id
	 *
	 * @return Response
	 */
	public function view_datatable ($id)
	{
		$data = array();
		$report = Reports::getReportById($id);
		$data['report'] = $report;
		$data['config_string'] = json_decode($report->excel_info);
		$data['data_table'] = json_decode($report->data_table);
		$data['data_table_columns'] = json_decode($report->data_table_columns);
		
		return view($this->viewPath.'view_datatable', $data);
	}
	
	
	/**
	 * Shows the add report form
	 *
	 * @return Response
	 */
	public function add () {
		$data = array();
		$data['config_list'] = Configuration::getConfigList();
		return view($this->viewPath.'new', $data);
	}
	
	/**
	 * "Delete" Record
	 *
	 * @return Response
	 */
	public function delete( $id = 0 )
	{
		Reports::deleteRecord($id);
		
		// redirect
		Session::flash('success', 'You have successfully deleted the record.');
		return Redirect::to('reports/list');
	}
	
	/**
	 * Uloads excel file(s)
	 *
	 * @return Response
	 */
	public function upload() {
		$data = array();
		$file = array('report' => Input::file('report'));
		$rules = array('report' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		$validator = Validator::make($file, $rules);
		
		if ($validator->fails()) {
			return Redirect::to('reports/new')->withInput()->withErrors($validator);
		}
		else {
			// checking file is valid.
			if (Input::file('report')->isValid()) {
				$destinationPath = 'uploads'; // upload path
				$extension = Input::file('report')->getClientOriginalExtension();
				$fileName = "reports_".rand(11111,99999).'_'.date('YmdHis').'.'.$extension;
				$originalName = Input::file('report')->getClientOriginalName();
				Input::file('report')->move($destinationPath, $fileName);
				
				$data['filename'] = $fileName;
				echo json_encode($data);
			}
			else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				//return Redirect::to('reports/new');
			}
		}
	}
	
	public function update_report ( $id )
	{
		Reports::updateReport($id);
		
		Session::flash('success', 'Your report(s) has been successfully updated.');
		return Redirect::to('reports/view1/'.$id);
	}
	
	public function view_file_version ( $file_id, $version_id )
	{
		
		# get all files under this report
		$reportFiles = ReportFile::getReportFilesByFileId($file_id);
		
		# get all version and sheets under this report
		for ( $i=0; $i<count($reportFiles); $i++ ) {
			// get current version
			$currentFileVersion = ReportFileVersion::getCurrentVersion($file_id);
			$reportFiles[$i]->currentFileVersion = $currentFileVersion;
			
			// get all file versions
			$allFileVersion = ReportFileVersion::getAllVersion($reportFiles[$i]->file_id);
			$reportFiles[$i]->allFileVersion = $allFileVersion;
			
			// get sheets
			$reportSheets = ReportFileSheets::getSheetsByVersionId($currentFileVersion->version_id);
			$reportFiles[$i]->reportSheets = $reportSheets;
		}
		
		$data['current_file_version'] = str_replace(" ", "_", $currentFileVersion->created_at);
		$data['report_files'] = $reportFiles;
		
		return view($this->viewPath.'view_file_version', $data);
	}
	
	public function savereport ()
	{
		$allfiles = Input::get('allfiles');
		$allfiles = explode(',', $allfiles);
		
		// get config
		$config = Configuration::getById(Input::get('config_id'));$this->print_this($config, '$config');
		
		// get config sheets
		$configSheets = ConfigurationSheet::getArrangedSheets($config->config_id);$this->print_this($configSheets, '$configSheets');
		
		// create the report first
		$report = Reports::addNewReport();$this->print_this($report, '$report - gyarados');
		
		foreach ( $allfiles as $currentFile ) {
			if ( $currentFile != '' ) {
				$this->print_this($currentFile, '$currentFile');
				// save file
				$reporfileData = array();
				//$reporfileData['flag_current_version'] = 1;
				//$reporfileData['report_filename'] = $currentFile;
				$reporfileData['report_id'] = $report->report_id;
				$reportFile = ReportFile::addReportFile($reporfileData);$this->print_this($reportFile, '$reportFile');
				
				// save file version
				$reportFileVersionData = array();
				$reportFileVersionData['file_id'] = $reportFile->file_id;
				$reportFileVersionData['flag_current_version'] = 1;
				$reportFileVersionData['report_filename'] = $currentFile;
				$reportVersion = ReportFileVersion::addReportFileVersion($reportFileVersionData);
				
				
				// save each sheet
				$file = "uploads/{$currentFile}";
				Excel::load($file, function ($reader) use($reportFile, $reportVersion, $config, $configSheets) {
					foreach ($reader->getWorksheetIterator() as $worksheetNbr => $worksheet) {
						echo 'Worksheet number - ', $worksheetNbr, PHP_EOL;
						
						$currentWorksheet = $worksheetNbr + 1;
						if ( isset( $configSheets["sheet{$currentWorksheet}"] ) ) {
							$currentConfig = $configSheets["sheet{$currentWorksheet}"];
							
							// data table columns
							$data_table_columns = $worksheet->rangeToArray($currentConfig['data_table_columns']);//self::print_this($data_table, '$data_table');exit;
							$data_table_columns = json_encode($data_table_columns);echo "data_table_columns: {$data_table_columns}";
							
							// data table
							$data_table = $worksheet->rangeToArray($currentConfig['data_table']);//self::print_this($data_table, '$data_table');exit;
							$data_table = json_encode($data_table);
							
							// excel info
							if ( $currentConfig['configuration_string'] != '' ) {
								$config_string = json_decode($currentConfig['configuration_string']);
								$new_config_string = array();
								
								for ( $i=0; $i<count($config_string); $i++ ) {
									$currentCell = $worksheet->getCell("{$config_string[$i]->column}{$config_string[$i]->row}")->getValue();
									$currentCellColor = $worksheet->getStyle("{$config_string[$i]->column}{$config_string[$i]->row}")->getFill()->getStartColor()->getARGB();
									$new_config_string[$i] = $config_string[$i];
									$new_config_string[$i]->cell_value = $currentCell;
									$new_config_string[$i]->cell_color = $currentCellColor;
								}
								$new_config_string = json_encode($new_config_string);
							} else { $new_config_string = ''; }
							
							// insert sheet
							$reportSheetData = array();
							$reportSheetData['version_id'] = $reportVersion->version_id;
							$reportSheetData['worksheet_number'] = $worksheetNbr;
							$reportSheetData['data_table'] = $data_table;
							$reportSheetData['data_table_columns'] = $data_table_columns;
							$reportSheetData['excel_info'] = $new_config_string;$this->print_this($reportSheetData, '$reportSheetData');
							
							
							ReportFileSheets::addReportFileSheet($reportSheetData);
						}
					}
				});
				
			}
		}
		
		Session::flash('success', 'Your report(s) has been successfully added.');
		return Redirect::to('reports/list');
	}

	
	public function test ()
	{
		$file = 'uploads/two_columns.xlsx';
		
		Excel::load($file, function ($reader)  {
			foreach ($reader->getWorksheetIterator() as $worksheetNbr => $worksheet) {
				echo 'Worksheet number - ', $worksheetNbr, PHP_EOL;
				$email_address = $worksheet->getCell('A1');echo '$email_address: '.$email_address.'<br />';
				$this->print_this($worksheet, '$worksheet');
				
			}
		});
	}
	
	public function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}
}
