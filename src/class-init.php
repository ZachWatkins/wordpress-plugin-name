<?php
/**
 * The file that defines the initial plugin class.
 *
 * @package    WordPress Plugin Name
 * @copyright  Zachary Watkins 2023
 * @author     Zachary Watkins <zwatkins.it@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-init.php
 */

namespace WordPress_Plugin_Name;

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
	 * @return void
	 */
	public function __construct() {

		// Register the assets that load on every page.
		new Assets();

		// Load the settings page.
		new SettingsPage();

		// Create the custom post type with its custom taxonomy.
		new NewPostType();
	}
}
