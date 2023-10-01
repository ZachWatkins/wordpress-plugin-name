<?php
/**
 * Demo Site
 *
 * @package   Demo Site
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright Zachary K. Watkins 2023
 * @license   GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Demo Site
 * Description:       Provide default database contents for the demo site as a mu-plugin.
 * Author:            Zachary K. Watkins
 * Author URI:        https://github.com/zachwatkins
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly request this file in your browser.' );
}

// require_once WP_PLUGIN_DIR . '/sqlite-database-integration/wp-includes/sqlite/install-functions.php';
// wp_install(
// 'Tim\'s Truck Parts and Service',
// 'admin',
// 'user@site.local',
// true,
// '',
// 'password'
// );

// add_action(
// 'mu_plugin_loaded',
// function ( $file ) {
// if ( false === strpos( $file, 'demo-site.php' ) ) {
// return;
// }
// if ( ! get_option( 'demo_site' ) ) {
// $blog_title    = 'Tim\'s Truck Parts and Service';
// $user_name     = 'admin';
// $user_email    = 'user@site.local';
// $is_public     = true;
// $user_password = 'password';
// $language      = '';

// wp_cache_flush();
// sqlite_make_db_sqlite();
// populate_options();
// populate_roles();
// update_option( 'blogname', $blog_title );
// update_option( 'admin_email', $user_email );
// update_option( 'blog_public', $is_public );

// Freshness of site - in the future, this could get more specific about actions taken, perhaps.
// update_option( 'fresh_site', 1 );

// if ( $language ) {
// update_option( 'WPLANG', $language );
// }

// $guessurl = wp_guess_url();

// update_option( 'siteurl', $guessurl );

// If not a public site, don't ping.
// if ( ! $is_public ) {
// update_option( 'default_pingback_flag', 0 );
// }

// *
// * Create default user. If the user already exists, the user tables are
// * being shared among sites. Just set the role in that case.
// */
// $user_id        = username_exists( $user_name );
// $user_password  = trim( $user_password );
// $email_password = false;
// $user_created   = false;

// if ( ! $user_id ) {
// $user_id      = wp_create_user( $user_name, $user_password, $user_email );
// $user_created = true;
// }

// $user = new WP_User( $user_id );
// $user->set_role( 'administrator' );

// if ( $user_created ) {
// $user->user_url = $guessurl;
// wp_update_user( $user );
// }

// wp_install_defaults( $user_id );

// wp_install_maybe_enable_pretty_permalinks();

// flush_rewrite_rules();

// wp_cache_flush();

// update_option( 'active_plugins', array( 'wordpress-plugin-name/wordpress-plugin-name.php', 'sqlite-database-integration/load.php' ) );
// update_option( 'demo_site', true );
// }
// },
// 9
// );
