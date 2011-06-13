<?php
$abspath = realpath(dirname(__FILE__)) . '/';
require_once($abspath . 'build/Bundler.php');

$builder = new Bundler($abspath);

$bundle = 'commonjs';
$bundler->define($bundle, 'common/js/build.js');
$bundler->add($bundle, 'common/js/hoverIntent.js');
$bundler->add($bundle, 'common/js/jquery.cookie.js');
$bundler->add($bundle, 'common/js/superfish.js');
$bundler->add($bundle, 'common/js/scripts.js');

$bundle = 'theberrycss';
$bundler->define($bundle, 'theberry/css/build.css');
$bundler->add($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add($bundle, 'theberry/css/main.css');

$bundle = 'thechivecss';
$bundler->define($bundle, 'thechive/css/build.css');
$bundler->add($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add($bundle, 'thechive/css/main.css');

$bundle = 'thebrigadecss';
$bundler->define($bundle, 'thebrigade/css/build.css');
$bundler->add($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add($bundle, 'thebrigade/css/main.css');

$bundle = 'thethrottlecss';
$bundler->define($bundle, 'thethrottle/css/build.css');
$bundler->add($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$bundler->add($bundle, 'thethrottle/css/main.css');
?>