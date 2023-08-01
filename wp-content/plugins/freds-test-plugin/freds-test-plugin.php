<?php
/**
 * Plugin Name: Freds test plugin - Dilate
 * Plugin URI:  https://www.example.com/dilate-blog-migration-acf-custom-plugin-fs
 */

function dilate_blog_migration_acf_custom_plugin_fs() {

    if(isset($_GET['fred'])) {
        $category_id = 1; // Set the category ID this is subject to change
        $args = array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $category_id,
                ),
            ),
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        $data = array();
        if (class_exists('WPSEO_Meta') && function_exists('wpseo_init')) { // Check if Yoast SEO plugin is active
            $headers = array('Post Title', 'Post Content', 'Yoast SEO - SEO Title', 'Yoast SEO - Slug', 'Yoast SEO - Meta Description', 'Yoast SEO - Focus Keyphrase', 'Featured Image', 'Author', 'Timestamp');
            while ($query->have_posts()) {
                $query->the_post();
                // Extract post title and content
                $post_title = get_the_title();
                $post_content = get_the_content();
                // Extract Yoast SEO meta information
                $yoast_seo_seo_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
                $yoast_seo_slug = get_permalink();
                $yoast_seo_meta_description = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
                $yoast_seo_focus_keyphrase = get_post_meta(get_the_ID(), '_yoast_wpseo_focuskw', true);
                $featured_image = '';
                if (has_post_thumbnail()) {
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                }
                $author = get_the_author();
                $timestamp = get_the_time();
                // Format the timestamp
                $formatted_timestamp = date('Y-m-d H:i:s', strtotime($timestamp));
                // Append the data to the array
                $data[] = array($post_title, $post_content, $yoast_seo_seo_title, $yoast_seo_slug, $yoast_seo_meta_description, $yoast_seo_focus_keyphrase, $featured_image, $author, $formatted_timestamp);
            }

        }
        elseif(class_exists('RankMath')) { // Check if Rank Math plugin is active
            $headers = array('Post Title', 'Post Content', 'Rank Math SEO - Title', 'Rank Math SEO - Permalink', 'Rank Math SEO - Description', 'Rank Math SEO - Primary Focus Keyword', 'Featured Image', 'Author', 'Timestamp');
            while ($query->have_posts()) {
                $query->the_post();
                $post_title = get_the_title();
                $post_content = get_the_content();
                $rank_math_seo_title = get_post_meta(get_the_ID(), 'rank_math_title', true);
                $rank_math_seo_permalink = get_permalink();
                $rank_math_seo_description = get_post_meta(get_the_ID(), 'rank_math_description', true);
                $rank_math_primary_focus_keyword = get_post_meta(get_the_ID(), 'rank_math_focus_keyword', true);
                $featured_image = '';
                if (has_post_thumbnail()) {
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                }
                $author = get_the_author();
                $timestamp = get_the_time();
                // Format the timestamp
                $formatted_timestamp = date('Y-m-d H:i:s', strtotime($timestamp));
                // Append the data to the array
                $data[] = array($post_title, $post_content, $rank_math_seo_title, $rank_math_seo_permalink, $rank_math_seo_description, $rank_math_primary_focus_keyword, $featured_image, $author, $formatted_timestamp);
            }
        }

        wp_reset_postdata();

        // $csv_content = implode(',', $headers) . "\n"; // Headers
        // foreach ($data as $row) {
        //     $csv_content .= implode(',', $row) . "\n"; // Data rows
        // }
        // header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename=blog_data.csv');
        // header('Pragma: no-cache');
        // header('Expires: 0');
        // echo $csv_content;

        array_unshift($data, $headers); // Add headers to the data array as the first element
        $json_content = json_encode($data);
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=blog_data.json');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $json_content;
        
        exit();

    }

    if(isset($_GET['dame'])) {
        $directory = get_stylesheet_directory() . '/blog_posts_content/';
        $content = '';
        $post_id = '';
        $catID = 161; 
        // $targetPostID = 18558; 
        $targetPostID = ''; 
        $data = array(
            array( 'inject' => false, 'modify' => false, 'title' => '11 Top Interior Timber Wall Cladding Design Ideas', 'post_id' => null, 'thumbnail' => '11-top-interior-timber-wall-cladding-ideas-Kustom-Timber-980x654.jpg'),
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
        if(!empty($data)) { $data = $data; } else { $data = []; }
        if(in_array($targetPostID, $queryPostID)) {
            $post_id = $targetPostID; 
        }
        foreach($data as $index => $value) {
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
            if($value['modify']) update_field('sections', $acf_field_values, $post_id); # validate 1st if modification is true then pushes given data to ACF
            $featured_image_url = get_site_url() . '/wp-content/uploads/2023/06/' . $value['thumbnail'];
            if(!empty($featured_image_url)) {
                $image_id = attachment_url_to_postid($featured_image_url);
                if($value['inject'] || $value['modify']) { 
                    set_post_thumbnail($post_id, $image_id); 
                }
            }
        }
    }

    if(isset($_GET['andy'])) {
        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        $links = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $permalink = get_permalink();
                $links[] = $permalink;
            }
        }
        // echo '<pre style="display: none">' . print_r($links, true) . '</pre>';
        
        // header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename=' . '$post_links.csv');
        // header('Pragma: no-cache');
        // header('Expires: 0');
        // $csv_content = implode("\n", $links);
        // echo $csv_content;


        $json_content = json_encode($links);
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=blog_data.json');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $json_content;
        
        exit();

    }

    if(isset($_GET['zyen'])) {
        function pull_all_category_term_id() {
            $categories = get_categories();
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            print_r($category_ids);
        }
        pull_all_category_term_id();
    }



}

add_action('init', 'dilate_blog_migration_acf_custom_plugin_fs');
