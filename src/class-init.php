<?php

/**
 * The file that defines the initial plugin class.
 *
 * @package    WordPress Plugin Name
 * @subpackage Source
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <zwatkins.it@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-init.php
 * @since      1.0.0
 */

namespace PluginName;

use PluginName\Assets;
use PluginName\NewPostType;
use ThoughtfulWeb\SettingsPageWP\Page as SettingsPage;

/**
 * The core plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  1.0.0
 * @return void
 */
class Init {



	/**
	 * Initialize the class.
	 *
	 * @since  1.0.0
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
