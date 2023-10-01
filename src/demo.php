<?php
/**
 * Make changes to the site to set up demo content, etc.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

if ( 'local' === wp_get_environment_type() && strpos( get_site_url(), 'localhost' ) !== false && file_exists( __DIR__ . '/local.php' ) ) {
	return;
}

// Replace the default page's contents with demo content.
add_action(
	'init',
	function () {
		// We want to avoid running this function if the plugin is not being developed in isolation from a custom theme.
		$current_theme      = wp_get_theme();
		$wp_themes          = array( 'Twenty Twenty', 'Twenty Twenty-One', 'Twenty Twenty-Two', 'Twenty Twenty-Three', 'Twenty Twenty-Four' );
		$current_theme_name = $current_theme->get( 'Name' );
		if ( ! in_array( $current_theme_name, $wp_themes, true ) ) {
			return;
		}
		// Create the demo post.
		$demo_post_values = array(
			'post_title'   => 'Plugin Demo Page',
			'post_content' => '<!-- wp:paragraph -->
<p>This is a post for the custom post type provided by the plugin. You can see output below for the shortcode it provides called "[my-shortcode]".</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[my-shortcode]
<!-- /wp:shortcode -->',
			'post_status'  => 'publish',
			'post_type'    => POST_TYPE_KEY,
			'post_author'  => 1,
		);
		$demo_post        = new \WP_Query(
			array(
				'post_type'      => POST_TYPE_KEY,
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'post_title'     => $demo_post_values['post_title'],
			)
		);
		if ( empty( $demo_post->posts ) ) {
			$demo_post_id = wp_insert_post( $demo_post_values );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $demo_post_id );
		}
	}
);
