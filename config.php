<?php
$abspath = realpath(dirname(__FILE__)) . '/';
require_once($abspath . 'lib/Bundler.php');

$bundler = new Bundler($abspath);

$bundle = 'commonjs';
$bundler->define($bundle, 'common/js/build.js');
$bundler->add_to($bundle, 'common/js/hoverIntent.js');
$bundler->add_to($bundle, 'common/js/jquery.cookie.js');
$bundler->add_to($bundle, 'common/js/superfish.js');
$bundler->add_to($bundle, 'common/js/scripts.js');

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