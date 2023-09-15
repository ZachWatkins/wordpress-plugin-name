<?php
/**
 * Custom post type content added after the excerpt.
 *
 * @package    WordPress Plugin Name
 * @subpackage Templates
 */

?>
<div class="new-post-type fields excerpt">
	<p><span class="title">Post Fields from Advanced Custom Fields</p>
	<p><span class="title">Field 1:</span> <?php the_field( 'post_field_1' ); ?></p>
	<p><span class="title">Field 2:</span> <?php the_field( 'post_field_2' ); ?></p>
	<p><span class="title">Field 3:</span> <?php the_field( 'post_field_3' ); ?></p>
</div>
