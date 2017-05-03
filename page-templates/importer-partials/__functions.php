<?php
/**
 * Change string into lowercase slug
 * 
 * @param 	$string 	Any string
 * @return 	$string 	Converted string into slug
 */
function slug($string) {
    # Lower case everything
    $string = strtolower($string);
    # Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    # Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    # Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function key_value_pair($product, $index='', $key, $value='', $class='') {
	if ($value == '') {
		if (isset($product[$index])) {
			$value = $product[$index];
		}
	}
	?>
	<?php if ($value === '0' || $value): ?>
		<?php  ?>
		<div class="key-value-pair">
			<span class="key"><span class="label <?php echo $class ?>"><?php echo $key ?></span></span>
			<span class="value"><?php echo $value ?></span>
		</div>	
	<?php else: ?>	
		<div class="key-value-pair">
			<span class="key"><span class="label alert"><?php echo $key ?></span></span>
			<?php if ($class == 'secondary'): ?>
				<span class="value error"><?php echo $key ?> not found <i><small>(not needed)</small></i></span>
			<?php else: ?>
				<span class="value error"><b>KEY ERROR: <?php echo $key ?> not found </b></span>
			<?php endif ?>
			
		</div>		
	<?php endif;
}

function process_tags($product, $index, $tag_terms) {
?>
	<span class="label">Tags</span>
	<div class="callout">
		<?php 

			if (isset($product[$index])) {
				$tags = $product[$index];
				if ($tags !== 'keywords here...') {
					echo "<p>"; echo ($tags); echo "</p>";
				}
				$tags = trim($tags);
	    		$tags = rtrim($tags, ',');
	    		$tags = str_replace('. ', ', ', $tags);
	    		$tags = explode(',', $tags);
	    		$tag_string = '';
	    		$all_tags = array();
	    		foreach ($tags as $key => $tag) {
	    			if ($tag !== '' && $tag !== 'keywords here...') {
		    			$tag = trim($tag);
		    			$tag = rtrim($tag, '.');
		    			$tag = strtolower($tag);
		    			$tag = str_replace(' - ', '-', $tag);
		    			$tag = str_replace(' ', '-', $tag);
		    			$tag = str_replace('/', '-', $tag);


		    			$all_tags[] = $tag;
		    			$tag_string .= $tag.'|';
	    			}
	    		}
	    		$tag_string = rtrim($tag_string, '|');

				if (count($all_tags) ) {
					foreach ($all_tags as $key => $tag) {

						if (isset($tag_terms[$tag])) {
							echo "<pre>$tag <span class='label warning'>$tag_terms[$tag]</span></pre>";
						}
						else {
							echo "<pre>$tag <span class='label alert'>ERROR: No tag found</span></pre>";
						}
					}
				}

			}

		?>
		<br>
		<p><small>The yellow <span class="label warning">box</span> shows the term ID.</small></p>
	</div>
<?php
}

