<?php
/**
 * Assets for the plugin.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 */

namespace WordPress_Plugin_Name;

/**
 * Register a shortcode tag with a render function callback.
 *
 * @param string $tag The shortcode tag to be searched in post content.
 * @param string $path The path to the file that renders the shortcode content.
 */
function register_shortcode( string $tag, string $path ): void {
	add_shortcode(
		$tag,
		function ( $atts ) use ( $tag, $path ) {
			$atts = shortcode_atts( array( 'id' => $tag ), $atts );
			ob_start();
			include dirname( __DIR__ ) . '/' . $path;
			$output = ob_get_clean();
			return wp_kses( $output, 'post' );
		}
	);
}
