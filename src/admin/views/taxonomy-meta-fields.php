<?php
/**
 * Taxonomy term metadata editor field.
 *
 * @package WordPress_Plugin_Name
 * @subpackage Admin
 */

namespace WordPress_Plugin_Name\Admin;

/**
 * Taxonomy term object being edited by the user.
 *
 * @var \WP_Term
 */
$wp_term = $props->term;

// Security field.
wp_nonce_field( $props->nonce, "term_meta_{$wp_term->taxonomy}_nonce" );

foreach ( $props->meta_fields as $meta ) {
	$value = (string) get_term_meta( $wp_term->term_id, "term_meta_{$wp_term->taxonomy}", true );

	?><tr class="form-field term-<?= esc_attr( $wp_term->taxonomy ) ?>-wrap">
		<th scope="row" valign="top"><label for="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>"><?= esc_html( $meta['name'] ) ?></label></th>
		<td>
	<?php

	if ( 'editor' === $meta['type'] ) {
		$value = wp_kses_post( $value );
		wp_editor(
			$value,
			"term_meta_{$wp_term->taxonomy}",
			array( 'textarea_name' => "term_meta_{$wp_term->taxonomy}" )
		);
	} elseif ( 'link' === $meta['type'] ) {
		?>
		<input type="url" name="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" id="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" value="<?= esc_attr( $value ) ?>" placeholder="https://example.com" pattern="http[s]?://.*">
		<p class="description"<?= esc_html__( 'Enter a value for this field', 'wordpress-plugin-name-textdomain' ) ?></p>
		<?php
	} elseif ( 'checkbox' === $meta['type'] ) {
		$value = 'on' === $value ? 'checked' : '';
		?>
		<input type="checkbox" name="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" id="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" <?= esc_attr( $value ) ?>
		<?php
	} else {
		?>
		<input type="text" name="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" id="term_meta_<?= esc_attr( $wp_term->taxonomy ) ?>" value="<?= esc_attr( $value ) ?>">
		<p class="description"><?= esc_html__( 'Enter a value for this field', 'wordpress-plugin-name-textdomain' ) ?></p>
		<?php
	}

	?>
	</td>
	</tr>
	<?php
}
