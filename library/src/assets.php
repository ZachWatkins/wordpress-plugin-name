<?php
/**
 * Assets helper functions.
 *
 * @package ThoughtfulWeb\WP
 * @copyright  Zachary K. Watkins 2023
 * @author     Zachary K. Watkins <zwatkins.it@gmail.com
 * @license    GPL-2.0-or-later
 */

/**
 * Register and enqueue a JS file.
 *
 * @param string $path        The path to the JS file.
 * @param string $plugin_file Absolute path to the plugin file.
 * @return void
 */
function twwp_enqueue_js( string $path, string $plugin_file ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $plugin_file ) {
			wp_enqueue_script(
				basename( dirname( $plugin_file ) ) . '-' . basename( $path, '.js' ),
				plugin_dir_url( $plugin_file ) . $path,
				array(),
				filemtime( dirname( $plugin_file ) . '/' . $path ),
				true
			);
		}
	);
}

/**
 * Register and enqueue a CSS file.
 *
 * @param string $path        The path to the CSS file.
 * @param string $plugin_file Absolute path to the plugin file.
 */
function twwp_enqueue_css( string $path, string $plugin_file ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $plugin_file ) {
			wp_enqueue_style(
				basename( dirname( $plugin_file ) ) . '-' . basename( $path, '.css' ),
				plugin_dir_url( $plugin_file ) . $path,
				array(),
				filemtime( dirname( $plugin_file ) . '/' . $path )
			);
		}
	);
}

/**
 * Register and enqueue a JS file.
 *
 * @param string $path        The path to the JS file.
 * @param mixed  $condition   Optional. A callable function for the condition to be met before registering the assets.
 * @param string $plugin_file Absolute path to the plugin file.
 * @return void
 */
function twwp_enqueue_js_if( string $path, $condition = null, string $plugin_file ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $plugin_file, $condition ) {
			if ( ! call_user_func( $condition ) ) {
				return;
			}
			wp_enqueue_script(
				basename( dirname( $plugin_file ) ) . '-' . basename( $path, '.js' ),
				plugin_dir_url( $plugin_file ) . $path,
				array(),
				filemtime( dirname( $plugin_file ) . '/' . $path ),
				true
			);
		}
	);
}

/**
 * Register and enqueue a CSS file.
 *
 * @param string $path        The path to the CSS file.
 * @param mixed  $condition   Optional. A callable function for the condition to be met before registering the assets.
 * @param string $plugin_file Absolute path to the plugin file.
 */
function twwp_enqueue_css_if( string $path, $condition = null, string $plugin_file ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $plugin_file, $condition ) {
			if ( ! call_user_func( $condition ) ) {
				return;
			}
			wp_enqueue_style(
				basename( dirname( $plugin_file ) ) . '-' . basename( $path, '.css' ),
				plugin_dir_url( $plugin_file ) . $path,
				array(),
				filemtime( dirname( $plugin_file ) . '/' . $path )
			);
		}
	);
}
