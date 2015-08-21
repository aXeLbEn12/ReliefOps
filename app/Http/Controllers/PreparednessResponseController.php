<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
		return view('home');
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
				$extension = Input::file('report')->getClientOriginalExtension(); // getting report extension
				$fileName = "preparedness_response_".rand(11111,99999).'_'.date('YmdHis').'.'.$extension; // renameing report
				Input::file('report')->move($destinationPath, $fileName); // uploading file to given path
				echo '$fileName: '.$fileName.'<br />';
				// then save to database
				exit;
				
				Session::flash('success', 'Upload successfully'); 
				return Redirect::to('preparedness_response/new');
			}
			else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::to('preparedness_response/new');
			}
		}
	}

	
	public function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}
}
