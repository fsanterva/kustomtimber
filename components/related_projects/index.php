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
    $currFinish = get_field('finish', $currProjID);
  
    $tax_q = array('relation'=>'AND');
    $meta_q = array('relation'=>'AND');
  
    $args = array(
      'post_type'       => 'project',
      'posts_per_page'  => 4,
      'post_status '    => array('publish')
    );
  
    if( !empty( $currRange ) ) {
      array_push($tax_q, array(
        'taxonomy' => 'range',
        'field' => 'slug',
        'terms' => $currRange[0]->slug
      ));
    }
  
    if( !empty($currFinish) ) {
      array_push($meta_q, array(
        'key' => 'finish',
        'value' => $currFinish,
      ));
    }
  
    $args['tax_query'] = $tax_q;
    $args['meta_query'] = $meta_q;
  
    $result = new WP_Query( $args );
    $new_search = $result->posts;
  
    if( !empty($new_search) ) : ?>

      <?php foreach( $new_search as $obj ) : 
        $pid = $obj->ID;
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
      ?>

      <div>
        <?=$perm?>
      </div>
    
      <?php endforeach; ?>
    <?php endif; ?>
  
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>