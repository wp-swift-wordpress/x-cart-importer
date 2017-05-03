<?php
/*
Template Name: X-Cart Importer
*/

global $image_errors;
$image_errors = array();
include "importer-partials/__functions.php";
include "importer-partials/__parse-images.php";
include "importer-partials/__parse-products.php";
include "importer-partials/_image-attachments.php";
include "importer-partials/_tags-taxonomy.php";
include "importer-partials/_categories.php";
include "importer-partials/_media-library.php";
include "importer-partials/_tags-from-products.php";
// include "importer-partials/_tags.php";
$image_attachments = get_image_attachments();
// echo "<pre>"; var_dump($image_attachments); echo "</pre>";
$images = get_images_from_csv($filename='/images.csv', $image_attachments);
$products = get_products_from_csv($filename='/data.csv');

$media_library = get_images_from_media_library();
$categories = get_all_categories($products);
$categories_names = get_all_categories($products, "name");
$tags = get_tags_from_products($products);
$tag_occurences = get_tag_occurences($tags);

if (isset($_POST["save-categories"])) {
    insert_categories($categories);
}
if (isset($_POST["save-tags"])) {
    insert_tags($tag_occurences);
}
$save_products = false;
if (isset($_POST["save-products"])) {
    $save_products = true;
}
$tag_terms = get_tags_taxonomy();
$category_terms = get_categories_taxonomy();

get_header(); 
?>

<div id="page-full-width" role="main">


<?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
        
        <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <div><?php 

            if (!$save_products) {
                include "importer-partials/view-partials/_category-terms.php";

                include "importer-partials/view-partials/_tag-terms.php";

                include "importer-partials/view-partials/_image-attachments.php";
            }

            if (count($category_terms) && count($tag_terms) && count($image_attachments)): ?>
                <?php if (!$save_products): ?>
                    <?php 
                        include "importer-partials/_product-reader.php"; 
                        // include "importer-partials/_count-image-errors.php";
                    ?>
                <?php else: ?>
                    <?php include "importer-partials/_product-importer.php"; ?>
                <?php endif ?>
                
            <?php
            endif;

      	// print_categories($categories, $category_terms);
// include "importer-partials/_tags.php";
      	// echo "<pre>"; var_dump($category_terms); echo "</pre>";
      	// insert_categories($categories);
      	// echo "<pre>"; var_dump($categories); echo "</pre>";

       // include "importer-partials/_tags.php";
      	// include "importer-partials/_image-table.php";
// include "importer-partials/_product-table.php";
      // include "importer-partials/_product-reader.php";
        // include "importer-partials/_product-importer.php";

        ?></div>

  </article>
<?php endwhile;?>
</div>
<?php get_footer();