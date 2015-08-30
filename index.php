<?php

$js_dir = "./..";
$uglifyjs_location = "./node_modules/uglify-js/bin/uglifyjs";
$qs_files = explode(',', $_GET['f']);

$files = array();
foreach($qs_files as &$file) {
   if (!$file) continue;

   // Prevent access of files outside of javascript directory
   $file = str_replace("../", "", $file);

   $file = "$js_dir/$file";
   if (strrpos($file, "//") === false && file_exists($file)) {
      $files[] = $file;
   }
}

$files = implode(' ', $files);

$command = "$uglifyjs_location $files -c";
echo exec($command);
exit;
