<?php
/**
 * WordPress Plugin Name
 *
 * @package WordPress_Plugin_Name
 * @author  Zachary Watkins <watkinza@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 *
 * @wordpress-plugin-name
 * Plugin Name:       WordPress Plugin Name
 * Plugin URI:        https://github.com/zachwatkins/wordpress-plugin-name
 * Description:       An introduction to WordPress plugin development.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.3.5
 * Author:            Zachary Watkins
 * Author URI:        https://github.com/zachwatkins
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wordpress-plugin-name
 * Domain Path:       /languages
 * Update URI:        https://github.com/zachwatkins/wordpress-plugin-name
 */

/**
 * Notes on what is above.
 * - The Domain Path header can be omitted if the plugin is in the official
 *   WordPress Plugin Directory. To be in the official directory, you must use
 *   Subversion instead of Git.
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Unique global constants available to any file in this plugin, and the entire
 * WordPress installation once it has loaded. They must be prefixed with letters
 * or words specific to your plugin to associate them with your plugin in the global
 * constant space. Other plugins and themes can use them after the 'after_setup_theme'
 * action hook.
 */
define( 'WP_PLUGIN_INTRO_DIR_URL', plugin_dir_url( __FILE__ ) . '/' );
define( 'WP_PLUGIN_INTRO_DIR_FILE', __FILE__ );
define( 'WP_PLUGIN_INTRO_DIR_PATH', plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'WP_PLUGIN_INTRO_SRC_PATH', WP_PLUGIN_INTRO_DIR_PATH . 'src' . DIRECTORY_SEPARATOR );
define( 'WP_PLUGIN_INTRO_VIEW_PATH', WP_PLUGIN_INTRO_DIR_PATH . 'views' . DIRECTORY_SEPARATOR );
define( 'WP_PLUGIN_INTRO_TEMPLATE_PATH', WP_PLUGIN_INTRO_DIR_PATH . 'templates' . DIRECTORY_SEPARATOR );
define( 'WP_PLUGIN_INTRO_PREFIX', 'wpi' ); // Used for action and filter hook names unique to this plugin.

/**
 * The core plugin class that is used to initialize the plugin.
 */
require WP_PLUGIN_INTRO_SRC_PATH . 'class-wordpress-plugin-name.php';
new WordPress_Plugin_Name();
