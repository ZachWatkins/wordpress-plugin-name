<?php
/**
 * The file that defines a custom taxonomy
 *
 * @link       https://github.com/zachwatkins/wordpress-plugin/blob/master/src/class-taxonomy.php
 * @since      1.0.0
 * @package    wordpress-plugin`
 * @subpackage wordpress-plugin/src
 */

namespace WordPress_Plugin;

/**
 * Builds and registers a custom taxonomy.
 *
 * @package wordpress-plugin
 * @since 1.0.0
 */
class Taxonomy {

	/**
	 * Taxonomy slug
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    slug $slug Stores taxonomy slug
	 */
	protected $slug;

	/**
	 * Taxonomy meta boxes
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    meta $meta_boxes Stores taxonomy meta boxes
	 */
	protected $meta_boxes = array();

	/**
	 * Taxonomy template file path for the archive page
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    file $template Stores taxonomy archive template file path
	 */
	protected $template;

	/**
	 * Builds and registers the custom taxonomy.
	 *
	 * @param string          $slug         The taxonomy slug.
	 * @param string          $singular     The label in singular form.
	 * @param string          $plural       The label in plural form.
	 * @param string|string[] $post_slug    The slug of the post type where the taxonomy will be added.
	 * @param array           $args         The arguments for taxonomy registration. Accepts    $args for
	 *                                   the WordPress core register_taxonomy function.
	 * @param array           $meta         Array (single or multidimensional) of custom fields to add to a
	 *                                   taxonomy item edit page. Requires 'name', 'slug', and 'type'.
	 * @param boolean         $sortable     Whether the taxonomy should be sortable from the admin dashboard.
	 * @param boolean         $admin_filter Whether the taxonomy has a filter drop-down menu in the admin post list interface.
	 * @param string          $template     The template file path for the taxonomy archive page.
	 * @return void
	 */
	public function __construct( $slug, $singular, $plural, $post_slug, $args = array(), $meta = array(), $sortable = false, $admin_filter = false, $template = null ) {

		// Validate the taxonomy slug before proceeding.
		$this->validate_taxonomy( $slug );

		$this->slug = $slug;

		// Taxonomy labels.
		$labels = array(
			'name'              => $plural,
			'singular_name'     => $singular,
			'search_items'      => __( 'Search', 'wordpress-plugin-name' ) . " $plural",
			'all_items'         => __( 'All', 'wordpress-plugin-name' ) . " $plural",
			'parent_item'       => __( 'Parent', 'wordpress-plugin-name' ) . " $singular",
			'parent_item_colon' => __( 'Parent', 'wordpress-plugin-name' ) . " {$singular}:",
			'edit_item'         => __( 'Edit', 'wordpress-plugin-name' ) . " $singular",
			'update_item'       => __( 'Update', 'wordpress-plugin-name' ) . " $singular",
			'add_new_item'      => __( 'Add New', 'wordpress-plugin-name' ) . " $singular",
			/* translators: placeholder is the singular taxonomy name */
			'new_item_name'     => sprintf( esc_html__( 'New %d Name', 'wordpress-plugin-name' ), $singular ),
			'menu_name'         => $plural,
		);

		// Taxonomy arguments.
		$default_args = array(
			'labels'             => $labels,
			'show_ui'            => true,
			'rewrite'            => array(
				'with_front' => false,
				'slug'       => $slug,
			),
			'show_in_rest'       => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
		);
		$args = array_merge( $default_args, $args );

		// Register the Type taxonomy.
		register_taxonomy( $slug, $post_slug, $args );
		register_taxonomy_for_object_type( $slug, $post_slug );

		// Create taxonomy custom fields.
		// Evaluate if the meta is an array or a nested array.
		if ( ! empty( $meta ) && is_admin() ) {
			$this->add_meta_boxes( $slug, $meta );
		}

		// Make taxonomy sortable.
		if ( $sortable && is_admin() ) {
			$this->make_sortable( $post_slug );
		}

		if ( $admin_filter && is_admin() ) {
			$this->add_admin_dropdown();
		}

		// Add custom template for post taxonomy views.
		if ( ! empty( $template ) ) {
			$this->template = $template;
			add_filter( 'template_include', array( $this, 'template' ) );
		}

	}

