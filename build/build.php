#!/usr/bin/php
<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Sorry pal, this script ain\'t for web.'); }

/**
 * http://pwfisher.com/nucleus/index.php?itemid=45
 */
function process_args($argv){
	array_shift($argv); $o = array();
	foreach ($argv as $a){
		if (substr($a,0,2) == '--'){ $eq = strpos($a,'=');
			if ($eq !== false){ $o[substr($a,2,$eq-2)] = substr($a,$eq+1); }
			else { $k = substr($a,2); if (!isset($o[$k])){ $o[$k] = true; } } }
		else if (substr($a,0,1) == '-'){
			if (substr($a,2,1) == '='){ $o[substr($a,1,1)] = substr($a,3); }
			else { foreach (str_split(substr($a,1)) as $k){ if (!isset($o[$k])){ $o[$k] = true; } } } }
		else { $o[] = $a; } }
	return $o;
}
$args = process_args($argv);

/* Get the path to the config file.
The config file is required to include the Bundler class */
$config_path = 'config.php';
if (isset($args['config'])) {
	$config_path = $args['config'];
}
require_once($config_path);

if (!class_exists('Bundler')) {
	throw new Exception('Class Bundler needs to be included in your config file.', 1);
}

/**
 * Call this from the build script. It writes the resulting files.
 */
function write_files($bundler_instance) {
	foreach ($bundler_instance->bundles as $bundle) {
		$built = '';
		foreach ($bundle['src'] as $file => $info) {
			$filepath = $bundler_instance->asset_path . $file;

			if (!file_exists($filepath)) {
				throw new Exception('D\'oh! File "'.$filepath.'" could not be found.', 1);
			}

			$file_contents = file_get_contents($filepath);
			
			// Do string replacements
			$file_contents = strtr($file_contents, $info['replacements']);
			
			$built .= $file_contents;
		}

		$file = fopen($bundler_instance->asset_path . $bundle['build'], 'w');
		fwrite($file, $built);
		fclose($file);
	}
}

$bundler_instances = Bundler::get_build_profiles();
if (empty($bundler_instances)) {
	throw new Exception('You need to run the Bundler add_to_build_profiles() method on at least one Bundler instance.
Otherwise I don\'t know what I should be building.', 1);
}

foreach ($bundler_instances as $bundler) {
	write_files($bundler);
}
?>