<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

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
	public static function parsePreparednessResponse ( $file ) {
        try {
            Excel::load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    self::print_this($row, '$row');
                }
            });
            //\Session::flash('success', 'Users uploaded successfully.');
            //return redirect(route('users.index'));
        } catch (\Exception $e) {
			self::print_this($e->getMessage(), 'error: ');
            //Session::flash('error', $e->getMessage());
            //return redirect(route('users.index'));
        }
	}
	
	public static function print_this ( $array = array(), $title = '' ) {
		echo "<hr />{$title}<pre>";
		print_r($array);
		echo "</pre>";
	}

}
