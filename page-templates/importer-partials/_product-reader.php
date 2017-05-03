<?php 
if (count($products)): ?>
<br>
	<h3>X-Cart Parsed Products</h3>
	<hr>
	<p class="lead">Please review the products below before saving. <b>Tip:</b> Search the page for <span class="label alert">ERROR</span>.</p>
	<?php foreach ($products as $key => $product): ?>
	<span class="label warning"><?php echo $key ?></span>
	<div class="callout warning">
		<?php 
			key_value_pair($product, 0, "ID", "", "");
			key_value_pair($product, 1, "sku", "", "");
			key_value_pair($product, 2, "post_name", "", "success");

			key_value_pair($product, 30, "post_date", product_post_date($product, 30), "");
			key_value_pair($product, 5, "regular_price", "", "");
			key_value_pair($product, 12, "stock", "", "");
			key_value_pair($product, 6, "post_excerpt", "", "");
			key_value_pair($product, 7, "post_content", "", "");

			process_categories($product, 25, $category_terms);			
			process_tags($product, 10, $tag_terms);

			$id = (int) $product[0];
			if (isset($images[$id])) {
				$product_image_array = $images[$id];
				$product_images = array();
				if (isset($product_image_array["images"])) {
					$product_images = $product_image_array["images"];
				}
				$featured_image = array_shift($product_images);
				$gallery = $product_images;
				print_featured_image($product, $featured_image, $media_library);
				print_gallery($gallery, $media_library);
				
			}
			key_value_pair($product, 9, "TITLE_TAG", get_title_tag($product, 9), "secondary");
			key_value_pair($product, 11, "META_DESCRIPTION", '', "secondary");
			// key_value_pair($product, 13, "RATING", '', "secondary");
			key_value_pair($product, 22, "LOW_AVAIL_LIMIT", '', "secondary");
			key_value_pair($product, 31, "VIEWS_STATS", '', "secondary");
			key_value_pair($product, 32, "SALES_STATS", '', "secondary");
			key_value_pair($product, 33, "DEL_STATS", '', "secondary");
			key_value_pair($product, 34, "SMALL_ITEM", '', "secondary");
			key_value_pair($product, 35, "SEPARATE_BOX", '', "secondary");
			key_value_pair($product, 36, "ITEMS_PER_BOX", '', "secondary");

		?>

	</div>	
	<?php endforeach ?>
	<br>
	<hr>
	<br>
    <form action="" method="post" id="save-products-form" class="js-check-form" name="save-products-form" novalidate="">
        <button type="submit" name="save-products" class="button expanded large" tabindex="4">Import X-Cart Products into WordPress</button>

    </form>
    
    <p>Click the button above to run the import.</p>
<?php endif;