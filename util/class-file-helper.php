<?php
/**
 * WordPress centric file helper class.
 *
 * @package    ThoughtfulWeb
 * @subpackage Utility
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/util/class-page-template.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Util;

use ThoughtfulWeb\Util\Error_Helper as Error_Helper;

/**
 * Undocumented class
 */
class File_Helper {

	/**
	 * Plugin activation file.
	 *
	 * @var string $file The root plugin file directory path. A Class variable cannot be defined using
	 *                   functions or variables so it is incomplete until construction.
	 */
	private $file = THOUGHTFULWEB_UTIL_PLUGIN_FILE;

	/**
	 * Default Headers.
	 *
	 * @var array $default_headers An associative array of page template headers.
	 */
	private $default_headers = array(
		'Description' => 'Description not found.',
	);

	/**
	 * Get page template file headers as associative arrays.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/get_file_data/
	 * @see    https://www.php.net/manual/en/function.array-merge.php
	 * @see    https://www.php.net/manual/en/function.is-array.php
	 *
	 * @since  0.1.0
	 *
	 * @param array $files The file path, relative to the page template without a leading slash.
	 *
	 * @param array $default_headers An associative array of page template headers.
	 *
	 * @return array
	 */
	private static function get_file_data( $files = array(), $default_headers = array() ) {

		// Set up the true $this->basedir value.
		$basedir = plugin_dir_path( $this->file );

		$results = array();

		$default_headers = array_merge( $this->default_headers, $default_headers );

		foreach ( $files as $file ) {
			$file      = basename( $file );
			$file_data = get_file_data( $basedir . $file, $default_headers );
			if ( is_array( $file_data ) ) {
				$results[ $file ] = $file_data;
			}
		}

		return $results;

	}
}
