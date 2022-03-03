<?php
/**
 * The file that defines the core plugin class.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Core
 * @copyright  Zachary Watkins 2022
 * @author     Zachary Watkins <watkinza@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/src/class-wordpress-plugin-name.php
 * @since      0.1.0
 */

namespace Plugin_Name\Src;

use \Plugin_Name\Src\Assets;
use \Plugin_Name\Util\PostType;
use \Plugin_Name\Util\Taxonomy;
use \ThoughtfulWeb\SettingsPageWP\Page;

/**
 * The core plugin Class.
 *
 * @see    https://www.php.net/manual/en/language.oop5.basic.php
 * @since  0.1.0
 * @return void
 */
class Init {

	/**
	 * Initialize the class.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function __construct() {

		// Load the assets.
		new Assets();

		// Load the settings page.
		new \ThoughtfulWeb\SettingsPageWP\Page();

		// Register a custom post type.
		new PostType( 'new_post_type', 'New Post Type', 'New Post Types', array( 'taxonomy' => 'new_taxonomy' ) );

		// Register Advanced Custom Fields.
		add_action('acf/init', array( $this, 'acf_files' ) );

		// Register a custom taxonomy.
		$taxonomy_meta = array(
			array(
				'slug' => 'text_field',
				'name' => 'Text Field',
				'type' => 'text',
			),
			array(
				'slug' => 'checkbox_field',
				'name' => 'Checkbox Field',
				'type' => 'checkbox',
			),
			array(
				'slug' => 'link_field',
				'name' => 'Link Field',
				'type' => 'link',
			),
			array(
				'slug' => 'editor_field',
				'name' => 'Editor Field',
				'type' => 'editor',
			),
		);
		new Taxonomy( 'new_taxonomy', 'New Taxonomy', 'New Taxonomies', 'new_post_type', array(), $taxonomy_meta, true, true );

	}

	/**
	 * Register ACF files.
	 *
	 * @return void
	 */
	public function acf_files() {

		require PLUGIN_NAME_DIR_PATH . '/advanced-custom-fields/new-post-type.php';

	}
}
