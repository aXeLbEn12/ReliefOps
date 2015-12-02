<?php namespace App\Http\Controllers;

use App\Models\Reports, App\Models\ReportFile, App\Models\ReportFileVersion, App\Models\ReportFileSheets, App\Models\Configuration, App\Models\ConfigurationSheet;
use Input, Validator, Redirect, Request, Session, Form, View, Response;
use App\Models\ConsolidatedReports, App\Models\ConsolidatedReportsVersion;

# File exporter
use App\Libraries\ExcelExporter;

class ConsolidatedController extends Controller {

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
	
	protected $viewPath = 'pages.consolidated.';
	protected $moduleName = 'Consolidated Reports';
	
	
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Shows the list of files uploaded
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array();
		$records = ConsolidatedReports::getList();
		
		foreach ( $records as $record ) {
			$currentReport = Reports::getReportById($record->report_id);
			$record->incident_report = "{$currentReport->incident_name} - Incident # {$currentReport->incident_number}";
		}
		
		$data['records'] = $records;
		
		return view($this->viewPath.'list', $data);
	}
	
	public function view ( $id = 0 )
	{
		$data = array();
		
		$currentReport = ConsolidatedReports::getById($id);
		$data['currentReport'] = $currentReport;
		$version = ConsolidatedReportsVersion::getById($id);
		$data['version'] = $version;
		
		$originalReport = Reports::getReportById($currentReport->report_id);
		$data['originalReport'] = $originalReport;
		
		return view($this->viewPath.'view', $data);
	}
	
	public function generate ( $id = 0 )
	{
		$data = array();
		$data['reports'] = Reports::getList();
		
		$reports = Reports::getList();
		$data['reports'] = $reports;
		
		# report
		$report = Reports::getReportById($id);
			$data['report'] = $report;
		
		if ( count($report) > 0 ) {
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
		} else {
			$reportFiles = array();
		}
		$data['report_files'] = $reportFiles;
		
		
		return view($this->viewPath.'generate', $data);
	}
	
	public function add ( $id = 0 )
	{
		$fileIds = Input::get('files_to_include');
		$tableData = Reports::getAllReportRowsByReportId($id, $fileIds);
		
		// report fields
		$_reportFields = array();
		$_reportFields['report_id'] = Input::get('report_id');
		$_reportFields['status'] = 'Pending';
		$_reportFields['generated_by'] = Input::get('generated_by');
		$consolidatedReport = ConsolidatedReports::saveConsolidatedReport($_reportFields);
		
		$_versionFields = array();
		$_versionFields['consolidated_id'] = $consolidatedReport->consolidated_id;
		$_versionFields['table_data'] = json_encode($tableData);
		$_versionFields['flag_current_version'] = true;
		$version = ConsolidatedReportsVersion::saveConsolidatedReportVersion($_versionFields);
		
		Session::flash('success', 'Your report has been successfully consolidated.');
		return Redirect::to('consolidated');
	}
	
	
	public function download ( $id = 0 )
	{
		$currentReport = ConsolidatedReports::getById($id);
		$version = ConsolidatedReportsVersion::getById($id);
		$dataTable = json_decode($version->table_data);
		
		$report = ExcelExporter::formatFileArrays($dataTable);//$this->print_this($report, '$report');exit;
		
		ExcelExporter::exportFileTest($report);
		//$reformattedReport = 
	}
	
	public function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
