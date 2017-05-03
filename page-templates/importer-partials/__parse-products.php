<?php
function get_products_from_csv($filename) {
    $template_directory = get_template_directory();
    $csv = array_map('str_getcsv', file($template_directory.$filename));
    $products = array();
    $count=0;
    $count_all=0;
    $category='';
    $categories= array();
    $temp_row = null;
    $all_cats = array();

    foreach ($csv as $key => $row) {

        if ($row[0] != '') {
            if (isset($row[2])) {
                $count++;
                if ($temp_row != null) {
                    $category = rtrim($category, "|");
                    $temp_row[25] = $categories;
                    $post_excerpt = $temp_row[6];

                    $link = '<a href="mirror-packing-mounting.html" title="Mirrors Packing &amp; Mounting">view packing & mounting info &raquo;</a>';

                    if (strpos($post_excerpt, $link) !== false) {

                        $post_excerpt = str_replace($link, '', $post_excerpt);
                        $temp_row[6] = $post_excerpt;
                    }
        
                   $categories= array();
                   $products[] =  $temp_row;
                }
                $temp_row = $row;
                $category='';
            }
        }



        if (isset($row[25])) {
            $cat = array();
            $cat_single = $row[25];
            $cat['name'] = $cat_single;
            $cat['slug'] = slug($cat_single);

            if ($cat_single!=='') {
                $all_cats[] = $cat;
                $categories[] = $cat;
                 $category .= $cat['slug']."|";
            }
        }    
    }
    if (isset($temp_row)) {
        $temp_row[25] = array(
            array('name' => 'All Mirrors', 'slug' => 'all-mirrors'),
            array('name' => 'Over Mantle', 'slug' => 'over-mantle'),
            array('name' => 'Silver Mirrors', 'slug' => 'silver-mirrors'),
            array('name' => 'Custom Made', 'slug' => 'custom-made')
        );
        $products[] =  $temp_row;
    }
    return $products;
}
