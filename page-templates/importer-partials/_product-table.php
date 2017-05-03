<?php 
if (count($products)): ?>
	<table>
		<thead>
			<tr>
				<!-- <th>Count</th> -->
				<th>ID</th>
				<th>sku</th>
				<th>post_name</th>
				<th>image name</th>
				<th>IMAGE</th>
				<th>featured_image</th>

				<th>post_date</th>
				<th>regular_price</th>
				<th>tags</th>

				<th>TITLE_TAG</th><!-- TITLE_TAG -->
				<th>stock</th><!-- AVAIL -->
				<th>META_DESCRIPTION</th><!-- META_DESCRIPTION -->
				<th>RATING</th><!-- RATING -->
				<th>LOW_AVAIL_LIMIT</th><!-- LOW_AVAIL_LIMIT -->
				<th>VIEWS_STATS</th><!-- VIEWS_STATS -->
				<th>SALES_STATS</th><!-- SALES_STATS -->
				<th>DEL_STATS</th><!-- DEL_STATS -->
				<th>SMALL_ITEM</th><!-- SMALL_ITEM -->
				<th>SEPARATE_BOX</th><!-- SEPARATE_BOX -->
				<th>ITEMS_PER_BOX</th><!-- ITEMS_PER_BOX -->
				
				<th>post_excerpt</th>
				<th>post_content</th>
				<th>category</th>

				<th>comment_status</th>
				<th>ping_status</th>
				<th>featured_image</th>
			</tr>
		</thead>
		<tbody>
		<?php $count=0; ?>
		<?php foreach ($products as $key => $product): ?>
			<?php //if ($count++ <1): //if ($count++ >0):?>
			<tr>
				<!-- <td><?php //echo $key ?></td> -->
				<td><?php echo $product[0] ?></td><!-- ID -->
				<td><?php echo $product[1] ?></td><!-- sku -->
				<td><?php echo $product[2] ?></td><!-- post_name -->
				<td><?php 
					if (isset($images[$product[0]])) {
						$image_set = $images[$product[0]];
						echo $image_set["images"][0]["basename"];
					}

				 ?></td><?php 
				 // 	$featured_image = '';
					// if (isset($images[$product[0]])) {
					// 	$image = $images[$product[0]];
					// 	$image_file =  $image[3];
					// 	$file = new SplFileInfo($image_file );
					// 	$featured_image = $file->getFilename();
					// }
				?>
				<td><?php 
					// echo $featured_image;
				 ?></td>
				<td><?php 
					// $featured_image = strtolower($featured_image);
					// $featured_image = str_replace('- ', '-', $featured_image);
					// $featured_image = str_replace(' ', '-', $featured_image);
					// echo $featured_image;
				 ?></td>
				<td><?php 
					$post_date = $product[30]; 
					$date = new DateTime($post_date);
					$date_format = date_format($date, 'Y-m-d H:i:s');
					echo $date_format; 
				?></td><!-- post_date -->
				<td><?php echo $product[5] ?></td><!-- regular_price -->
				<td><?php 
					$tags = $product[10];

					$tags = trim($tags);
		    		$tags = rtrim($tags, ',');
		    		$tags = explode(',', $tags);
		    		$tag_string = '';
		    		foreach ($tags as $key => $tag) {
		    			if ($tag !== 'keywords here...') {
			    			$tag = trim($tag);
			    			$tag = strtolower($tag);
			    			$tag = str_replace(' - ', '-', $tag);
			    			$tag = str_replace(' ', '-', $tag);
			    			$tag = str_replace('', '/', $tag);
			    			$all_tags[] = $tag;
			    			$tag_string .= $tag.'|';
		    			}
		    		}
		    		$tag_string = rtrim($tag_string, '|');
					echo $tag_string;
				?></td><!-- tags -->
				<td><?php 
					$title_tag = $product[9];
					if ($title_tag !== 'include title here') {
						echo $title_tag;
					}
				?></td><!-- TITLE_TAG -->
				<td><?php echo $product[12] ?></td><!-- AVAIL -->
				<td><?php echo $product[11] ?></td><!-- META_DESCRIPTION -->
				<td><?php echo $product[11] ?></td><!-- RATING -->
				<td><?php echo $product[22] ?></td><!-- LOW_AVAIL_LIMIT -->
				<td><?php echo $product[31] ?></td><!-- VIEWS_STATS -->
				<td><?php echo $product[32] ?></td><!-- SALES_STATS -->
				<td><?php echo $product[33] ?></td><!-- DEL_STATS -->
				<td><?php echo $product[34] ?></td><!-- SMALL_ITEM -->
				<td><?php echo $product[35] ?></td><!-- SEPARATE_BOX -->
				<td><?php echo $product[36] ?></td><!-- ITEMS_PER_BOX -->

				<td><?php 
					$post_excerpt = $product[6];
					$post_excerpt = substr($post_excerpt, 0, 60);
					echo $post_excerpt;
				?></td><!-- post_excerpt -->
				<td><?php 
					$post_content = $product[7];
					$post_content = substr($post_content, 0, 60);
					echo $post_content;
				?></td><!-- post_content -->
				<td><?php echo $product[25] ?></td><!-- category -->

				<td>closed</td><!-- comment_status -->
				<td>closed</td><!-- ping_status -->
				<td>featured_image</td><!-- featured_image -->
			</tr>				
			<?php //endif ?>

		<?php endforeach ?>
		</tbody>
	</table>	
<?php endif ?>