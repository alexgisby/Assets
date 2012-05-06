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
		// Combine the file down:
		$tmpfile = $this->combine_files();
		
		$this->set_options(array(
			'--js'				=> $tmpfile,
			'--js_output_file' 	=> $filename
		));
		
		$cmd = 'java -jar ' . escapeshellarg($this->compiler_path) . ' ' . $this->compile_options() . ' 2>&1';
		$output = shell_exec($cmd);
		
		if($output != NULL)
		{
			// Something went wrong.
			throw new Kohana_Exception('Closure failed with message: ' . $output);
		}
		
		// Kill the tmp file to be tidy:
		unlink($tmpfile);
		
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
			'--js',
			'--js_output_file',
		);
	}
}