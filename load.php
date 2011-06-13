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

require_once(TEMPLATEPATH . '/assets/config.php');
$bundle = $blog['slug'] ? $blog['slug'] . 'css' : 'thechivecss';
$asset_url = trailingslashit(get_bloginfo('template_url')).'assets/';

if (SDAC_PRODUCTION) {
	$file = $builder->get_bundle_built($bundle);
	wp_enqueue_style($bundle, $asset_url . $file, array(), SDAC_VER, 'screen');

	$bundle = 'commonjs';
	$file = $builder->get_bundle_built($bundle);
	wp_enqueue_script($bundle, $asset_url . $file, array('jquery'), SDAC_VER);
}
else {
	$files = $builder->get_bundle_src($bundle);
	foreach ($files as $file) {
		wp_enqueue_style($file, $asset_url . $file, array(), SDAC_VER, 'screen');
	}
	
	$files = $builder->get_bundle_src('commonjs');
	foreach ($files as $file) {
		wp_enqueue_script($file, $asset_url . $file, array('jquery'), SDAC_VER);
	}
}

wp_enqueue_script( 'google_services', 'http://partner.googleadservices.com/gampad/google_service.js' );

// Glam ads
if ($blog['site_name'] == 'TheChive') {
	wp_enqueue_script('glam', 'http://www2a.glam.com/mobile/detect.act?affiliateId=420105803', array(), null);
}

// "Social"
wp_enqueue_script('twitter', 'http://platform.twitter.com/widgets.js', array(), null, true);
wp_enqueue_script('googlebuzz', 'http://www.google.com/buzz/api/button.js', array(), null, true);
// Digg Widget
wp_enqueue_script( 'digg', 'http://widgets.digg.com/buttons.js', array(), null, true );
?>