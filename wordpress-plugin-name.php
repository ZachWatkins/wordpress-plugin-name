<?php
/**
 * WordPress Plugin Name
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.com>
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 *
 * @wordpress-plugin-name
 * Plugin Name:       WordPress Plugin Name
 * Plugin URI:        https://github.com/zachwatkins/wordpress-plugin-name
 * Description:       An introduction to WordPress plugin development.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Zachary Watkins
 * Author URI:        https://github.com/zachwatkins
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wordpress-plugin-name
 * Update URI:        https://github.com/zachwatkins/wordpress-plugin-name
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Unique global constants available to any file in this plugin, and the entire
 * WordPress installation once it has loaded. They must be prefixed with letters
 * or words specific to your plugin to associate them with your plugin in the global
 * constant space. Other plugins and themes can use them after the 'after_setup_theme'
 * action hook.
 *
 * @see https://developer.wordpress.org/reference/functions/plugin_dir_url/
 * @see https://www.php.net/manual/en/function.dirname.php
 */
define( 'WORDPRESS_PLUGIN_NAME_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WORDPRESS_PLUGIN_NAME_DIR_FILE', __FILE__ );
define( 'WORDPRESS_PLUGIN_NAME_DIR_PATH', __DIR__ );

// Register PHP class names for autoloading.
require __DIR__ . '/vendor/autoload.php';

// Apply plugin activation requirements.
new \ThoughtfulWeb\ActivationRequirementsWP\Plugin();

// Load the main class file.
new \WordPress_Plugin_Name\Init();
