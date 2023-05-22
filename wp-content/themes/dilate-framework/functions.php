<?php
ob_start();
/** Load Component */
require get_template_directory() . '/inc/component.php';
require get_template_directory() . '/inc/critical-component.php';
require get_template_directory() . '/inc/ui.php';
/** misc function */
require get_template_directory() . '/lib/helper.php';
require get_template_directory() . '/lib/enqueue.php';
require get_template_directory() . '/lib/shortcodes.php';
require get_template_directory() . '/lib/register-post-types.php';
require get_template_directory() . '/lib/register-taxonomies.php';

/** Temp Function Laurince will be deleted and merged to helper.php once all good */
// require get_template_directory() . '/lib/temp.php';


function r_inspect($val) {
    echo '<pre class="pre pre_red">';
    print_r($val);
    echo '</pre>';
}

function v_inspect($val) {
    echo '<pre class="pre pre_red">';
    var_dump($val);
    echo '</pre>';
}

function get_what_page() {
    global $post;
    echo print_r('<span class="athena">' . get_page($post->id)->post_type . ' <a href="' . get_bloginfo("url") . '/wp-admin/post.php?post=' . get_the_ID($post->id)  . '&action=edit">wp-admin edit</a>' . ' ' . get_the_ID($post->id) ) . '</span>';
} 
add_action('wp_head', 'get_what_page' );
