<?php
$category_occurences = array_count_values($all_cats);
foreach ($category_occurences as $key => $occurence) {
    echo "<pre>".$key.'  ('.$occurence.")</pre>";
}