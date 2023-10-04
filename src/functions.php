<?php
/**
 * Global functions namespaced to the plugin.
 *
 * @package WordPress_Plugin_Name
 */

namespace WordPress_Plugin_Name;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Get the rendered output.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_kses/
 * @see https://www.php.net/manual/en/function.extract.php
 * @see https://www.php.net/manual/en/function.ob-start.php
 * @see https://www.php.net/manual/en/function.ob-get-clean.php
 *
 * @param string $file The path to the PHP file.
 * @param array  $props Associative array of variable names and values available to the file.
 * @return string The rendered HTML.
 */
function render( string $file, $props ) {
	$props = (object) array_combine(
		array_map(
			fn ( $key ) => strtolower( str_replace( '-', '_', $key ) ),
			array_keys( $props )
		),
		array_values( $props )
	);
	ob_start();
	include $file;
	$rendered               = ob_get_clean();
	$allowed_html           = wp_kses_allowed_html( 'post' );
	$allowed_html['script'] = array( 'type' => true );
	return wp_kses( $rendered, $allowed_html );
}
