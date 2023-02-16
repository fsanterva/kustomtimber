<?php $layoutName = 'product_child_enquire_form' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$formShortcode = $dataFlds['form_shortcode'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
    
  <div class="columns">
    
    <div class="column column__left">
      <?php renderKustomTimberIcon('white'); ?>
    </div>
    
    <div class="column column__right">
      
      <?php headlineText($headlineText, $headlineSEO); ?>

      <?php if( !empty($textSummary) ) : ?>

        <div class="text__summary"><?= $textSummary ?></div>

      <?php endif; ?>
      
      <?= do_shortcode($formShortcode); ?>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>