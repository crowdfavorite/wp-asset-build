#!/usr/bin/php
<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Sorry pal, this script ain\'t for web.'); }
require_once(realpath(dirname(__FILE__)).'/../config.php');
$builder->write_files();
?>