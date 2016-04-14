<?php

ini_set("display_errors", 1);
error_reporting(-1);

if (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") {
   $node_location = "C:\\nodejs\\node.exe";
} else {
   $node_location = "/usr/local/bin/node";
}
$js_dir = __DIR__."/..";
$uglifyjs_location = __DIR__."/node_modules/uglify-js/bin/uglifyjs";
$cache_location = __DIR__."/cache";

$qs_files = explode(",", $_GET["f"]);

$files = array();
$hashes = array();
foreach($qs_files as &$file) {
   $file = trim($file);
   if (!$file) continue;

   // Prevent access of files outside of javascript directory
   $file = str_replace("../", "", $file);

   $file = "$js_dir/$file";
   if (strrpos($file, "//") === false && file_exists($file)) {
      $files[] = $file;
      $hashes[] = md5_file($file);
   }
}

if (count($files)) {
   $cache_file = "$cache_location/" . implode("-", $hashes) . ".js";
   if (!file_exists($cache_file)) {
      $command = "$node_location $uglifyjs_location " . implode(" ", $files) . " -c -o $cache_file";
      exec($command);
   }

   echo file_get_contents($cache_file);
}
