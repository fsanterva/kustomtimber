<?php $layoutName = 'internal_hero_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$textFlds = $data->data_fields;
$headlineText = $textFlds['main_headline_text'];
$headlineSEO = $textFlds['seo_tag'];
$textSummary = $textFlds['text_summary'];
$button = $textFlds['site_button'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="data__wrap to_animate_manual">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <?php if( !empty($textSummary) ) : ?>
    
      <div class="text__summary"><?= $textSummary ?></div>
    
    <?php endif; ?>
    
    <?php if( !empty($button['button_link']) ) : ?>
    <?php button($button); ?>
    <?php endif; ?>

  </div>

  <?php renderScrolldownIcon(); ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>