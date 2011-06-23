<?php
/* Combine files together. Hooray! */
class Bundler {
	public $asset_path;
	public $bundles = array();
	protected static $build_profiles;
	
	/**
	 * @param string $asset_path_prefix a path that asset paths should be prefixed with in order to find them on the file system.
	 */
	public function __construct($asset_path_prefix = '') {
		$this->asset_path = $asset_path_prefix;
	}
	
	/**
	 * We need an easy way to send an instances of Bundler to the build script.
	 * This function, when run, will set the current instance as the instance to be built by the build script.
	 */
	public function add_to_build_profiles() {
		self::$build_profiles[] = $this;
	}
	/**
	 * Static function used by the build script to get bundles to build.
	 */
	public static function get_build_profiles() {
		return self::$build_profiles;
	}

	/**
	 * Define a file bundle
	 * @param string $built_file the file name of the resulting built file
	 * @param array $files the array of file names you want to combine into the built file
	 */
	public function define($bundle, $built_file) {
		$this->bundles[$bundle]['build'] = $built_file;
	}
	
	/**
	 * Add a file to a bundle
	 * @param string $bundle Bundle key
	 * @param string $file File URL
	 * @param array $replacements string replacements for the file
	 */
	public function add_to($bundle, $file, $replacements = array()) {
		$this->bundles[$bundle]['src'][$file]['replacements'] = $replacements;
	}
	
	public function get_bundled_file($bundle) {
		$bundle = $this->bundles[$bundle];
		if (!isset($bundle)) {
			throw new Exception('Bundle "'.$bundle.'" doesn\'t exist', 1);
		}
		return $bundle['build'];
	}
	
	public function get_original_files($bundle = '') {
		$keys = array();
		$bundle = $this->bundles[$bundle];
		if (!isset($bundle)) {
			throw new Exception('Uh-oh! Bundle "'.$bundle.'" doesn\'t exist', 1);
		}

		foreach ($bundle['src'] as $file => $info) {
			$keys[] = $file;
		}

		return $keys;
	}
}
?>