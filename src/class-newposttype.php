<?php
/**
 * The file that defines the new post type class.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-wordpress-plugin-name.php
 */

namespace WordPress_Plugin_Name;

use WordPress_Plugin_Name\Assets;
use Common\PostType;

/**
 * Provide a custom WordPress post type named "New Post Type".
 */
class NewPostType {

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type = 'new-post-type';

	/**
	 * Initialize the class.
	 *
	 * @param string $plugin_file The root plugin file.
	 * @return void
	 */
	public function __construct( protected string $plugin_file ) {
		new PostType( $this->post_type, 'New Post Type', 'New Post Types' );

		new Assets(
			$this->plugin_file,
			array( "single-{$this->post_type}" => 'assets/js/single-new-post-type.js' ),
			array( "single-{$this->post_type}" => 'assets/css/single-new-post-type.css' ),
			fn () => is_singular( $this->post_type ),
		);

		new Assets(
			$this->plugin_file,
			array(),
			array( "archive-{$this->post_type}" => 'assets/css/archive-new-post-type.css' ),
			fn () => is_archive( $this->post_type ),
		);

		add_action(
			'acf/init',
			fn () => include __DIR__ . '/../advanced-custom-fields/new-post-type.php'
		);

		// Single page template file.
		add_filter( 'the_content', array( $this, 'content_template' ) );
		add_filter( 'get_the_excerpt', array( $this, 'disable_content_template' ), 9 );
		add_filter( 'get_the_excerpt', array( $this, 'enable_content_template' ), 11 );

		// Archive page template file.
		add_filter( 'the_excerpt', array( $this, 'excerpt_template' ) );
	}

	/**
	 * Load template files.
	 *
	 * @param string $content The existing page content, originally from the page content editor screen.
	 * @return string
	 */
	public function content_template( $content ) {

		if ( get_post_type() === $this->post_type ) {
			ob_start();
			include __DIR__ . '/../includes/content-new-post-type.php';
			$template = ob_get_clean();
			$content .= $template;
		}

		return $content;
	}

	/**
	 * Add custom fields to the post excerpt
	 *
	 * @param string $excerpt The post excerpt.
	 * @return string
	 */
	public function excerpt_template( $excerpt ) {

		if ( get_post_type() === $this->post_type ) {
			ob_start();
			include __DIR__ . '/../includes/excerpt-new-post-type.php';
			$template = ob_get_clean();
			$excerpt .= $template;
		}

		return $excerpt;
	}

	/**
	 * Unhook the content template when it would be used to generate the post excerpt.
	 *
	 * @param string $excerpt The post excerpt.
	 * @return string
	 */
	public function disable_content_template( $excerpt ) {

		if ( get_post_type() === $this->post_type ) {
			remove_filter( 'the_content', array( $this, 'content_template' ) );
		}
		return $excerpt;
	}

	/**
	 * Rehook the content template after it would be used to generate the post excerpt.
	 *
	 * @param string $excerpt The post excerpt.
	 * @return string
	 */
	public function enable_content_template( $excerpt ) {

		if ( get_post_type() === $this->post_type ) {
			add_filter( 'the_content', array( $this, 'content_template' ) );
		}
		return $excerpt;
	}
}
