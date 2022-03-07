<?php
/**
 * The file that defines the new post type class.
 *
 * @package    WordPress Plugin Name
 * @subpackage Src
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <zwatkins.it@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

namespace Plugin_Name\Src;

use \Plugin_Name\Util\PostType;
use \Plugin_Name\Util\Taxonomy;

/**
 * The new post type plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  0.1.0
 * @return void
 */
class New_Post_Type {
	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type;

	/**
	 * The post type file name slug.
	 *
	 * @var string
	 */
	private $post_type_filename;

	/**
	 * Initialize the class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function __construct() {

		$this->post_type          = 'new_post_type';
		$this->post_type_filename = 'new-post-type';

		// Register a custom taxonomy.
		$taxonomy_meta = array(
			array(
				'slug' => 'text_field',
				'name' => 'Text Field',
				'type' => 'text',
			),
			array(
				'slug' => 'checkbox_field',
				'name' => 'Checkbox Field',
				'type' => 'checkbox',
			),
			array(
				'slug' => 'link_field',
				'name' => 'Link Field',
				'type' => 'link',
			),
			array(
				'slug' => 'editor_field',
				'name' => 'Editor Field',
				'type' => 'editor',
			),
		);

		new Taxonomy( 'new_taxonomy', 'New Taxonomy', 'New Taxonomies', $this->post_type, array(), $taxonomy_meta, true, true );

		// Register a custom post type.
		new PostType( $this->post_type, 'New Post Type', 'New Post Types', array( 'taxonomies' => array( 'new_taxonomy' ) ) );

		// Register global styles used in the theme.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_public_scripts' ), 10 );

		// Enqueue extension styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts' ), 10 );

		// Register Advanced Custom Fields for the post type.
		add_action( 'acf/init', array( $this, 'acf_files' ) );

		// Single page template file.
		add_filter( 'the_content', array( $this, 'content_template' ) );
		add_filter( 'get_the_excerpt', array( $this, 'disable_content_template' ), 9 );
		add_filter( 'get_the_excerpt', array( $this, 'enable_content_template' ), 11 );

		// Archive page template file.
		add_filter( 'the_excerpt', array( $this, 'excerpt_template' ) );

	}

	/**
	 * Registers public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_script/
	 * @see    https://www.php.net/manual/en/function.filemtime.php
	 * @since  0.1.0
	 * @return void
	 */
	public function register_public_scripts() {

		if ( $this->post_type === get_post_type() ) {

			if ( is_singular( $this->post_type ) ) {

				// Register public styles.
				wp_register_style(
					"single-{$this->post_type_filename}",
					PLUGIN_NAME_DIR_URL . "css/single-{$this->post_type_filename}.css",
					false,
					filemtime( PLUGIN_NAME_DIR_PATH . "css/single-{$this->post_type_filename}.css" ),
					'screen'
				);

				// Register public JavaScript in the site footer with jQuery pre-loaded.
				wp_register_script(
					"single-{$this->post_type_filename}-script",
					PLUGIN_NAME_DIR_URL . "js/single-{$this->post_type_filename}.js",
					array( 'jquery' ),
					filemtime( PLUGIN_NAME_DIR_PATH . "js/single-{$this->post_type_filename}.js" ),
					true
				);

			} elseif ( is_archive( $this->post_type ) ) {

				// Register public styles.
				wp_register_style(
					"archive-{$this->post_type_filename}",
					PLUGIN_NAME_DIR_URL . "css/archive-{$this->post_type_filename}.css",
					false,
					filemtime( PLUGIN_NAME_DIR_PATH . "css/archive-{$this->post_type_filename}.css" ),
					'screen'
				);

			}

		}

	}

	/**
	 * Enqueues public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @since  0.1.0
	 * @return void
	 */
	public function enqueue_public_scripts() {

		if ( $this->post_type === get_post_type() ) {

			if ( is_singular( $this->post_type ) ) {

				wp_enqueue_style( "single-{$this->post_type_filename}" );
				wp_enqueue_script( "single-{$this->post_type_filename}-script" );

			} elseif ( is_archive( $this->post_type ) ) {

				wp_enqueue_style( "archive-{$this->post_type_filename}" );

			}

		}

	}

	/**
	 * Register ACF files.
	 *
	 * @return void
	 */
	public function acf_files() {

		require PLUGIN_NAME_DIR_PATH . '/advanced-custom-fields/new-post-type.php';

	}

	/**
	 * Load template files.
	 *
	 * @param string $content The existing page content, originally from the page content editor screen.
	 *
	 * @return string
	 */
	public function content_template( $content ) {

		if ( $this->post_type === get_post_type() ) {
			// Get the template file contents.
			ob_start();
			include PLUGIN_NAME_DIR_PATH . '/templates/single-new-post-type.php';
			$template = ob_get_clean();
			// Append the template to the editor content.
			$content .= $template;
		}

		return $content;

	}

	/**
	 * Add custom fields to the post excerpt
	 *
	 * @param [type] $excerpt
	 * @return void
	 */
	public function excerpt_template( $excerpt ) {
		if ( $this->post_type === get_post_type() ) {
			ob_start();
			include PLUGIN_NAME_DIR_PATH . '/templates/archive-new-post-type.php';
			$template = ob_get_clean();
			$excerpt .= $template;
		}

		return $excerpt;

	}

	public function disable_content_template( $excerpt ) {
		if ( $this->post_type === get_post_type() ) {
			remove_filter( 'the_content', array( $this, 'content_template' ) );
		}
		return $excerpt;
	}

	public function enable_content_template( $excerpt ) {
		if ( $this->post_type === get_post_type() ) {
			add_filter( 'the_content', array( $this, 'content_template' ) );
		}
		return $excerpt;
	}
}
