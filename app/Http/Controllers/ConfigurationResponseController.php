<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Reports, App\Models\PreparednessResponse, App\Models\PreparednessResponseRow, App\Models\Configuration;
use Input, Validator, Redirect, Request, Session, Form, View;

class ConfigurationResponseController extends Controller {
	
	protected $viewPath = 'pages.configuration.';
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
		$data['records'] = Configuration::getConfigList();
		
		return view($this->viewPath.'list', $data);
	}
	
	/**
	 * View report by id
	 *
	 * @return Response
	 */
	public function view ($id)
	{
		$data = array();
		$config = Configuration::getById($id);
		$data['config'] = $config;
		
		// cells and rows
		$config_string = json_decode($config->configuration_string);
		$data['config_string'] = $config_string;
		
		return view($this->viewPath.'update', $data);
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
	 * Stores the configuration
	 *
	 * @return Response
	 */
	public function store () {
		Configuration::saveConfiguration();
		
		// redirect
		Session::flash('success', 'Your configuration has been successfully saved.');
		return Redirect::to('configuration');
	}

	/**
	 * Updates the configuration
	 *
	 * @return Response
	 */
	public function update () {
		Configuration::updateConfiguration();
		
		// redirect
		Session::flash('success', 'Your configuration has been successfully updated.');
		return Redirect::to('configuration');
	}


	/**
	 * "Delete" Record
	 *
	 * @return Response
	 */
	public function delete( $id = 0 )
	{
		Configuration::deleteRecord($id);
		
		// redirect
		Session::flash('success', 'You have successfully deleted the record.');
		return Redirect::to('configuration/list');
	}

	public function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}
}
