<?php $layoutName = 'room_visualization_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$bgColor = $dataFlds['column_background_color'];
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$imageFlds = $data->image_fields;
$image1 = $imageFlds['default_image'];
$image2 = $imageFlds['hover_image'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <div class="column__left" style="background-color:<?= ( !empty($bgColor) ) ? $bgColor : 'var(--color1)' ?>">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <?php if( !empty($textSummary) ) : ?>
    
      <div class="text__summary"><?= $textSummary ?></div>
    
    <?php endif; ?>
    
    <?php button($button); ?>

  </div>
  
  <div class="column__right">
    
    <button class="changeFloorBtn">CHANGE FLOOR</button>
    
    <div class="img__wrap">
      <img class="default" <?= acf_responsive_image($image1['id'], '', '1920px'); ?> alt="<?= $image1['alt']; ?>"/>
      <img class="hover" <?= acf_responsive_image($image2['id'], '', '1920px'); ?> alt="<?= $image2['alt']; ?>"/>
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>