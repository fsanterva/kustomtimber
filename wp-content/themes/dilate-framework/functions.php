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


function ct_blog_posts() {
    $directory = get_stylesheet_directory() . '/blog_posts_content/';
    $content = '';
    $post_id = '';
    $catID = 172; 
    // $catID = 161; 
    $targetPostID = 18510; 
    $data = array(
        array( 'inject' => false, 'modify' => false, 'title' => '11 Top Interior Timber Wall Cladding Design Ideas', 'post_id' => null, 'thumbnail' => '11-top-interior-timber-wall-cladding-ideas-Kustom-Timber-980x654.jpg'),
        array( 'inject' => false, 'modify' => true, 'title' => 'When Should You Sand Back Your Timber Floors?', 'post_id' => null, 'thumbnail' => 'Timber-Floors-980x653-1.jpg'),
        array( 'inject' => false, 'modify' => false, 'title' => 'Trending in 2019: Oak Flooring in the Kitchen', 'post_id' => null, 'thumbnail' => 'Oak-Flooring-980x653-1.jpg'),
    );
    $data_query = array( # query all registered published posts
        'post_type'       => 'post',
        'posts_per_page'  => -1,
        'post_status' 	  => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $catID,
            ),
        ),
    );
    $query = new WP_Query($data_query);
    $queryPostID = wp_list_pluck($query->posts, 'ID'); # query each post pulling their ID
    // echo print_r($queryPostID, true) . '</br>';
    foreach($data as $index => $value) {
        if($index >= 40) { break; }
        if(in_array($targetPostID, $queryPostID)) {
            $post_id = $targetPostID; 
        } 
        if($value['inject']) { 
            $value['modify'] = true; # make this "true" to query "$content" data to push it over ACF
            $post_id = wp_insert_post( # insert data
                array( # data of the new post to be inserted
                    'post_title'  => $value['title'],
                    'post_status' => 'publish',
                    'post_type'   => 'post',
                )
            );
            $value[$index]['post_id'] = $post_id; # overrides the 'post_id' of the given array for usage
            wp_set_post_terms($post_id, $catID, 'category');
        }
        $content = file_get_contents($directory . $index . '.txt'); # locate path for ACF content
        $acf_field_values = array( # ACF data
            array(
                'acf_fc_layout' => 'blog_child_hero', 
                'blog_child_hero' => array(),
            ),
            array(
                'acf_fc_layout' => 'blog_child_gallery', 
                'blog_child_gallery' => array(
                    'data_fields' => array(
                        'information' => array(
                            array(
                                'text_summary' => $content,
                            ),
                        ),
                    ),
                    'layout_select' => array(
                        'layout_select' => 'layout2',
                    ),
                ),
            ),
            array(
                'acf_fc_layout' => 'blog_child_related_articles', 
                'blog_child_related_articles' => array(),
            ),
        );
        if($value['modify']) { # validate 1st if modification is true then pushes given data to ACF 
            update_field('sections', $acf_field_values, $post_id); 
        } 
        $featured_image_url = get_site_url() . '/wp-content/uploads/2023/06/' . $value['thumbnail'];
        if(!empty($featured_image_url)) {
            $image_id = attachment_url_to_postid($featured_image_url);
            if($value['inject'] || $value['modify']) { 
                set_post_thumbnail($post_id, $image_id); 
            }
        }
    }
}
if(isset($_GET['fred'])) { add_action('init', 'ct_blog_posts'); }
