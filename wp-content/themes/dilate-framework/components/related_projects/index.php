<?php $layoutName = 'related_projects' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$dataFeedAuto = $sectionObject->data_feed;

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
  
  <?php if( $dataFeedAuto ) : 
    $currProjID = get_the_ID();
    $currRange = get_the_terms( $currProjID, 'range' );
  
    $tax_q = array('relation'=>'AND');
  
    $args = array(
      'post_type'       => 'project',
      'posts_per_page'  => 4,
      'post_status '    => array('publish'),
      'orderby'         => 'rand',
    );
  
    if( !empty( $currRange ) ) {
      array_push($tax_q, array(
        'taxonomy' => 'range',
        'field' => 'slug',
        'terms' => $currRange[0]->slug
      ));
    }
  
    $args['tax_query'] = $tax_q;
  
    $result = new WP_Query( $args );
    $new_search = $result->posts;
  
    if( !empty($new_search) ) : ?>
    <div class="project__wrapper">
      <?php foreach( $new_search as $obj ) : 
        $pID = $obj->ID;
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $projRange = get_the_terms( $pID, 'range' );
        $projRangeName = $currRange[0]->name;
        $projfinish = get_field('finish', $obj);
        $projPattern = get_field('pattern', $obj);
        $featImg = getFeaturedImage($pID);
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
            <span class="value"><?= $projPattern['value']; ?></span>
          </div>
          
        </div>
        
        <div class="featured__image">
          <a href="<?= $perm; ?>" class="link-to-post" aria-name="Link to <?=$title?>"></a>
          <img data-src="<?= $featImg['url']; ?>" alt="<?= $featImg['alt']; ?>"/>
        </div>
        
      </div>
    
      <?php endforeach; ?>
  </div>
    <?php endif; ?>
  
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>