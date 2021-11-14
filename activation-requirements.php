<?php
/**
 * Plugin activation requirements.
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage Activation_Requirements
 * @see        ThoughtfulWeb\Library\Activation_Requirements::$requirements
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/activation-requirements.php
 * @since      0.1.0
 */

// If this file is called directly, or is included by a file other than those we expect, then abort.
$allowed_scripts = array(
	__DIR__ . '/thoughtfulweb/library/class-file-helper.php',
);

if (
	isset( $_SERVER['SCRIPT_FILENAME'] )
	&& (
		! defined( 'ABSPATH' )
		|| ! in_array( realpath( $_SERVER['SCRIPT_FILENAME'] ), $allowed_scripts, true )
		( isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] && realpath( __FILE__ ) === realpath( $_SERVER['SCRIPT_FILENAME'] ) )
	)
) {

	header( 'HTTP/1.0 404 Not Found', true, 404 );

	/* choose the appropriate page to redirect users */
	header( 'location: /404.php' );

	die();

}

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
