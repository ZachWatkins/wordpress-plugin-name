<?php
/**
 * Seed the database.
 */
if ( ! defined( 'ABSPATH' ) || 'local' !== wp_get_environment_type() ) {
	die( 'We\'re sorry, but you can not directly access this file nor run it in production.' );
}

global $wpdb;

// Set option "seeded" to "true".
$wordpress_theme_seeded = get_option( 'wordpress_plugin_name_seeded' );
if ( $wordpress_theme_seeded ) {
	echo "Database already seeded.\n";
	return;
}
update_option( 'wordpress_plugin_name_seeded', true );
echo "Database seeded.\n";

// Add a post to the database with the title "Hello, WordPress!" and include the shortcode "my-shortcode" in the content.
$wpdb->insert(
	$wpdb->posts,
	array(
		'post_title'   => 'Hello, WordPress!',
		'post_content' => '[my-shortcode]',
		'post_status'  => 'publish',
		'post_type'    => 'post',
	)
);
