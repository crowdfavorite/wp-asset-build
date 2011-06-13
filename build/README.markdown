build.php is a very simple build script designed to take groups of CSS or JS files and combine them into a built file.

## What it has going for it

- Combines files
- Works on the command line
- PHP!

## What it doesn't

`build.php` does not:

- Try to do smart path rewriting for URLs, by itself. You can, however, specify a list of string replacements for each bundle.
- Do any kind of path error checking -- it's up to you to make sure things make sense.
- Strip whitespace characters
- Strip comments
- Make you coffee

## How to use it

First, set up some bundles using the bundle() method. For example, if your Builder instance is called $builder:

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