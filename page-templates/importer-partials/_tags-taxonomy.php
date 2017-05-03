<?php
function get_tags_taxonomy() {
	$tags_taxonomy = array();
	$terms = get_terms( 
		'product_tag',
		array('hide_empty' => false) 
	);
	if (count( $terms )) {
		foreach ($terms as $key => $term) {
			$tags_taxonomy[$term->slug] = $term->term_id;
		}
	}
	return $tags_taxonomy;
}