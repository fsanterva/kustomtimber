<?php 

add_action( 'wp_ajax_getPosts', 'getPosts' );
add_action( 'wp_ajax_nopriv_getPosts', 'getPosts' );
function getPosts() {
  // $page         = $_POST['page'];
  $s            = $_POST['s'];
  $cat          = $_POST['cat'];
  $display_num  = 6;
  
  $args = array(
    'post_type'       => 'post',
    'posts_per_page'  => -1,
    's'               => $s,
    'post_status '    => array('publish'),
    'category_name'   => $cat
  );

  $result = new WP_Query( $args );
  $listings_found = count($result->posts);
  r_inspect($listings_found);
  $totalpage = ceil($listings_found/$display_num);
  $new_search = array_slice($result->posts, ($page*$display_num), $display_num);

  ob_start();

  if( !empty($new_search) ) : ?>
    <span class="ajaxloader"></span>
    <div class="articles__wrapper" data-totalcount=<?=$listings_found?>>
      <?php foreach( $new_search as $post ): 
            $pID = $post->ID;
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
            $post_term = get_term_by('id', $post_primary_term_id, 'category');
        ?>

        <div class="article">
          <div class="img_wrap">
            <img src="<?php echo $featImg['url']; ?>" alt="<?php echo $title; ?>" />
            <a class="link-to-post" href="<?= $perm; ?>"></a>
          </div>
          <div class="info">

            <div class="info-top">
              <h4 class="post__title"><a href="<?=$perm;?>"><?= $title; ?></a></h4>
    
              <div class="excerpt">
                <?= $finalExcerpt; ?>
              </div>
             </div>

            <div class="info-bottom">
              <span class="post__cat"><?= $post_term->name; ?></span>
              <div class="action-btn">
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