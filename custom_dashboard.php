<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="dashboard">
    <?php $url = "https://dilate.com.au/dashboard/dashboard.html";
//     $dashboard = file_get_contents($url);
    $ch = curl_init();
    // Return Page contents.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Grab URL and pass it to the variable
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    echo empty($result) ? "<h1><a href='http://help.dilate.com.au/'>help.dilate.com.au</h1>" : $result;
    ?>
</div>
