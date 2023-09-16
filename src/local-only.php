<?php
/**
 * LOCAL ONLY development helper features which should never, ever be used in production.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Common
 * @author     Zachary K. Watkins
 * @copyright  Zachary K. Watkins 2023
 * @license    GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) || 'local' !== wp_get_environment_type() ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Output action hook names to the public page in the order they are called.
 * This is a great way to learn how the WordPress action hook system works.
 */
add_action( 'all', 'wordpress_plugin_name_show_all_hooks' );
$wordpress_plugin_name_debug_tags = array();
/**
 * Render the name of an action hook.
 *
 * @param string $tag The name of the action hook.
 * @return void
 */
function wordpress_plugin_name_show_all_hooks( $tag ) {
	// Display Hooks in front end pages only.
	if ( ! ( is_admin() ) ) {
		global $wordpress_plugin_name_debug_tags;
		if ( in_array( $tag, $wordpress_plugin_name_debug_tags, true ) ) {
			return;
		}
		echo wp_kses_post( '<pre>' . $tag . '</pre>' );
		$wordpress_plugin_name_debug_tags[] = $tag;
	}
}
