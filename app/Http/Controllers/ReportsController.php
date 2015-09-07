<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Reports, App\Models\PreparednessResponse, App\Models\PreparednessResponseRow, App\Models\Configuration;
use Input, Validator, Redirect, Request, Session, Form, View;

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
		$data['data_table'] = json_decode($report->data_table);//$this->print_this($data, '$data');
		
		return view($this->viewPath.'view_report', $data);
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
	 * Uloads excel file then save data
	 *
	 * @return Response
	 */
	public function upload() {
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
				
				// get config
				$config = Configuration::getById(Input::get('config_id'));
				
				$reportData = array();
				$reportData['fileName'] = $fileName;
				$reportData['originalName'] = $originalName;
				
				// create new report
				$newReport = Reports::addNewReport($reportData);
				
				
				// parse and save to db
				Reports::parseReport($destinationPath.'/'.$fileName, $newReport, $config);
				
				Session::flash('success', 'Report successfully uploaded.'); 
				return Redirect::to('reports/list');
			}
			else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::to('reports/new');
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
