<?php
/**
 * The file that registers the plugin's publicly available CSS and/or JS files.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly request this file in your browser.' );
}

/**
 * Register and enqueue a JS file.
 *
 * @param string $path The path to the JS file.
 * @param mixed  $callback Optional. A callable function for the condition to be met before registering the assets.
 */
function enqueue_js( string $path, $callback = null ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $callback ) {
			if ( $callback && ! call_user_func( $callback ) ) {
				return;
			}
			wp_enqueue_script(
				basename( ROOT_FILE, '.php' ) . '-' . basename( $path, '.js' ),
				plugin_dir_url( ROOT_FILE ) . $path,
				array(),
				filemtime( dirname( ROOT_FILE ) . '/' . $path ),
				true
			);
		}
	);
}

/**
 * Register and enqueue a CSS file.
 *
 * @param string $path The path to the CSS file.
 * @param mixed  $callback Optional. A callable function for the condition to be met before registering the assets.
 */
function enqueue_css( string $path, $callback = null ): void {
	add_action(
		'wp_enqueue_scripts',
		function () use ( $path, $callback ) {
			if ( $callback && ! call_user_func( $callback ) ) {
				return;
			}
			wp_enqueue_style(
				basename( ROOT_FILE, '.php' ) . '-' . basename( $path, '.css' ),
				plugin_dir_url( ROOT_FILE ) . $path,
				array(),
				filemtime( dirname( ROOT_FILE ) . '/' . $path ),
				'screen'
			);
		}
	);
}
