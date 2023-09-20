<?php
/**
 * Prepare the WordPress environment for testing.
 *
 * @package WordPress_Plugin_Name
 */

// Add the SQLite database plugin.
if ( ! is_dir( dirname( __DIR__ ) . '/wordpress/wp-content/' ) ) {
	mkdir( dirname( __DIR__ ) . '/wordpress/wp-content/' );
}

file_put_contents(
	dirname( __DIR__ ) . '/wordpress/wp-content/db.php',
	str_replace(
		array(
			'{SQLITE_IMPLEMENTATION_FOLDER_PATH}',
			'{SQLITE_PLUGIN}',
		),
		array(
			dirname( __DIR__ ) . '/vendor/wordpress/sqlite-database-integration',
			'sqlite-database-integration/load.php',
		),
		file_get_contents( dirname( __DIR__ ) . '/vendor/wordpress/sqlite-database-integration/db.copy' )
	)
);

if ( ! is_dir( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/sqlite-database-integration' ) ) {
	mkdir( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/sqlite-database-integration' );
}

if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/sqlite-database-integration/plugin.php' ) ) {
	unlink( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/sqlite-database-integration/plugin.php' );
}

file_put_contents(
	dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/sqlite-database-integration/plugin.php',
	'<?php
/**
 * Plugin Name: SQLite Database Integration
 * Description: SQLite database driver drop-in.
 * Author: WordPress Performance Team
 * Version: 2.1.1
 * Requires PHP: 5.6
 * Textdomain: sqlite-database-integration
 *
 * This feature plugin allows WordPress to use SQLite instead of MySQL as its database.
 *
 * @package wp-sqlite-integration
 */

require dirname( __FILE__, 5 ) . \'/vendor/wordpress/sqlite-database-integration/load.php\';
'
);

echo "Success: SQLite database driver added.\n";
echo "+ ./wordpress/wp-content/db.php\n";
echo "+ ./wordpress/wp-content/mu-plugins/sqlite-database-integration/plugin.php\n";
