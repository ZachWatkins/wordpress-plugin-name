<?php
/**
 * The file that handles plugin activation and deactivation with annotated dependency checks.
 *
 * Links to PHP core documentation are included but this file will not be easy to grasp for beginners.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-activation.php
 * @since      0.1.0
 */

namespace WordPress_Plugin_Name;

/**
 * The class that handles plugin activation and deactivation.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Plugin_Activation {

	/**
	 * Plugin requirements.
	 *
	 * @var bool|array $requirements Activation requirements. Accepts false or array. Default false.
	 */
	private $requirements = false;

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
	 * @param bool|array $requirements {
	 *     Optional. Bool or array of activation requirements. Default false.
	 *
	 *     @type array $plugins {
	 *         Optional. Array of plugin clauses. Inspired by the WP_Meta_Query class constructor parameter.
	 *
	 *         @type string $relation Optional. The keyword used to compare the activation status
	 *                                of the plugins. Accepts 'AND', or 'OR'. Default 'AND'.
	 *         @type array  ...$0 {
	 *             Optional. An array of a plugin's data.
	 *
	 *             @type string $name Required. Display name of the plugin.
	 *             @type string $path Required. Path to the plugin file relative to the plugins directory.
	 *         }
	 *     }
	 * }
	 * @return void
	 */
	public function __construct( $requirements = false ) {

		// Store plugin data.
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$this->plugin_headers = get_plugin_data( WP_PLUGIN_INTRO_DIR_FILE );
		$this->requirements   = $requirements;
		if ( is_array( $requirements ) && array_key_exists( 'plugins', $requirements ) ) {
			$this->plugin_queries = $requirements['plugins'];
		}

		/**
		 * Add core plugin activation error handler for PHP version support.
		 * On WP_Error during plugin activation, wp_die() is called. This triggers the filter 'wp_die_handler'.
		 * The default function for this filter is '_default_wp_die_handler';
		 * @see https://developer.wordpress.org/reference/functions/_default_wp_die_handler/
		 * We need to add "$parsed_args['back_link']" to this handler's received parameters.
		 * Provides a link back to the Plugin page from the white screen error page.
		 * Requires WordPress 5.6.0.
		 */
		if ( version_compare( floatval( $GLOBALS['wp_version'] ), '5.6.0', '>=' ) ) {
			add_action( 'wp_error_added', array( $this, 'wp_error_added' ), 11, 4 );
		}

		// Register activation hook.
		register_activation_hook( WP_PLUGIN_INTRO_DIR_FILE, array( $this, 'activate_plugin' ) );

	}

	/**
	 * Display link back to Plugins page upon default WordPress activation error.
	 * Requires WordPress 5.6.0.
	 *
	 * @see   https://developer.wordpress.org/reference/functions/_default_wp_die_handler/
	 * @see   https://www.php.net/manual/en/reference.pcre.pattern.syntax.php
	 * @see   https://www.php.net/manual/en/function.preg-match.php
	 * @see   https://developer.wordpress.org/reference/classes/wp_error/
	 * @see   https://developer.wordpress.org/reference/functions/wp_die/
	 * @since 0.1.0
	 *
	 * @param string|int $code     Error code.
	 * @param string     $message  Error message.
	 *
	 * @return void
	 */
	public function wp_error_added( $code, $message ){

		// The \b meta-character is a word boundary.
		$pattern = '/\b' . $this->plugin_headers['Name'] . '\b/';
		preg_match( $pattern, $message, $matches );
		if ( 'plugin_php_incompatible' === $code && ! empty( $matches ) ) {
			// Do stuff.
		}
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
		} elseif ( is_string( $result ) ) {
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
	 * @param  string $message The custom activation error message. Default empty string.
	 * @return void
	 */
	public function deactivate_plugin( $message = '' ) {

		// Deactivate the plugin.
		deactivate_plugins( plugin_basename( WP_PLUGIN_INTRO_DIR_FILE ) );

		// Set error message.
		$this->failure_message = $message;

		// Add a custom message to the end of the error message in the view file below.
		add_filter( 'wpn_failed_activation_message_after', array( $this, 'failed_activation_message_after' ) );

		// Demonstrate that variables are available to the failed-activation.php file from this function.
		include WP_PLUGIN_INTRO_DIR_PATH . '/views/failed-activation.php';

		// Prevent any remaining processes from executing and load the page.
		wp_die();

	}

	/**
	 * Add a message after the failed plugin activation message.
	 *
	 * @since  0.1.0
	 * @param  string $message The message after the failed plugin activation message.
	 * @return string
	 */
	public function failed_activation_message_after( $message ) {

		if ( $this->failure_message ) {
			$message = $this->failure_message;
		}

		return $message;

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

		if ( ! $this->requirements ) {
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

		// Retrieve plugin statuses.
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

		$result = sprintf(
			/* translators: %s: Required plugin names. */
			_n(
				' It needs the %s plugin to be installed and activated first.',
				' It needs the %s plugins to be installed and activated first.',
				$plural,
				'wordpress-plugin-name'
			),
			$inactive_plugins_phrase
		);

		return $result;
	}
}
