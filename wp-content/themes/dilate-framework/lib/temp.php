<?php 

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
   $featImg = getFeaturedImage($pID);
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
              <img src="<?php echo $featImg['url']; ?>" alt="<?php echo $title; ?>" />
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