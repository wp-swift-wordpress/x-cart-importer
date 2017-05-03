<?php
function get_images_from_media_library() {
	$media_library = array();
	$args = array(
	    'post_type' => 'attachment',
	    'post_mime_type' => 'image',
	    'orderby' => 'post_date',
	    'order' => 'desc',
	    'posts_per_page' => -1,
	    'post_status'    => 'inherit'
	);

	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
		global $post;
		$image_src = wp_get_attachment_image_src( get_the_ID() ); 
		$image = array();
		$image["id"] = $post->ID;
		$image["post_title"] = $post->post_title;
		$image["guid"] = $post->guid;
		$media_library[$post->post_title] = $post->ID;
	endwhile;
	wp_reset_postdata();
	return $media_library;
}