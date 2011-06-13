<?php
$abspath = realpath(dirname(__FILE__)) . '/';
require_once($abspath . 'build/Builder.php');

$builder = new Builder($abspath);

$bundle = 'commonjs';
$builder->define_bundle($bundle, 'common/js/build.js');
$builder->add_to_bundle($bundle, 'common/js/hoverIntent.js');
$builder->add_to_bundle($bundle, 'common/js/jquery.cookie.js');
$builder->add_to_bundle($bundle, 'common/js/superfish.js');
$builder->add_to_bundle($bundle, 'common/js/scripts.js');

$bundle = 'theberrycss';
$builder->define_bundle($bundle, 'theberry/css/build.css');
$builder->add_to_bundle($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$builder->add_to_bundle($bundle, 'theberry/css/main.css');

$bundle = 'thechivecss';
$builder->define_bundle($bundle, 'thechive/css/build.css');
$builder->add_to_bundle($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$builder->add_to_bundle($bundle, 'thechive/css/main.css');

$bundle = 'thebrigadecss';
$builder->define_bundle($bundle, 'thebrigade/css/build.css');
$builder->add_to_bundle($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$builder->add_to_bundle($bundle, 'thebrigade/css/main.css');

$bundle = 'thethrottlecss';
$builder->define_bundle($bundle, 'thethrottle/css/build.css');
$builder->add_to_bundle($bundle, 'common/css/main.css', array('../img/' => '../../common/img/'));
$builder->add_to_bundle($bundle, 'thethrottle/css/main.css');
?>