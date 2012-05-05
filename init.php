<?php defined('SYSPATH') or die('No direct script access.');

//
// Init for the Assets module
//

Route::set('module-assets', 'assets/<asset_filename>', array(
		'asset_filename' => '[a-z0-9\-_./]+\.(js|css)',
	))
	->defaults(array(
		'controller'	=> 'assets',
		'action'		=> 'serve',
	));