function process_tag_ids($product, $index, $tag_terms) {
$term_ids = array();
	if (isset($product[$index])) {
		$tags = $product[$index];

		$tags = trim($tags);
		$tags = rtrim($tags, ',');
		$tags = str_replace('. ', ', ', $tags);
		$tags = explode(',', $tags);
		$tag_string = '';
		$all_tags = array();
		foreach ($tags as $key => $tag) {
			if ($tag !== '' && $tag !== 'keywords here...') {
    			$tag = trim($tag);
    			$tag = rtrim($tag, '.');
    			$tag = strtolower($tag);
    			$tag = str_replace(' - ', '-', $tag);
    			$tag = str_replace(' ', '-', $tag);
    			$tag = str_replace('/', '-', $tag);


    			$all_tags[] = $tag;
    			$tag_string .= $tag.'|';
			}
		}
		$tag_string = rtrim($tag_string, '|');
		if (count($all_tags) ) {
			foreach ($all_tags as $key => $tag) {

				if (isset($tag_terms[$tag])) {
					$term_ids[] = $tag_terms[$tag];
				}
			}
		}
	}
	return $term_ids;
}
function process_categories($product, $index, $category_terms) {
?>
	<span class="label">Categories</span>
	<div class="callout">
		<?php 

			if (isset($product[$index])) {
				$categories = $product[$index];

				if (count($categories)) {
					foreach ($categories as $key => $category) {

						if (isset($category_terms[$category['slug']])) {
							echo "<pre>".$category['slug']." <span class='label warning'>".$category_terms[$category['slug']]."</span></pre>";
						}
						else {
							echo "<pre>".$category['slug']." <span class='label alert'>ERROR: No tag found</span></pre>";
						}					
						
					}
				}
			}
		?>
		<br>
		<p><small>The yellow <span class="label warning">box</span> shows the category ID.</small></p>
	</div>
<?php
}
function process_categories_ids($product, $index, $category_terms) {
	$cat_ids = array();
	if (isset($product[$index])) {
		$categories = $product[$index];

		if (count($categories)) {
			foreach ($categories as $key => $category) {

				if (isset($category_terms[$category['slug']])) {
					$cat_ids[] = $category_terms[$category['slug']];
				}				
				
			}
		}
	}
	return $cat_ids;
}
function product_post_date($product, $index) {
	$date_format = '';
	if (isset($product[$index])) {
		$post_date = $product[$index]; 
		$date = new DateTime($post_date);
		$date_format = date_format($date, 'Y-m-d H:i:s');
	}
	return $date_format;
}
function get_title_tag($product, $index) {
	$title_tag = '';
	if (isset($product[$index])) {
		if ($product[$index] !== 'include title here') {
			$title_tag = $product[$index];
		}
	}
	return $title_tag;
}
function get_attachment_url_by_slug( $slug, $media_library ) {
	if (isset($media_library[$slug])) {
		return $media_library[$slug];
	}
	return false;
}
function print_featured_image($product, $featured_image, $media_library) {
	global $image_errors;
	$featured_image_filepath='';
	if (isset($featured_image["filepath"])): ?>

		<span class="label">featured_image</span>
		<div class="callout">	
			<table>
				<thead>
					<tr>
						<th>Original Filepath</th>
						<th width="200">Slug</th>
						<th width="150">Extension</th>
						<th width="150">IMAGEID</th>
						<th width="150">WordPress ID</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $featured_image["filepath"]; ?></td>
						<td><?php echo $featured_image["slug"]; ?></td>
						<td><?php echo $featured_image["extension"]; ?></td>
						<td><?php echo $featured_image["IMAGEID"]; ?></td>
						<td><?php 
							$id = get_attachment_url_by_slug( $featured_image["slug"], $media_library );

							if ($id) {
								echo '<span class="label warning">';//IMG FOUND 
								echo $id;
								echo '</span>IMG FOUND';
							}
							else {
								echo '<span class="label alert">FEAT IMG ERROR</span>';
								// $image_errors[] = $featured_image["filepath"];
								$image_errors[] = $product[2];
							}
						?></td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php
	endif;
}
function print_gallery($gallery, $media_library) {
	global $image_errors;
	if (count($gallery)): ?>
		<span class="label">Gallery</span>
		<div class="callout">	
			<table>
				<thead>
					<tr>
						<th>Original Filepath</th>
						<th width="200">Slug</th>
						<th width="150">Extension</th>
						<th width="150">IMAGEID</th>
						<th width="150">WordPress ID</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($gallery as $key => $gallery_image): ?>
						<tr>
							<td><?php echo $gallery_image["filepath"]; ?></td>
							<td><?php echo $gallery_image["slug"]; ?></td>
							<td><?php echo $gallery_image["extension"]; ?></td>
							<td><?php echo $gallery_image["IMAGEID"]; ?></td>
							<td><?php 
								$id = get_attachment_url_by_slug( $gallery_image["slug"], $media_library );

								if ($id) {
									echo '<span class="label warning">';//IMG FOUND 
									echo $id;
									echo '</span>IMG FOUND';
								}
								else {
									echo '<span class="label alert">IMG ERROR</span>';
								}
							?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php endif;
}


function update_post_meta_check($post_id, $product, $meta_key, $meta_value) {

}

function get_featured_image_id ($id, $images) {
	$id = (int) $id;
	if (isset($images[$id])) {
		$product_image_array = $images[$id];
		$product_images = array();
		if (isset($product_image_array["images"])) {
			$product_images = $product_image_array["images"];
		}
		$featured_image = array_shift($product_images);
		return $featured_image;
	}	
}

function get_gallery_ids ($id, $images) {
	$id = (int) $id;
	if (isset($images[$id])) {
		$product_image_array = $images[$id];
		$product_images = array();
		if (isset($product_image_array["images"])) {
			$product_images = $product_image_array["images"];
		}
		$featured_image = array_shift($product_images);
		$gallery = $product_images;
		$gallery_id_string = '';

		foreach ($gallery as $key => $image) {
			if (isset($image["wordpress_id"]) && $image["wordpress_id"] != '') {
				$gallery_id_string .= $image["wordpress_id"].',';
			}
		}
		$gallery_id_string = rtrim($gallery_id_string, ',');
		return $gallery_id_string;
	}	
}