# Assets

Assets is a Kohana module for collecting your CSS and Javascript files together, minifying them and (probably)
gzipping them.

**This module is under heavy development and may not actually do anything it claims to.**

## Why should I do this?

- Lower bandwidth usage on your servers
- Fewer HTTP requests
- Faster page loads
- Better Google Page Ranks (due to improved performance)
- Easily abstract away assets for CDN level caching.

## How does it do it?

Assets uses the fantastic [JShrink PHP Library](http://code.google.com/p/jshrink-/) to minify Javascript.
Will probably expand to use YUI compressor if Java is available at a later date.

Uses it's own custom CSS minifier which strips comments and whitespace.

# Under Construction

Like I said above. Unstable codebase. Don't rely on it!