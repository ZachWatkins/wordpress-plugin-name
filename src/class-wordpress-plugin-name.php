<?php
/**
 * The file that defines the core plugin class.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

/**
 * The core plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  0.1.0
 * @return void
 */
class WordPress_Plugin_Name {

	/**
	 * Base directory for the plugin.
	 *
	 * @var string $basedir The directory of the root plugin file.
	 */
	private static $basedir = WP_PLUGIN_INTRO_DIR_PATH;

	/**
	 * Initialize the class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function __construct() {

		// Load the assets.
		require_once self::$basedir . 'src/class-assets.php';
		new WordPress_Plugin_Name\Assets();

	}
}
