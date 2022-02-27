<?php
/**
 * The file that registers the plugin's publicly available CSS and/or JS files.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-assets.php
 * @since      0.1.0
 */

namespace Plugin_Name\Src;

/**
 * The class that registers public web assets.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Assets {

	/**
	 * Initialize the class
	 *
	 * @see    https://developer.wordpress.org/reference/functions/add_action/
	 * @since  0.1.0
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
	 * @since  0.1.0
	 * @return void
	 */
	public function register_admin_scripts() {

		wp_register_style(
			'wordpress-plugin-name-admin',
			PLUGIN_NAME_DIR_URL . 'css/admin.css',
			false,
			filemtime( PLUGIN_NAME_DIR_PATH . 'css/admin.css' ),
			'screen'
		);

	}

	/**
	 * Enqueues admin scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @since  0.1.0
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
	 * @since  0.1.0
	 * @return void
	 */
	public function register_public_scripts() {

		// Register public styles.
		wp_register_style(
			'wordpress-plugin-name-public',
			PLUGIN_NAME_DIR_URL . 'css/style.css',
			false,
			filemtime( PLUGIN_NAME_DIR_PATH . 'css/style.css' ),
			'screen'
		);

		// Register public JavaScript in the site footer with jQuery pre-loaded.
		wp_register_script(
			'wordpress-plugin-name-public-script',
			PLUGIN_NAME_DIR_URL . 'js/public.js',
			array( 'jquery' ),
			filemtime( PLUGIN_NAME_DIR_PATH . 'js/public.js' ),
			true
		);

	}

	/**
	 * Enqueues public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @since  0.1.0
	 * @return void
	 */
	public function enqueue_public_scripts() {

		wp_enqueue_style( 'wordpress-plugin-name-public' );
		wp_enqueue_script( 'wordpress-plugin-name-public-script' );

	}
}
