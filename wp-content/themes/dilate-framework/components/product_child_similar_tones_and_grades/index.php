<?php $layoutName = 'product_child_similar_tones_and_grades' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$cta = $data->site_button;

$tonesFeedAuto = $data->similar_tones_data_feed;
$tonesFeedManual = $data->select_similar_tones;
$gradesFeedAuto = $data->similar_grades_data_feed;
$gradesFeedManual = $data->select_similar_grades;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="tabs to_animate">
    
    <div class="tabs__nav">
      <button class="active" data-id="tones" aria-label="Kustom Timber Tones Button">Browse Similar Tones</button>
      <button data-id="grades" aria-label="Kustom Timber Grade Button">Browse Similar Grades</button>
    </div>
    
    <div class="tabs__content">
      
      <div class="tab tones active">
        
        <?php if( $tonesFeedAuto ) :
          $currColour = get_the_terms( get_the_ID(), 'colour' );
          $tax_q = array('relation'=>'AND');
          $tonesArgs = array(
            'post_type'       => 'timber-product',
            'posts_per_page'  => -1,
            'post__not_in'    => array(get_the_ID()),
            'post_status '    => array('publish'),
            'orderby'         => 'rand',
          );
          if( !empty( $currColour ) ) {
            array_push($tax_q, array(
              'taxonomy' => 'colour',
              'field' => 'slug',
              'terms' => $currColour[0]->slug
            ));
          }

          $tonesArgs['tax_query'] = $tax_q;
          $tonesResult = new WP_Query( $tonesArgs );
        ?>
        
          <?php if( !empty($tonesResult->posts) ) : ?>
          <div class="tones__carousel_wrapper">
            <?php foreach( $tonesResult->posts as $obj ) :
              $title = get_the_title($obj);
              $perm = get_the_permalink($obj);
              $prodImg = get_field('product_image', $obj);
            ?>
            <div class="item">
              <a href="<?= $perm ?>" class="link-to-post"></a>
              <span class="img__wrap">
                <?php acf_responsive_image3($prodImg, $lazyload); ?>
              </span>
              <span class="name"><?= $title; ?></span>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        
        <?php else : ?>
        
          <?php if( !empty($tonesFeedManual) ) : ?>
            <div class="tones__carousel_wrapper">
              <?php foreach( $tonesFeedManual as $obj ) :
                $title = get_the_title($obj);
                $perm = get_the_permalink($obj);
                $prodImg = get_field('product_image', $obj);
              ?>
              <div class="item">
                <a href="<?= $perm ?>" class="link-to-post"></a>
                <span class="img__wrap">
                  <?php acf_responsive_image3($prodImg, $lazyload); ?>
                </span>
                <span class="name"><?= $title; ?></span>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
        
        <?php endif; ?>
        
      </div>
      
      <div class="tab grades">
        
        <?php if( $gradesFeedAuto ) : 
          $currGrade = get_the_terms( get_the_ID(), 'grade' );
          $tax_q = array('relation'=>'AND');
          $gradesArgs = array(
            'post_type'       => 'timber-product',
            'posts_per_page'  => -1,
            'post__not_in'    => array(get_the_ID()),
            'post_status '    => array('publish'),
            'orderby'         => 'rand',
          );
          if( !empty( $currGrade ) ) {
            array_push($tax_q, array(
              'taxonomy' => 'grade',
              'field' => 'slug',
              'terms' => $currGrade[0]->slug
            ));
          }

          $gradesArgs['tax_query'] = $tax_q;
          $gradesResult = new WP_Query( $gradesArgs );
        ?>
        
          <?php if( !empty($gradesResult->posts) ) : ?>
          <div class="grades__carousel_wrapper">
            <?php foreach( $gradesResult->posts as $obj ) :
              $title = get_the_title($obj);
              $perm = get_the_permalink($obj);
              $prodImg = get_field('product_image', $obj);
            ?>
            <div class="item">
              <a href="<?= $perm ?>" class="link-to-post"></a>
              <span class="img__wrap">
                <?php acf_responsive_image3($prodImg, $lazyload); ?>
              </span>
              <span class="name"><?= $title; ?></span>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        
        <?php else : ?>
        
          <?php if( !empty($gradesFeedManual) ) : ?>
            <div class="grades__carousel_wrapper">
              <?php foreach( $gradesFeedManual as $obj ) :
                $title = get_the_title($obj);
                $perm = get_the_permalink($obj);
                $prodImg = get_field('product_image', $obj);
              ?>
              <div class="item">
                <a href="<?= $perm ?>" class="link-to-post"></a>
                <span class="img__wrap">
                  <?php acf_responsive_image3($prodImg, $lazyload); ?>
                </span>
                <span class="name"><?= $title; ?></span>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
        
        <?php endif; ?>
        
      </div>
      
    </div>
    
  </div>
  
  <?php
  button($cta);
  ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>