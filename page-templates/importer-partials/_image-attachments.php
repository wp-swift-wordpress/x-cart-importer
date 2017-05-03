<?php
function get_image_attachments() {
	$query_images_args = array(
	    'post_type'      => 'attachment',
	    'post_mime_type' => 'image',
	    'post_status'    => 'inherit',
	    'posts_per_page' => - 1,
	);

	$query_images = new WP_Query( $query_images_args );

	$images = array();
	foreach ( $query_images->posts as $image ) {
		$image_array = array();
	    $images[$image->post_name] = $image->ID;	
	}
	return $images;	
}

function get_image_attachment_objects() {
	$query_images_args = array(
	    'post_type'      => 'attachment',
	    'post_mime_type' => 'image',
	    'post_status'    => 'inherit',
	    'posts_per_page' => - 1,
	);

	$images = new WP_Query( $query_images_args );
	return $images;	
}