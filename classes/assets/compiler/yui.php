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
		$this->set_options(array(
			'--type'	=> 'css',
			'-o' 		=> $filename
		));
		
		// Combine the file down:
		$tmpfile = $this->combine_files();
		
		$cmd = 'java -jar ' . escapeshellarg($this->compiler_path) . ' ' . $this->compile_options() . ' ' . escapeshellarg($tmpfile);
		$output = shell_exec($cmd);
		
		if($output != NULL)
		{
			// Something went wrong.
			throw new Kohana_Exception('YUI failed with message: ' . $output);
		}
		
		// Kill the tmp file to be tidy:
		unlink($tmpfile);
		
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
			'-o',
			'--type',
		);
	}
}