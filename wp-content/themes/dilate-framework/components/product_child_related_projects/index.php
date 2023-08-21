<?php $layoutName = 'product_child_related_projects' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$dataFeedAuto = $sectionObject->data_feed;
$dataFeedManual = $sectionObject->select_projects;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
    
  <?php headlineText($headlineText, $headlineSEO); ?>

  <?php if( !empty($textSummary) ) : ?>

    <div class="text__summary"><?= $textSummary ?></div>

  <?php endif; ?>
  
  <?php if( !empty( $button['button_link'] ) ) : ?>
    <?php button($button); ?>
  <?php endif; ?>
  
</div>

<div class="row row--projects">
  
  <?php if( $dataFeedAuto ) : //IF AUTO
    $currProdID = get_the_ID();
    $currProdPostType = get_post_type( $currProdID );
    $currRange = get_the_terms( $currProdID, 'range' );
  
    $meta_q = array('relation'=>'AND');
  
    /* GET PRODUCT IDs IN THE SAME RANGE */
    $argsProd = array(
      'post_type'       => $currProdPostType,
      'posts_per_page'  => -1,
      'post_status '    => array('publish'),
      'tax_query'       => array(
        array(
          'taxonomy' => 'range',
          'field' => 'slug',
          'terms' => $currRange[0]->slug
        )
      )
    );
    $productsResult = new WP_Query( $argsProd );
    $prodIDs = array_column($productsResult->posts, 'ID');
    /* END GET PRODUCT IDs IN THE SAME RANGE */

    $args = array(
      'post_type'       => 'project',
      'posts_per_page'  => 4,
      'post_status '    => array('publish'),
      'orderby'         => 'rand',
    );
  
    if( !empty( $prodIDs ) ) {
      array_push($meta_q, array(
        'key' => 'finish',
        'value' => $prodIDs,
        'compare' => 'IN'
      ));
    }
  
    $args['meta_query'] = $meta_q;
  
    $result = new WP_Query( $args );
    $new_search = $result->posts;
  
    if( !empty($new_search) ) : ?>
    <div class="project__wrapper">
      <?php foreach( $new_search as $obj ) : 
        $pID = $obj->ID;
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $projRange = get_the_terms( $pID, 'range' );
        // $projRangeName = $projRange[0]->name;
        $projfinish = get_field('finish', $obj);
        $projPattern = get_field('pattern', $obj);
//         $featImg = getFeaturedImage($pID);
      ?>

      <div class="item to_animate">
        
        <div class="featured__image">
          <a href="<?= $perm; ?>" class="link-to-post" aria-name="Link to <?=$title?>"></a>
          <?php getFeaturedImage($pID, $lazyload); ?>
        </div>
        
        <div class="data__info">
          <span class="title"><?=$title;?></span>
          <a href="<?= $perm; ?>" aria-name="Link to <?=$title?>">
            <span class="text">View project</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
            </span>
          </a>
        </div>
        
      </div>
    
      <?php endforeach; ?>
    </div>
  
    <?php endif; ?>
  
  <?php else : ?><!-- ELSE IF MANUAL -->
  
    <div class="project__wrapper">
    <?php foreach( $dataFeedManual as $pID ) :
      $title = get_the_title($pID);
      $perm = get_the_permalink($pID);
      $projRange = get_the_terms( $pID, 'range' );
      // $projRangeName = $projRange[0]->name;
      $projfinish = get_field('finish', $pID);
      $projPattern = get_field('pattern', $pID);
//       $featImg = getFeaturedImage($pID);
    ?>
    <div class="item to_animate">
        
        <div class="featured__image">
          <a href="<?= $perm; ?>" class="link-to-post" aria-name="Link to <?=$title?>"></a>
          <?php getFeaturedImage($pID, $lazyload); ?>
        </div>
        
        <div class="data__info">
          <span class="title"><?=$title;?></span>
          <a href="<?= $perm; ?>" aria-name="Link to <?=$title?>">
            <span class="text">View project</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
            </span>
          </a>
        </div>
        
      </div>
    <?php endforeach; ?>
  
    </div>
      
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>