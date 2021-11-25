<?php
/**
 * WordPress centric file system helper class.
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage File
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/thoughtfulweb/library/admin/class-page-template.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Library\File;

/**
 * The File Require class.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class System {

	/**
	 * Class constructor.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function __construct(){}

	/**
	 * Calculate a true file or folder path for a path relative to the root directory.
	 * Returns false on failure and absolutized string on success.
	 * We cannot use realpath if the running script does not have read access.
	 *
	 * @since 0.1.0
	 *
	 * @param string $path    The file or folder path. Accepts a path relative to the root project
	 *                        directory.
	 * @param string $basedir The root project directory path.
	 *
	 * @return boolean|string
	 */
	public function absolutize( $path = '', $basedir = '' ) {

		// Exit early.
		if ( empty( $path ) ) {
			return $path;
		}

		// Standardize directory separators.
		$path    = str_replace( '\\', '/', $path );
		$basedir = str_replace( '\\', '/', $basedir );
		// Trim outer slash for basedir.
		$basedir = rtrim( $basedir, '/' );
		// Remove preceding and inner relative path patterns for path.
		$path = ltrim( $path, './' );
		$path = str_replace( '/./', '/', $path );
		$path = ltrim( $path, '/' );

		// Handle relative paths with and without a basedir parameter.
		$relative_path = false !== strpos( $path, '../' ) ? true : false;
		if ( $relative_path && ! $basedir ) {
			// Create a basedir from the path, assuming the path begins absolute.
			return str_replace( '/', DIRECTORY_SEPARATOR, $path );
			} else {
				$index = strpos( $path, '../' );
				} elseif ( false !== strpos( $path, './' ) ) {
					$path = str_replace( './', '', $path );
				}
			}
		} elseif ( $basedir ) {
			// Combine the variables if we expect to be able to.
			// Warning: Potentially a malformed path.
			return str_replace( '/', DIRECTORY_SEPARATOR, "$basedir/$path" );
		}


		// Remove ../ from the path string and enforce it upon the base directory.
		$first_three = substr( $path, 0, 3 );
		while ( '../' === $first_three ) {
			$basedir     = dirname( $basedir );
			$path        = substr( $path, 3 );
			$first_three = substr( $path, 0, 3 );
		}

		// Combine the basedir and file paths.
		$path = "$basedir/$path";
		$path = str_replace( '/', DIRECTORY_SEPARATOR, $path );

		return $path;
	}
}
