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


add_action( 'wp_ajax_getBlogs', 'getBlogs' );
add_action( 'wp_ajax_nopriv_getBlogs', 'getBlogs' );
function getBlogs() {
  $page         = $_POST['page'];
  $cat          = $_POST['cat'];
  $s            = $_POST['s'];
  $display_num  = 7;
  
  $args = array(
    'post_type'       => 'post',
    'posts_per_page'  => -1,
    's'               => $s,
    'post_status '    => array('publish'),
    'category_name'   => $cat
  );

  $result = new WP_Query( $args );
  $listings_found = count($result->posts);
  $totalpage = ceil($listings_found/$display_num);
  $new_search = array_slice($result->posts, ($page*$display_num), $display_num);

  ob_start();

  if( !empty($new_search) ) : ?>
    <span class="ajaxloader"></span>
    <div class="articles__wrapper" data-totalcount=<?=$listings_found?>>
      <?php foreach( $new_search as $post ): 
        $pID = $post->ID;
        $featImg = get_the_post_thumbnail_url($pID);
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
        $post_term = get_term_by('id', $post_primary_term_id, 'category');
        ?>

        <div class="article">
          <div class="img_wrap">
            <img data-src="<?= $featImg; ?>"/>
            <a class="link-to-post" href="<?= $perm; ?>"></a>
          </div>
          <div class="info">
            <span class="post__cat"><?= $post_term->name; ?></span>
            <h4 class="post__title"><a href="<?=$perm;?>"><?= $title; ?></a></h4>
            <div class="author"><span class="text">by <?=$display_name;?></div>
            <div class="excerpt">
              <?= $finalExcerpt; ?>
            </div>
            <?php
            button(array(
              'button_style'=>'solid',
              'button_shape'=>'default',
              'button_arrow'=>0,
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

      <?php endforeach; ?>
    </div>
    <div class="pagination">
      <ul class="pages">
        <?php if( $totalpage <= 4 ) : ?>
        
          <?php for( $x=0; $x<$totalpage; $x++ ): ?>
          <li><button class="page <?=($page == $x) ? 'current' : ''?>" data-page=<?=$x?>><?=$x+1?></button></li>
          <?php endfor; ?>
        
        <?php else : ?>
        
          <?php if( $page+1 <= 3 ) : ?>
        
            <?php for( $y=0; $y<4; $y++ ): ?>
            <li><button class="page <?=($page == $y) ? 'current' : ''?>" data-page=<?=$y?>><?=$y+1?></button></li>
            <?php endfor; ?>
            <li class="clip"><button class="dots">...</button></li>
            <li><button class="page" data-page=<?=$totalpage-1?>><?=$totalpage?></button></li>
          
          <?php elseif( $page+1 >= $totalpage-2 ) : ?>
        
            <li><button class="page" data-page='0'>1</button></li>
            <li class="clip"><button class="dots">...</button></li>
            <?php for( $z=$totalpage-4; $z<$totalpage; $z++ ): ?>
            <li><button class="page <?=($page == $z) ? 'current' : ''?>" data-page=<?=$z?>><?=$z+1?></button></li>
            <?php endfor; ?>
        
          <?php else : ?>

            <li><button class="page" data-page='0'>1</button></li>
            <li class="clip"><button class="dots">...</button></li>
            <?php for( $w=$page-1; $w<=$page+1; $w++ ): ?>
            <li><button class="page <?=($page == $w) ? 'current' : ''?>" data-page=<?=$w?>><?=$w+1?></button></li>
            <?php endfor; ?>
            <li class="clip"><button class="dots">...</button></li>
            <li><button class="page" data-page=<?=$totalpage-1?>><?=$totalpage?></button></li>

          <?php endif; ?>
        
        <?php endif; ?>
        
      </ul>
    </div>
  <?php else : ?>
    <div class="no-results">
      <h4>No matching articles found</h4>
    </div>
  <?php endif;

  echo ob_get_clean();
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
    'post_type'       => 'product',
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
          
            <img data-src="<?= $img['url'] ?>" alt="<?= $img['alt']; ?>" />

          </div>

          <div class="back">
            
            <img data-src="<?= $imgHover['url'] ?>" alt="<?= $imgHover['alt']; ?>" />

            <a href="<?= $perm; ?>" class="link-to-post"></a>

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




