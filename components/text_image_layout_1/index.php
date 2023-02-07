<?php $layoutName = 'text_image_layout_1' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$imageFlds = $data->image_fields;
$showKIcon = $imageFlds['show_k_icon'];
$IconColor = $imageFlds['icon_color'];
$image = $imageFlds['image'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="column__left to_animate">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <?php if( !empty($textSummary) ) : ?>
    
      <div class="text__summary"><?= $textSummary ?></div>
    
    <?php endif; ?>
    
    <?php button($button); ?>

  </div>
  
  <div class="column__right">
    
    <?php if( $showKIcon ) :
    renderKustomTimberIcon($IconColor);
    endif; ?>
    
    <?php if( !empty($image) ) : ?>
    <div class="img__wrap to_parallax_bg">
      <img data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"/>
    </div>
    <?php endif; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>