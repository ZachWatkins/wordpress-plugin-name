<?php
/**
 * The file that handles plugin activation and deactivation with annotated dependency checks.
 *
 * Links to PHP core documentation are included but this file will not be easy to grasp for beginners.
 *
 * @package    ThoughtfulWeb
 * @subpackage Core
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/util/class-activation.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Util;

use ThoughtfulWeb\Util\Error_Helper as Error_Helper;

/**
 * The class that handles plugin activation and deactivation.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Plugin_Activation {

	/**
	 * Plugin activation file.
	 *
	 * @var string $file The root plugin file directory path. A Class variable cannot be defined using
	 *                   functions or variables so it is incomplete until construction.
	 */
	private $file = THOUGHTFULWEB_UTIL_PLUGIN_FILE;

	/**
	 * Plugin requirements.
	 *
	 * @var array $requirements {
	 *     File path or array of activation requirements. Default empty array.
	 *
	 *     @type array $plugins {
	 *         Optional. Array of plugin clauses. Inspired by the WP_Meta_Query class constructor parameter.
	 *
	 *         @type string $relation Optional. The keyword used to compare the activation status
	 *                                of the plugins. Accepts 'AND', or 'OR'. Default 'AND'.
	 *         @type array  ...$0 {
	 *             An array of a plugin's data.
	 *
	 *             @type string $name Required. Display name of the plugin.
	 *             @type string $path Required. Path to the plugin file relative to the plugins directory.
	 *         }
	 *     }
	 *     @key array $templates {
	 *         Page template data not able to be stored in the file header.
	 *
	 *         @key string $path The relative file path to the page template.
	 *     }
	 * }
	 */
	private $requirements;

	/**
	 * Plugin dependency queries.
	 *
	 * @var bool|array $plugin_queries Plugin dependencies. Accepts false or array. Default false.
	 */
	private $plugin_queries = false;

	/**
	 * Failed activation message.
	 *
	 * @var bool|array $failed_message The plugin activation failure message. Accepts false or array. Default false.
	 */
	private $failure_message = false;

	/**
	 * Initialize the class
	 *
	 * @todo Add support for an array of plugin clauses.
	 *
	 * @see   https://www.php.net/manual/en/function.version-compare.php
	 * @see   https://developer.wordpress.org/reference/functions/register_activation_hook/
	 * @since 0.1.0
	 *
	 * @param string|array $requirements File path or array of activation requirements. Default empty array.
	 *
	 * @return void
	 */
	public function __construct( $requirements = array() ) {

		$this->requirements   = $requirements;
		$this->plugin_headers = get_plugin_data( $this->file );
		if ( is_array( $requirements ) && array_key_exists( 'plugins', $requirements ) ) {
			$this->plugin_queries = $requirements['plugins'];
		} else {
			// Handle the retrieval of the requirements file.
			$this->plugin_requirements = File_Helper::require( $requirements );
		}

		// Register activation hook.
		register_activation_hook( self::$file, array( $this, 'activate_plugin' ) );

	}

	/**
	 * Ensure plugin activation requirements are met and a graceful deactivation if not.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function activate_plugin() {

		// Returns true or error message string.
		$result = $this->meets_activation_requirements();

		// Handle result.
		if ( true === $result ) {
			return;
		} elseif ( is_wp_error( $result ) ) {
			$this->deactivate_plugin( $result );
		}

	}

	/**
	 * Deactivate the plugin.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/deactivate_plugins/
	 * @see    https://developer.wordpress.org/reference/functions/plugin_basename/
	 * @see    https://developer.wordpress.org/reference/hooks/wp_die/
	 * @since  0.1.0
	 *
	 * @param  WP_Error $wp_error The WP_Error object.
	 *
	 * @return void
	 */
	public function deactivate_plugin( $wp_error ) {

		// Deactivate the plugin.
		deactivate_plugins( plugin_basename( self::$file ) );

		// Alert the user to the issue.
		Error_Helper::display( $wp_error );

	}

	/**
	 * Validate plugin activation requirements.
	 *
	 * Returns true or an array if requirements are not met.
	 *
	 * @since  0.1.0
	 * @return bool|array
	 */
	private function meets_activation_requirements() {

		if ( empty( $this->requirements ) ) {
			return true;
		}

		// Verify if required plugins are installed.
		$results = $this->validate_plugins();

		return $results;

	}

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
	private function validate_plugins() {

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

		$error = new \WP_Error(
			'thoughtful_util_plugin_activation_error',
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

		Error_Helper::display( $wp_error );

		return false;
	}
}
