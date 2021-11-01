<?php
/**
 * Plugin activation admin alert message.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Views
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/views/activation-message.php
 * @since      0.1.0
 * @see        https://developer.wordpress.org/reference/hooks/admin_notices/
 * @see        https://developer.wordpress.org/reference/functions/get_plugin_data/
 * @see        https://www.php.net/manual/en/function.sprintf.php
 * @see        https://developer.wordpress.org/reference/functions/wp_kses_post/
 */

/**
 * This file servers to demonstrate:
 * 1. How "views" are used
 *    * A separate and/or reusable block of HTML dependent on PHP logic.
 *    * Not all HTML needs a "view" file.
 *    * Not all view files need PHP, but they must have the <?php ?> tags at the top along with the
 *      documentation block inside it.
 * 2. How plugin meta data is retrieved from the core plugin file's comments using 'get_plugin_data'.
 * 3. How to internationalize a string with a variable in it using WordPress Coding Standards.
 *    * The code that enables language translation is `__( 'string', 'text-domain' )`
 *    * https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/
 */

?><p>
	<?php

		// Get this plugin's name as defined in the root file's comments block.
		$plugin_data = get_plugin_data( WP_PLUGIN_INTRO_DIR_FILE );
		$plugin_name = $plugin_data['Name'];

		/**
		 * Translate a string with a variable in it using WordPress Coding Standards.
		 * The 'printf' and 'sprintf' functions are slower than string concatenation and templating.
		 * They seem to be required or recommended for internationalizing strings for WordPress source code.
		 */
		$output = sprintf(
			/* translators: %s: This plugin name. */
			__(
				'The %s plugin could not be activated.',
				'wordpress-plugin-name'
			),
			$plugin_name
		);

		/**
		 * Check if the $error_message variable is defined from outside of this file.
		 * If so, then append it to the error message here.
		 */
		$output .= apply_filters( 'wpn_failed_activation_message_after', '' );

		// Render - i.e. output - the string.
		echo wp_kses_post( $output );

		?>
</p>
