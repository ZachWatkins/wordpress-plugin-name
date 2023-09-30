<?php
/**
 * Custom post type content added after the full content.
 *
 * @package    WordPress_Plugin_Name
 * @subpackage Templates
 */

?>
<div class="custom-post-type fields content">
	<p><span class="title">Post Meta Fields</p>
	<p><span class="title">Field 1:</span> <?php get_post_meta( get_the_ID(), 'post_field_1', true ); ?></p>
</div>
