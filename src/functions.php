<?php
/**
 * Useful functions for WordPress plugins.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

/**
 * Register and enqueue a JS file.
 *
 * @param string $path      The path to the JS file.
 * @param mixed  $condition Optional. A callable function for the condition to be met before registering the assets.
 */
function enqueue_js( string $path, $condition = null ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $condition ) {
			if ( $condition && ! call_user_func( $condition ) ) {
				return;
			}
			wp_enqueue_script(
				handle: basename( dirname( __DIR__ ) ) . '-' . basename( $path, '.js' ),
				src: plugin_dir_url( __FILE__ ) . $path,
				deps: array(),
				ver: filemtime( __DIR__ . '/' . $path ),
				in_footer: true
			);
		}
	);
}

/**
 * Register and enqueue a CSS file.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see https://www.php.net/manual/en/function.call-user-func.php
 *
 * @param string $path The path to the CSS file.
 * @param mixed  $condition Optional. A callable function for the condition to be met before registering the assets.
 */
function enqueue_css( string $path, $condition = null ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $condition ) {
			if ( $condition && ! call_user_func( $condition ) ) {
				return;
			}
			wp_enqueue_style(
				handle: basename( dirname( __DIR__ ) ) . '-' . basename( $path, '.css' ),
				src: plugin_dir_url( __FILE__ ) . $path,
				deps: array(),
				ver: filemtime( __DIR__ . '/' . $path )
			);
		}
	);
}

/**
 * Get the rendered output.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_kses/
 * @see https://www.php.net/manual/en/function.extract.php
 * @see https://www.php.net/manual/en/function.ob-start.php
 * @see https://www.php.net/manual/en/function.ob-get-clean.php
 *
 * @param string $file The path to the PHP file.
 * @param array  $vars Optional. Associative array of variables available to the file.
 * @return string The rendered content.
 */
function render( string $file, $vars ) {
	$vars = array_combine(
		array_map( fn ( $key ) => str_replace( '-', '_', $key ), array_keys( $vars ) ),
		array_values( $vars )
	);
	extract( $vars ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	ob_start();
	include $file;
	$rendered = ob_get_clean();
	return wp_kses( $rendered, 'post' );
}
