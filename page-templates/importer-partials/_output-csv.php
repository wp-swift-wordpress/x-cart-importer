<?php
$fp = fopen($template_directory.'/file.csv', 'w');

foreach ($products as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
