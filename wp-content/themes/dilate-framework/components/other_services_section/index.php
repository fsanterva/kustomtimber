<?php $layoutName = 'other_services_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$services = $data->services;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <?php headlineText($headlineText, $headlineSEO); ?>

  <?php if( !empty($textSummary) ) : ?>
  <div class="text__summary">
    <?= $textSummary; ?>
  </div>
  <?php endif; ?>

  <?php if( !empty($button['button_link']) ) : ?>
  <?php button($button); ?>
  <?php endif; ?>
  
</div>

<div class="row row--full row--services to_animate">
  
  <div class="services__carousel">
    
    <?php foreach( $services as $service ) : 
    $title = get_the_title($service);
    $perm = get_the_permalink($service);
//     $img = getFeaturedImage($service);
    ?>
    <div class="service__item">
      
      <label class="name"><?= $title; ?></label>
      <div class="img__wrap">
        <?php getFeaturedImage($service, $lazyload); ?>
        <span class="learnmore">Learn more</span>
        <a href="<?= $perm; ?>" class="link-to-post"></a>
      </div>
      
    </div>
    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>