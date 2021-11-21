<?php
/**
 * The WordPress admin notice generator class file.
 *
 * Tips for helpful notices:
 *     Pointer to current line in file: __LINE__
 *     Get the current class name:      get_class($this)
 *
 * @package    ThoughtfulWeb\Library
 * @subpackage Admin
 * @author     Zachary Kendall Watkins <zwatkins.it@gmail.com>
 * @copyright  2021 Zachary Kendall Watkins
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link       https://github.com/zachwatkins/wordpress-plugin-name/blob/master/thoughtfulweb/library/admin/class-notice.php
 * @since      0.1.0
 */

declare(strict_types=1);
namespace ThoughtfulWeb\Library\Admin;

/**
 * The Notice class.
 */
class Notice {

	/**
	 * The admin notice store.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_notices/
	 *
	 * @since 0.1.0
	 *
	 * @var array $notices {
	 *     All notices registered by the class instance.
	 *
	 *     @key array The notice slug. {
	 *         The notice configuration parameters.
	 *
	 *         @key string $mode    The notice mode.
	 *         @key string $message The notice message.
	 *     }
	 * }
	 */
	private $notices = array();

	/**
	 * Construct a new admin notice. Must be instantiated before the 'admin_notices' hook.
	 *
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since 0.1.0
	 *
	 * @param string $slug    The slug used by core processes.
	 * @param string $mode    The notice mode. Accepts success, warning, and error.
	 * @param string $message The notice message template string.
	 * @param bool   $dismiss If the notice can be dismissed.
	 * @param array  $permit  How to decide which user(s) to show the notice to.
	 *
	 * @return void
	 */
	public function __construct( $slug, $mode, $message, $dismiss = true, $permit = array( 'cap' => 'read' ) ) {

		$first_notice = empty( $this->notices ) ? true : false;
		$notice       = array(
			'mode'    => $mode,
			'message' => $message,
			'permit'  => $permit,
		);

		$this->notices[ $slug ] = $notice;

		if ( $first_notice ) {
			$this->add_hooks();
		}
	}

	/**
	 * Add WordPress action and filter hooks as necessary.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	private function add_hooks() {

		add_action( 'admin_notices', array( $this, 'display_notices' ) );

	}

	/**
	 * Display the admin notices.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function display_notices() {

		global $pagenow;

		// Exit early if no notices found.
		$notices = $this->notices;
		if ( empty( $notices ) ) {
			return;
		}

		$output = '';

		foreach ( $notices as $slug => $notice ) {
			// Check user against permissions.
			$permit_user = $this->can_view_notice( $notice['permit'] );
			if ( false === $permit_user ) {
				continue;
			}

			// Add the message to the output.
			$output .= sprintf(
				'<div id="' . $slug . '" class="notice notice-' . esc_attr( $notice['mode'] ) . '"><p>',
			);
			/* translators: Translations must occur before this class is provided with the message. */
			$output .= $notice['message'];
			$output .= '</p></div>';
		}

		echo wp_kses_post( $output );
	}

	/**
	 * Test user roles and capabilities against a notice's configurations.
	 *
	 * @param array $permits The roles and/or capabilities a user must have.
	 *
	 * @return boolean
	 */
	public function can_view_notice( $permits ) {

		foreach ( $permits as $type => $value ) {
			switch( $type ) {
				case 'cap':
				case 'role':
					if ( ! current_user_can( $value ) ) {
						return false;
					}
					break;
				default:
					break;
			}
		}

		return true;
	}
}
