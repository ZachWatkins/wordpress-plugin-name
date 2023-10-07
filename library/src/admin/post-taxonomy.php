<?php
/**
 * Post taxonomy helper functions.
 *
 * @package ZW\WP
 * @subpackage Admin
 */

namespace ZW\WP\Admin;

use function ZW\WP\render;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Register a custom WordPress post taxonomy.
 *
 * @param  string          $taxonomy     The taxonomy slug.
 * @param  string          $singular     The label in singular form.
 * @param  string          $plural       The label in plural form.
 * @param  string|string[] $post_slug    The slug of the post type where the taxonomy will be added.
 * @param  array           $args         The arguments for taxonomy registration. Accepts $args for
 *                                       the WordPress core register_taxonomy function.
 */
function register_post_taxonomy(
	string $taxonomy,
	string $singular,
	string $plural,
	$post_slug,
	array $args = array()
) {
	$default_args = array(
		'show_ui'            => true,
		'show_in_rest'       => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => true,
		'labels'             => array(
			'name'              => $plural,
			'singular_name'     => $singular,
			'search_items'      => __( 'Search', 'zw-wp-textdomain' ) . " $plural",
			'all_items'         => __( 'All', 'zw-wp-textdomain' ) . " $plural",
			'parent_item'       => __( 'Parent', 'zw-wp-textdomain' ) . " $singular",
			'parent_item_colon' => __( 'Parent', 'zw-wp-textdomain' ) . " {$singular}:",
			'edit_item'         => __( 'Edit', 'zw-wp-textdomain' ) . " $singular",
			'update_item'       => __( 'Update', 'zw-wp-textdomain' ) . " $singular",
			'add_new_item'      => __( 'Add New', 'zw-wp-textdomain' ) . " $singular",
			/* translators: placeholder is the singular taxonomy name */
			'new_item_name'     => sprintf( esc_html__( 'New %d Name', 'zw-wp-textdomain' ), $singular ),
			'menu_name'         => $plural,
		),
	);

	$args = array_merge( $default_args, $args );
	register_taxonomy( $taxonomy, $post_slug, $args );
	register_taxonomy_for_object_type( $taxonomy, $post_slug );
}

/**
 * Detect if a taxonomy slug is a reserved term, too long, or already registered.
 * WordPress has documented that you should not use terms that are reserved for core functionality, but they do not perform these checks in their own registration function.
 *
 * @param string $taxonomy The taxonomy slug.
 * @return bool|string True if the taxonomy is valid, otherwise a string with the validation error.
 */
function validate_taxonomy_slug( $taxonomy ): bool {

	$valid = true;

	$reserved_terms = array( 'attachment', 'attachment_id', 'author', 'author_name', 'calendar', 'cat', 'category', 'category__and', 'category__in', 'category__not_in', 'category_name', 'comments_per_page', 'comments_popup', 'custom', 'customize_messenger_channel', 'customized', 'cpage', 'day', 'debug', 'embed', 'error', 'exact', 'feed', 'fields', 'hour', 'link_category', 'm', 'minute', 'monthnum', 'more', 'name', 'nav_menu', 'nonce', 'nopaging', 'offset', 'order', 'orderby', 'p', 'page', 'page_id', 'paged', 'pagename', 'pb', 'perm', 'post', 'post__in', 'post__not_in', 'post_format', 'post_mime_type', 'post_status', 'post_tag', 'post_type', 'posts', 'posts_per_archive_page', 'posts_per_page', 'preview', 'robots', 's', 'search', 'second', 'sentence', 'showposts', 'static', 'status', 'subpost', 'subpost_id', 'tag', 'tag__and', 'tag__in', 'tag__not_in', 'tag_id', 'tag_slug__and', 'tag_slug__in', 'taxonomy', 'tb', 'term', 'terms', 'theme', 'title', 'type', 'types', 'w', 'withcomments', 'withoutcomments', 'year' );

	if ( in_array( $taxonomy, $reserved_terms, true ) ) {
		$valid = 'a reserved term';
	} elseif ( strlen( $taxonomy ) > 32 ) {
		$valid = 'longer than 32 characters';
	} elseif ( \taxonomy_exists( $taxonomy ) ) {
		$valid = 'already registered';
	}

	if ( is_string( $valid ) ) {
		\wp_die( esc_html( "The taxonomy \"{$taxonomy}\" encountered the following validation error and was not registered: {$valid}" ) );
	}

	return $valid;
}

