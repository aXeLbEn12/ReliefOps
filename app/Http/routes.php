<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# site pages
Route::get('/', 'ReportsController@index');
Route::get('home', 'ReportsController@index');

# preparedness response
Route::get('preparedness_response/new', 'PreparednessResponseController@add');
Route::get('preparedness_response/', 'PreparednessResponseController@index');
Route::get('preparedness_response/list', 'PreparednessResponseController@index');
Route::get('preparedness_response/view/{id}', 'PreparednessResponseController@view_report');
Route::get('preparedness_response/download/{file}', 'PreparednessResponseController@filename');
Route::post('preparedness_response/upload', 'PreparednessResponseController@upload');

# configuration
Route::get('configuration/', 'ConfigurationResponseController@index');
Route::get('configuration/list', 'ConfigurationResponseController@index');
Route::get('configuration/new', 'ConfigurationResponseController@add');
Route::post('configuration/store', 'ConfigurationResponseController@store');
Route::get('configuration/view/{id}', 'ConfigurationResponseController@view');
Route::get('configuration/delete/{id}', 'ConfigurationResponseController@delete');
Route::post('configuration/update/{id}', 'ConfigurationResponseController@update');

# reports
Route::get('reports/', 'ReportsController@index');
Route::get('reports/list', 'ReportsController@index');
Route::get('reports/new', 'ReportsController@add');
Route::get('reports/view/{id}', 'ReportsController@view_report');
Route::get('reports/delete/{id}', 'ReportsController@delete');
Route::get('reports/view_datatable/{id}', 'ReportsController@view_datatable');
Route::get('reports/download/{file}', 'ReportsController@filename');
Route::post('reports/upload', 'ReportsController@upload');
Route::post('reports/update_report/{id}', 'ReportsController@update_report');
Route::get('reports/view_file_version/{file_id}/{version_id}', 'ReportsController@view_file_version');
Route::post('reports/savereport', 'ReportsController@savereport');
Route::get('reports/consolidated/{report_id}', 'ReportsController@consolidated');
Route::get('reports/test', 'ReportsController@test');
Route::get('reports/download/{file}/{filename}', 'ReportsController@download');


Route::get('reports/view1/{id}', 'ReportsController@view1');
Route::post('reports/addfileversion/{id}', 'ReportsController@addfileversion');




































$data = array();
/*$data['dining_result'][] = array(
	'id'				=> '18231',
	'code'				=> 'quick-battles-hokkaido-ramen-santouka-vs-mendokoro-ramenba-shio-ramen',
	'thumbnail'			=> '/article_images/0017/2334/qb_ramen.jpg',
	'title'				=> 'Quick Battles: Hokkaido Ramen Santouka vs. Mendokoro Ramenba Shio Ramen',
	'author'			=> 'Juice.ph Team',
	'category'			=> 'dining',
	'post_date'			=> 'October 5, 2015',
	'excerpt'			=> "For this month's Quick Battles, we're taking on everyone's favorite rainy weather comfort food:ramen!",
	'content'			=> '',
	'url'				=> '/features/quick-battles-hokkaido-ramen-santouka-vs-mendokoro-ramenba-shio-ramen',
);

$data['dining_result'][] = array(
	'id'				=> '41543',
	'code'				=> 'quick-battles-ramen-daisho-vs-kichitora-of-tokyo',
	'thumbnail'			=> '/article_images/0017/2016/carousel1.jpg',
	'title'				=> 'Quick Battles: Ramen Daisho vs. Kichitora of Tokyo',
	'author'			=> 'Juice.ph Team',
	'category'			=> 'dining',
	'post_date'			=> 'September 23, 2015',
	'excerpt'			=> "For this month's Quick Battles, we're taking on everyone's favorite rainy weather comfort food: ramen!",
	'content'			=> '',
	'url'				=> '/dining/features/quick-battles-ramen-daisho-vs-kichitora-of-tokyo',
);

$data['dining_result'][] = array(
	'id'				=> '8532',
	'code'				=> 'quick-battles-ippudo-vs-ramen-nagi',
	'thumbnail'			=> '/article_images/0017/1974/ramen.jpg',
	'title'				=> 'Quick Battles: Ippudo vs. Ramen Nagi',
	'author'			=> 'Juice.ph Team | Photos by Julian Rodriguez',
	'category'			=> 'dining',
	'post_date'			=> 'September 17, 2015',
	'excerpt'			=> "For this month's Quick Battles, we're taking on everyone's favorite rainy weather comfort food: ramen.",
	'content'			=> '',
	'url'				=> '/dining/features/quick-battles-ippudo-vs-ramen-nagi',
);*/


/*$data['movie_result'][] = array(
	'id'				=> '5234',
	'thumbnail'			=> '/article_images/0017/2263/movie_poster_black_mass.jpg',
	'code'				=> 'black-mass',
	'title'				=> 'Black Mass',
	'trailer_link'		=> '/movies/trailer/black-mass',
	'category'			=> 'movies',
	'runing_time'		=> '2 hrs. 10 mins.',
	'rating'			=> 'R-16',
	'excerpt'			=> "The true story of Whitey Bulger, the brother of a state senator and the most infamous violent criminal in the history of South Boston, who became an FBI informant to take down a Mafia family invading his turf. ",
	'content'			=> '',
	'url'				=> '/movies/movie/black-mass',
);

$data['movie_result'][] = array(
	'id'				=> '5231',
	'thumbnail'			=> '/article_images/0017/2727/movie_poster_operator.jpg',
	'code'				=> 'operator',
	'title'				=> 'Operator',
	'trailer_link'		=> '/movies/trailer/operator',
	'category'			=> 'movies',
	'rating'			=> 'R-13',
	'runing_time'		=> '1 hr. 28 mins.',
	'excerpt'			=> "When the daughter of veteran 911 call center operator Pamela (Mischa Barton), and her estranged husband Jeremy (Luke Goss),",
	'content'			=> '',
	'url'				=> '/movies/movie/operator',
);

$data['movie_result'][] = array(
	'id'				=> '8953',
	'thumbnail'			=> '/article_images/0017/2755/movie_poster_paranormal_activity_the_ghost_dimension.jpg',
	'code'				=> 'paranormal-activity-5-the-ghost-dimension',
	'title'				=> 'Paranormal Activity 5: The Ghost Dimension',
	'trailer_link'		=> '/movies/trailer/paranormal-activity-5-the-ghost-dimension',
	'category'			=> 'movies',
	'rating'			=> 'R-13',
	'runing_time'		=> '1 hr. 37 mins.',
	'excerpt'			=> "Using a special camera that can see spirits, a family must protect their daughter from an evil entity with a sinister plan. ",
	'content'			=> '',
	'url'				=> '/movies/movie/paranormal-activity-5-the-ghost-dimension',
);

echo json_encode($data);
exit;*/










