<?php $layoutName = 'home_hero_1' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$textFlds = $data->data_fields;
$headlineText = $textFlds['main_headline_text'];
$headlineSEO = $textFlds['seo_tag'];
$headlineText2 = $textFlds['headline_text_2_main_headline_text'];
$headlineSEO2 = $textFlds['headline_text_2_seo_tag'];
$textSummary = $textFlds['text_summary'];
$button = $textFlds['site_button'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="data__wrap to_animate_manual">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <?php if( !empty($headlineText2) ) : ?>
    
      <div class="text__summary">
		  <?php headlineText($headlineText2, $headlineSEO2); ?>
	  </div>
    
    <?php endif; ?>
    
    <?php button($button); ?>

  </div>

  <?php renderScrolldownIcon(); ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>