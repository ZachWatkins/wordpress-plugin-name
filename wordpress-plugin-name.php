<?php
/**
 * WordPress Plugin Name
 *
 * @package   WordPress_Plugin_Name
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @copyright Zachary K. Watkins 2023
 * @license   GPL-2.0-or-later
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

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/assets.php';
require __DIR__ . '/src/demo.php';

const VERSION   = '1.0.0';
const ROOT_FILE = __FILE__;

enqueue_js( 'src/assets/js/public.js' );
enqueue_css( 'src/assets/css/public.css' );

add_shortcode(
	'my-shortcode',
	function ( $atts ) {
		$atts = shortcode_atts( array( 'id' => 'my-shortcode' ), $atts );
		ob_start();
		include __DIR__ . '/src/views/my-shortcode.php';
		$output = ob_get_clean();
		return wp_kses( $output, 'post' );
	}
);

add_action(
	'init',
	function () {
		// https://developer.wordpress.org/reference/functions/register_post_type/.
		register_post_type(
			'custom_post_type',
			array(
				'label'            => 'Custom Post Types',
				'labels'           => array(
					'name'          => __( 'Custom Post Types', 'wordpress-plugin-name-textdomain' ),
					'singular_name' => __( 'Custom Post Type', 'wordpress-plugin-name-textdomain' ),
				),
				'description'      => 'Custom post type to demonstrate how to add them to a website using a plugin.',
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

		enqueue_js( 'src/assets/js/single-new-post-type.js', fn () => is_singular( 'custom_post_type' ) );
		enqueue_css( 'src/assets/css/single-new-post-type.css', fn () => is_singular( 'custom_post_type' ) );
		enqueue_css( 'src/assets/css/archive-new-post-type.css', fn () => is_post_type_archive( 'custom_post_type' ) );

		add_filter(
			'the_content',
			function ( $content ) {
				if ( get_post_type() === 'custom_post_type' && is_singular( 'custom_post_type' ) ) {
					ob_start();
					include __DIR__ . '/src/views/content-new-post-type.php';
					$template = ob_get_clean();
					$content .= $template;
				}

				return $content;
			}
		);

		add_filter(
			'the_excerpt',
			function ( $excerpt ) {
				if ( get_post_type() === 'custom_post_type' && ! is_singular( 'custom_post_type' ) ) {
					ob_start();
					include __DIR__ . '/src/views/excerpt-new-post-type.php';
					$template = ob_get_clean();
					$excerpt .= $template;
				}

				return $excerpt;
			}
		);
	}
);

register_activation_hook( __FILE__, 'flush_rewrite_rules' );
register_deactivation_hook( __FILE__, fn () => unregister_post_type( 'new_post_type' ) && flush_rewrite_rules() );

new \ThoughtfulWeb\SettingsPageWP\Page();
