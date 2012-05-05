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
					if(file_exists($this->config->css['filesystem_path'] . '/' . $f))
					{
						$this->css[] = $this->config->css['filesystem_path'] . '/'. $f;
					}
				break;
				
				case 'js':
					// Check the file exists:
					if(file_exists($this->config->js['filesystem_path'] . '/' . $f))
					{
						$this->js[] = $this->config->js['filesystem_path'] . '/'. $f;
					}
				break;
			}
		}
	}
	
	/**
	 * Compile the CSS files and return the filename of the output.
	 *
	 * @param 	array 	Options for the compiler. Overrides those in the config file.
	 * @return 	string 	Filename of the output css.
	 */
	public function compile_css(array $options = array())
	{
		// Generate a filename for this lot:
		$filename = '';
		foreach($this->css as $file)
		{
			$filename .= $file . '--' . @filemtime($file);
		}
		
		$filename = sha1($filename) . '.min.css';
		$fullpath = self::cache_dir() . '/' . $filename;

		// Check the cache:
		self::check_cache_dir();
		// if(!file_exists($fullpath))
		// {
			// Doesn't exist, COMPILE ME BABY!
			$compiler_class = 'Compiler_' . $this->config->css['compiler'];
			$compiler = new $compiler_class();
			
			$c_jar = $this->config->css['compiler'] . '_jar';
			$compiler->set_compiler_path($this->config->$c_jar);

			$compiler->add_files($this->css);
			$compiler->set_options(arr::merge($this->config->css['compiler_args'], $options));
			
			$compiler->compile($fullpath);
		// }
		
		return $filename;
	}
	
	/**
	 * Compile the JS files and return the filename of the output.
	 *
	 * @return 	string 	Filename of the output JS.
	 */
	public function compile_js()
	{
		$compiler_class = 'Compiler_' . $this->config->css['compiler'];
		$compiler = new $compiler_class();
		
		$compiler->add_files($this->js);
		
		return sha1(time()) . '.min.js';
	}
	
	
	
	/**
	 * --------------------- Caching ------------------------------
	 */
	
	/**
	 * Returns the cache directory
	 *
	 * @return 	string
	 */
	public static function cache_dir()
	{
		return kohana::$cache_dir . '/assets';
	}
	
	/**
	 * Checks that the cache dir is present and writeable
	 *
	 * @return 	bool
	 */
	public static function check_cache_dir()
	{
		if(!file_exists(self::cache_dir()))
		{
			mkdir(self::cache_dir(), 0777);
			chmod(self::cache_dir(), 0777);
		}
		
		if(!is_writable(self::cache_dir()))
		{
			chmod(self::cache_dir(), 0777);
		}
		
		return file_exists(self::cache_dir()) && is_writable(self::cache_dir());
	}
	
}