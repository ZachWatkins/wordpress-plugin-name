<?php
/**
 * Activation requirements for the plugin.
 * These values are consumed by the ThoughtfulWeb class files.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Configuration
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

/**
 * Activation requirements clauses.
 *
 * @var array {
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
return array(
	'plugins'   => array(
		'relation' => 'OR',
		array(
			'name' => 'Advanced Custom Fields',
			'file' => 'advanced-custom-fields/acf.php',
		),
		array(
			'name' => 'Advanced Custom Fields Pro',
			'file' => 'advanced-custom-fields-pro/acf.php',
		),
	),
	'templates' => array(
		'path' => 'templates/example.php',
	),
);
