<?php
/**
 * Taxonomy term metadata editor field.
 *
 * @package ZW
 * @subpackage WP\Admin\Views
 */

namespace ZW\WP\Admin\Views;

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
	<?php
		$value = wp_kses_post( $value );
		wp_editor(
			$value,
			$props->uid,
			array( 'textarea_name' => $props->uid )
		);
		?>
	</td>
</tr>
