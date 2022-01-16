<?php
/**
 * Plugin activation requirements.
 *
 * @package    Thoughtful Web Library for WordPress
 * @subpackage Plugin Requirements
 * @see        ThoughtfulWeb\LibraryWP\Plugin\Requirements::$requirements
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/activation-requirements.php
 * @since      0.1.0
 */

// If this file is called directly, or is included by a file other than those we expect, then abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

return array(
	'main'      => dirname( __FILE__, 2 ) . '/wordpress-plugin-name.php',
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
);
