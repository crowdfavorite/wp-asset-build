<?php
/**
 * @package sdac
 * This file is where all the assets for the theme get added.
 *
 * It has two basic modes:
 * Production mode will enqueue the files built using the
 * command line PHP script in build/build.php (see README in the same folder).
 * Developer mode will load in the original, unminified CSS files for development.
 *
 * You can toggle between developer and production mode by setting SDAC_PRODUCTION true/false
 * in functions.php
 *
 * ALWAYS run build.php, turn of developer mode and commit result before deploying.
 */
// Using icky blog global to determine which assets to deliver for now.
global $blog;

cfct_template_file('asset-builder', 'config');

$asset_url = trailingslashit(get_bloginfo('template_url'));

foreach (Bundler::$build_profiles as $bundler) {
	if (!is_admin()) {
		$asset_url_prefix = $asset_url;
		$bundles = $bundler->get_bundles();
		foreach($bundles as $bundle) {
			if (CFCT_PRODUCTION) {
				enqueue_bundle($bundle->get_language(), $bundle->get_bundle_key(), $asset_url_prefix . $bundle->get_bundled_path(), $bundle->get_meta('dependencies'), CFCT_THEME_VERSION);
			}
			else {
				foreach($bundle->get_bundle_items() as $bundle_item) {
					enqueue_bundle($bundle->get_language(), $bundle_item->get_key(), $asset_url_prefix . $bundle_item->get_path(), array(), CFCT_THEME_VERSION);
				}
			}		
		}
	}
}

function enqueue_bundle($language, $key, $path, $dependencies, $version) {
	switch($language) {
		case 'javascript':
			wp_enqueue_script($key, $path, $dependencies, $version);
			break;
		case 'css':
			wp_enqueue_style($key, $path, $dependencies, $version);
			break;
	}
}

// if (SDAC_PRODUCTION) {
// 	$file = $bundler->get_bundled_file($bundle);
// 	wp_enqueue_style($bundle, $asset_url . $file, array(), SDAC_VER, 'screen');
// 
// 	$bundle = 'commonjs';
// 	$file = $bundler->get_bundled_file($bundle);
// 	wp_enqueue_script($bundle, $asset_url . $file, array('jquery'), SDAC_VER);
// }
// else {
// 	$files = $bundler->get_original_files($bundle);
// 	foreach ($files as $file) {
// 		wp_enqueue_style($file, $asset_url . $file, array(), SDAC_VER, 'screen');
// 	}
// 	
// 	$files = $bundler->get_original_files('commonjs');
// 	foreach ($files as $file) {
// 		wp_enqueue_script($file, $asset_url . $file, array('jquery'), SDAC_VER);
// 	}
// }
// 
// wp_enqueue_script( 'google_services', 'http://partner.googleadservices.com/gampad/google_service.js' );
// 
// // Glam ads
// if ($blog['site_name'] == 'TheChive') {
// 	wp_enqueue_script('glam', 'http://www2a.glam.com/mobile/detect.act?affiliateId=420105803', array(), null);
// }
// 
// // "Social"
// wp_enqueue_script('twitter', 'http://platform.twitter.com/widgets.js', array(), null, true);
// wp_enqueue_script('googlebuzz', 'http://www.google.com/buzz/api/button.js', array(), null, true);
// // Digg Widget
// wp_enqueue_script( 'digg', 'http://widgets.digg.com/buttons.js', array(), null, true );
?>