<?php
/**
 * Settings page for the plugin.
 *
 * @package WordPress_Plugin_Name
 */

namespace WordPress_Plugin_Name;

add_action(
	'admin_menu',
	function () {
		add_options_page(
			__( 'WordPress Plugin Name Settings', 'wordpress-plugin-name-textdomain' ),
			__( 'WordPress Plugin Name', 'wordpress-plugin-name-textdomain' ),
			'manage_options',
			PLUGIN_KEY,
			function () {
				?>
				<div class="wrap">
					<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
					<form action="options.php" method="post">
						<?php
						settings_fields( PLUGIN_KEY );
						do_settings_sections( PLUGIN_KEY );
						submit_button( __( 'Save Settings', 'wordpress-plugin-name-textdomain' ) );
						?>
					</form>
				</div>
				<?php
			}
		);
	}
);

add_action(
	'admin_init',
	function () {
		add_settings_section(
			PLUGIN_KEY,
			__( 'WordPress Plugin Name Settings', 'wordpress-plugin-name-textdomain' ),
			function () {
				echo '<p>' . esc_html__( 'These settings are for the WordPress Plugin Name plugin.', 'wordpress-plugin-name-textdomain' ) . '</p>';
			},
			PLUGIN_KEY
		);

		$api_key_id = PLUGIN_KEY . '_api_key';

		add_settings_field(
			$api_key_id,
			__( 'API Key', 'wordpress-plugin-name-textdomain' ),
			function () use ( $api_key_id ) {
				?>
				<input
					type="text"
					id="<?= esc_attr( $api_key_id ) ?>"
					name="<?= esc_attr( $api_key_id ) ?>"
					value="<?php echo esc_attr( get_option( $api_key_id ) ); ?>"
				/>
				<?php
			},
			PLUGIN_KEY,
			PLUGIN_KEY
		);

		register_setting( PLUGIN_KEY, $api_key_id );
	}
);

