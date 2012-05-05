<?php defined('SYSPATH') or die('No direct script access.');

/**
 * HTML Helper
 * An extension to Kohana's built in HTML helper that over-loads the css() and script()
 * functions to automatically use Assets.
 *
 * @package 	Assets
 * @category 	Helpers
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */
class Assets_HTML extends Kohana_HTML
{
	/**
	 * @var 	Assets 		Instance of the Assets class used to combine and minify.
	 */
	protected static $_assets;
	
	/**
	 * Creates a style sheet link element.
	 *
	 *     echo HTML::style('media/css/screen.css');
	 *
	 * [!!] Will make use of the Assets library to combine and minify.
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function style($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		self::construct_assets();
		self::$_assets->add($file);
		return parent::style($file, $attributes, $protocol, $index);
	}
	
	/**
	 * Creates a script link.
	 *
	 *     echo HTML::script('media/js/jquery.min.js');
	 *
	 * [!!] Will make use of Assets to combine and minify scripts.
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function script($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		self::construct_assets();
		self::$_assets->add($file);
		return parent::script($file, $attributes, $protocol, $index);
	}
	
	/**
	 * Compiles CSS files and generates the <link rel> tag to output.
	 *
	 * @return 	string
	 */
	public static function compiled_css()
	{
		return parent::style(self::$_assets->url_for_asset(self::$_assets->compile_css()));
	}
	
	/**
	 * Compiles JS files and generates the <script> tag to output.
	 *
	 * @return 	string
	 */
	public static function compiled_js()
	{
		return self::$_assets->compile_js();
	}
	
	/**
	 * Creates the Assets instance if it hasn't been already.
	 */
	public static function construct_assets()
	{
		if(!isset(self::$_assets) || !self::$_assets instanceof Assets)
		{
			self::$_assets = new Assets();
		}
	}
}