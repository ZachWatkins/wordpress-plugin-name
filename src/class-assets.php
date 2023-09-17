<?php
/**
 * The file that registers the plugin's publicly available CSS and/or JS files.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.`com`>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-assets.php
 */

namespace WordPress_Plugin_Name;

/**
 * The class that registers public web assets.
 */
class Assets {

	/**
	 * The base name of the plugin file.
	 *
	 * @var string
	 */
	protected string $prefix = '';

	/**
	 * Initialize the class
	 *
	 * @param string $plugin_file The root plugin file.
	 * @param string $plugin_dir The root plugin directory.
	 * @param array  $js_paths The paths to the JS files to be registered.
	 * @param array  $css_paths The paths to the CSS files to be registered.
	 * @return void
	 */
	public function __construct(
		protected string $plugin_file,
		protected string $plugin_dir,
		protected array $js_paths = array(),
		protected array $css_paths = array(),
	) {

		$this->prefix = basename( $this->plugin_file, '.php' );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_public_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts' ) );
	}

	/**
	 * Registers public scripts.
	 *
	 * @return void
	 */
	public function register_public_scripts() {

		foreach ( $this->css_paths as $key => $path ) {
			wp_register_style(
				"{$this->prefix}-{$key}-style",
				plugin_dir_url( $this->plugin_file ) . $path,
				array(),
				filemtime( "{$this->plugin_dir}{$path}" ),
				'screen'
			);
		}

		foreach ( $this->js_paths as $path ) {
			wp_register_script(
				"{$this->prefix}-{$key}-script",
				plugin_dir_url( $this->plugin_file ) . $path,
				array(),
				filemtime( "{$this->plugin_dir}{$path}" ),
				true
			);
		}
	}

	/**
	 * Enqueues public scripts.
	 *
	 * @return void
	 */
	public function enqueue_public_scripts() {

		foreach ( $this->css_paths as $key => $path ) {
			wp_enqueue_style( "{$this->prefix}-{$key}-style" );
		}
		foreach ( $this->js_paths as $key => $path ) {
			wp_enqueue_script( "{$this->prefix}-{$key}-script" );
		}
	}
}
