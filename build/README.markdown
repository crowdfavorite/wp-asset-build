`build.php` is a very simple command line build script designed to take groups of CSS or JS files and combine them into a built file.

## What it has going for it

- Combines files
- Works on the command line
- PHP!

## What it doesn't

`build.php` does not:

- ...Try to do smart URL rewriting by itself. You can, however, specify a list of string replacements for each bundle.
- ...Do any kind of path error checking -- it's up to you to make sure things make sense.
- ...Strip whitespace characters.
- ...Strip comments.
- ...Make you coffee.

## How to use it

Each site's configuration will likely be a little different. I've found it useful to structure assets like this:

	assets/
		config.php # Includes Builder.php. Defines the bundles.
		load.php # Includes config.php. Handles enqueueing assets/bundles into WordPress.
		build/
			build.php # Includes config.php. The command-line build script.
			Builder.php # This class keeps track of all the assets, bundles.

Setting up bundles is easy using the `define_bundle()` and `add_to_bundle()` methods. For example:
	
	$builder = new Bundler
	$builder->define_bundle($bundle, 'common/js/build.js');
	$builder->add_to_bundle($bundle, 'common/js/hoverIntent.js');
	
	$builder->bundle('my-built-file-name.css', array(
		'one.css',
		'two.css',
		'three.css'
	));

For the purpose of this project, the bundle method is called automatically based on the array found in assets/config.php. So go there and config it!

In the command line,

	$ cd /path/to/build.php
	
	then...
	
	$ php build.php

That's it! Assuming PHP has write access, new files will be created for each bundle in the same directory as your old development files.