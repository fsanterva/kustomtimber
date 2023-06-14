<?php
add_theme_support( 'post-thumbnails' );

/* SET THE TIME TO GMT+8
================================================== */
function update_default_time() {
  update_option( 'gmt_offset', '+8' );
  update_option( 'timezone_string', '' );
} add_action( 'after_switch_theme', 'update_default_time' );


/* PREPARE CUSTOM DASHBOARD
================================================== */
function register_menu() {
  add_dashboard_page( 'Dilate Digital', 'Dilate Digital', 'read', 'custom-dashboard', 'create_dashboard' );
} add_action('admin_menu', 'register_menu' );

function redirect_dashboard() {
  if( is_admin() ) {
    $screen = get_current_screen();
    if( $screen->base == 'dashboard' ) {
      wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );
    }
  }
} add_action('load-index.php', 'redirect_dashboard' );

function create_dashboard() {
  include_once( get_template_directory() .'/custom_dashboard.php'  );
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/* DELAY JS
================================================== */
add_filter( 'script_loader_tag', 'dilate_delay_overrirde', 10, 2);
function dilate_delay_overrirde($tag, $handle) {
    if (strpos($tag, 'dilate-lazyload') !== false) {
        return delay_script($tag);
    } else if (strpos($tag, 'jquery-core-js') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        return delay_script($tag);
    } else if (strpos($tag, 'jquery-migrate-js') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        $tag = str_replace(' src', ' defer="defer" src', $tag);
        return delay_script($tag);
    } else if (strpos($tag, 'dilate-slick') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        $tag = str_replace(' src', ' defer="defer" src', $tag);
        return delay_script($tag);
    } else if (strpos($tag, 'dilate-vivus') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        $tag = str_replace(' src', ' defer="defer" src', $tag);
        return delay_script($tag);
    } else if (strpos($tag, 'dilate-panellum') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        $tag = str_replace(' src', ' defer="defer" src', $tag);
        return delay_script($tag);
    } else if (strpos($tag, 'dilate-main') !== false) {
        $tag = str_replace('text/javascript','',$tag);
        $tag = str_replace(' src', ' defer="defer" src', $tag);
        return delay_script($tag);
    }
    else {
        return delay_script($tag);
    }
}
function delay_script($tag){
  return str_replace('text/javascript','dilatelazyloadscript',$tag);
}

/* FORCE REMOVE SPECIFIC CSS
================================================== */
add_filter( 'style_loader_tag', 'dilate_css_overrirde', 10, 2);
function dilate_css_overrirde($tag, $handle) {
    if (strpos($tag, 'forminator-icons') !== false) {
        return delay_style($tag);
    }else if (strpos($tag, 'forminator-utilities') !== false) {
        return delay_style($tag);
    }else if (strpos($tag, 'forminator-grid-default') !== false) {
        return delay_style($tag);
    }else if (strpos($tag, 'buttons-css') !== false) {
        return delay_style($tag);
    }else{
      return $tag;
    }
}
function delay_style($tag){
  return str_replace('text/css','dilateoverridecss',$tag);
}

function mytheme_register_nav_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'your-text-domain' ),
        'footer' => __( 'Footer Menu', 'your-text-domain' )
    )); 
}
add_action( 'after_setup_theme', 'mytheme_register_nav_menus' );

function add_custom_image_sizes() {
  add_image_size( 'small-b', 480 );
}
add_action( 'after_setup_theme', 'add_custom_image_sizes' );


add_filter( 'max_srcset_image_width', 'acf_max_srcset_image_width', 10 , 2 );
// set the max image width 
function acf_max_srcset_image_width() {
	return 2200;
}

function add_file_types_to_uploads($file_types){
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

  // Check function exists.
  if( function_exists('acf_add_options_page') ) {

    // Register options page.
    $option_page = acf_add_options_page(
      array(
        'page_title' => __('Theme Options'),
        'menu_title' => __('Theme Options'),
        'menu_slug' => 'theme-options',
        'capability' => 'manage_options',
        'icon_url' => 'dashicons-superhero-alt',
        'redirect' => false,
        'updated_message' => __('Theme settings has been updated', 'acf'),
      )
    );
    
    $option_page = acf_add_options_page(
      array(
        'page_title' => __('Global Components'),
        'menu_title' => __('Global Components'),
        'menu_slug' => 'global-components',
        'capability' => 'manage_options',
        'icon_url' => 'dashicons-tagcloud',
        'redirect' => false,
        'updated_message' => __('Global Components has been updated', 'acf'),
      )
    );
  }
  
}


