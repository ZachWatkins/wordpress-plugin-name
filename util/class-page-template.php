<?php
/**
 * The file that facilitates page template file registration.
 *
 * @package    ThoughtfulWeb
 * @subpackage Utility
 * @copyright  Zachary Watkins 2021
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-page-template.php
 * @since      0.1.0
 */

namespace ThoughtfulWeb\Util;

/**
 * The class that registers page template file registration.
 *
 * @see   https://www.php.net/manual/en/language.oop5.basic.php
 * @since 0.1.0
 */
class Page_Template {

	/**
	 * Base directory for the plugin.
	 *
	 * @var string $basedir The directory of the root plugin file.
	 */
	private $basedir = '';

	/**
	 * Reserved names.
	 *
	 * These page template names are reserved by WordPress themes.
	 *
	 * @var reserved_filems
	 */
	private $reserved_filenames = array(
		'page.php',
		'page-%s.php',
	);

	/**
	 * Default page template headers.
	 *
	 * @var array $default_headers {
	 *     An associative array of page template headers.
	 *
	 *     @type string $TemplateName The template name.
	 *     @type string $Description  The template description.
	 * }
	 */
	private $default_headers = array(
		'TemplateName' => 'Template Name Not Found',
		'Description'  => 'Description not found.',
	);

	/**
	 * Page template headers for registered page templates.
	 *
	 * @var array ...$template_headers {
	 *     An enumerable array of page template header configurations.
	 * }
	 */
	private $template_headers = array();

	/**
	 * Template file headers and other data.
	 *
	 * @var array $template_meta {
	 *     The page template headers and other data.
	 *
	 *     @key string $path The relative file page to the page template.
	 * }
	 */
	private $template_meta = array();

	/**
	 * Template file paths for hooks.
	 *
	 * @var array $template_paths {
	 *     A series of "filename.php":"Template Name" pairs.
	 * }
	 */
	private $template_paths;

	/**
	 * Construct the class.
	 *
	 * @since  0.1.0
	 * @param  array $templates {
	 *     Page template data not able to be stored in the file header.
	 *
	 *     @key string $path The relative file path to the page template.
	 * }
	 * @return void
	 */
	public function __construct( $templates = array() ) {

		if ( empty( $templates ) ) {
			return;
		}

		if ( ! defined( 'THOUGHTFULWEB_UTIL_PLUGIN_FILE' ) ) {
			$this->alert( 'thoughtful_util_constant_undefined', 'The constant "THOUGHTFULWEB_UTIL_PLUGIN_FILE" is undefined.' );
		}

		// Set up the true $this->basedir value.
		$this->basedir = plugin_dir_path( THOUGHTFULWEB_UTIL_PLUGIN_FILE );

		// Store the template data.
		$this->template_meta = $this->sanitize_template_meta( $templates );

		// Store template file paths and the plugin's base directory.
		$this->set_template_headers();

		// Register templates.
		$this->register_templates();

	}

	/**
	 * Call an Alert class method if available.
	 *
	 * @since 0.1.0
	 *
	 * @param  string|int $code    Alert code.
	 * @param  string     $message Alert message.
	 * @param  mixed      $data    Optional. Alert data.
	 * @return bool|void
	 */
	private function alert( $code = '', $message = '', $data = '' ) {

		if ( class_exists( '\ThoughtfulWeb\Util\Alert' ) && method_exists( '\ThoughtfulWeb\Util\Alert', 'display' ) ) {
			\ThoughtfulWeb\Util\Alert::display( $code, $message, $data );
		} else {
			$wp_error = new \WP_Error( $code, $message, $data );
			$messages = $wp_error->get_error_messages();
			$messages = implode( ' ', $messages );
			wp_die( wp_kses_post( $messages ) );
		}

	}

