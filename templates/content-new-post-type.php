<?php
/**
 * Custom post type content added after the full content.
 *
 * @package    WordPress Plugin Name
 * @subpackage Templates
 */

?>
<div class="new-post-type fields content">
	<p><span class="title">Unique Text Field Setting:</span> <?php echo esc_html( get_option( 'unique_text_field' ) ); ?></p>
	<p><span class="title">Field 1:</span> <?php the_field( 'post_field_1' ); ?></p>
	<p><span class="title">Field 2:</span> <?php the_field( 'post_field_2' ); ?></p>
	<p><span class="title">Field 3:</span> <?php the_field( 'post_field_3' ); ?></p>
</div>
