<?php
/**
 * Register a shortcode.
 *
 * @package WordPress_Plugin_Name
 */

namespace WordPress_Plugin_Name;

add_shortcode(
	'my-shortcode',
	function ( $atts, $content = '' ) {

		$allowed_shortcode_atts = array( 'id' => 'my-shortcode' );

		$props = (object) array_merge(
			shortcode_atts( $allowed_shortcode_atts, $atts, 'my-shortcode' ),
			array( 'content' => $content )
		);

		ob_start();
		include 'views/my-shortcode.php'; // Uses $props.
		return ob_get_clean();
	}
);
