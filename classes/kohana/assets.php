<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Assets Class. This class will automatically combine and minify CSS and Javascript files.
 *
 * @package 	Assets
 * @category 	Classes
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */

class Kohana_Assets
{
	/**
	 * @var 	array 	CSS files to stitch together
	 */
	protected $css = array();
	
	/**
	 * @var 	array 	JS files to stitch together
	 */
	protected $js = array();
	
	/**
	 * @var 	Config 	Config file
	 */
	protected $config = false;
	
	/**
	 * Constructor. Doesn't do much.
	 */
	public function __construct()
	{
		$this->config = kohana::$config->load('assets');
	}
	
	/**
	 * Adds a file or files to the class. Will automatically determine if it's CSS or JS.
	 *
	 * @param 	string|array 	Filename or array of filenames
	 * @return 	this
	 */
	public function add($file)
	{
		if(!is_array($file))
			$file = array($file);
		
		foreach($file as $f)
		{
			$info = pathinfo($f);
			switch($info['extension'])
			{
				case 'css':
					// Check the file exists:
					if(file_exists($this->config->css_filesystem_basepath . '/' . $f))
					{
						$this->css[] = $f;
					}
				break;
				
				case 'js':
					// Check the file exists:
					if(file_exists($this->config->js_filesystem_basepath . '/' . $f))
					{
						$this->js[] = $f;
					}
				break;
			}
		}
	}
	
	/**
	 * Builds the files
	 */
	public function build()
	{
		
	}
	
}