<?php $layoutName = 'text_image_layout_2' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$textSummary2 = $dataFlds['text_summary_2'];
$button = $dataFlds['site_button'];

$reverse = $data->reverse;
$image = $data->image;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row <?= ($reverse) ? 'reverse' : '' ?>">
  
  <div class="column__left to_animate">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
    
    <?php if( !empty($textSummary) || !empty($textSummary2) ) : ?>
    <div class="text__summaries <?= ( !empty($textSummary) && !empty($textSummary2) ) ? 'double' : 'single' ?> ">
      
      <?php if( !empty($textSummary) ) : ?>
      <div class="text_summary text_summary_1">
        <?= $textSummary; ?>
      </div>
      <?php endif; ?>
      
      <?php if( !empty($textSummary2) ) : ?>
      <div class="text_summary text_summary_2">
        <?= $textSummary2; ?>
      </div>
      <?php endif; ?>
      
    </div>
    <?php endif; ?>
    
    <?php button($button); ?>

  </div>
  
  <div class="column__right">
    
    <?php if( !empty($image) ) : ?>
    <div class="img__wrap to_parallax_bg">
      <?php acf_responsive_image3($image, $lazyload); ?>
    </div>
    <?php endif; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>