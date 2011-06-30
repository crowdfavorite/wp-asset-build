<?php
$abspath = realpath(dirname(__FILE__)) . '/';
require_once($abspath . 'lib/Bundler.php');

/* EXAMPLE FUTURE API */
// Create method must push instance into build profiles static property
$bundler = Bundler::create($abspath);

$bundle = new Bundle('/path-to/built/file.js')
	->add('common/js/hoverIntent.js')
	->add('common/js/jquery.cookie.js', array('../img/' => '../../common/img/'))
	->add('common/js/superfish.js');
	->add('common/js/scripts.js');
$bundler->push($bundle);


$bundle1_css = new Bundle('package1/css/build.css');
$bundle1_css->add('common_css', 'common/css/common.css');
$bundle1_css->add('pkg1_css', 'package1/css/main.css');
$bundler->push($bundle1_css);




/* END EXAMPLE */







/* Current api */
$bundle = 'theberrycss';
$bundler->define($bundle, 'theberry/css/build.css');
$bundler->add_to($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add_to($bundle, 'theberry/css/main.css');

$bundle = 'thechivecss';
$bundler->define($bundle, 'thechive/css/build.css');
$bundler->add_to($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add_to($bundle, 'thechive/css/main.css');

$bundle = 'thebrigadecss';
$bundler->define($bundle, 'thebrigade/css/build.css');
$bundler->add_to($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add_to($bundle, 'thebrigade/css/main.css');

$bundle = 'thethrottlecss';
$bundler->define($bundle, 'thethrottle/css/build.css');
$bundler->add_to($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add_to($bundle, 'thethrottle/css/main.css');

$bundler->add_to_build_profiles();
?>