/**
 * Register a boolean meta field for a taxonomy's terms and provide a checkbox for editing its value.
 *
 * @param string $taxonomy   The taxonomy slug.
 * @param string $meta_label The label for the meta value.
 * @param string $meta_key   The key for the meta value.
 * @return void
 */
function register_taxonomy_meta_boolean( string $taxonomy, string $meta_label, string $meta_key ) {
	$uid   = "term_meta_{$taxonomy}_{$meta_key}";
	$nonce = "_wpnonce_{$uid}";
	add_action(
		"{$taxonomy}_edit_form_fields",
		fn ( \WP_Term $tag, string $taxonomy ) => render(
			'admin/views/taxonomy-meta-checkbox.php',
			array(
				'tag'      => $tag,
				'taxonomy' => $taxonomy,
				'label'    => $meta_label,
				'key'      => $meta_key,
				'uid'      => $uid,
				'nonce'    => $nonce,
			)
		),
		10,
		2
	);
	add_action(
		"edited_{$taxonomy}",
		fn ( int $term_id, int $tt_id, array $args ) => wp_verify_nonce( $nonce, $uid )
			&& update_term_meta(
				$term_id,
				$meta_key,
				isset( $args[ $uid ] ) && $args[ $uid ]
					? 1
					: 0
			),
	);
}

/**
 * Register text metadata for a taxonomy's terms and provide a form field for editing the text value.
 *
 * @param string $taxonomy   The taxonomy slug.
 * @param string $meta_label The label for the meta value.
 * @param string $meta_key   The key for the meta value.
 * @return void
 */
function register_taxonomy_meta_text( string $taxonomy, string $meta_label, string $meta_key ) {
	$uid   = "term_meta_{$taxonomy}_{$meta_key}";
	$nonce = "_wpnonce_{$uid}";
	add_action(
		"{$taxonomy}_edit_form_fields",
		fn ( \WP_Term $tag, string $taxonomy ) => render(
			'admin/views/taxonomy-meta-input.php',
			array(
				'tag'      => $tag,
				'taxonomy' => $taxonomy,
				'label'    => $meta_label,
				'key'      => $meta_key,
				'uid'      => $uid,
				'nonce'    => $nonce,
			)
		),
		10,
		2
	);
	add_action(
		"edited_{$taxonomy}",
		fn ( int $term_id, int $tt_id, array $args ) => wp_verify_nonce( $nonce, $uid )
			&& update_term_meta(
				$term_id,
				$meta_key,
				sanitize_text_field(
					isset( $args[ $uid ] )
						? $args[ $uid ]
						: ''
				)
			),
	);
}

/**
 * Register HTML metadata for a taxonomy's terms and provide a form field for editing its value.
 *
 * @param string $taxonomy   The taxonomy slug.
 * @param string $meta_label The label for the meta value.
 * @param string $meta_key   The key for the meta value.
 * @return void
 */
function register_taxonomy_meta_html( string $taxonomy, string $meta_label, string $meta_key ) {
	$uid   = "term_meta_{$taxonomy}_{$meta_key}";
	$nonce = "_wpnonce_{$uid}";
	add_action(
		"{$taxonomy}_edit_form_fields",
		fn ( \WP_Term $tag, string $taxonomy ) => render(
			'admin/views/taxonomy-meta-input.php',
			array(
				'tag'      => $tag,
				'taxonomy' => $taxonomy,
				'label'    => $meta_label,
				'key'      => $meta_key,
				'uid'      => $uid,
				'nonce'    => $nonce,
			)
		),
		10,
		2
	);
	add_action(
		"edited_{$taxonomy}",
		fn ( int $term_id, int $tt_id, array $args ) => wp_verify_nonce( $nonce, $uid )
			&& update_term_meta(
				$term_id,
				$meta_key,
				wp_kses_post(
					isset( $args[ $uid ] )
						? $args[ $uid ]
						: ''
				)
			),
	);
}
