<?php $layoutName = 'service_child_hero' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$image = $data->image;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
  <div class="columns">
    
    <div class="column column__left">
      
      <?php headlineText($headlineText, $headlineSEO); ?>
      
    </div>
    
    <div class="column column__right">
      
      <?php if( !empty($textSummary) ) : ?>
      <div class="text__summary">
        <?= $textSummary; ?>
      </div>
      <?php endif; ?>
      <?php button($button); ?>
      
    </div>
    
  </div>
  
</div>

<div class="row row--full">
  
  <?php if( !empty($image) ) : ?>
  <div class="img__wrap to_parallax_bg">
    <img <?= acf_responsive_image($image['id'], '', '1920px', $lazyload); ?> alt="<?= $image['alt']; ?>"/>
  </div>
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>