<?php
$all_tags = array();
if (count($products)) {
    foreach ($products as $key => $product) {
    	if ($product[10] !== '' && $product[10] !== 'keywords here...') {
    		$tags = $product[10];
    		$tags = trim($tags);
    		$tags = rtrim($tags, ',');
    		$tags = explode(',', $tags);
    		foreach ($tags as $key => $tag) {
    			$tag = trim($tag);
    			$tag = ucwords($tag);
    			$tag = ucwords($tag, "/");
    			$all_tags[] = $tag;
    		}
    	}
		
    }
}

$tag_string = '';
$tag_occurences = array_count_values($all_tags);
foreach ($tag_occurences as $key => $occurence) {
    if (strpos($key, '/')) {
    	$key = str_replace('/', '-', $key);
    	echo "<pre>$key</pre>";
    }	
    $tag_string .= $key.', ';
}
$tag_string = rtrim($tag_string, ', ');
echo $tag_string;