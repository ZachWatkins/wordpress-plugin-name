<?php
/**
 * Register a custom post type.
 *
 * @package WordPress_Plugin_Name
 */

namespace WordPress_Plugin_Name;

register_activation_hook(
	PLUGIN_FILE,
	function () {
		flush_rewrite_rules();
	}
);

register_deactivation_hook(
	PLUGIN_FILE,
	function () {
		unregister_post_type( POST_TYPE_KEY );
		flush_rewrite_rules();
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
						PLUGIN_URL . 'src/assets/js/single-new-post-type.js',
						array(),
						filemtime( PLUGIN_DIR . 'src/assets/js/single-new-post-type.js' ),
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
						PLUGIN_URL . 'src/assets/css/single-new-post-type.css',
						array(),
						filemtime( PLUGIN_DIR . 'src/assets/css/single-new-post-type.css' )
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
						PLUGIN_URL . 'src/assets/css/archive-new-post-type.css',
						array(),
						filemtime( PLUGIN_DIR . 'src/assets/css/archive-new-post-type.css' )
					);
				}
			}
		);

		add_filter(
			'the_content',
			function ( $content ) {
				if ( ! is_singular( POST_TYPE_KEY ) ) {
					return $content;
				}
				$props = (object) array( 'content' => $content );
				ob_start();
				include 'views/content-new-post-type.php'; // Uses $props.
				return ob_get_clean();
			}
		);

		add_filter(
			'the_excerpt',
			function ( $excerpt ) {
				if ( get_post_type() !== POST_TYPE_KEY || is_singular( POST_TYPE_KEY ) ) {
					return $excerpt;
				}
				$props = (object) array( 'excerpt' => $excerpt );
				ob_start();
				include 'views/excerpt-new-post-type.php'; // Uses $props.
				return ob_get_clean();
			}
		);
	}
);