add_action( 'save_post', 'clearCacheOnSave', 10,3 );
function clearCacheOnSave( $post_id, $post, $update ) {
    if ( $update ) {
      $wpurl = get_the_permalink( get_the_ID() );
      $parsed = parse_url($wpurl);
      $urlPath = $parsed['path'];
      $finalURL = ( $urlPath == '/' ) ? '/home/' : $urlPath;
      $file = str_replace("-", "", str_replace("/", "_", $finalURL));
      $cachefile = 'cached'.substr_replace($file,"",-1).'.html';
      $root = $_SERVER['DOCUMENT_ROOT'];
      
      if ( file_exists($root.'/cached/'.$cachefile) ) {
          unlink( $root.'/cached/'.$cachefile );
      }
    }
}

/** AJAX BASED RESOURCES LIST **/
add_action( 'wp_ajax_deleteAllCache', 'deleteAllCache' );
add_action( 'wp_ajax_nopriv_deleteAllCache', 'deleteAllCache' );
function deleteAllCache() {
  $root = $_SERVER['DOCUMENT_ROOT'];
  $folder_path = $root.'/cached/';
  // Folder path to be flushed
//   $folder_path = "myGeeks";
  // List of name of files inside
  // specified folder
  $files = glob($folder_path.'/*'); 
  // Deleting all the files in the list
  foreach($files as $file) {
    if(is_file($file)) 
      // Delete the given file
      unlink($file); 
  }
}


add_action( 'wp_ajax_getFileURL', 'getFileURL' );
add_action( 'wp_ajax_nopriv_getFileURL', 'getFileURL' );
function getFileURL() {
  
  $fileid = $_POST['fileid'];
  
  echo wp_get_attachment_url($fileid);
  die();
}


add_action( 'wp_ajax_getproducts', 'getproducts' );
add_action( 'wp_ajax_nopriv_getproducts', 'getproducts' );
function getproducts() {
  
  $range = $_POST['range'];
  $colour = $_POST['colour'];
  $grade = $_POST['grade'];
  $width = $_POST['width'];
  $length = $_POST['length'];
  $thickness = $_POST['thickness'];
  
  $tax_q = array('relation'=>'AND');
  $meta_q = array('relation'=>'AND');
  
  $args = array(
    'post_type'       => 'kt-product',
    'posts_per_page'  => -1,
    'order_by'        => 'date',
    'order'           =>  'ASC',
    'post_status '    => array('publish')
  );
  
  if( !empty($range) ) {
    array_push($tax_q, array(
      'taxonomy' => 'range',
      'field' => 'slug',
      'terms' => $range
    ));
  }

  if( !empty($colour) ) {
    array_push($tax_q, array(
      'taxonomy' => 'colour',
      'field' => 'slug',
      'terms' => $colour
    ));
  }

  if( !empty($grade) ) {
    array_push($tax_q, array(
      'taxonomy' => 'grade',
      'field' => 'slug',
      'terms' => $grade
    ));
  }

  if( !empty($width) ) {
    array_push($meta_q, array(
      'key' => 'width',
      'value' => $width,
    ));
  }

  if( !empty($length) ) {
    array_push($meta_q, array(
      'key' => 'length',
      'value' => $length,
    ));
  }

  if( !empty($thickness) ) {
    array_push($meta_q, array(
      'key' => 'thickness',
      'value' => $thickness,
    ));
  }
  
  $args['tax_query'] = $tax_q;
  $args['meta_query'] = $meta_q;
  
  $result = new WP_Query( $args );
  $new_search = $result->posts;
  
  ob_start();
    if( !empty($new_search) ) : ?>

      <?php foreach( $new_search as $obj ) : 
        $pid = $obj->ID;
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $img = get_field('product_image', $obj);
        $imgHover = get_field('product_image_hover', $obj);

      ?>

      <div class="item">
        
        <div class="flipper">

          <div class="front">
          
            <?php acf_responsive_image3($img, true); ?>

          </div>

          <div class="back">
            
            <?php acf_responsive_image3($imgHover, true); ?>

            <a href="<?= $perm; ?>" class="link-to-post" aria-label="Kustom Timber Product Link"></a>

          </div>
          
        </div>

        <h4 class="product__name"><?= $title; ?></h4>

      </div>
      
      <?php endforeach; ?>

  <?php else : ?>

  <div class="no-results">
    <h3>No matching products found</h3>
  </div>

  <?php endif; ?>

  <?php echo ob_get_clean();
  die();
}



