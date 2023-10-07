<?php
/**
 * Taxonomy term metadata editor field.
 *
 * @package ZW\WP
 * @subpackage Admin
 */

namespace ZW\WP\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Do not directly access this file in your browser.' );
}

/**
 * Taxonomy term object being edited by the user.
 *
 * @var \WP_Term
 */
$wp_term = $props->tag;

// Security field.
wp_nonce_field( $props->uid, $props->nonce );

$value = (string) get_term_meta( $wp_term->term_id, $props->key, true );

?><tr class="form-field">
	<th scope="row" valign="top">
		<label for="<?= esc_attr( $props->uid ) ?>"><?= esc_html( $props->label ) ?></label>
	</th>
	<td>
		<input type="text" name="<?= esc_attr( $props->uid ) ?>" id="<?= esc_attr( $props->uid ) ?>" value="<?= esc_attr( $value ) ?>">
		<p class="description"><?= esc_html__( 'Enter a value for this field', 'wordpress-plugin-name-textdomain' ) ?></p>
	</td>
</tr>
<?php
