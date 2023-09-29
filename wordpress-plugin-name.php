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

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly request this file in your browser.' );
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/assets.php';
require __DIR__ . '/src/shortcode.php';

const VERSION   = '1.0.0';
const ROOT_FILE = __FILE__;

enqueue_js( 'src/assets/js/public.js' );
enqueue_css( 'src/assets/css/public.css' );

register_shortcode( 'my-shortcode', 'src/views/my-shortcode.php' );
new NewPostType();
new \ThoughtfulWeb\SettingsPageWP\Page();
