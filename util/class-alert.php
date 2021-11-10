<?php
/**
 * The file that handles alerts for plugin activation issues.
 *
 * @package    ThoughtfulWeb
 * @subpackage Utility
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-alert.php
 * @since      0.1.0
 */

namespace ThoughtfulWeb\Util;

/**
 * The class that registers page template file registration.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Alert {

	/**
	 * The class constructor.
	 */
	public function __construct(){}

	/**
	 * Display an alert with precise context and delivery.
	 * Based on WP_Error class constructor.
	 *
	 * @see   https://developer.wordpress.org/reference/classes/wp_error/
	 * @see   https://developer.wordpress.org/reference/functions/is_wp_error/
	 * @see   https://developer.wordpress.org/reference/functions/wp_die/
	 * @see   https://github.com/WordPress/WordPress-Coding-Standards/wiki/Escaping-a-WP_Error-object
	 * @since 0.1.0
	 *
	 * @param  string|int $code    Alert code.
	 * @param  string     $message Alert message.
	 * @param  mixed      $data    Optional. Alert data.
	 * @return bool|void
	 */
	public static function display( $code = '', $message = '', $data = '' ) {

		// Attempt to create an error object.
		$alert = new \WP_Error( $code, $message, $data );
		if ( ! is_wp_error( $alert ) ) {
			return false;
		}

		wp_die( $this->escape_wp_error( $alert ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $alert is escaped before being passed in.

	}

	/**
	 * Copied from WordPress Coding Standards.
	 * Escape a WP_Error object for passing directly to wp_die().
	 *
	 * The wp_die() function accepts an WP_Error object as the first parameter, but it
	 * does not escape it's contents before printing it out to the user. By passing
	 * the object through this function before giving it to wp_die(), the potential for
	 * XSS should be avoided.
	 *
	 * @see https://github.com/WordPress/WordPress-Coding-Standards/wiki/Escaping-a-WP_Error-object
	 *
	 * @param WP_Error $error The error to escape.
	 *
	 * @return WP_Error The escaped error.
	 */
	private function escape_wp_error( $error ) {

		$code = $error->get_error_code();

		$error_data = $error->error_data;

		if ( isset( $error_data[ $code ]['title'] ) ) {
			$error_data[ $code ]['title'] = wp_kses(
				$error->error_data[ $code ]['title'],
				'escape_wp_error_title'
			);
			$error->error_data            = $error_data;
		}

		$all_errors = $error->errors;

		foreach ( $all_errors as $code => $errors ) {
			foreach ( $errors as $key => $message ) {
				$all_errors[ $code ][ $key ] = wp_kses(
					$message,
					'escape_wp_error_message'
				);
			}
		}

		$error->errors = $all_errors;

		return $error;

	}
}