add_action( 'wp_ajax_getprojects', 'getprojects' );
add_action( 'wp_ajax_nopriv_getprojects', 'getprojects' );
function getprojects() {
  
  $page         = $_POST['page'];
  $keyword      = $_POST['s'];
  $collection   = $_POST['collection'];
  $finish       = $_POST['finish'];
  $pattern      = $_POST['pattern'];
  $display_num  = 12;
  
  $tax_q = array('relation'=>'AND');
  $meta_q = array('relation'=>'AND');
  
  $args = array(
    'post_type'       => 'project',
    'posts_per_page'  => -1,
    'order_by'        => 'date',
    'order'           =>  'ASC',
    'post_status '    => array('publish')
  );
  
  if( !empty($collection) ) {
    array_push($tax_q, array(
      'taxonomy' => 'range',
      'field' => 'slug',
      'terms' => $collection
    ));
  }

  if( !empty($finish) ) {
    array_push($meta_q, array(
      'key' => 'finish',
      'value' => $finish,
    ));
  }
  
  if( !empty($pattern) ) {
    array_push($meta_q, array(
      'key' => 'pattern',
      'value' => $pattern,
    ));
  }
  
  if( !empty( $keyword ) ) {
    $args['s'] = $keyword;
  }
  
  $args['tax_query'] = $tax_q;
  $args['meta_query'] = $meta_q;
  
  $result = new WP_Query( $args );
  $new_search = $result->posts;
  $listings_found = count($new_search);
  $totalpage = ceil( $listings_found / $display_num);
  $finalResults = array_slice($new_search, ($page*$display_num), $display_num);
  
  ob_start();
    if( !empty($finalResults) ) : ?>

      <div class="project__wrapper">
        
      <?php foreach( $finalResults as $obj ) : 
  
        $pID = $obj->ID;
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $projRange = get_the_terms( $pID, 'range' );
        $projRangeName = $projRange[0]->name;
        $projfinish = get_field('finish', $obj);
        $projPattern = get_field('pattern', $obj);
//         $featImg = getFeaturedImage($pID);

      ?>
        
      <div class="item">
        
        <div class="data__blocks">
          
          <div class="data__block data__block--name">
            <label>Project Name</label>
            <span class="value"><?= $title; ?></span>
          </div>

          <div class="data__block data__block--range">
            <label>Collection</label>
            <span class="value"><?= $projRangeName; ?></span>
          </div>

          <div class="data__block data__block--finish">
            <label>Finish</label>
            <span class="value"><?= get_the_title($projfinish); ?></span>
          </div>

          <div class="data__block data__block--pattern">
            <label>Pattern</label>
            <span class="value"><?= (!empty($projPattern)) ? $projPattern['label'] : ''; ?></span>
          </div>
          
        </div>
        
        <div class="featured__image">
          <span class="img__wrap">
            <a href="<?= $perm; ?>" class="link-to-post" aria-label="Link to <?=$title?>"></a>
            <?php getFeaturedImage($pID, true); ?>
            <span class="plus"></span>
          </span>
        </div>
        
      </div>
      
      <?php endforeach; ?>
        
      </div>
      
      <?php if( $page+1 < $totalpage ): ?>
        <button id="loadmore-button" data-key="<?=$page+1?>">LOAD MORE</button>
      <?php endif; ?>

  <?php else : ?>

  <div class="no-results">
    <h3>No matching project found</h3>
  </div>

  <?php endif; ?>

  <?php echo ob_get_clean();
  die();
}


// LAURINCE's CODES
add_action( 'wp_ajax_getPosts', 'getPosts' );
add_action( 'wp_ajax_nopriv_getPosts', 'getPosts' );
function getPosts() {
  $page           = $_POST['p'];
  $s              = $_POST['s'];
  $cat            = $_POST['cat'];
  $range          = $_POST['range'];
  $display_num    = 6;

  if($cat){
   $tax[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $cat
    );    
  }

  if($range){
    $tax[] = array(
             'taxonomy' => 'range',
             'field' => 'slug',
             'terms' => $range
     );    
   }
  
  $args = array(
    'post_type'       => array('post'),
    'posts_per_page'  => $display_num,
    's'               => $s,
    'post_status '    => array('publish'),
    'paged'           => $page,
    'tax_query' => array(
       'relation' => 'OR',
       $tax
    )
  );

  //echo '<pre>' .print_r($args,1). '</pre>';

  $result = new WP_Query( $args );
  $listings_found = count($result->posts);
  // $totalpage = ceil($listings_found/$display_num);
  // $new_search = array_slice($result->posts, ($page*$display_num), $display_num);
  //echo '<pre>' .print_r($new_search,1). '</pre>';

  ob_start();

  if( !empty($result->posts) ) : ?>
    <span class="ajaxloader"></span>
    <div class="articles__wrapper" data-totalcount=<?=$listings_found?> data-last-page="<?php echo $result->max_num_pages; ?>">
      <?php 
      
          foreach( $result->posts as $post ): 
          
            $pID = $post->ID;
            post_card($pID);
      
          endforeach; 
        ?>
    </div>
  
    <?php else : ?>
    <div class="no-results">
      <h4>No matching articles found</h4>
    </div>
  <?php endif;

  echo ob_get_clean();
  die();
}

