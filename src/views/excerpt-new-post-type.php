<?php
/**
 * Custom post type content added after the excerpt.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Templates
 */

?>
<div class="new-post-type fields excerpt">
	<p><span class="title">Post Meta Fields</p>
	<p><span class="title">Field 1:</span> <?php get_post_meta( get_the_ID(), 'post_field_1', true ); ?></p>
	<p><span class="title">Field 2:</span> <?php get_post_meta( get_the_ID(), 'post_field_2', true ); ?></p>
	<p><span class="title">Field 3:</span> <?php get_post_meta( get_the_ID(), 'post_field_3', true ); ?></p>
</div>
