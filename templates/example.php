<?php
/**
Template Name: Example
Description: Example page template using Advanced Custom Fields and jQuery.
 * @package    WordPress_Plugin_Name
 * @subpackage page.php
 * @copyright  Zachary Watkins 2022
 * @since      0.1.0
 */

/**
 * Add your Advanced Custom Fields content here.
 *
 * @since  0.1.0
 * @param  string $content The page content controlled by the page content editor.
 * @return string
 */
function examplephp_content( $content ) {

	$content .= 'Hello, world!';

	return $content;

}
add_filter( 'the_content', 'examplephp_content' );

// Check for and load a theme-compatible base page template we want to build off of.
$base_template = locate_template( 'page.php' );
if ( '' !== $base_template ) {
	// Load the page template.
	load_template( $base_template );
} else {
	// Basic template content that is not guaranteed to be compatible with a theme.
	get_header();
	?>
	<div id="primary" class="content-area"><main id="main" class="site-main">
	<?php

		the_content();

	?>
	</main></div>
	<?php
	get_footer();
}
