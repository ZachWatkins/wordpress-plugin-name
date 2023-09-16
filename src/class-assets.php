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
	 * The plugin directory.
	 *
	 * @var string
	 */
	private $plugin_dir = WORDPRESS_PLUGIN_NAME_DIR_PATH;

	/**
	 * The plugin directory URL.
	 *
	 * @var string
	 */
	private $plugin_dir_url = WORDPRESS_PLUGIN_NAME_DIR_URL;

	/**
	 * Initialize the class
	 *
	 * @see    https://developer.wordpress.org/reference/functions/add_action/
	 * @return void
	 */
	public function __construct() {

		// Register global styles used in the theme.
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Enqueue extension styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Register global styles used in the theme.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_public_scripts' ) );

		// Enqueue extension styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts' ) );
	}

	/**
	 * Registers admin scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_style/
	 * @see    https://www.php.net/manual/en/function.filemtime.php
	 * @since  1.0.0
	 * @return void
	 */
	public function register_admin_scripts() {

		wp_register_style(
			'wordpress-plugin-name-admin',
			"{$this->plugin_dir_url}/assets/css/admin.css",
			false,
			filemtime( "{$this->plugin_dir}/assets/css/admin.css" ),
			'screen'
		);
	}

	/**
	 * Enqueues admin scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_style( 'wordpress-plugin-name-admin' );
	}

	/**
	 * Registers public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_script/
	 * @see    https://www.php.net/manual/en/function.filemtime.php
	 * @since  1.0.0
	 * @return void
	 */
	public function register_public_scripts() {

		// Register public styles.
		wp_register_style(
			'wordpress-plugin-name-public',
			"{$this->plugin_dir_url}/assets/css/public.css",
			false,
			filemtime( "{$this->plugin_dir}/assets/css/public.css" ),
			'screen'
		);

		// Register public JavaScript in the site footer with jQuery pre-loaded.
		wp_register_script(
			'wordpress-plugin-name-public-script',
			"{$this->plugin_dir_url}/assets/js/public.js",
			array( 'jquery' ),
			filemtime( "{$this->plugin_dir}/assets/js/public.js" ),
			true
		);
	}

	/**
	 * Enqueues public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_public_scripts() {

		wp_enqueue_style( 'wordpress-plugin-name-public' );
		wp_enqueue_script( 'wordpress-plugin-name-public-script' );
	}
}