	/**
	 * Add actions to render and save custom fields
	 *
	 * @return void
	 */
	public function add_meta_boxes( $slug, $meta ) {
		if ( ! array_key_exists( 0, $meta ) ) {
			$this->meta_boxes[] = $meta;
		} else {
			$this->meta_boxes = $meta;
		}
		add_action( "{$slug}_edit_form_fields", array( $this, 'taxonomy_edit_meta_field' ), 10, 2 );
		add_action( "edited_{$slug}", array( $this, 'save_taxonomy_custom_meta' ), 10, 2 );
	}

	/**
	 * Make the taxonomy sortable.
	 *
	 * @param string|string[] $post_type The post type or types to add filters for.
	 *
	 * @return void
	 */
	public function make_sortable( $post_type ) {
		if ( ! is_array( $post_type ) ) {
			add_filter( "manage_edit-{$post_type}_sortable_columns", array( $this, 'register_sortable_columns' ) );
		} else {
			foreach ( $post_type as $slug ) {
				add_filter( "manage_edit-{$slug}_sortable_columns", array( $this, 'register_sortable_columns' ) );
			}
		}
		add_filter( 'posts_orderby', array( $this, 'taxonomy_orderby' ), 10, 2 );
	}

	/**
	 * Add a filter in the admin interface for the taxonomy.
	 *
	 * @return void
	 */
	private function add_admin_dropdown() {
		add_action( 'restrict_manage_posts', array( $this, 'add_posts_filter' ) );
		add_filter( 'parse_query', array( $this, 'apply_filter_to_query' ) );
	}

	/**
	 * Render custom fields
	 *
	 * @param object $tag      Current taxonomy term object.
	 * @param string $taxonomy Current taxonomy slug.
	 * @return void
	 */
	public function taxonomy_edit_meta_field( $tag, $taxonomy ) {

		// put the term ID into a variable.
		$t_id = $tag->term_id;

		foreach ( $this->meta_boxes as $key => $meta ) {
			// Retrieve the existing value(s) for this meta field. This returns an array.
			$slug      = $meta['slug'];
			$term_meta = get_term_meta( $t_id, "term_meta_{$slug}" );

			?><tr class="form-field term-<?php echo esc_attr( $slug ); ?>-wrap">
				<th scope="row" valign="top"><label for="term_meta_<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $meta['name'] ); ?></label></th>
				<td>
					<?php

					// Make sure the form request comes from WordPress.
					wp_nonce_field( basename( __FILE__ ), "term_meta_{$slug}_nonce" );

					// Output the form field.
					switch ( $meta['type'] ) {
						case 'full':
							$value = $term_meta ? stripslashes( $term_meta ) : '';
							$value = html_entity_decode( $value );
							wp_editor(
								$value,
								'term_meta_' . $slug,
								array(
									'textarea_name' => 'term_meta_' . $slug,
									'wpautop'       => false,
								)
							);
							break;

						case 'link':
							$value  = $term_meta ? stripslashes( $term_meta ) : '';
							$value  = html_entity_decode( $value );
							$output = "<input type=\"url\" name=\"term_meta_{$slug}\" id=\"term_meta_{$slug}\" value=\"{$value}\" placeholder=\"https://example.com\" pattern=\"http[s]?://.*\"><p class=\"description\"" . esc_html_e( 'Enter a value for this field', 'agrilife-degree-programs' ) . '</p>';
							echo wp_kses(
								$output,
								array(
									'input' => array(
										'type'        => array(),
										'name'        => array(),
										'id'          => array(),
										'value'       => array(),
										'placeholder' => array(),
										'pattern'     => array(),
									),
									'p'     => array(
										'class' => array(),
									),
								)
							);
							break;

						case 'checkbox':
							$value  = ! empty( $term_meta ) && 'on' === $term_meta[0] ? 'checked' : '';
							$output = "<input type=\"checkbox\" name=\"term_meta_{$slug}\" id=\"term_meta_{$slug}\" {$value}>";
							echo wp_kses(
								$output,
								array(
									'input' => array(
										'type'    => array(),
										'name'    => array(),
										'id'      => array(),
										'checked' => array(),
									),
								)
							);
							break;

						default:
							$value  = $term_meta ? stripslashes( $term_meta ) : '';
							$value  = html_entity_decode( $value );
							$output = "<input type=\"text\" name=\"term_meta_{$slug}\" id=\"term_meta_{$slug}\" value=\"{$value}\"><p class=\"description\"" . esc_html_e( 'Enter a value for this field', 'wordpress-plugin-textdomain' ) . '</p>';
							echo wp_kses(
								$output,
								array(
									'input' => array(
										'type'  => array(),
										'name'  => array(),
										'id'    => array(),
										'value' => array(),
									),
									'p'     => array(
										'class' => array(),
									),
								)
							);
							break;
					}

					?>
				</td>
			</tr>
			<?php
		}
	}

