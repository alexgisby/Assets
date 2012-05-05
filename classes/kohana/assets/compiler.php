<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Base class for Compilers to extend from.
 *
 * @package 	Assets
 * @category 	Compilers
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */
abstract class Kohana_Assets_Compiler
{
	/**
	 * ----------------- Adding files into the compiler ------------------
	 */
	
	/**
	 * @param 	array 	Files to work on
	 */
	protected $files = array();
	
	/**
	 * Sets a file to compress
	 *
	 * @param 	string 	Full path to CSS file.
	 * @return 	this
	 */
	public function add_file($filename)
	{
		$this->files[] = $filename;
		return $this;
	}
	
	/**
	 * Add multiple files into the compiler
	 *
	 * @param 	array 	files
	 * @return 	this
	 */
	public function add_files(array $files)
	{
		foreach($files as $f)
			$this->add_file($f);
		
		return $this;
	}
	
	/**
	 * -------------------- Compiler Operations ---------------------
	 */
	
	/**
	 * @param 	array 	Compiler options.
	 */
	protected $options = array();
	
	/**
	 * Convert the files down into a single, compressed file.
	 *
	 * @param 	string 	Filename to save output to.
	 * @return 	this
	 */
	abstract public function compile($filename);
	
	/**
	 * Sets an option into the compiler.
	 *
	 * @param 	string 	Option name.
	 * @param 	string 	Value
	 * @return 	this
	 */
	public function set_option($name, $value)
	{
		if(in_array($name, $this->valid_options()))
			$this->options[$name] = escapeshellarg($value);
			
		return $this;
	}
	
	/**
	 * Return an array of valid option flags for this compiler.
	 *
	 * @return 	array
	 */
	abstract protected function valid_options();
	
	/**
	 * Bulk setting options to a compiler
	 *
	 * @param 	array 	Key value pairs of options
	 * @return 	this
	 */
	public function set_options(array $options)
	{
		foreach($options as $name => $value)
			$this->set_option($name, $value);
		
		return $this;
	}
}