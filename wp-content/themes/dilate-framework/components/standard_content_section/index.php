<?php $layoutName = 'standard_content_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$cta = $dataFlds['site_button'];

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--narrow row--heading">
  
  <div class="content__wrap">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
    
    <?php if( !empty($textSummary) ) : ?>

      <div class="text__summary">
        <?= $textSummary; ?>
      </div>

    <?php endif; ?>

    <?php button($cta); ?>

  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>