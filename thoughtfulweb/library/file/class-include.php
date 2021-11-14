<?php
/**
 * WordPress centric file include helper class.
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage File
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/util/class-page-template.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Library\File;

use ThoughtfulWeb\Library\Monitor\Error as TWLM_Error;

/**
 * The File Include class.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class File {

	/**
	 * Default error arguments.
	 *
	 * @var array $err_args {
	 *     The default file validation error monitor arguments.
	 * }
	 */
	private $err_args = array(
		'die'     => true,
		'level'   => E_ERROR,
		'cause'   => 'user',
		'message' => array(
			'A file that was needed for inclusion within another file was not found by the Thoughtful Web Library.',
		),
	);

	/**
	 * Load file.
	 *
	 * @since 0.1.0
	 *
	 * @param string $file     The file to return.
	 * @param array  $err_args Extra arguments related to error handling.
	 *
	 * @return mixed
	 */
	public function __construct( $file = '', $err_args = array() ) {

		$result = false;

		if ( TWLM_Error::validate( 'file_path', $file ) ) {

			$result = include $file;

		}

		return $result;

	}
}
