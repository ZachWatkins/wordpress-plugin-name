<?php
/**
 * WordPress centric file include helper class.
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

use ThoughtfulWeb\Library\Monitor\Incident as TWLM_Error;

/**
 * The File Read class.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Read {

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
	 * @param string $file        The file to return.
	 * @param array  $credentials Access authentication credentials.
	 * @param array  $error_args  Optional. Extra arguments related to error handling. Default empty array.
	 *
	 * @return mixed
	 */
	public function __construct( $file = '', $credentials = array(), $error_args = array() ) {

		$authorized = $this->authorized( $file, $credentials );

		if ( true === $authorized ) {

			include $file;

		} else {

			new TWLM_Error( $this->err_args );

		}

		return false;

	}

	/**
	 * Authorize the file execution attempt.
	 *
	 * @param string $file The directory path to the file being included.
	 * @param array  $conditions {
	 *     The conditions to check from the file being included.
	 *
	 *     @key string      $including_file  Server script filename including the file.
	 *     @key string[...] $allowed_scripts Directory path to files allowed to include the
	 *                                       file. Must be OS-specific.
	 *     @key string      $request_method  Server request method. Expects GET.
	 *     @key bool        $abspath         If the ABSPATH constant is defined, indicating
	 *                                       WordPress is including the file.
	 * }
	 *
	 * @return bool
	 */
	public function authorize( $file, $conditions ) {

		$authorized = false;

		if ( $this->authorized ) {
			return $authorized;
		} else {
			$this->error_404();
		}
	}

	/**
	 * Emit 404 error headers and end script execution.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function error_404() {

		header( 'HTTP/1.0 404 Not Found', true, 404 );

		/* choose the appropriate page to redirect users */
		header( 'location: /404.php' );

		die();

	}
}