function post_card($pID){
   ob_start(); 
    $title = get_the_title($pID);
    $perm = get_the_permalink($pID);
    $excerpt = get_the_excerpt($pID);
    $exceptLen = strlen($excerpt);
    $excerptLimit = 210;
    $finalExcerpt = ($exceptLen > $excerptLimit) ? substr($excerpt, 0, $excerptLimit+1).'...' : $excerpt;
    $date = get_the_date('F j, Y', $pID);
    $author_id = get_post_field ('post_author', $pID );
    $display_name = get_the_author_meta( 'display_name' , $author_id );
    $post_primary_term_id = yoast_get_primary_term_id( 'category', $pID );
    //$post_term = get_term_by('id', $post_primary_term_id, 'category');
    $cat_name = get_the_category( $pID )[0]->name;

    if(empty($cat_name)){
      $cat_name = get_the_terms( $pID, 'range' )[0]->name;
    }
?>

<div class="article">
      <div class="img_wrap">
          <a class="link-to-post" href="<?= $perm; ?>">
              <?php getFeaturedImage($pID, true); ?>
          </a>
        </div>
        <div class="info">

          <div class="info-top">
            <h4 class="post__title"><a href="<?=$perm;?>"><?= $title; ?></a></h4>
  
            <div class="excerpt">
              <?= $finalExcerpt; ?>
            </div>
            </div>

          <div class="info-bottom">
            <span class="post__cat"><?= $cat_name; ?></span>
            <div class="action-btn">
              <?php
                button(array(
                    'button_style'=>'solid',
                    'button_shape'=>'default',
                    'button_arrow'=>1,
                    'button_link'=>array(
                      'url'=>$perm,
                      'target'=>'',
                      'title'=>'Read more'
                    ),
                    'button_custom_class'=>'',
                    'button_function'=>''
                  ));
                ?>
            </div>
          </div>
      </div>
</div>

<?php
   echo ob_get_clean();
}

function dilate_get_related_posts( $post_id, $related_count, $args = array() ) {
    $args = wp_parse_args( (array) $args, array(
      'orderby' => 'rand',
      'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
    ) );

    $related_args = array(
      'post_type'      => get_post_type( $post_id ),
      'posts_per_page' => $related_count,
      'post_status'    => 'publish',
      'post__not_in'   => array( $post_id ),
      'orderby'        => $args['orderby'],
      'tax_query'      => array()
    );

    $post       = get_post( $post_id );
    $taxonomies = get_object_taxonomies( $post, 'names' );

    foreach ( $taxonomies as $taxonomy ) {
      $terms = get_the_terms( $post_id, $taxonomy );
      if ( empty( $terms ) ) {
        continue;
      }
      $term_list                   = wp_list_pluck( $terms, 'slug' );
      $related_args['tax_query'][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $term_list
      );
    }

    if ( count( $related_args['tax_query'] ) > 1 ) {
      $related_args['tax_query']['relation'] = 'OR';
    }

    if ( $args['return'] == 'query' ) {
      return new WP_Query( $related_args );
    } else {
      return $related_args;
    }
}

add_action('init', 'disable_woo_commerce_sidebar');
function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
}

// Change WooCommerce "Related products" text
add_filter('gettext', 'change_rp_text', 10, 3);
add_filter('ngettext', 'change_rp_text', 10, 3);

function change_rp_text($translated, $text, $domain)
{
     if ($text === 'Related products' && $domain === 'woocommerce') {
         $translated = esc_html__('YOU MAY ALSO LIKE', $domain);
     }
     return $translated;
}


add_filter('acfe/flexible/thumbnail/layout=home_hero_1', 'my_acf_layout_thumbnail', 10, 3);
function my_acf_layout_thumbnail($thumbnail, $field, $layout){

    // Must return an URL or Attachment ID
    return get_template_directory() . '/components/home_hero_1/placeholder.jpg';

}