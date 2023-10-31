<?php
/**
 * Make changes to the site to set up demo content, etc.
 *
 * @package WordPress_Plugin_Name
 */

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

if ( 'local' !== wp_get_environment_type() || strpos( get_site_url(), 'localhost' ) !== false ) {
	return;
}

// Replace the default page's contents with demo content.
add_action(
	'init',
	function () {
		if ( ! using_default_theme() ) {
			return;
		}

		$demo_post_id = get_or_create_demo_post();

		if ( get_option( 'page_on_front' ) !== $demo_post_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $demo_post_id );
		}
	}
);

/** Get the Post ID for the demo post, and create it if it doesn't exist. */
function get_or_create_demo_post(): int {

	$post_title = 'Plugin Demo Page';
	$query      = new \WP_Query(
		array(
			'post_title'     => $post_title,
			'post_type'      => 'page',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( $query->posts ) {
		return $query->posts[0];
	}

	// Create the demo post.
	return wp_insert_post(
		array(
			'post_title'   => $post_title,
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_content' => '<!-- wp:paragraph -->
<p>This is a post for the custom post type provided by the plugin. You can see output below for the shortcode it provides called "[my-shortcode]".</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[my-shortcode]
<!-- /wp:shortcode -->',
		)
	);
}

/** Detect use of default theme in current site. */
function using_default_theme(): bool {
	$current_theme      = wp_get_theme();
	$wp_themes          = array( 'Twenty Twenty', 'Twenty Twenty-One', 'Twenty Twenty-Two', 'Twenty Twenty-Three', 'Twenty Twenty-Four' );
	$current_theme_name = $current_theme->get( 'Name' );
	return in_array( $current_theme_name, $wp_themes, true );
}
