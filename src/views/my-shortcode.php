<?php
/**
 * The file that defines the generated shortcode content.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

?><div id="<?php echo esc_attr( $props->id ); ?>">Hello! <?php echo esc_html( $props->content ); ?></div>
<?php

$response = wp_remote_get( rest_url() . 'wp/v2/posts/1' );

if ( is_wp_error( $response ) ) {
	$error_message = $response->get_error_message();
	echo esc_html( "Something went wrong: $error_message" );
} else {
	$body    = wp_remote_retrieve_body( $response );
	$results = json_decode( $body );
	?>
	<table>
		<thead>
			<tr>
				<?php
				$headers = array_keys( (array) $results[0] );
				foreach ( $headers as $header ) {
					echo '<th>' . esc_html( $header ) . '</th>';
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $results as $result ) {
				echo '<tr>';
				foreach ( $result as $value ) {
					echo '<td>' . esc_html( $value ) . '</td>';
				}
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	<?php
}
