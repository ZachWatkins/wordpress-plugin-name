<?php
/**
 * WordPress Plugin Name
 *
 * @package   WordPress_Plugin_Name
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright Zachary K. Watkins 2023
 * @license   GPL-2.0-or-later
 * @see       https://developer.wordpress.org/reference/functions/
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

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly request this file in your browser.' );
}

require 'library/index.php';

const PLUGIN_FILE   = __FILE__;
const PLUGIN_KEY    = 'wordpress-plugin-name';
const POST_TYPE_KEY = 'custom_post_type';
define( 'WordPress_Plugin_Name\PLUGIN_URL', plugin_dir_url( __FILE__ ) . 'src' );

require 'src/shortcode.php';
require 'src/post-type.php';
require 'src/demo.php';
