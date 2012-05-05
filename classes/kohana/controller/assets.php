<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Assets Controller. Serves up the compressed assets with appropriate cache headers.
 *
 * @package 	Assets
 * @category 	Controllers
 * @author		Alex Gisby <alex@solution10.com>
 * @copyright 	Alex Gisby
 * @license 	MIT
 */
class Kohana_Controller_Assets extends Controller
{
	/**
	 * Serving action. Outputs the file with the correct headers and with a far-future
	 * cache time, since when we re-compile we have a unique filename.
	 */
	public function action_serve()
	{
		$filename 	= $this->request->param('asset_filename');
		$path 		= Assets::cache_dir() . '/' . $filename;
		$config 	= kohana::$config->load('assets');
		
		if(!file_exists($path))
		{
			throw new HTTP_Exception_404('Asset not found: ' . $filename);
		}
		
		// Output the files contents, along with the right headers:
		$pathinfo = pathinfo($path);
		$headers = array(
			'Cache-Control' => 'max-age=' . $config->cache_control['max_age'] . ', must-revalidate',
			'Expires' 		=> 
		);
		
		switch($pathinfo['extension'])
		{
			case 'css':
				$headers['Content-Type'] = 'text/css';
			break;
			
			case 'js':
				$headers['Content-Type'] = 'application/javascript';
			break;
		}
		
		// print_r($pathinfo); exit;
		// exit;
	}
}