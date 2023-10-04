<?php
/**
 * Custom post type content added after the excerpt.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Templates
 */

?><div class="custom-post-type fields excerpt">
	<p><span class="title">Post Meta Fields</p>
	<p><span class="title">Field 1:</span> <?php get_post_meta( get_the_ID(), 'post_field_1', true ); ?></p>
</div>
<?php echo wp_kses( $props->content, 'post' ); ?>
