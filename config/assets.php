<?php defined('SYSPATH') or die('No direct script access.');

return array(

	/**
	 * ------------- Settings for CSS files ---------------
	 */
	'css' => array(
		/**
		 * Base directory where the CSS files are saved. ie. /var/www/public_html/css
		 */
		'filesystem_path' => '/var/www',
		
		/**
		 * Compressor. Yui is supported out the box, so unless you know what you're doing, keep this as is.
		 */
		'compiler' => 'yui',
		
		/**
		 * Default compiler arguments (YUI)
		 */
		'compiler_args' => array(

		),
	),
	
	/**
	 * ------------- Javascript settings --------------
	 */
	'js' => array(
		/**
		 * Base directory where the JS files are saved. ie. /var/www/public_html/js
		 */
		'filesystem_path' => '/var/www',
		
		/**
		 * Compressor. Yui and Google Closure are supported out the box.
		 */
		'compiler' => 'closure',
		
		/**
		 * Compiler arguments to send on (Closure for example)
		 */
		'compiler_args' => array(
			'--compilation_level' => 'ADVANCED_OPTIMIZATIONS',
		),
	),
	
	/**
	 * Compile on dev or not.
	 * Generally speaking, you won't want to compile on dev all the time, so leave this false.
	 */
	'compile_on_dev' => false,
	
	/**
	 * Path to YUI compressor within a vendor/ folder.
	 */
	'yui_jar' => 'yui/build/yuicompressor-2.4.7',
	
	/**
	 * Path to Closure compressor within a vendor/ folder.
	 */
	'closure_jar' => 'google_closure/compiler',
	
	/**
	 * Cache Control options
	 */
	'cache_control' => array(
		/**
		 * Set a strtotime() friendly string for how far in the future content should be cached for.
		 */
		'css' 	=> '+1 year',
		'js' 	=> '+1 year',
	),
);