<?php
/**
 * The file that initializes custom post types
 *
 * A class definition that registers custom post types with their attributes
 *
 * @link       https://github.com/zachwatkins/wordpress-plugin/blob/master/src/class-posttype.php
 * @since      1.0.0
 * @package    wordpress-plugin
 * @subpackage wordpress-plugin/src
 */

namespace Plugin_Name\Util;

/**
 * The post type registration class
 *
 * @since 1.0.0
 * @return void
 */
class PostType {

	/**
	 * Default post type registration arguments.
	 *
	 * @var array
	 */
	private $default_args = array(
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'          => 'dashicons-portfolio',
		'menu_position'      => 20,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_rest'       => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'show_in_nav_menus'  => true,
		'show_ui'            => true,
		'supports'           => array(
			'editor',
			'author',
			'custom-fields',
			'page-attributes',
		),
		'delete_with_user' => false,
	);

	/**
	 * Arguments defined in the class constructor parameter.
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type;

	/**
	 * Single post template.
	 *
	 * @var $single_template
	 */
	private $single_template;

	/**
	 * Archive post template.
	 *
	 * @var $archive_template
	 */
	private $archive_template;

	/**
	 * Builds and registers the custom taxonomy.
	 *
	 * @param  string $slug     The post type slug.
	 * @param  array  $singular The singular post label.
	 * @param  array  $plural   The plural post label.
	 * @param  array  $args     Additional user arguments which override all others for the function register_post_type.
	 * @param  array  $templates  {
	 *     The post type templates for archive or single views.
	 *     @key string $single  The single post template.
	 *     @key string $archive The archive post template.
	 * }
	 * @return void
	 */
	public function __construct( $slug, $singular, $plural, $args = array(), $templates = array() ) {

		// Store parameters to use in hooks.
		$this->post_type = $slug;
		$this->args      = $args;

		// Create default post type labels argument if not defined in the args parameter.
		if ( ! isset( $args['labels'] ) ) {
			$labels                       = array(
				'name'               => $plural,
				'singular_name'      => $singular,
				'add_new'            => __( 'Add New', 'wordpress-plugin-name' ),
				'add_new_item'       => __( 'Add New', 'wordpress-plugin-name' ) . " $singular",
				'edit_item'          => __( 'Edit', 'wordpress-plugin-name' ) . " $singular",
				'new_item'           => __( 'New', 'wordpress-plugin-name' ) . " $singular",
				'view_item'          => __( 'View', 'wordpress-plugin-name' ) . " $singular",
				'search_items'       => __( 'Search', 'wordpress-plugin-name' ) . " $plural",
				/* translators: placeholder is the plural taxonomy name */
				'not_found'          => sprintf( esc_html__( 'No %s Found', 'wordpress-plugin-name' ), $plural ),
				/* translators: placeholder is the plural taxonomy name */
				'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'wordpress-plugin-name' ), $plural ),
				'parent_item_colon'  => '',
				'menu_name'          => $plural,
			);
			$this->default_args['labels'] = $labels;
		}

		// Register the post type.
		add_action( 'init', array( $this, 'register' ) );

		// Register post type templates.
		if ( ! empty( $templates ) ) {
			// Render single template.
			if ( isset( $templates['single'] ) ) {
				$this->single_template = $templates['single'];
				add_filter( 'single_template', array( $this, 'get_single_template' ) );
			}

			// Render archive template.
			if ( isset( $templates['archive'] ) ) {
				$this->archive_template = $templates['archive'];
				add_filter( 'archive_template', array( $this, 'get_archive_template' ) );
			}
		}

	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function register() {

		$args = array_merge( $this->default_args, $this->args );
		register_post_type( $this->post_type, $args );

	}

	/**
	 * Shows which single template is needed
	 *
	 * @param  string $single_template The default single template.
	 * @return string
	 */
	public function get_single_template( $single_template ) {

		if ( $this->post_type === get_query_var( 'post_type' ) ) {

			$single_template = PLUGIN_NAME_DIR_PATH . $this->single_template;

		}

		return $single_template;

	}

	/**
	 * Shows which archive template is needed
	 *
	 * @param  string $archive_template The default archive template.
	 * @return string
	 */
	public function get_archive_template( $single_template ) {

		if ( $this->post_type === get_query_var( 'post_type' ) ) {

			$archive_template = PLUGIN_NAME_DIR_PATH . $this->archive_template;

		}

		return $archive_template;

	}

}
