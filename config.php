<?php
$abspath = realpath(dirname(__FILE__)) . '/';
require_once($abspath . 'lib/Bundler.php');

/* EXAMPLE API */
$bundler = Bundler::create($abspath);

$bundle1_css = new Bundle('package1/css/build.css');
$bundle1_css->add('common_css', 'common/css/common.css')
			->add('pkg1_css', 'package1/css/main.css');
$bundler->push($bundle1_css);

$bundle2_css = new Bundle('package2/css/build.css');
$bundle2_css->add('common_css', 'common/css/common.css')
			->add('pkg2_css', 'package2/css/main.css');
$bundler->push($bundle2_css);

$bundle3_css = new Bundle('package3/css/build.css');
$bundle3_css->add('common_css', 'common/css/common.css')
	->add('pkg3_css', 'package3/css/main.css');
$bundler->push($bundle3_css);

/* END EXAMPLE */

?>