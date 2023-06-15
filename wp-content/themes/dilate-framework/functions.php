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






function add_blog_posts() { // Insert Blog Post
    $titles = array(
        'Tips and Tricks To Make Your Timber Floors Look Like New',
	'Getting The Most Out of Your Melbourne Hardwood Flooring Service',
	'What You Need To Know About Melbourne Engineered Timber Flooring',
	'Popular Timber Flooring Colours Perfect For Your Home Design',
	'Why Most Australians Go For Timber Flooring Installations',
	'Things to Consider Before You Install a Wood Floor',
	'Timber Flooring: Different Species, Different Characteristics',
	'The Complete Process of How To Sand Timber Floors',
	'A Buyer’s Guide for Choosing The Best Wooden Flooring',
	'Timber Stairs - Give me the facts',
	'What is Blackbutt Flooring?',
	'Why Choose Oak Flooring?',
	'What Can You Expect From Timber Flooring Services Melbourne?',
	'4 Signs That You Should Leave Your Floor Sanding to The Professionals',
	'Timber Floor Sanding in Melbourne Gives New Life To Your Floors',
	'3 Must-Knows Before Floor Sanding Your Melbourne Home',
	'Wooden Floorboards: How to Clean and Maintain',
	'The Ins and Outs of Whitewash Flooring',
	'Repairing and Maintaining Timber Flooring for Melbourne Homes',
	'Floor Sanding and Polishing: The Boost Your Flooring May Need',
  	'Timber Flooring Trends From Around the World',
	'When Should You Sand Back Your Timber Floors?',
	'Trending in 2019: Oak Flooring in the Kitchen',
	'Precision Counts Every Step of the Way When Laying Timber Flooring',
	'How Do I Care For My Wooden Floors?',
	'Should You Choose a Matte Finish for Your Timber Floors?',
	'Why Engineered Timber Flooring is Perfect for Australian Homes',
	'What to Consider Before Staining Your Timber Floors | Kustom Timber',
	'How to Ensure Your Oak Flooring Melbourne Stands the Test of Time',
	'5 Mistakes To Avoid With Timber Flooring Installation',
	'The Benefits of Blackbutt Flooring for Your Home',
	'The Benefits of Choosing Lighter Coloured Timber Flooring',
	'How to Maintain Your Engineered Oak Flooring',
	'Hardwood vs Laminate: Which is Better? | Kustom Timber',
	'Common Mistakes People Make with Floor Sanding Melbourne',
	'Preparing for Timber Flooring Installation Melbourne',
	'Top 5 Timber Flooring Myths',
	'FAQs About Engineered Oak Flooring: We Answer Your Questions',
	'Carpet vs Timber Stairs: Which is Right For Your Home?',
	'Top 7 Home Design Trend Predictions for 2019',
    );
    for ($i = 0; $i < 40; $i++) {

        $data = array(
            'post_title'  => $titles[$i],
            'post_status' => 'publish',
            'post_type'   => 'post',
        );

        $post_id = wp_insert_post($data);
        wp_set_post_terms($post_id, 161, 'category');

        $file_content = file_get_contents(get_stylesheet_directory() . '/blog_posts_content/' . $i . '.txt');

        $sections_field_key = 'sections';

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
                                'text_summary' => $file_content,
                            ),
                            // array(
                            //     'text_summary' => $file_content,
                            // ),
                        ),
                    ),
                ),
            ),
            array( // Blog Child Related Articles - Component UI
                'acf_fc_layout' => 'blog_child_related_articles', 
                'blog_child_related_articles' => array(),
            ),
        );

        update_field($sections_field_key, $acf_field_values, $post_id);

    }
}

function update_blog_posts() { // Update Blog Post

        $post_id = 15797;

        $file_content = file_get_contents(get_stylesheet_directory() . '/blog_posts_content/' . '39' . '.txt');
        // $file_content = file_get_contents(get_stylesheet_directory() . '/blog_posts_content/modify/modify.txt');

        $sections_field_key = 'sections';

        $acf_field_values = array(
            array( // Blog Child Gallery - Component UI
                'acf_fc_layout' => 'blog_child_gallery', 
                'blog_child_gallery' => array(
                    'data_fields' => array(
                        'information' => array(
                            array(
                                'text_summary' => $file_content,
                            ),
                        ),
                    ),
                ),
            ),
        );

        update_field($sections_field_key, $acf_field_values, $post_id);

}


if(isset($_GET['fred'])) { add_action('init', 'add_blog_posts'); }
if(isset($_GET['dame'])) { add_action('init', 'update_blog_posts'); }
