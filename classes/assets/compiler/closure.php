<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Compiler for Google Closure with Assets module.
 *
 * @package 	Assets
 * @category 	Compilers
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */
class Assets_Compiler_Closure extends Assets_Compiler
{
	/**
	 * Compile the files!
	 *
	 * @param 	string 	Output filename
	 * @return 	this
	 */
	public function compile($filename)
	{
		return $this;
	}
	
	
	/**
	 * Valid option flags for Closure
	 *
	 * @return 	array
	 */
	protected function valid_options()
	{
		return array(
				
		);
	}
}