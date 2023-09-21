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

if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme' ) ) {
	if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/style.css' ) ) {
		unlink( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/style.css' );
	}

	if ( file_exists( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/index.php' ) ) {
		unlink( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/index.php' );
	}

	rmdir( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme' );
}

mkdir( dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme', 0777, true );

file_put_contents(
	dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/style.css',
	'/*
!
Theme Name: No Theme
Description: Minimal default theme to provide a local development environment.
*/'
);

echo "+ ./wordpress/wp-content/themes/no-theme/style.css\n";

file_put_contents(
	dirname( __DIR__ ) . '/wordpress/wp-content/themes/no-theme/index.php',
	<<<HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
<?php wp_head(); ?>
</head>
<body>
<h1><?php bloginfo( 'name' ); ?></h1>
<h2><?php bloginfo( 'description' ); ?></h2>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h3><?php the_title(); ?></h3>

<?php the_content(); ?>
<?php wp_link_pages(); ?>
<?php edit_post_link(); ?>

<?php endwhile; ?>

<?php
if ( get_next_posts_link() ) {
next_posts_link();
}
?>
<?php
if ( get_previous_posts_link() ) {
previous_posts_link();
}
?>

<?php else: ?>

<p>No posts found. :(</p>

<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
HEREDOC
);

echo "+ ./wordpress/wp-content/themes/no-theme/index.php\n";
