<?php
/**
 * Seed the database.
 */

global $wpdb;

// Set option "seeded" to "true".
$wordpress_theme_seeded = get_option( 'wordpress_plugin_name_seeded' );
if ( $wordpress_theme_seeded ) {
	echo "Database already seeded.\n";
	return;
}

update_option( 'wordpress_plugin_name_seeded', true );
echo "Database seeded.\n";