	/**
	 * Sanitize the template_meta variable.
	 *
	 * @since  0.1.0
	 * @param  array $template_meta {
	 *     Array of page template data definitions not able to be stored in the file header.
	 *
	 *     @key string $path The relative file path of the page template.
	 * }
	 * @return array
	 */
	public function sanitize_template_meta( $template_meta = array() ) {

		$result = true;

		if ( empty( $template_meta ) ) {

			$this->alert(
				'plugin_templates_undefined',
				__(
					'The plugin called a page template class constructor without defining page template files.',
					'wordpress-plugin-name'
				),
				array( 'back_link' => true )
			);

		}

		// Ensure template_meta is an array of arrays.
		$is_numeric  = array_keys( $template_meta ) === range( 0, count( $template_meta ) - 1 );
		$first_value = array_values( $template_meta )[0];
		if ( ! $is_numeric && ! is_array( $first_value ) ) {
			$template_meta = array( $template_meta );
		}

		$all_valid = true;
		foreach ( $template_meta as $template ) {
			// Confirm the page template file is valid.
			$valid = $this->validate_template_path( $template );
			if ( false === $valid ) {
				$all_valid = false;
				break;
			}
		}

		return $template_meta;

	}

	/**
	 * Validate a relative file path in case of incorrect file path definition.
	 *
	 * @since 0.1.0
	 *
	 * @param array $template_meta {
	 *     Accepts false or array. Template details provided by a plugin author. Default false.
	 *
	 *     @key string $path The relative path of a plugin's page template file.
	 * }
	 *
	 * @throws \WP_Error Mixed.
	 *
	 * @return bool|void
	 */
	public function validate_template_path( $template_meta = array() ) {

		$passed = false;

		if ( false === is_array( $template_meta ) ) {

			$this->alert(
				'plugin_template_undefined',
				__(
					'The template_meta variable must be an array.',
					'wordpress-plugin-name'
				),
				array( 'back_link' => true )
			);

		} elseif ( ! array_key_exists( 'path', $template_meta ) || empty( $template_meta['path'] ) ) {

			$this->alert(
				'plugin_template_path_undefined',
				__(
					'The template_meta "path" member must be defined and must be a relative path. Example: templates/example.php',
					'wordpress-plugin-name'
				),
				array( 'back_link' => true )
			);

		} else {

			$full_path = $this->basedir . $template_meta['path'];
			$file      = wp_basename( $template_meta['path'] );

			if ( ! file_exists( $full_path ) ) {

				$this->alert(
					'plugin_template_file_not_found',
					sprintf(
						/* translators: 1: Plugin defined page template file path 2: Full path */
						__(
							'The template file %1$s does not exist at the path %2$s.',
							'wordpress-plugin-name'
						),
						$template_meta['path'],
						$full_path
					),
					array( 'back_link' => true )
				);

			} elseif ( 0 === strpos( $file, 'page-' ) ) {

				/**
				 * Possible issue with page template files that start with "page-".
				 * https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use
				 */
				$this->alert(
					'plugin_template_filename',
					sprintf(
						/* translators: %s: Plugin defined page template file path */
						__(
							'Hi, Zach here. I am unsure if this is the case for hook-based page template registration but there may be an issue with your page template name. The template file name "%s" cannot start with "page-" as a prefix, as WordPress may interpret the file as a specialized template meant to apply to only one page on your site. Source: https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use',
							'wordpress-plugin-name'
						),
						$template_meta['path']
					),
					array( 'back_link' => true )
				);

			} else {

				$passed = true;

			}
		}

		return $passed;

	}

	/**
	 * Get page template file headers as associative arrays.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/get_file_data/
	 * @see    https://www.php.net/manual/en/function.array-merge.php
	 * @see    https://www.php.net/manual/en/function.is-array.php
	 * @since  0.1.0
	 * @return void
	 */
	private function set_template_headers() {

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

	/**
	 * Register the page template in the WordPress dashboard.
	 *
	 * In WordPress v4.7 a change allowed page templates to be registered differently.
	 * The version check is for backwards compatibility.
	 *
	 * @see    https://www.php.net/manual/en/function.version-compare.php
	 * @see    https://www.php.net/manual/en/function.floatval.php
	 * @see    https://developer.wordpress.org/reference/functions/add_filter/
	 * @see    https://developer.wordpress.org/reference/hooks/theme_page_templates/
	 * @see    https://developer.wordpress.org/reference/hooks/admin_init/
	 * @see    https://developer.wordpress.org/reference/hooks/wp_insert_post_data/
	 * @see    https://developer.wordpress.org/reference/hooks/template_include/
	 * @since  0.1.0
	 * @return void
	 */
	private function register_templates() {

		// Store template file paths The WordPress Way for use in Core filters.
		$this->set_template_paths();

		if ( version_compare( floatval( $GLOBALS['wp_version'] ), '4.7', '<' ) ) {
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'add_to_cache' ) );
		} else {
			add_filter( 'theme_page_templates', array( $this, 'add_to_cache_templates' ) );
		}

