<?php
/**
 * WordPress Plugin Name
 *
 * @package   WordPress_Plugin_Name
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright Zachary K. Watkins 2023
 * @license   GPL-2.0-or-later
 * @see       https://developer.wordpress.org/reference/functions/
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Name
 * Plugin URI:        https://github.com/zachwatkins/wordpress-plugin-name
 * Description:       A template WordPress plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Zachary K. Watkins
 * Author URI:        https://github.com/zachwatkins
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wordpress-plugin-name-textdomain
 * Update URI:        https://github.com/zachwatkins/wordpress-plugin-name
 */

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly request this file in your browser.' );
}

const VERSION       = '1.0.0';
const PLUGIN_KEY    = 'wordpress-plugin-name';
const POST_TYPE_KEY = 'custom_post_type';

require 'vendor/autoload.php';
require 'src/demo.php';

add_shortcode(
	'my-shortcode',
	function ( $atts ) {
		wp_enqueue_script(
			PLUGIN_KEY . '-my-shortcode-script',
			plugin_dir_url( __FILE__ ) . 'src/assets/js/my-shortcode.js',
			array(),
			filemtime( __DIR__ . '/src/assets/js/my-shortcode.js' ),
			true
		);

		wp_enqueue_style(
			PLUGIN_KEY . '-my-shortcode-style',
			plugin_dir_url( __FILE__ ) . 'src/assets/css/my-shortcode.css',
			array(),
			filemtime( __DIR__ . '/src/assets/css/my-shortcode.css' )
		);

		return render(
			'src/views/my-shortcode.php',
			shortcode_atts( array( 'id' => 'my-shortcode' ), $atts )
		);
	}
);

add_action(
	'init',
	function () {
		register_post_type(
			POST_TYPE_KEY,
			array(
				'labels'           => array(
					'singular_name' => 'Custom Post Type',
					'name'          => 'Custom Post Types',
				),
				'description'      => 'Demonstrate how to provide a custom post type.',
				'public'           => true,
				'show_in_rest'     => true,
				'menu_position'    => 20,
				'menu_icon'        => 'dashicons-portfolio',
				'supports'         => array(
					'title',
					'editor',
					'author',
					'custom-fields',
					'page-attributes',
					'excerpt',
				),
				'has_archive'      => true,
				'rewrite'          => array( 'slug' => 'custom-posts' ),
				'delete_with_user' => false,
			),
		);

		add_action(
			'wp_enqueue_scripts',
			function () {
				if ( is_singular( POST_TYPE_KEY ) ) {
					wp_enqueue_script(
						PLUGIN_KEY . '-single-' . POST_TYPE_KEY,
						plugin_dir_url( __FILE__ ) . 'src/assets/js/single-new-post-type.js',
						array(),
						filemtime( __DIR__ . '/src/assets/js/single-new-post-type.js' ),
						true
					);
				}
			}
		);

		add_action(
			'wp_enqueue_scripts',
			function () {
				if ( is_singular( POST_TYPE_KEY ) ) {
					wp_enqueue_style(
						PLUGIN_KEY . '-single-' . POST_TYPE_KEY,
						plugin_dir_url( __FILE__ ) . 'src/assets/css/single-new-post-type.css',
						array(),
						filemtime( __DIR__ . '/src/assets/css/single-new-post-type.css' )
					);
				}
			}
		);

		add_action(
			'wp_enqueue_scripts',
			function () {
				if ( is_post_type_archive( POST_TYPE_KEY ) ) {
					wp_enqueue_style(
						PLUGIN_KEY . '-single-' . POST_TYPE_KEY,
						plugin_dir_url( __FILE__ ) . 'src/assets/css/archive-new-post-type.css',
						array(),
						filemtime( __DIR__ . '/src/assets/css/archive-new-post-type.css' )
					);
				}
			}
		);

		add_filter(
			'the_content',
			function ( $content ) {
				if ( is_singular( POST_TYPE_KEY ) ) {
					return render( 'src/views/content-new-post-type.php', array( 'content' => $content ) );
				}
				return $content;
			}
		);

		add_filter(
			'the_excerpt',
			function ( $excerpt ) {
				if ( get_post_type() === POST_TYPE_KEY && ! is_singular( POST_TYPE_KEY ) ) {
					return render( 'src/views/excerpt-new-post-type.php', array( 'excerpt' => $excerpt ) );
				}
				return $excerpt;
			}
		);
	}
);

register_activation_hook(
	__FILE__,
	function () {
		flush_rewrite_rules();
	}
);

register_deactivation_hook(
	__FILE__,
	function () {
		unregister_post_type( POST_TYPE_KEY );
		flush_rewrite_rules();
	}
);

// External library loaded from Composer to provide a settings page for the plugin.
new \ThoughtfulWeb\SettingsPageWP\Page( 'config/thoughtful-web/settings.json' );

/**
 * Get the rendered output.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_kses/
 * @see https://www.php.net/manual/en/function.extract.php
 * @see https://www.php.net/manual/en/function.ob-start.php
 * @see https://www.php.net/manual/en/function.ob-get-clean.php
 *
 * @param string $file The path to the PHP file.
 * @param array  $props Associative array of variable names and values available to the file.
 * @return string The rendered HTML.
 */
function render( string $file, $props ) {
	$props = array_combine(
		array_map( fn ( $key ) => str_replace( '-', '_', $key ), array_keys( $props ) ),
		array_values( $props )
	);
	extract( $props ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	ob_start();
	include $file;
	$rendered = ob_get_clean();
	return wp_kses( $rendered, 'post' );
}
