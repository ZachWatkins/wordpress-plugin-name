<?php
/**
 * The file that initializes custom post types.
 *
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/util/class-posttype-search.php
 * @since      1.0.0
 * @package    WordPress Plugin Name
 * @subpackage Utilities
 */

namespace Plugin_Name\Util;

/**
 * The post type registration class
 *
 * @since 1.0.0
 */
class PostType_SearchForm {

	/**
	 * The plugin directory.
	 *
	 * @var string
	 */
	private $plugin_dir = PLUGIN_NAME_DIR_PATH;

	/**
	 * The plugin directory URL.
	 *
	 * @var string
	 */
	private $plugin_file = PLUGIN_NAME_DIR_FILE;

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type;

	/**
	 * The post type template path.
	 *
	 * @var string
	 */
	private $template;

	/**
	 * The post type title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * The taxonomies to create search filters for.
	 *
	 * @var string[]
	 */
	private $taxonomies;

	/**
	 * The post meta to create search filters for.
	 *
	 * @var string[]
	 */
	private $meta;

	/**
	 * Builds and registers the custom taxonomy.
	 *
	 * @param string $slug       The post type slug.
	 * @param string $title      The title of the post type to use in the search form.
	 * @param string $template   The directory path of the search form template file.
	 * @param array  $taxonomies The taxonomy slugs to create search filters for.
	 * @param array  $meta       The post meta to create search filters for.
	 * @return void
	 */
	public function __construct( $slug, $title, $template, $taxonomies = array() ) {

		// Store parameters to use in hooks.
		$this->post_type  = $slug;
		$this->title      = $title;
		$this->template   = $template;
		$this->taxonomies = $taxonomies;
		$this->meta       = $meta;

		add_filter( 'wp_dropdown_cats', array( $this, 'multi_selected' ), 11, 2 );
		add_filter( 'get_search_form', array( $this, 'add_search_filters' ), 11, 2 );

	}

	/**
	 * If selected taxonomies are an array, add selected property elements.
	 *
	 * @since 1.0.0
	 *
	 * @param string $output      HTML output.
	 * @param array  $parsed_args Arguments used to build the drop-down.
	 */
	public function multi_selected( $output, $parsed_args ) {

		if ( get_post_type() === $this->post_type ) {
			$taxonomy_slug = $parsed_args['taxonomy'];
			if ( ! $this->taxonomies || in_array( $taxonomy_slug, $this->taxonomies, true ) ) {
				$selected = get_query_var( $taxonomy_slug, null );
				if ( is_array( $selected ) && $selected ) {
					foreach ( $selected as $term ) {
						$output = str_replace( "value=\"$term\"", "selected=\"selected\" value=\"$term\"", $output );
					}
				}
			}
		}

		return $output;

	}

	/**
	 * Filters the HTML output of the search form.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form The search form HTML output.
	 * @param array  $args The array of arguments for building the search form.
	 */
	public function add_search_filters( $form, $args ) {

		if ( $this->title === $args['aria_label'] ) {

			$taxonomies     = get_object_taxonomies( $this->post_type, 'objects' );
			$search_filters = array(
				'post-type' => '<input type="hidden" value="' . $this->post_type . '" name="post_type" id="post_type" />',
			);

			// Taxonomy filters.
			foreach ( $taxonomies as $key => $taxonomy ) {
				if ( $this->taxonomies && ! in_array( $key, $this->taxonomies, true ) ) {
					continue;
				}

				$terms = get_terms( array( 'taxonomy' => $key ) );

				if ( is_array( $terms ) && ! empty( $terms ) ) {

					// Show dropdown with values selected if present in URL parameter.
					$args = array(
						'echo'        => 0,
						'id'          => "taxonomy-{$taxonomy->name}",
						'taxonomy'    => $key,
						'name'        => $key,
						'value_field' => 'slug',
						'orderby'     => 'name',
						'multiple'    => true,
					);

					// If the taxonomy URL parameter value is not an array then we can set it here.
					// Otherwise, we must set it with a filter function.
					$selected_query_tax = get_query_var( $key, null );
					if ( ! is_array( $selected_query_tax ) ) {
						$args['selected'] = $selected_query_tax;
					}
					$dropdown = wp_dropdown_categories( $args );

					$search_filters[ $key ] = sprintf(
						'<div class="filter"><label for="taxonomy-%s" class="taxonomy-label">%s</label>%s</div>',
						$taxonomy->name,
						$taxonomy->label,
						$dropdown
					);
				}
			}

			$search_fields = implode( '', $search_filters );
			preg_match( '/^<form[^>]*>(.*)<\/form>$/', $form, $matches );
			// Add search filters.
			$form = str_replace( $matches[1], $search_fields . $matches[1], $form );

		}

		return $form;

	}

}
