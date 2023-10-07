<?php
/**
 * Assets helper functions.
 *
 * @package ZW\WP
 */

namespace ZW\WP;

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
				basename( dirname( __DIR__ ) ) . '-' . basename( $path, '.js' ),
				plugin_dir_url( __FILE__ ) . $path,
				array(),
				filemtime( __DIR__ . '/' . $path ),
				true
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
				basename( dirname( __DIR__ ) ) . '-' . basename( $path, '.css' ),
				plugin_dir_url( __FILE__ ) . $path,
				array(),
				filemtime( __DIR__ . '/' . $path )
			);
		}
	);
}
