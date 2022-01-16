<?php
/**
 * The file that defines the core plugin class.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

use \WordPress_Plugin_Name\Assets;
use \ThoughtfulWeb\LibraryWP\Plugin\Activation;
use \ThoughtfulWeb\LibraryWP\Admin\Page\Settings;

/**
 * The core plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  0.1.0
 * @return void
 */
class WordPress_Plugin_Name {

	/**
	 * Initialize the class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function __construct( $root_plugin_file ) {


		/**
		 * Load activation-related hooks.
		 */
		$required_plugins = include dirname( __FILE__, 2 ) . '/config/required-plugins.php';
		if ( $required_plugins ) {
			new \ThoughtfulWeb\LibraryWP\Plugin\Activation\Requirements( $root_plugin_file, $required_plugins );
		}

		/**
		 * Load the settings page.
		 */
		new \ThoughtfulWeb\LibraryWP\Admin\Page\Settings();

		/**
		 * Load page template files.
		 */
		if ( isset( $activation_requirements['templates'] ) ) {
			// new \ThoughtfulWeb\LibraryWP\Theme\Page_Template( $activation_requirements );
		}

		// Load the assets.
		require __DIR__ . '/class-assets.php';
		new \WordPress_Plugin_Name\Assets();

	}
}
