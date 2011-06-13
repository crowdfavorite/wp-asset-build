<?php
/* Combine files together. Hooray! */
class Bundler {
	public $asset_path;
	public $bundles = array();
	
	/**
	 * @param string $asset_path_prefix a path that asset paths should be prefixed with in order to find them on the file system.
	 */
	public function __construct($asset_path_prefix = '') {
		$this->asset_path = $asset_path_prefix;
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

	/**
	 * Call this from the build script. It writes the resulting files.
	 */
	public function write_files() {
		foreach ($this->bundles as $bundle) {
			$built = '';
			foreach ($bundle['src'] as $file => $info) {
				$filepath = $this->asset_path . $file;

				if (!file_exists($filepath)) {
					throw new Exception('D\'oh! File "'.$filepath.'" could not be found.', 1);
				}

				$file_contents = file_get_contents($filepath);
				
				// Do string replacements
				$file_contents = strtr($file_contents, $info['replacements']);
				
				$built .= $file_contents;
			}

			$file = fopen($this->asset_path . $bundle['build'], 'w');
			fwrite($file, $built);
			fclose($file);
		}
	}
}
?>