<?php
/**
 * WordPress Plugin Name
 *
 * @package   WordPress_Plugin_Name
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright Zachary K. Watkins 2023
 * @license   GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Name
 * Plugin URI:        https://github.com/zachwatkins/wordpress-plugin-name
 * Description:       A template WordPress plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Zachary K. Watkins
 * Author URI:        https://github.com/zachwatkins
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wordpress-plugin-name-textdomain
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
 * action hook has resolved.
 */
define( 'WORDPRESS_PLUGIN_NAME_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WORDPRESS_PLUGIN_NAME_DIR_FILE', __FILE__ );
define( 'WORDPRESS_PLUGIN_NAME_DIR_PATH', __DIR__ );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

// Load the main class file.
new \WordPress_Plugin_Name\Init( __FILE__, __DIR__ );

if ( 'local' === wp_get_environment_type() && file_exists( __DIR__ . '/local.php' ) && strpos( get_site_url(), 'local' ) !== false ) {
	require __DIR__ . '/local.php';
}
