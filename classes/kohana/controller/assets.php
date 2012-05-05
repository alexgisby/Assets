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
		
		$pathinfo = pathinfo($path);
		
		// Output the files contents, along with the right headers:
		$expirytime = strtotime($config->cache_control[$pathinfo['extension']]);
		$seconds	= $expirytime - time();
		
		$this->response->headers(array(
			'Expires' 		=> gmdate('D, d M Y H:i:s \G\M\T', $expirytime),
		));
		
		switch($pathinfo['extension'])
		{
			case 'css':
				$this->response->headers('Content-Type', 'text/css');
			break;
			
			case 'js':
				$this->response->headers('Content-Type', 'application/javascript');
			break;
		}
		
		$this->response->body(file_get_contents($path));
	}
}