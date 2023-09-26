<?php
/**
 * The file that defines the generated shortcode content.
 * phpcs:ignorefile WordPress.NamingConventions.PrefixAllGlobals
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

// You may register and enqueue assets within your shortcode output render function.
wp_register_script(
	'wordpress-plugin-name-my-shortcode-script',
	plugins_url( 'wordpress-plugin-name/assets/js/my-shortcode.js' ),
	array(),
	filemtime( plugin_dir_path( dirname( __DIR__ ) . '/wordpress-plugin-name.php' ) . 'assets/js/my-shortcode.js' ),
	true
);
wp_register_style(
	'wordpress-plugin-name-my-shortcode-style',
	plugins_url( 'wordpress-plugin-name/assets/css/my-shortcode.css' ),
	array(),
	filemtime( plugin_dir_path( dirname( __DIR__ ) . '/wordpress-plugin-name.php' ) . 'assets/css/my-shortcode.css' )
);
wp_enqueue_script( 'wordpress-plugin-name-my-shortcode-script' );
wp_enqueue_script( 'wordpress-plugin-name-my-shortcode-style' );

?><div id="my-shortcode">Hello, WordPress!</div>
<?php

$response = wp_remote_get( rest_url() . 'wp/v2/posts/1' );

if ( is_wp_error( $response ) ) {
	$error_message = $response->get_error_message();
	echo esc_html( "Something went wrong: $error_message" );
} else {
	$body = wp_remote_retrieve_body( $response );
	$results = json_decode( $body );
	?><table>
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
