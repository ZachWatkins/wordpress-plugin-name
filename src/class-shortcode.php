<?php
/**
 * Assets for the plugin.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary K. Watkins 2023
 * @author    Zachary K. Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-shortcode.php
 */

namespace WordPress_Plugin_Name;

/**
 * Create shortcode to display a static file in the `includes` folder.
 */
class Shortcode {

	/**
	 * Initialize the class
	 *
	 * @param string       $name         The name of the shortcode used in markup.
	 * @param string       $file         The file that renders the shortcode content.
	 * @param array        $attributes   The allowed shortcode attributes.
	 * @param array|string $allowed_html An array of allowed HTML elements and attributes, or a
	 *                                   context name such as 'post'. Default value 'post'. For
	 *                                   the list of accepted context names, see
	 *                                   https://developer.wordpress.org/reference/functions/wp_kses_allowed_html/.
	 * @return void
	 */
	public function __construct(
		protected string $name = 'my-shortcode',
		protected string $file = 'my-shortcode.php',
		protected array $attributes = array(),
		protected $allowed_html = 'post'
	) {
		add_shortcode( $name, array( $this, 'render' ) );
	}

	/**
	 * Rendering function for the shortcode content.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	public function render( $atts ) {

		$atts = shortcode_atts( $this->attributes, $atts );

		ob_start();
		// Included file can use $atts variable.
		include __DIR__ . '/../includes/' . $this->file;
		$output = ob_get_clean();

		return wp_kses( $output, $this->allowed_html );
	}
}
