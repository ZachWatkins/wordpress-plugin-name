<?php
/**
 * The file that extends WP_Error notification capabilities.
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage Admin
 * @author     Zachary Kendall Watkins <zwatkins.it@gmail.com>
 * @copyright  2021 Zachary Kendall Watkins
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/thoughtfulweb/library/admin/class-acf-fieldset.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Library\Admin\Page;

use ThoughtfulWeb\Library\File\Read as TWL_File_Read;

/**
 * Undocumented class
 */
class Settings {

	/**
	 * Settings page fieldset file.
	 *
	 * @var string $fieldset_file The fieldset file to load.
	 */
	private $fieldset_file = __DIR__ . '../../../../fields/admin-page-settings.php';

	/**
	 * Admin settings class constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param string $basedir       The root directory path.
	 * @param string $fieldset_file The fieldset file path relative to the root directory.
	 */
	public function __construct( $fieldset_file = '', $basedir = '' ) {

		$this->configure( $fieldset_file, $basedir );

	}

	/**
	 * Configure class properties.
	 *
	 * @since 0.1.0
	 *
	 * @param string $fieldset_file The fieldset file path relative to the root directory.
	 * @param string $basedir       The root directory path.
	 *
	 * @return void
	 */
	public function configure( $fieldset_file = '', $basedir = '' ) {

		$this->fieldset_file = new TWL_File_Read( $fieldset_file, $basedir );

		// Initialize loading the file.
		if ( $this->fieldset_file ) {

			$this->add_hooks();

		}
	}

	/**
	 * Add action and filter hooks.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	private function add_hooks() {

		add_action( 'init', array( $this, 'fieldset_init' ) );

	}
}
