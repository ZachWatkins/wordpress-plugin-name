<?php
/**
 * The file that defines the core plugin class.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

/**
 * The core plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  0.1.0
 * @return void
 */
class WordPress_Plugin_Name {

	/**
	 * Initialize the class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function __construct() {

		// Load the assets.
		require_once WP_PLUGIN_INTRO_SRC_PATH . 'class-assets.php';
		new WordPress_Plugin_Name\Assets();

		// Load activation-related hooks.
		$requirements = array(
			'plugins' => array(
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
		require_once WP_PLUGIN_INTRO_SRC_PATH . 'class-activation.php';
		new WordPress_Plugin_Name\Activation( $requirements );

		// Load page template files.
		$templates = array( 'path' => 'templates/example.php' );
		require_once WP_PLUGIN_INTRO_SRC_PATH . 'class-page-template.php';
		new WordPress_Plugin_Name\Page_Template( $templates );

	}
}