	/**
	 * Save custom fields
	 *
	 * @param int $term_id The term ID.
	 * @param int $tt_id   The term taxonomy ID.
	 * @return void
	 */
	public function save_taxonomy_custom_meta( $term_id, $tt_id ) {

		foreach ( $this->meta_boxes as $key => $meta ) {

			$slug = $meta['slug'];
			$key  = sanitize_key( "term_meta_$slug" );
			$nkey = isset( $_POST[ $key . '_nonce' ] ) ? sanitize_key( $_POST[ $key . '_nonce' ] ) : null;

			if (
				! isset( $nkey )
				|| ! wp_verify_nonce( $nkey, basename( __FILE__ ) )
			) {
				continue;
			}

			if ( 'checkbox' === $meta['type'] ) {

				$value = isset( $_POST[ $key ] ) ? sanitize_key( wp_unslash( $_POST[ $key ] ) ) : null;

			} else {

				$post_meta = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
				$t_id      = $term_id;
				$value     = wp_unslash( $post_meta );
				$value     = sanitize_text_field( htmlentities( $value ) );

			}

			// Save the option array.
			update_term_meta( $term_id, $key, $value );

		}

	}

	/**
	 * Use custom template file if on the taxonomy archive page
	 *
	 * @param string $template The path of the template to include.
	 * @return string
	 */
	public function template( $template ) {

		if ( is_tax( $this->slug ) ) {

			return $this->template;

		}

		return $template;
	}

	/**
	 * Make this taxonomy sortable from the post type dashboard list page.
	 *
	 * @param array $columns The list of taxonomy columns sortable on this post type's list page.
	 * @return array
	 */
	public function register_sortable_columns( $columns ) {

		$columns[ "taxonomy-{$this->slug}" ] = "taxonomy-{$this->slug}";

		return $columns;
	}


	/**
	 * Sort this taxonomy in the dashboard by the taxonomy text value.
	 *
	 * @param string $orderby The SQL query which orders posts.
	 * @param object $wp_query The query object.
	 * @return array
	 */
	public function taxonomy_orderby( $orderby, $wp_query ) {

		global $wpdb;

		// If this taxonomy is the orderby parameter, then update the SQL query.
		if ( isset( $wp_query->query['orderby'] ) && "taxonomy-{$this->slug}" === $wp_query->query['orderby'] ) {

			$orderby  = "(
	      SELECT GROUP_CONCAT(name ORDER BY name ASC)
	      FROM $wpdb->term_relationships
	      INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
	      INNER JOIN $wpdb->terms USING (term_id)
	      WHERE $wpdb->posts.ID = object_id
	      AND taxonomy = '{$this->slug}'
	      GROUP BY object_id
	    ) ";
			$orderby .= ( 'ASC' === strtoupper( $wp_query->get( 'order' ) ) ) ? 'ASC' : 'DESC';

		}

