<?php
/**
 * The file that defines the new post type class.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

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
	 * @return void
	 */
	public function __construct() {
		new PostType( $this->post_type, 'New Post Type', 'New Post Types' );

		enqueue_js( 'src/assets/js/single-new-post-type.js', fn () => is_singular( $this->post_type ) );
		enqueue_css( 'src/assets/css/single-new-post-type.css', fn () => is_singular( $this->post_type ) );

		enqueue_css( 'src/assets/css/archive-new-post-type.css', fn () => is_archive( $this->post_type ) );

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
