<?php
/**
 * The file that initializes custom post types.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Common
 */

namespace Common;

/**
 * The post type registration class
 */
class PostType {

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
	private $plugin_file = WORDPRESS_PLUGIN_NAME_DIR_FILE;

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
			'title',
			'editor',
			'revisions',
			'author',
			'custom-fields',
			'page-attributes',
			'thumbnail',
		),
		'delete_with_user'   => false,
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
	 * @param  string $slug      The post type slug.
	 * @param  array  $singular  The singular post label.
	 * @param  array  $plural    The plural post label.
	 * @param  array  $args      Additional user arguments which override all others for the function register_post_type.
	 * @param  array  $templates {
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
				'add_new'            => __( 'Add New', 'wordpress-plugin-textdomain' ),
				'add_new_item'       => __( 'Add New', 'wordpress-plugin-textdomain' ) . " $singular",
				'edit_item'          => __( 'Edit', 'wordpress-plugin-textdomain' ) . " $singular",
				'new_item'           => __( 'New', 'wordpress-plugin-textdomain' ) . " $singular",
				'view_item'          => __( 'View', 'wordpress-plugin-textdomain' ) . " $singular",
				'search_items'       => __( 'Search', 'wordpress-plugin-textdomain' ) . " $plural",
				/* translators: placeholder is the plural taxonomy name */
				'not_found'          => sprintf( esc_html__( 'No %s Found', 'wordpress-plugin-textdomain' ), $plural ),
				/* translators: placeholder is the plural taxonomy name */
				'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'wordpress-plugin-textdomain' ), $plural ),
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

		// Add an activation hook for flushing rewrite rules.
		// Checks to ensure it is not yet hooked.
		if ( false === has_action( "activate_{$this->plugin_file}", 'flush_rewrite_rules' ) ) {
			register_activation_hook( $this->plugin_file, 'flush_rewrite_rules' );
		}

		// Add a deactivation hook for unregistering the post type and flushing rewrite rules.
		// Checks to ensure it is not yet hooked.
		if ( false === has_action( "deactivate_{$this->plugin_file}", array( $this, 'unregister' ) ) ) {
			register_deactivation_hook( $this->plugin_file, array( $this, 'unregister' ) );
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
	 * Unregister the post type.
	 *
	 * @return void
	 */
	public function unregister() {

		unregister_post_type( $this->post_type );
		flush_rewrite_rules();
	}

	/**
	 * Shows which single template is needed
	 *
	 * @param  string $single_template The default single template.
	 * @return string
	 */
	public function get_single_template( $single_template ) {

		if ( get_query_var( 'post_type' ) === $this->post_type ) {
			$single_template = $this->plugin_dir . '/' . $this->single_template;
		}

		return $single_template;
	}

	/**
	 * Shows which archive template is needed
	 *
	 * @param  string $archive_template The default archive template.
	 * @return string
	 */
	public function get_archive_template( $archive_template ) {

		if ( get_query_var( 'post_type' ) === $this->post_type ) {
			$archive_template = $this->plugin_dir . '/' . $this->archive_template;
		}

		return $archive_template;
	}
}
