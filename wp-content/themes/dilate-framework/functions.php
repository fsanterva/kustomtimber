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


function ct_blog_posts() { // Insert Blog Post
    $directory = get_stylesheet_directory() . '/blog_posts_content/';
    $data = array(
        array( 'modify' => false, 'title' => 'Tips and Tricks To Make Your Timber Floors Look Like New', 'post_id' => null, 'thumbnail' => 'KINGSLEYLN6-U-1.jpg'),
        array( 'modify' => false, 'title' => 'Getting The Most Out of Your Melbourne Hardwood Flooring Service', 'post_id' => null, 'thumbnail' => 'installation-services-980x980-1.jpg'),
        array( 'modify' => false, 'title' => 'What You Need To Know About Melbourne Engineered Timber Flooring', 'post_id' => null, 'thumbnail' => 'Engineered-Timber-Flooring-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Popular Timber Flooring Colours Perfect For Your Home Design', 'post_id' => null, 'thumbnail' => 'Bec_Judd_Buller_home_timber_flooring-1280x854-1.jpg'),
        array( 'modify' => false, 'title' => 'Why Most Australians Go For Timber Flooring Installations', 'post_id' => null, 'thumbnail' => 'Kustom-Timber-Roseberry-Ave_Simon-Shiff_FINALS_0-15_WEB-JPEG-72DPI-sRGB-1.jpg'),
        array( 'modify' => false, 'title' => 'Things to Consider Before You Install a Wood Floor', 'post_id' => null, 'thumbnail' => 'Kustom-Timber-Moore-St-Finals_SimonShiff._0-23-980x654-1.jpg'),
        array( 'modify' => false, 'title' => 'Timber Flooring: Different Species, Different Characteristics', 'post_id' => null, 'thumbnail' => 'Timber-Flooring-melbourne-980x654-1.jpg'),
        array( 'modify' => false, 'title' => 'The Complete Process of How To Sand Timber Floors', 'post_id' => null, 'thumbnail' => 'floor-sanding-melbourne-1.jpg'),
        array( 'modify' => false, 'title' => 'A Buyer’s Guide for Choosing The Best Wooden Flooring', 'post_id' => null, 'thumbnail' => 'Wooden-Flooring-980x654-1.jpg'),
        array( 'modify' => false, 'title' => 'Timber Stairs - Give me the facts', 'post_id' => null, 'thumbnail' => 'Kustom-Timber-26-Danks-St_Simon-Shiff_0-15_-1.jpg'),
        array( 'modify' => false, 'title' => 'What is Blackbutt Flooring?', 'post_id' => null, 'thumbnail' => 'outback_blackbutt-980x980-1.jpg'),
        array( 'modify' => false, 'title' => 'Why Choose Oak Flooring?', 'post_id' => null, 'thumbnail' => 'Oak-Flooring-1-980x730-1.jpg'),
        array( 'modify' => false, 'title' => 'What Can You Expect From Timber Flooring Services Melbourne?', 'post_id' => null, 'thumbnail' => 'timber-flooring-services-melbourne-1280x853-1.jpg'),
        array( 'modify' => false, 'title' => '4 Signs That You Should Leave Your Floor Sanding to The Professionals', 'post_id' => null, 'thumbnail' => 'floor-sanding-melbourne-1.jpg'),
        array( 'modify' => false, 'title' => 'Timber Floor Sanding in Melbourne Gives New Life To Your Floors', 'post_id' => null, 'thumbnail' => 'Floor-Sanding-980x653-1.jpg'),
        array( 'modify' => false, 'title' => '3 Must-Knows Before Floor Sanding Your Melbourne Home', 'post_id' => null, 'thumbnail' => 'floor-sanding-melbourne-980x823-1.jpg'),
        array( 'modify' => false, 'title' => 'Wooden Floorboards: How to Clean and Maintain', 'post_id' => null, 'thumbnail' => 'Wooden-Floorboards-700x675-1.jpg'),
        array( 'modify' => false, 'title' => 'The Ins and Outs of Whitewash Flooring', 'post_id' => null, 'thumbnail' => 'Whitewash-Flooring-980x735-1.jpg'),
        array( 'modify' => false, 'title' => 'Repairing and Maintaining Timber Flooring for Melbourne Homes', 'post_id' => null, 'thumbnail' => 'Timber-Flooring-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Floor Sanding and Polishing: The Boost Your Flooring May Need', 'post_id' => null, 'thumbnail' => 'Floor-Sanding-and-Polishing-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Timber Flooring Trends From Around the World', 'post_id' => null, 'thumbnail' => 'Timber-Flooring-Trends-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'When Should You Sand Back Your Timber Floors?', 'post_id' => null, 'thumbnail' => 'Timber-Floors-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Trending in 2019: Oak Flooring in the Kitchen', 'post_id' => null, 'thumbnail' => 'Oak-Flooring-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Precision Counts Every Step of the Way When Laying Timber Flooring', 'post_id' => null, 'thumbnail' => 'Timber-Flooring-melbourne-980x654-1.jpg'),
        array( 'modify' => false, 'title' => 'How Do I Care For My Wooden Floors?', 'post_id' => null, 'thumbnail' => 'Wooden-Floors-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Should You Choose a Matte Finish for Your Timber Floors?', 'post_id' => null, 'thumbnail' => 'Matte-Finish-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'Why Engineered Timber Flooring is Perfect for Australian Homes', 'post_id' => null, 'thumbnail' => 'australian-timber-flooring-1280x854-1.jpg'),
        array( 'modify' => false, 'title' => 'What to Consider Before Staining Your Timber Floors | Kustom Timber', 'post_id' => null, 'thumbnail' => 'Timber-Floor-Staining-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'How to Ensure Your Oak Flooring Melbourne Stands the Test of Time', 'post_id' => null, 'thumbnail' => '35-Albert-Street-Port-Melbourne-004-150x150-1.jpg'),
        array( 'modify' => false, 'title' => '5 Mistakes To Avoid With Timber Flooring Installation', 'post_id' => null, 'thumbnail' => 'installation.jpg'),
        array( 'modify' => false, 'title' => 'The Benefits of Blackbutt Flooring for Your Home', 'post_id' => null, 'thumbnail' => 'Blackbutt-Flooring.jpg'),
        array( 'modify' => false, 'title' => 'The Benefits of Choosing Lighter Coloured Timber Flooring', 'post_id' => null, 'thumbnail' => 'Lighter-Coloured-Timber-Flooring-980x653-1.jpg'),
        array( 'modify' => false, 'title' => 'How to Maintain Your Engineered Oak Flooring', 'post_id' => null, 'thumbnail' => 'Engineered-Oak-Flooring-980x718-1.jpg'),
        array( 'modify' => false, 'title' => 'Hardwood vs Laminate: Which is Better? | Kustom Timber', 'post_id' => null, 'thumbnail' => 'laminate-vs-hardwood-1280x854-1.jpg'),
        array( 'modify' => false, 'title' => 'Common Mistakes People Make with Floor Sanding Melbourne', 'post_id' => null, 'thumbnail' => 'floor-sanding-blog-1280x853-1.jpg'),
        array( 'modify' => false, 'title' => 'Preparing for Timber Flooring Installation Melbourne', 'post_id' => null, 'thumbnail' => 'timber-flooring-installation-melbourne-960x640-1.jpg'),
        array( 'modify' => false, 'title' => 'Top 5 Timber Flooring Myths', 'post_id' => null, 'thumbnail' => 'Timber-Flooring-Myths-980x686-1.jpg'),
        array( 'modify' => false, 'title' => 'FAQs About Engineered Oak Flooring: We Answer Your Questions', 'post_id' => null, 'thumbnail' => 'engineered-oak-flooring-1.jpg'),
        array( 'modify' => false, 'title' => 'Carpet vs Timber Stairs: Which is Right For Your Home?', 'post_id' => null, 'thumbnail' => 'timber-stairs-melbourne-1.jpg'),
        array( 'modify' => false, 'title' => 'Top 7 Home Design Trend Predictions for 2019', 'post_id' => null, 'thumbnail' => 'timber-flooring-melbourne-1.jpg'),
    );
    $insert_blog_post = false;
    // $post_id = 18376;
    foreach($data as $index => $value) {
        if($index >= 40) { break; }
        $data = array(
            'post_title'  => $value['title'],
            'post_status' => 'publish',
            'post_type'   => 'post',
        );
        if($insert_blog_post !== false) { 
            $post_id = wp_insert_post($data); 
            $value[$index]['post_id'] = $post_id;
            wp_set_post_terms($post_id, 161, 'category');
        }
        $content = '';
        // if($value['modify'] == true) {
            $content = file_get_contents($directory . $index . '/content.txt');
        // }
        $acf_field_values = array(
            array( // Blog Child Hero - Component UI
                'acf_fc_layout' => 'blog_child_hero', 
                'blog_child_hero' => array(),
            ),
            array( // Blog Child Gallery - Component UI
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
            array( // Blog Child Related Articles - Component UI
                'acf_fc_layout' => 'blog_child_related_articles', 
                'blog_child_related_articles' => array(),
            ),
        );
        if($value['modify'] == true) { update_field('sections', $acf_field_values, $post_id); };
        $featured_image_url = get_site_url() . '/wp-content/uploads/2023/06/' . $value['thumbnail'];
        if(!empty($featured_image_url)) {
            $image_id = attachment_url_to_postid($featured_image_url);
            if($insert_blog_post !== false) { set_post_thumbnail($post_id, $image_id); }
        }
    }
}
if(isset($_GET['fred'])) { add_action('init', 'ct_blog_posts'); }
