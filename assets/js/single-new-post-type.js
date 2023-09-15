/**
 * This file is added to the single post page for the custom post type.
 *
 * @package    WordPress Plugin Name
 * @subpackage JavaScript
 */

(function ($) {

	// Now you can use the $ function for the jQuery library.
	$( 'body p' ).first().after( '<p style="text-align:center; font-size:16px;">wordpress-plugin-name/js/single-new-post-type.js, line 5: You are on the single page template for the post type!</p>' );
	console.log( 'wordpress-plugin-name/js/single-new-post-type.js, line 6: You are on the single page template for the post type!' );

})( jQuery );
