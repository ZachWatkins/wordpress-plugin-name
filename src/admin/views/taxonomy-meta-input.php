<?php
/**
 * Taxonomy term metadata editor field.
 *
 * @package WordPress_Plugin_Name
 * @subpackage Admin
 */

namespace WordPress_Plugin_Name\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Taxonomy term object being edited by the user.
 *
 * @var \WP_Term
 */
$wp_term = $props->tag;

// Security field.
wp_nonce_field( $props->uid, $props->nonce );

$value            = (string) get_term_meta( $wp_term->term_id, $props->key, true );
$taxonomy_meta_id = "term_meta_{$wp_term->taxonomy}_{$props->key}";

?><tr class="form-field">
	<th scope="row" valign="top"><label for="<?= esc_attr( $taxonomy_meta_id ) ?>"><?= esc_html( $props->label ) ?></label></th>
	<td>
<?php

if ( 'editor' === $props->input ) {
	$value = wp_kses_post( $value );
	wp_editor(
		$value,
		$taxonomy_meta_id,
		array( 'textarea_name' => $taxonomy_meta_id )
	);
} elseif ( 'link' === $props->input ) {

	?>
	<input type="url" name="term_meta_<?= esc_attr( $taxonomy_meta_id ) ?>" id="<?= esc_attr( $taxonomy_meta_id ) ?>" value="<?= esc_attr( $value ) ?>" placeholder="https://example.com" pattern="http[s]?://.*">
	<p class="description"<?= esc_html__( 'Enter a value for this field', 'wordpress-plugin-name-textdomain' ) ?></p>
	<?php
} elseif ( 'checkbox' === $props->input ) {

	?>
	<input type="checkbox" name="<?= esc_attr( $taxonomy_meta_id ) ?>" id="<?= esc_attr( $taxonomy_meta_id ) ?>" <?= ( 'on' === $value ? 'checked' : '' ) ?>
	<?php
} else {

	?>
	<input type="text" name="<?= esc_attr( $taxonomy_meta_id ) ?>" id="<?= esc_attr( $taxonomy_meta_id ) ?>" value="<?= esc_attr( $value ) ?>">
	<p class="description"><?= esc_html__( 'Enter a value for this field', 'wordpress-plugin-name-textdomain' ) ?></p>
	<?php
}

?>
</td>
</tr>
<?php
