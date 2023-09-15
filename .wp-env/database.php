<?php
/**
 * Seed the database.
 */

global $wpdb;

// Set option "seeded" to "true".
$wordpress_theme_seeded = get_option( 'seeded' );
if ( $wordpress_theme_seeded ) {
	echo "Database already seeded.\n";
	return;
}

update_option( 'seeded', true );
echo "Database seeded.\n";
