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
	__DIR__ . '/thoughtfulweb/library/admin/page/class-settings.php',
	__DIR__ . '/thoughtfulweb/library/plugin/class-activation.php',
	__DIR__ . '/thoughtfulweb/library/plugin/class-requirements.php',
	__DIR__ . '/thoughtfulweb/library/theme/class-page-template.php',
);
new \ThoughtfulWeb\Library\File\Auth_Include( __FILE__, $allowed_scripts, $_SERVER, 'ABSPATH' );

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
