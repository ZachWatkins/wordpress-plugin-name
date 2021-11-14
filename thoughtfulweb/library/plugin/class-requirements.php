<?php
/**
 * The file that provides plugin activation requirement features via a configuration file or an array
 * passed to the ThoughtfulWeb\Library\Plugin_Activation constructor.
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage Plugin
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/twlibrary/validate/class-activation-requirements.php
 * @since      0.1.0
 * @todo       https://tommcfarlin.com/registry-pattern-in-wordpress/
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Library\Plugin;

use ThoughtfulWeb\Library\Monitor\Error as TWL_Error;
use ThoughtfulWeb\Library\File_Helper as File_Helper;

/**
 * The class that validates configuration requirements.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Requirements {

	/**
	 * Validate required plugins.
	 *
	 * @see    https://www.php.net/manual/en/function.is-array.php
	 * @see    https://www.php.net/manual/en/function.isset.php
	 * @see    https://www.php.net/manual/en/function.strtoupper.php
	 * @see    https://www.php.net/manual/en/function.unset.php
	 * @see    https://www.php.net/manual/en/control-structures.foreach.php
	 * @see    https://www.php.net/manual/en/control-structures.break.php
	 * @see    https://developer.wordpress.org/reference/functions/is_plugin_active/
	 * @see    https://www.php.net/manual/en/function.array-key-exists.php
	 * @see    https://www.php.net/manual/en/function.empty.php
	 * @see    https://www.php.net/manual/en/function.in-array.php
	 * @see    https://www.php.net/manual/en/function.array-keys.php
	 * @see    https://www.php.net/manual/en/function.count.php
	 * @see    https://www.php.net/manual/en/function.implode.php
	 * @see    https://www.php.net/manual/en/function.array-pop.php
	 * @see    https://www.php.net/manual/en/function.sprintf.php
	 * @see    https://www.php.net/manual/en/function.strtolower.php
	 * @see    https://developer.wordpress.org/reference/functions/_n/
	 * @since  0.1.0
	 * @return bool|string
	 */
	private function validate_required_plugins() {

		$plugin_query = $this->plugin_queries;
		$results      = true;

		if ( ! is_array( $plugin_query ) ) {
			return $results;
		}

		// Enforce a default value of 'AND' for $relation.
		if ( isset( $plugin_query['relation'] ) && 'OR' === strtoupper( $plugin_query['relation'] ) ) {
			$relation = 'OR';
		} else {
			$relation = 'AND';
		}
		if ( isset( $plugin_query['relation'] ) ) {
			unset( $plugin_query['relation'] );
		}

		// Retrieve plugin active status.
		$all_active = true;
		foreach ( $plugin_query as $key => $plugin ) {
			$active = is_plugin_active( $plugin['file'] );
			// Store active status.
			$plugin_query[ $key ]['active'] = $active;
			// Monitor overall plugin active status.
			if ( ! $active ) {
				$all_active = false;
			}
		}
		$this->plugin_queries = $plugin_query;

		// Evaluate results so far.
		if ( 'AND' === $relation && $all_active ) {
			return $results;
		}

		// Determine which plugins to report failure for.
		$inactive_plugins = array();
		if ( 'AND' === $relation ) {
			foreach ( $plugin_query as $plugin ) {
				if ( ! $plugin['active'] ) {
					$inactive_plugins[] = $plugin['name'];
				}
			}
		} elseif ( 'OR' === $relation ) {
			$found_active = false;
			foreach ( $plugin_query as $plugin ) {
				if ( $plugin['active'] ) {
					$found_active = true;
					break;
				} else {
					$inactive_plugins[] = $plugin['name'];
				}
			}
		}

		// Exit if we still have not found plugins to report an error for.
		if ( empty( $inactive_plugins ) ) {
			return $results;
		}

		// Assemble all inactive plugins as a phrase using the relation parameter.
		$inactive_plugins_phrase = '';
		$plural                  = 'OR' === $relation ? 1 : count( $inactive_plugins );
		if ( 2 >= $plural ) {
			$inactive_plugins_phrase = implode( strtolower( " $relation " ), $inactive_plugins );
		} else {
			$plugin_last              = array_pop( $inactive_plugins );
			$inactive_plugins_phrase  = implode( ', ', $inactive_plugins );
			$inactive_plugins_phrase .= strtolower( ", $relation " ) . $plugin_last;
		}

		Error_Helper::display(
			'thoughtful_web_plugin_activation_error',
			sprintf(
				/* translators: %s: Required plugin names. */
				_n(
					' It needs the %s plugin to be installed and activated first.',
					' It needs the %s plugins to be installed and activated first.',
					$plural,
					'thoughtful_web'
				),
				$inactive_plugins_phrase
			)
		);
	}

	private static function validate_requirements( $requirements ){
		return false;
	}
}
