<?php
/**
 * The file that initializes custom post types.
 *
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/util/class-posttype-search.php
 * @since      1.0.0
 * @package    WordPress Plugin Name
 * @subpackage Utilities
 *
 * @todo Allow custom ordering of the taxonomy and meta fields by combining the two parameters into one and requiring a prefix to identify a meta or a term.
 */

namespace Plugin_Name\Util;

/**
 * The post type registration class
 *
 * @since 1.0.0
 */
class PostType_SearchForm {

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private $post_type;

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
	private $meta_keys;

	/**
	 * Builds and registers the custom taxonomy.
	 *
	 * @param string $slug       The post type slug.
	 * @param array  $taxonomies The taxonomy slugs to create search filters for.
	 * @param array  $meta_keys  {
	 *     The meta keys to create search filters for.
	 *     @key string $meta_label The visible label and meta key to use in the search filter.
	 * }
	 * @return void
	 */
	public function __construct( $slug, $taxonomies = array(), $meta_keys = array() ) {

		// Store parameters to use in hooks.
		$this->post_type  = $slug;
		$this->taxonomies = $taxonomies;
		$this->meta_keys  = $meta_keys;

		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		add_filter( 'wp_dropdown_cats', array( $this, 'multi_selected' ), 11, 2 );

	}

	/**
	 * Register taxonomies and meta keys as valid URL parameters.
	 *
	 * @param array $public_query_vars The allowed public query URL parameters.
	 *
	 * @return array
	 */
	public function add_query_vars( $public_query_vars ) {

		foreach ( $this->meta_keys as $key => $meta_key ) {
			$query_param         = is_int( $key ) ? $meta_key : $key;
			$public_query_vars[] = $query_param;
		}

		foreach ( $this->taxonomies as $key => $taxonomy ) {
			$query_param         = is_int( $key ) ? $taxonomy : $key;
			$public_query_vars[] = $query_param;
		}

		return $public_query_vars;

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

		if ( get_post_type() === $this->post_type && strpos( ' multiple', $output ) !== false ) {
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
	 * @return void
	 */
	public function render() {

		$form           = get_search_form( array( 'echo' => false ) );
		$taxonomies     = get_object_taxonomies( $this->post_type, 'objects' );
		$search_filters = array(
			'post-type' => '<input type="hidden" value="' . $this->post_type . '" name="post_type" id="post_type" />',
		);

		// Taxonomy filters.
		if ( $this->taxonomies ) {
			foreach ( $taxonomies as $key => $taxonomy ) {
				if ( ! in_array( $key, $this->taxonomies, true ) ) {
					continue;
				}

				$terms = get_terms( array( 'taxonomy' => $key ) );

				if ( is_array( $terms ) && $terms ) {

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

					// Create the dropdown for the taxonomy.
					$dropdown = wp_dropdown_categories( $args );

					$search_filters[ $key ] = sprintf(
						'<div class="filter"><label for="taxonomy-%s" class="taxonomy-label">%s</label>%s</div>',
						$taxonomy->name,
						$taxonomy->label,
						$dropdown
					);
				}
			}
		}

		if ( $this->meta_keys ) {
			foreach ( $this->meta_keys as $meta_label => $meta_key ) {
				// Get all unique values of the meta key and store them in a transient.
				global $wpdb;
				$unique_values = get_transient( "distinct_meta_{$meta_key}_new_post_type" );
				if ( ! $unique_values ) {
					// @codingStandardsIgnoreStart
					$unique_values = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE pm.meta_key = %s and p.post_type = %s AND p.post_status = 'publish' ORDER BY pm.meta_value", array( $meta_key, $this->post_type ) ), ARRAY_N );
					$unique_values = $unique_values[0];
					set_transient( "distinct_meta_{$meta_key}_wordpress_plugin_name", $unique_values, DAY_IN_SECONDS );
					// @codingStandardsIgnoreEnd
				}

				// Create the search filter options.
				$selected_query_meta = get_query_var( $meta_key, null );
				$dropdown            = "<select name=\"meta-{$meta_key}\"><option value=\"\">Select</option>";
				foreach ( $unique_values as $meta_value ) {
					$selected  = $selected_query_meta !== $meta_value ? '' : ' selected';
					$dropdown .= "<option value=\"{$meta_value}\"{$selected}>{$meta_value}</option>";
				}
				$dropdown                            .= '</select>';
				$search_filters[ "meta_{$meta_key}" ] = "<div class=\"filter\"><label for=\"meta-{$meta_key}\" class=\"meta-label\">{$meta_label}</label>{$dropdown}</div>";
			}
		}

		// Add search filters.
		$search_fields = implode( '', $search_filters );
		preg_match( '/^\s*<form[^>]*>/', $form, $matches );
		$form = str_replace( $matches[0], $matches[0] . $search_fields, $form );

		// Output the form.
		echo wp_kses(
			$form,
			array(
				'form'   => array(
					'role'   => true,
					'method' => true,
					'class'  => true,
					'action' => true,
				),
				'input'  => array(
					'type'  => true,
					'value' => true,
					'name'  => true,
					'id'    => true,
					'class' => true,
				),
				'select' => array(
					'name' => true,
				),
				'option' => array(
					'value' => true,
				),
				'label'  => array(
					'for'   => true,
					'class' => true,
				),
				'div'    => array(
					'class' => true,
				),
			)
		);

	}

}
