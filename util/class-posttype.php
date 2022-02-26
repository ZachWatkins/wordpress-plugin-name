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

namespace WordPress_Plugin;

/**
 * The post type registration class
 *
 * @since 1.0.0
 * @return void
 */
class PostType {

	/**
	 * Post type slug
	 *
	 * @var search_file
	 */
	private $post_type;

	/**
	 * Builds and registers the custom taxonomy.
	 *
	 * @param  string $slug       The post type slug.
	 * @param  array  $singular   The singular post label.
	 * @param  array  $plural     The plural post label.
	 * @param  array  $taxonomies The taxonomies this post type supports. Accepts arguments found in
	 *                            WordPress core register_post_type function.
	 * @param  string $icon       The icon used in the admin navigation sidebar.
	 * @param  array  $user_args  Additional user arguments which override all others for the function register_post_type.
	 * @return void
	 */
	public function __construct( $slug, $singular, $plural, $icon = 'dashicons-portfolio', $args = array() ) {

		// Backend labels.
		$labels = array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'add_new'            => __( 'Add New', 'wordpress-plugin-name' ),
			'add_new_item'       => __( 'Add New', 'wordpress-plugin-name' ) . " $singular",
			'edit_item'          => __( 'Edit', 'wordpress-plugin-name' ) . " $singular",
			'new_item'           => __( 'New', 'wordpress-plugin-name' ) . " $singular",
			'view_item'          => __( 'View', 'wordpress-plugin-name' ) . " $singular",
			'search_items'       => __( 'Search', 'wordpress-plugin-name' ) . " $plural",
			/* translators: placeholder is the plural taxonomy name */
			'not_found'          => sprintf( esc_html__( 'No %d Found', 'wordpress-plugin-name' ), $plural ),
			/* translators: placeholder is the plural taxonomy name */
			'not_found_in_trash' => sprintf( esc_html__( 'No %d found in trash', 'wordpress-plugin-name' ), $plural ),
			'parent_item_colon'  => '',
			'menu_name'          => $plural,
		);

		// Post type arguments.
		$defaults = array(
			'can_export'         => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'labels'             => $labels,
			'menu_icon'          => $icon,
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
			'rewrite'            => array(
				'with_front' => true,
				'slug'       => $slug,
				'feeds'      => true,
			),
			'delete_with_user' => false,
		);
		$args = array_merge( $defaults, $args );

		// Register the post type.
		register_post_type( $slug, $args );

	}

}
