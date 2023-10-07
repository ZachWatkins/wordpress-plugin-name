<?php
/**
 * Useful functions for WordPress plugins.
 *
 * @package    ThoughtfulWeb
 * @subpackage LibraryWP
 * @copyright  Zachary K. Watkins 2023
 * @author     Zachary K. Watkins <zwatkins.it@gmail.com
 * @license    GPL-2.0-or-later
 */

namespace ZW\WP;

/**
 * Get the rendered output.
 *
 * @param string       $file The path to the PHP file.
 * @param object|array $props Associative array of variable names and values available to the file.
 * @return string The rendered HTML.
 */
function render( string $file, $props ) {
	if ( is_array( $props ) ) {
		$props = (object) array_combine(
			array_map( fn ( $key ) => str_replace( '-', '_', strtolower( $key ) ), array_keys( $props ) ),
			array_values( $props )
		);
	}
	ob_start();
	include $file;
	$rendered               = ob_get_clean();
	$allowed_html           = wp_kses_allowed_html( 'post' );
	$allowed_html['script'] = array( 'type' => true );
	return wp_kses( $rendered, $allowed_html );
}
