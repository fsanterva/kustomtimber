<?php $layoutName = 'related_projects' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$dataFeed = $sectionObject->data_feed;

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
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>