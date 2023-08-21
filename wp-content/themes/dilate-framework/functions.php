<?php
ob_start();
/** Load Component */
require get_template_directory() . '/inc/component2.php';
require get_template_directory() . '/inc/critical-component2.php';
require get_template_directory() . '/inc/ui.php';
/** misc function */
require get_template_directory() . '/lib/helper.php';
require get_template_directory() . '/lib/enqueue.php';
require get_template_directory() . '/lib/shortcodes.php';
require get_template_directory() . '/lib/register-post-types.php';
require get_template_directory() . '/lib/register-taxonomies.php';

/** Temp Function Laurince will be deleted and merged to helper.php once all good */
// require get_template_directory() . '/lib/temp.php';
