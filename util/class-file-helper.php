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

class File_Helper {

	/**
	 * Get page template file headers as associative arrays.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/get_file_data/
	 * @see    https://www.php.net/manual/en/function.array-merge.php
	 * @see    https://www.php.net/manual/en/function.is-array.php
	 * @since  0.1.0
	 * @return void
	 */
	private static function set_template_headers() {

	foreach ( $this->template_meta as $template_meta ) {
		$file      = basename( $template_meta['path'] );
		$file_data = get_file_data( $this->basedir . $template_meta['path'], $this->default_headers );
		if ( is_array( $file_data ) ) {
			$this->template_headers[ $file ] = $file_data;
		}
	}

	}

	/**
	* Set template_paths variable.
	*
	* @since 0.1.0
	*
	* @return void
	*/
	private function set_template_paths() {

	$template_paths   = array();
	$template_headers = $this->template_headers;

	foreach ( $this->template_meta as $key => $template ) {

		$file = basename( $template['path'] );
		$name = $template_headers[ $file ]['TemplateName'];

		// Define the structure The WordPress Way.
		$template_paths[ $file ] = $name;

	}

	$this->template_paths = $template_paths;

	}
	}
