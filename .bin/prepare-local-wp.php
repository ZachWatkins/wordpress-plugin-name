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

echo "+ ./wordpress/wp-content/mu-plugins/sqlite-database-integration/plugin.php\n";
echo "+ ./wordpress/wp-content/db.php\n";

// Create a symbolic link for the plugin directory.
if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name' ) ) {
	if ( is_file( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name' ) || is_link( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name' ) ) {
		unlink( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name' );
	} else {
		rmdir( dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name' );
	}
}

symlink(
	dirname( __DIR__ ),
	dirname( __DIR__ ) . '/wordpress/wp-content/mu-plugins/wordpress-plugin-name'
);

echo "+ ./wordpress/wp-content/mu-plugins/wordpress-plugin-name -> ./\n";

if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-config-sample.php' ) ) {
	if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-config.php' ) ) {
		unlink( dirname( __DIR__ ) . '/wordpress/wp-config.php' );
	}

	copy(
		dirname( __DIR__ ) . '/wordpress/wp-config-sample.php',
		dirname( __DIR__ ) . '/wordpress/wp-config.php'
	);
}

echo "+ ./wordpress/wp-config.php\n";

if ( ! file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/themes/twentytwentythree' ) ) {
	$temp_dir     = __DIR__;
	$zip_file     = $temp_dir . '/twentytwentythree.zip';
	$zip_resource = fopen( $zip_file, 'w' );

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, 'https://downloads.wordpress.org/theme/twentytwentythree.1.2.zip' );
	curl_setopt( $ch, CURLOPT_FAILONERROR, true );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_FILE, $zip_resource );
	$results = curl_exec( $ch );

	if ( ! $results ) {
		echo 'Error :- ' . curl_error( $ch );
	}

	$zip = new ZipArchive();
	$zip->open( $zip_file );
	$zip->extractTo( dirname( __DIR__ ) . '/wordpress/wp-content/themes/' );
	$zip->close();
	unlink( $zip_file );

	echo "+ ./wordpress/wp-content/themes/twentytwentythree/\n";
}

if ( ! file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/plugins/advanced-custom-fields/' ) ) {
	$temp_dir     = __DIR__;
	$zip_file     = $temp_dir . '/advanced-custom-fields.zip';
	$zip_resource = fopen( $zip_file, 'w' );

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, 'https://downloads.wordpress.org/plugin/advanced-custom-fields.6.2.1.zip' );
	curl_setopt( $ch, CURLOPT_FAILONERROR, true );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_FILE, $zip_resource );
	$results = curl_exec( $ch );

	if ( ! $results ) {
		echo 'Error :- ' . curl_error( $ch );
	}

	$zip = new ZipArchive();
	$zip->open( $zip_file );
	$zip->extractTo( dirname( __DIR__ ) . '/wordpress/wp-content/plugins/' );
	$zip->close();
	unlink( $zip_file );

	echo "+ ./wordpress/wp-content/plugins/advanced-custom-fields/\n";
}
