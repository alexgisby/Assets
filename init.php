<?php defined('SYSPATH') or die('No direct script access.');

//
// Init for the Assets module
//

Route::set('module-assets', 'assets/<asset_filename>')
	->defaults(array(
		'controller'	=> 'assets',
		'action'		=> 'serve',
	));