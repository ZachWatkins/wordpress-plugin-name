<?php
/**
 * Assets for the plugin.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.`com`>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/src/class-shortcode.php
 */

namespace WordPress_Plugin_Name;

/**
 * Create shortcode to display the faculty search form.
 */
class Shortcode {

	protected const DEFAULT_ATTRIBUTE_VALUES = array(
		'id'    => 'shortcode-id',
		'class' => 'shortcode-class',
	);

	/**
	 * Initialize the class
	 *
	 * @param string $name The name of the shortcode used in markup.
	 * @param array  $attributes The allowed shortcode attributes.
	 * @param string $file The file that renders the shortcode content.
	 * @return void
	 */
	public function __construct(
		protected string $name = 'my-shortcode',
		protected array $attributes = array(),
		protected string $file = 'my-shortcode.php'
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

		$atts = shortcode_atts( self::DEFAULT_ATTRIBUTE_VALUES, $atts );

		// Sanitize shortcode parameters for security.
		$atts['id']    = esc_attr( $atts['id'] );
		$atts['class'] = esc_attr( $atts['class'] );

		ob_start();
		// The shortcode.php file has access to the $atts variable.
		include __DIR__ . '/../includes/' . $this->file;
		$output = ob_get_clean();

		return wp_kses(
			$output,
			array(
				'div'    => array(
					'id'    => array(),
					'class' => array(),
				),
				'script' => array(
					'src' => array(),
				),
			)
		);
	}
}
