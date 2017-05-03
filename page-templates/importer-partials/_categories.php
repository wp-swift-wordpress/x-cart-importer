<?php
function get_all_categories($products, $array_key='slug') {
	$categories = array();
	$category_occurences = array();
	if (count($products)) {
		foreach ($products as $key => $product) {
			foreach ($product[25] as $key => $category) {
				if (isset($category[$array_key])) {
					$categories[] = $category[$array_key];
				}
				
			}
		}
		$category_occurences = array_count_values($categories);
		// foreach ($category_occurences as $key => $occurence) {
		// 	echo "<pre>".$key.'  ('.$occurence.")</pre>";
		// }	
	}
	return $category_occurences;
}
function print_categories($categories, $category_terms) {
?>
	<span class="label">All Categories</span>
	<div class="callout">
		<h6>We have parsed the products and found the following categories</h6>
		<br>
		<div class="row">
			<div class="small-12 medium-12 large-6 columns">
				<?php 
				foreach ($categories as $category => $count) {
					$category_name = $category;
					$category_name = str_replace('-', ' ', $category_name);
					$category_name = ucwords($category_name);
					echo "<div>$category_name <small>($category)</small> <span class='label'>$count</span></div>";
				} ?>
						<br>
		<p>The blue <span class="label">box</span> shows the occurence count.</p>
			</div>
			<div class="small-12 medium-12 large-6 columns">
				<?php 
				//	echo "<pre>"; var_dump($category_terms); echo "</pre>"; 

				?>				
				<?php 
				foreach ($category_terms as $category_slug => $count) {
					echo "<div>$category_slug <span class='label warning'>$count</span></div>";
				} ?>
		<br>
		<?php if (count($category_terms)): ?>
			<p>The yellow <span class="label warning">box</span> shows the term ID.</p>
		<?php else: ?>
			<p>No terms have been found.</p>
			<p>Check the source code for the following php function:</p>
			<pre>insert_categories($categories)</pre>
		<?php endif ?>
		
			</div>
		</div>

	</div>
<?php 
}

function insert_categories($categories) {
	foreach ($categories as $key => $category) {
		$category_slug = $key;
		$category_name = str_replace('-', ' ', $category_slug);
		$category_name = ucwords($category_name);

		$results = wp_insert_term(
		  $category_name, // the term 
		  'product_cat', // the taxonomy
		  array(
		    'description'=> '',
		    'slug' => $category_slug,
		    'parent'=> 0
		  )
		);
	}
}

function get_categories_taxonomy() {
	$categories_taxonomy = array();
	$terms = get_terms( 
		'product_cat',
		array('hide_empty' => false) 
	);
	if (count( $terms )) {
		foreach ($terms as $key => $term) {
			$categories_taxonomy[$term->slug] = $term->term_id;
		}
	}
	return $categories_taxonomy;
}