		return $orderby;

	}

	/**
	 * Detect if a taxonomy slug is a reserved term or too long.
	 *
	 * @param string $taxonomy The taxonomy slug.
	 *
	 * @return true|string
	 */
	private function validate_taxonomy( $taxonomy ) {

		$valid = true;

		$reserved_terms = array(
			'attachment',
			'attachment_id',
			'author',
			'author_name',
			'calendar',
			'cat',
			'category',
			'category__and',
			'category__in',
			'category__not_in',
			'category_name',
			'comments_per_page',
			'comments_popup',
			'custom',
			'customize_messenger_channel',
			'customized',
			'cpage',
			'day',
			'debug',
			'embed',
			'error',
			'exact',
			'feed',
			'fields',
			'hour',
			'link_category',
			'm',
			'minute',
			'monthnum',
			'more',
			'name',
			'nav_menu',
			'nonce',
			'nopaging',
			'offset',
			'order',
			'orderby',
			'p',
			'page',
			'page_id',
			'paged',
			'pagename',
			'pb',
			'perm',
			'post',
			'post__in',
			'post__not_in',
			'post_format',
			'post_mime_type',
			'post_status',
			'post_tag',
			'post_type',
			'posts',
			'posts_per_archive_page',
			'posts_per_page',
			'preview',
			'robots',
			's',
			'search',
			'second',
			'sentence',
			'showposts',
			'static',
			'status',
			'subpost',
			'subpost_id',
			'tag',
			'tag__and',
			'tag__in',
			'tag__not_in',
			'tag_id',
			'tag_slug__and',
			'tag_slug__in',
			'taxonomy',
			'tb',
			'term',
			'terms',
			'theme',
			'title',
			'type',
			'types',
			'w',
			'withcomments',
			'withoutcomments',
			'year',
		);

		if ( in_array( $taxonomy, $reserved_terms, true ) ) {
			$valid = 'a reserved term';
		} elseif ( strlen( $taxonomy ) > 32 ) {
			$valid = 'longer than 32 characters';
		} elseif ( taxonomy_exists( $taxonomy ) ) {
			$valid = 'already registered';
		}

		if ( is_string( $valid ) ) {
			wp_die( "The taxonomy \"{$slug}\" encountered the following validation error and was not registered: {$valid}" );
		}

	}

	/**
	 * Add taxonomy term select element to admin page.
	 *
	 * @return void
	 */
	public function add_posts_filter() {

		global $typenow;
		global $wp_query;
		if ( $typenow == $this->post_slug ) {

			$taxonomy     = $this->slug;
			$taxonomy_obj = get_taxonomy( $taxonomy );
			wp_dropdown_categories( array(
				'show_option_all' =>  __( "Show All {$taxonomy_obj->label}" ),
				'value_field'     => 'slug',
				'taxonomy'        =>  $taxonomy,
				'name'            =>  $taxonomy,
				'orderby'         =>  'name',
				'selected'        =>  $wp_query->query[ $taxonomy ],
				'hide_empty'      =>  false,
			) );

		}

	}

	/**
	 * Convert the admin select element value to a taxonomy term ID for the query.
	 *
	 * @param WP_Query $query The main WordPress Query object for listing admin posts.
	 *
	 * @return void
	 */
	public function apply_filter_to_query( $query ) {

		global $pagenow;

		if ( $pagenow === 'edit.php' ) {
			$query_vars = &$query->query_vars;
			if (
				isset( $query_vars['taxonomy'] )
				&& $query_vars['taxonomy'] === $this->slug
				&& isset( $query_vars['term'] )
				&& is_numeric( $query_vars['term'] )
			) {
				$term = get_term_by( 'id', $query_vars['term'], $this->slug );
				$query->query_vars['term'] = $term->slug;
			}
		}
	}

}
