<?php
/* Combine files together. Hooray! */
class Bundler {
	public $asset_path;
	public $bundles = array();
	
	/**
	 * @param string $asset_path the full URL to the assets directory where the files can be found.
	 */
	public function __construct($asset_path = '') {
		$this->asset_path = $asset_path;
	}

	/**
	 * Define a file bundle
	 * @param string $built_file the file name of the resulting built file
	 * @param array $files the array of file names you want to combine into the built file
	 */
	public function define_bundle($bundle, $built_file) {
		$this->bundles[$bundle]['build'] = $built_file;
	}
	
	public function add_to_bundle($bundle, $file, $replacements = array()) {
		$this->bundles[$bundle]['src'][$file]['replacements'] = $replacements;
	}
	
	public function get_bundle_built($bundle) {
		$bundle = $this->bundles[$bundle];
		if (!isset($bundle)) {
			throw new Exception('Bundle "'.$bundle.'" doesn\'t exist', 1);
		}
		return $bundle['build'];
	}
	
	public function get_bundle_src($bundle = '') {
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
	
	/* Call this last. It writes the resulting file */
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