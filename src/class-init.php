<?php
/**
 * The file that defines the initial plugin class.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
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

		// Register the assets that load on every page.
		new Assets(
			$this->plugin_file,
			array( 'assets/js/public.js' ),
			array( 'assets/css/public.css' )
		);

		// Register a shortcode.
		new Shortcode( 'my-shortcode' );

		// Create the custom post type with its custom taxonomy.
		new NewPostType( $this->plugin_file );

		// Load the settings page.
		new SettingsPage();
	}
}
