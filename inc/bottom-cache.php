<?php
// Cache the contents to a cache file
$cached = fopen($root.'/cached/'.$cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
?>