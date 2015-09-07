<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Reports, App\Models\PreparednessResponse, App\Models\PreparednessResponseRow;
use Input, Validator, Redirect, Request, Session, Form, View;

class PreparednessResponseController extends Controller {
	
	protected $viewPath = 'pages.preparedness_response.';
	protected $moduleName = 'Preparedness Response';

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
		$data['records'] = PreparednessResponse::getActiveReports();
		
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
		$report = PreparednessResponse::getReportById($id);
		$data['report'] = $report;
		$reportRows = PreparednessResponseRow::getReportRowsByReportId($id);
		$data['reportRows'] = $reportRows;
		
		return view($this->viewPath.'view_report', $data);
	}
	
	
	/**
	 * Download file
	 *
	 * @return Response
	 */
	public function download_file ($filename)
	{
		$file = public_path(). "/uploads/{$filename}";
		
		if (File::isFile($file))
		{
			$headers = array(
				'Content-Type: application/pdf',
				'application/octet-stream', // txt etc
				'application/msword', // doc
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
				'application/vnd.ms-excel', // xls
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
				'application/pdf', // pdf
			);
			return Response::download($file, $filename, $headers);
		}
	}
	
	/**
	 * Shows the add report form
	 *
	 * @return Response
	 */
	public function add () {
		$data = array();
		
		return view($this->viewPath.'new', $data);
	}

	/**
	 * Uloads excel file then save data
	 *
	 * @return Response
	 */
	public function upload() {
		$file = array('report' => Input::file('report'));
		$rules = array('report' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		$validator = Validator::make($file, $rules);
		
		if ($validator->fails()) {
			return Redirect::to('preparedness_response/new')->withInput()->withErrors($validator);
		}
		else {
			// checking file is valid.
			if (Input::file('report')->isValid()) {
				$destinationPath = 'uploads'; // upload path
				$extension = Input::file('report')->getClientOriginalExtension();
				$fileName = "preparedness_response_".rand(11111,99999).'_'.date('YmdHis').'.'.$extension;
				$originalName = Input::file('report')->getClientOriginalName();
				Input::file('report')->move($destinationPath, $fileName);
				
				$reportData = array();
				$reportData['fileName'] = $fileName;
				$reportData['originalName'] = $originalName;
				
				// create new report
				$newReport = PreparednessResponse::addNewReport($reportData);
				
				
				// parse and save to db
				Reports::parsePreparednessResponse($destinationPath.'/'.$fileName, $newReport);
				
				Session::flash('success', 'Report successfully uploaded.'); 
				return Redirect::to('preparedness_response/list');
			}
			else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::to('preparedness_response/new');
			}
		}
	}

	public function delete()
	{
		echo "delete not functioning yet.";
	}

	public function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}
}
