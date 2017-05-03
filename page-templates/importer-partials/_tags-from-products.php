<?php
function get_tags_from_products($products) {

    $all_tags = array();
    if (count($products)) {
        foreach ($products as $key => $product) {
            if ($product[10] !== '' && $product[10] !== 'keywords here...') {
                $tag_array = array();
                $tags = $product[10];
                $tags = trim($tags);
                $tags = str_replace('.', ',', $tags);
                $tags = rtrim($tags, ',');
                $tags = explode(',', $tags);
                foreach ($tags as $key => $tag) {
                    $tag = trim($tag);
                    $tags = rtrim($tag, '.');
                    $tag = ucwords($tag);
                    $tag = str_replace('/', '-', $tag);
                    $tag_array['name'] = $tag;
                    $tag_array['lug'] = slug($tag);
                    $all_tags[] = $tag;
                }
            }
            
        }
    }

    return $all_tags;
}


function get_tag_occurences($all_tags) {

    $tag_string = '';
    $tag_occurences = array_count_values($all_tags);
    foreach ($tag_occurences as $key => $occurence) {
        if (strpos($key, '/')) {
            $key = str_replace('/', '-', $key);
        }   
        $tag_string .= $key.', ';
    }
    $tag_string = rtrim($tag_string, ', ');

    return $tag_occurences;
}


function insert_tags($tags) {
    foreach ($tags as $tag_name => $count) {
        $tag_slug = slug($tag_name);

        $results = wp_insert_term(
          $tag_name, // the term 
          'product_tag', // the taxonomy
          array(
            'description'=> '',
            'slug' => $tag_slug,
            'parent'=> 0
          )
        );
    }
}
