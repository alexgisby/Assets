<?php defined('SYSPATH') or die('No direct script access.');

/**
 * YUI Compiler Implementation for Assets module.
 *
 * @package 	Assets
 * @category 	Compilers
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */
class Assets_Compiler_Yui extends Assets_Compiler
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
	 * Valid option flags for YUI
	 *
	 * @return 	array
	 */
	protected function valid_options()
	{
		return array(
				
		);
	}
}