<?php
/**
 * The file that defines the generated shortcode content.
 *
 * @package   WordPress_Plugin_Name
 * @copyright Zachary Watkins 2023
 * @author    Zachary Watkins <zwatkins.it@gmail.com>
 * @license   GPL-2.0-or-later
 * @link      https://github.com/zachwatkins/wordpress-plugin-name/blob/main/includes/my-shortcode.php
 */

// You may register and enqueue assets within your shortcode output render function.
wp_register_script(
	'wordpress-plugin-name-my-shortcode-script',
	plugins_url( 'wordpress-plugin-name/assets/js/my-shortcode.js' ),
	array(),
	filemtime( plugin_dir_path( dirname( __DIR__ ) . '/wordpress-plugin-name.php' ) . 'assets/js/my-shortcode.js' ),
	true
);
wp_register_style(
	'wordpress-plugin-name-my-shortcode-style',
	plugins_url( 'wordpress-plugin-name/assets/css/my-shortcode.css' ),
	array(),
	filemtime( plugin_dir_path( dirname( __DIR__ ) . '/wordpress-plugin-name.php' ) . 'assets/css/my-shortcode.css' )
);
wp_enqueue_script( 'wordpress-plugin-name-my-shortcode-script' );
wp_enqueue_script( 'wordpress-plugin-name-my-shortcode-style' );

?><div id="my-shortcode">Hello, WordPress!</div>
<?php
