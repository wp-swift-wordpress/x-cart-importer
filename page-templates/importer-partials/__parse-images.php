<?php
function get_images_from_csv($filename, $image_attachments) {
    $template_directory = get_template_directory();
    $csv = array_map('str_getcsv', file($template_directory.'/xcart-export-images-no-headers.csv'));

    $images = array();
    $temp_row = null;
    $temp_images = array();

    foreach ($csv as $key => $row) {

        if ($row[0] != '') {
            if (isset($row[2])) {
                if ($temp_row != null) {
                    $associative_array = array();
                    $associative_array["product_id"] = $temp_row[0];
                    $associative_array["product_code"] = $temp_row[1];
                    $associative_array["product_name"] = $temp_row[2];           
                    $associative_array["images"] = $temp_images; 
                    $id = (string) $temp_row[0];                   
                    $images[$temp_row[0]] =  $associative_array;
                }
                $temp_row = $row;
                $temp_images = array();
                $category='';
            }
        }

        if (isset($row[6])) {
            $image["filepath"] = $row[3];
            $image["alt"] = $row[4];
            $image["ORDERBY"] = $row[5];
            $image["IMAGEID"] = $row[6];
            $file = new SplFileInfo($row[3] );
            $image["filename"] = $file->getFilename();
            $basename = $file->getBasename('.'.$file->getExtension());
            $image["basename"] = $basename;
            $image["extension"] = $file->getExtension(); 
            $slug = strtolower($basename);
            $slug = str_replace('- ', '-', $slug);
            $slug = str_replace('  ', '-', $slug);
            $slug = str_replace(' ', '-', $slug);
            $slug = str_replace('_', '-', $slug);
            $slug = strtolower($slug);
            $image["slug"] = $slug;
            $image["wordpress_id"]='';
            if (isset($image_attachments[$slug])) {
               $image["wordpress_id"] = $image_attachments[$slug];
            }
               
            $temp_images[] = $image;
        }    
    }
    if (isset($temp_row)) {
        $temp_row[7] = $temp_images; 
        $images[] =  $temp_row;
    }
    return $images;
}