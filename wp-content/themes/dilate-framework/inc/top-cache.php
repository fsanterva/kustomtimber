<?php
// $url = $_SERVER["SCRIPT_NAME"];
// var_dump($url);
// $break = Explode('/', $url);
// $file = $break[count($break) - 1];
// $cachefile = 'cached-'.substr_replace($file ,"",-4).'.html';

$current_url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = $_SERVER["REQUEST_URI"];
$finalURL = ( $url == '/' ) ? '/home/' : $url;
$file = str_replace("-", "", str_replace("/", "_", $finalURL));
$cachefile = 'cached'.substr_replace($file,"",-1).'.html';
$cachetime = 2592000; //30days
$root = $_SERVER['DOCUMENT_ROOT'];

if (!file_exists($root.'/cached/')) {
  mkdir($root.'/cached/', 0777, true);
}

// Serve from the cache if it is younger than $cachetime
if (file_exists($root.'/cached/'.$cachefile) && time() - $cachetime < filemtime($root.'/cached/'.$cachefile)) {
    echo "<!-- Cached copy, generated ".date('H:i', filemtime($root.'/cached/'.$cachefile))." -->\n";
    readfile($root.'/cached/'.$cachefile);
    exit;
}
// ob_start(); // Start the output buffer