		add_filter( 'admin_init', array( $this, 'add_to_cache' ) );
		add_filter( 'wp_insert_post_data', array( $this, 'add_to_cache' ) );
		add_filter( 'template_include', array( $this, 'view_project_template' ) );

	}

	/**
	 * Add template to cache of theme page templates
	 *
	 * @see   https://developer.wordpress.org/reference/hooks/theme_page_templates/
	 * @see   https://www.php.net/manual/en/function.md5.php
	 * @see   https://developer.wordpress.org/reference/functions/get_theme_root/
	 * @see   https://developer.wordpress.org/reference/functions/get_stylesheet/
	 * @see   https://www.php.net/manual/en/function.empty.php
	 * @see   https://developer.wordpress.org/reference/functions/wp_cache_delete/
	 * @see   https://www.php.net/manual/en/function.array-merge.php
	 * @see   https://developer.wordpress.org/reference/functions/wp_cache_add/
	 * @since 0.1.0
	 *
	 * @param array $templates List of page templates.
	 *
	 * @return array
	 */
	public function add_to_cache_templates( $templates ) {

		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		if ( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key, 'themes' );

		$templates = array_merge( $templates, $this->template_paths );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $templates;

	}

	/**
	 * Add template to cache of theme page templates
	 *
	 * @see   https://developer.wordpress.org/reference/hooks/wp_insert_post_data/
	 * @see   https://www.php.net/manual/en/function.md5.php
	 * @see   https://developer.wordpress.org/reference/functions/get_theme_root/
	 * @see   https://developer.wordpress.org/reference/functions/get_stylesheet/
	 * @see   https://developer.wordpress.org/reference/functions/wp_get_theme/
	 * @see   https://developer.wordpress.org/reference/classes/wp_theme/get_page_templates/
	 * @see   https://www.php.net/manual/en/function.empty.php
	 * @see   https://developer.wordpress.org/reference/functions/wp_cache_delete/
	 * @see   https://www.php.net/manual/en/function.array-merge.php
	 * @see   https://developer.wordpress.org/reference/functions/wp_cache_add/
	 * @since 0.1.0
	 *
	 * @param array $atts Cache attributes.
	 *
	 * @return array
	 */
	public function add_to_cache( $atts ) {

		// Create a unique key for the cache item.
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Extract templates if using WordPress <4.7.
		$templates = wp_get_theme()->get_page_templates();

		if ( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key, 'themes' );

		$templates = array_merge( $templates, $this->template_paths );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Add template to template_include
	 *
	 * @see   https://developer.wordpress.org/reference/hooks/template_include/
	 * @see   https://developer.wordpress.org/reference/functions/get_post_meta/
	 * @see   https://www.php.net/manual/en/function.file-exists.php
	 * @see   https://developer.wordpress.org/reference/functions/esc_url/
	 * @since 0.1.0
	 *
	 * @param string $template Template.
	 *
	 * @return string
	 */
	public function view_project_template( $template ) {

		// Get global post.
		global $post;

		// Return template if post is empty.
		if ( ! $post ) {
			return $template;
		}

		// Stop the function if it's running for a template not defined for this plugin.
		$template_meta = get_post_meta(
			$post->ID,
			'_wp_page_template',
			true
		);
		if ( ! isset( $this->template_paths[ $template_meta ] ) ) {
			return $template;
		}

		$template = $this->basedir . $template_meta;

		// Just to be safe, we check if the file exist first.
		if ( file_exists( $template ) ) {
			return $template;
		}

		// Return template.
		return $template;

	}

}
