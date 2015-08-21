<?php namespace App\Http\Controllers;

use App\Fileentry;
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
	public function upload () {
 
		$file = Request::file('report');
		$extension = $file->getClientOriginalExtension();
		Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
		$entry = new Fileentry();
		$entry->mime = $file->getClientMimeType();
		$entry->original_filename = $file->getClientOriginalName();
		$entry->filename = $file->getFilename().'.'.$extension;
 
		$entry->save();
 
		return redirect($this->viewPath.'new');
		
	}
}
