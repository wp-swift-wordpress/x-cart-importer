<?php 

$count=0;
$save = true;
$print = false;
$admin_url = admin_url();
if (count($products)): ?>
	<?php foreach ($products as $key => $product): ?>
		<?php 
			$count++;

		?>
		<?php if ($count >5 ): // $count >1 && $count <6 // $count >1 && $count <6 // $count==1 ?>
			<span class="label warning"><?php echo $key ?></span>
			<div class="callout secondary">

				<?php
					$post_id = false;
					$args = array(
						'post_date' => product_post_date($product, 30),
					    'post_title' => $product[2],
					    'post_content' => $product[7],
					    'post_excerpt' => $product[6],
					    'post_status' => 'publish',
					    'post_type' => "product",
					);
					if (isset($args)) {
						if ($print) {
							echo "<pre>"; var_dump($args); echo "</pre>";
						}
						
						if ($save) {
							$post_id = wp_insert_post( $args );
						}
					}
				
					$category_term_ids = process_categories_ids($product, $index=25, $category_terms);
					$tag_term_ids = process_tag_ids($product, $index=10, $tag_terms);
					
					if (count($category_term_ids)) {
						if ($print) {
							echo "<pre>"; var_dump($category_term_ids); echo "</pre>";
						}
						
						if ($save) {
							wp_set_object_terms( $post_id, $category_term_ids, 'product_cat' );
						}					
					}
				
					if (count($tag_term_ids)) {
						if ($print) {
							echo "<pre>"; var_dump($tag_term_ids); echo "</pre>";
						}
						
						if ($save) {
							wp_set_object_terms( $post_id, $tag_term_ids, 'product_tag' );
						}					
					}
					$featured_image = get_featured_image_id($product[0], $images);
					if ($print) {
						echo "<pre>"; var_dump($featured_image["wordpress_id"]); echo "</pre>";
					}
					
					$gallery_ids = get_gallery_ids($product[0], $images);
					if ($print) {
						echo "<pre>"; var_dump($gallery_ids); echo "</pre>";
					}
					
					if (isset($featured_image["wordpress_id"]) && $featured_image["wordpress_id"] !== '') {
						if ($save) {
							set_post_thumbnail($post_id, $featured_image["wordpress_id"]);
						}
					}
					else {
						echo '<pre><span class="label alert">ERROR</span> No featured image found</pre>';
					}
				
					if ($save) {
				
				
						if (isset($gallery_ids)) {
							update_post_meta($post_id,'_product_image_gallery', $gallery_ids);
						}
						update_post_meta( $post_id, '_visibility', 'visible' );
						update_post_meta( $post_id, '_stock_status', 'instock');
						update_post_meta( $post_id, 'total_sales', '0' );
						update_post_meta( $post_id, '_downloadable', 'no' );
						update_post_meta( $post_id, '_virtual', 'no' );
						update_post_meta( $post_id, '_regular_price', $product[5] );
						update_post_meta( $post_id, '_sale_price', '' );
						update_post_meta( $post_id, '_purchase_note', '' );
						update_post_meta( $post_id, '_featured', 'no' );
						update_post_meta( $post_id, '_weight', '' );
						update_post_meta( $post_id, '_length', '' );
						update_post_meta( $post_id, '_width', '' );
						update_post_meta( $post_id, '_height', '' );
						update_post_meta( $post_id, '_sku', $product[1] );
						update_post_meta( $post_id, '_product_attributes', array() );
						update_post_meta( $post_id, '_sale_price_dates_from', '' );
						update_post_meta( $post_id, '_sale_price_dates_to', '' );
						update_post_meta( $post_id, '_price', $product[5] );
						update_post_meta( $post_id, '_sold_individually', '' );
						update_post_meta( $post_id, '_manage_stock', 'no' );
						update_post_meta( $post_id, '_backorders', 'no' );
						update_post_meta( $post_id, '_stock', $product[12] );
				
						// Save the 'Legacy ID' from Xcart
						if ($product[0] !== '') {
							update_field("field_58ee394501678", $product[0] , $post_id);// legacy_id
						}
						// Save the 'Meta Description from Xcart
						if ($product[11] !== '') {
							update_field("field_58ee39c001679", $product[11] , $post_id);// meta_description
						}
						
				
					}
					if ($post_id):
						?>
							<h5><?php echo $product[2] ?> has been saved</h5>
							<a href="<?php echo $admin_url.'post.php?post='.$post_id.'&action=edit'; ?>" target="_blank">Edit Post</a>
						<?php
					endif;
				?>	
				</div>		
		<?php endif ?>
	<?php endforeach ?>
<?php endif;