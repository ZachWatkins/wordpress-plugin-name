<?php
/**
 * The post type archive "template".
 * It is not a WordPress Template - instead, it is a dynamic HTML file loaded when this post type is being rendered in a certain context.
 */
?>
<div class="archive-new-post-type">
	<p><span class="title">Field 1:</span> <?php the_field( 'post_field_1' ); ?></p>
	<p><span class="title">Field 2:</span> <?php the_field( 'post_field_2' ); ?></p>
	<p><span class="title">Field 3:</span> <?php the_field( 'post_field_3' ); ?></p>
</div>
