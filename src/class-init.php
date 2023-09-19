<?php
/**
 * The file that defines the initial plugin class.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-init.php
 */

namespace WordPress_Plugin_Name;

use WordPress_Plugin_Name\Shortcode;
use WordPress_Plugin_Name\Assets;
use WordPress_Plugin_Name\NewPostType;
use ThoughtfulWeb\SettingsPageWP\Page as SettingsPage;

/**
 * The core plugin Class.
 *
 * @return void
 */
class Init {

	/**
	 * Initialize the class.
	 *
	 * @param string $plugin_file The root plugin file.
	 * @param string $plugin_dir The root plugin directory.
	 * @return void
	 */
	public function __construct(
		protected string $plugin_file,
		protected string $plugin_dir
	) {

		// Register a shortcode.
		new Shortcode( 'my-shortcode' );

		// Register the assets that load on every page.
		new Assets(
			$this->plugin_file,
			array( 'assets/js/public.js' ),
			array( 'assets/css/public.css' )
		);

		// Load the settings page.
		new SettingsPage();

		// Create the custom post type with its custom taxonomy.
		new NewPostType(
			$this->plugin_file,
		);
	}
}
