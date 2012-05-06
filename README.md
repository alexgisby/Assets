# Assets

Assets is a module for Kohana 3.2+ which will combine and minify your CSS and Javascript automatically using either [YUI compressor](http://developer.yahoo.com/yui/compressor/) or [Google Closure](https://developers.google.com/closure/compiler/).

Assets are compiled on the fly, and if you're using Kohana's HTML helper to render CSS and Javascript, it should only be two extra lines of code!

## Why should I do this?

- Lower bandwidth usage on your servers
- Fewer HTTP requests
- Faster page loads
- Better Google Page Ranks (due to improved performance)
- Easily abstract away assets for CDN level caching.

# Requirements

- Kohana 3.2+ (currently, will probably back-port to 3.1 and 3.0 in the future)
- PHP to have shell_exec() permission
- Java on host machine (to run compilers)
- Both .jar compiler files to have exec permissions (most errors will come from that)

## How does it do it?

Google Closure and YUI are compressors which can remove whitespace and other extraneous bits and pieces. This module also combines all your files into a single one for compression.

# How to use

Use the Kohana HTML helper to add CSS and Javascript to the page as normal, and then after all the
scripts and styles are on the page, add their compiled tags in:

	<html>
		<head>
			<?php echo html::style('css/bootstrap.css'); ?>
			<?php echo html::style('css/main.css'); ?>
			<?php echo html::compiled_css(); ?>
		</head>
		
		<body>
		
			<?php echo html::script('js/main.js'); ?>
			<?php echo html::compiled_js(); ?>
		</body>
	</html>

By default, on your development environment, everything will render out as separate tags, but when you push to testing or above,
the module will combine and compile all those files in one go.

On subsequent page renders, the module will only recompile the assets if something has changed, meaning you only incur a performance hit on
the first page load by the first person to hit the new resources.

# How the files are served

The files are served through a controller so as to add far-future expiration headers to the content. See the init.php file for the Route.

# Configuration?

The config is set up to give you maximum power and choice. Within the config you can define:

- Path to the compilers (if you don't want to use the in-built ones)
- Different compilers for CSS and JS (defaults to YUI for CSS and Closure for JS)
- Default compiler flags for either compiler
- Expiry dates for content

# Can I use my own compiler?

Yeah sure, the compilers are designed to be plug-and-play, so check out the source for the YUI and Closure compiler adapters in the module. Adding your own is as easy as extending Assets_Compiler and filling in the abstract methods.

# More documentation?

Sorry, the module is a bit sparse on docs at the moment, all the classes are fully PHPDoc'd so use the userguide API browser.

# License

The portions written by me are MIT licensed. See the individual compilers for their licenses.

# Author

Alex Gisby [@alexgisby](http://twitter.com/alexgisby)