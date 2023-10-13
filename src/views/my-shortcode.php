<?php
/**
 * The file that defines the generated shortcode content.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

wp_enqueue_script(
	PLUGIN_KEY . '-my-shortcode-script',
	PLUGIN_URL . 'src/assets/js/my-shortcode.js',
	array(),
	filemtime( PLUGIN_DIR . 'src/assets/js/my-shortcode.js' ),
	true
);

wp_enqueue_style(
	PLUGIN_KEY . '-my-shortcode-style',
	PLUGIN_URL . 'src/assets/css/my-shortcode.css',
	array(),
	filemtime( PLUGIN_DIR . 'src/assets/css/my-shortcode.css' )
);

?><div id="<?= esc_attr( $props->id ) ?>">Hello! <?= esc_html( $props->content ) ?></div>
<?php

$response = wp_remote_get( rest_url() . 'wp/v2/posts/1' );

if ( is_wp_error( $response ) ) {
	$error_message = $response->get_error_message();
	echo esc_html( "Something went wrong: $error_message" );
	return;
}

$body    = wp_remote_retrieve_body( $response );
$results = json_decode( $body );
$headers = array_keys( (array) $results[0] );

?>
<table id="my-shortcode-api-results">
	<thead>
		<tr>
		<?php
		foreach ( $headers as $header ) {
			?>
			<th><?= esc_html( $header ) ?></th>
			<?php
		}
		?>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ( $results as $key => $result ) {
		?>
		<tr class="result result-<?= esc_attr( $key ) ?>">
		<?php
		foreach ( $result as $value ) {
			?>
			<td><?= esc_html( $value ) ?></td>
			<?php
		}
		?>
		</tr>
		<?php
	}
	?>
	</tbody>
</table>
<?php
