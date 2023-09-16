<?php
/**
 * The file that defines the new post type class.
 *
 * @package    WordPress Plugin Name
 * @subpackage Source
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <zwatkins.it@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-wordpress-plugin-name.php
 * @since      1.0.0
 */

namespace WordPress_Plugin_Name;

use Common\PostType;
use Common\Taxonomy;
use Common\PostTypeSearchForm;

/**
 * The new post type plugin Class.
 *
 * @since  1.0.0
 * @return void
 */
class NewPostType {


	/**
	 * The plugin directory.
	 *
	 * @var string
	 */
	private $plugin_dir = WORDPRESS_PLUGIN_NAME_DIR_PATH;

	/**
	 * The plugin directory URL.
	 *
	 * @var string
	 */
	private $plugin_dir_url = WORDPRESS_PLUGIN_NAME_DIR_URL;

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type = 'NewPostType';

	/**
	 * The post type file name slug.
	 *
	 * @var string
	 */
	private $post_type_filename = 'new-post-type';

	/**
	 * The post search form.
	 *
	 * @var object
	 */
	private $post_search_form;

	/**
	 * Initialize the class.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct() {

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

		// Add a search form for the new post type.
		$this->post_search_form = new PostTypeSearchForm(
			$this->post_type,
			array( 'new_taxonomy' ),
			array(
				'Field 1' => 'post_field_1',
				'Field 2' => 'post_field_2',
				'Field 3' => 'post_field_3',
			)
		);
		add_action( 'loop_start', array( $this, 'do_search_form' ), 1 );

		// Register Advanced Custom Fields for the post type.
		add_action( 'acf/init', array( $this, 'acf_files' ) );

		// Register styles and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_public_scripts' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts' ), 10 );

		// Single page template file.
		add_filter( 'the_content', array( $this, 'content_template' ) );
		add_filter( 'get_the_excerpt', array( $this, 'disable_content_template' ), 9 );
		add_filter( 'get_the_excerpt', array( $this, 'enable_content_template' ), 11 );

		// Archive page template file.
		add_filter( 'the_excerpt', array( $this, 'excerpt_template' ) );
	}

	/**
	 * Output the post type search form.
	 *
	 * @return void
	 */
	public function do_search_form() {

		$this->post_search_form->render();
	}

	/**
	 * Register ACF files.
	 *
	 * @return void
	 */
	public function acf_files() {

		include "{$this->plugin_dir}/advanced-custom-fields/new-post-type.php";
	}

	/**
	 * Registers public scripts.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_style/
	 * @see    https://developer.wordpress.org/reference/functions/wp_register_script/
	 * @see    https://www.php.net/manual/en/function.filemtime.php
	 * @since  1.0.0
	 * @return void
	 */
	public function register_public_scripts() {

		if ( get_post_type() === $this->post_type ) {
			if ( is_singular( $this->post_type ) ) {

				// Register public styles.
				wp_register_style(
					"single-{$this->post_type_filename}",
					"{$this->plugin_dir_url}/css/single-{$this->post_type_filename}.css",
					false,
					filemtime( "{$this->plugin_dir}/css/single-{$this->post_type_filename}.css" ),
					'screen'
				);

				// Register public JavaScript in the site footer with jQuery pre-loaded.
				wp_register_script(
					"single-{$this->post_type_filename}-script",
					"{$this->plugin_dir_url}/js/single-{$this->post_type_filename}.js",
					array( 'jquery' ),
					filemtime( "{$this->plugin_dir}/js/single-{$this->post_type_filename}.js" ),
					true
				);
			} elseif ( is_archive( $this->post_type ) ) {

				// Register public styles.
				wp_register_style(
					"archive-{$this->post_type_filename}",
					"{$this->plugin_dir_url}/css/archive-{$this->post_type_filename}.css",
					false,
					filemtime( "{$this->plugin_dir}/css/archive-{$this->post_type_filename}.css" ),
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
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_public_scripts() {

		if ( get_post_type() === $this->post_type ) {
			if ( is_singular( $this->post_type ) ) {
				wp_enqueue_style( "single-{$this->post_type_filename}" );
				wp_enqueue_script( "single-{$this->post_type_filename}-script" );
			} elseif ( is_archive( $this->post_type ) ) {
				wp_enqueue_style( "archive-{$this->post_type_filename}" );
			}
		}
	}

	/**
	 * Load template files.
	 *
	 * @param string $content The existing page content, originally from the page content editor screen.
	 *
	 * @return string
	 */
	public function content_template( $content ) {

		if ( get_post_type() === $this->post_type ) {
			// Get the template file contents.
			ob_start();
			include "{$this->plugin_dir}/includes/content-new-post-type.php";
			$template = ob_get_clean();
			// Append the template to the editor content.
			$content .= $template;
		}

		return $content;
	}

	/**
	 * Add custom fields to the post excerpt
	 *
	 * @param string $excerpt The post excerpt.
	 *
	 * @return string
	 */
	public function excerpt_template( $excerpt ) {

		if ( get_post_type() === $this->post_type ) {
			ob_start();
			include "{$this->plugin_dir}/includes/excerpt-new-post-type.php";
			$template = ob_get_clean();
			$excerpt .= $template;
		}

		return $excerpt;
	}

	/**
	 * Unhook the content template when it would be used to generate the post excerpt.
	 *
	 * @param string $excerpt The post excerpt.
	 *
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
	 *
	 * @return string
	 */
	public function enable_content_template( $excerpt ) {

		if ( get_post_type() === $this->post_type ) {
			add_filter( 'the_content', array( $this, 'content_template' ) );
		}
		return $excerpt;
	}
}
