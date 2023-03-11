<?php $layoutName = 'text_image_layout_4' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$imageFlds = $data->image_fields;
$showIcon = $imageFlds['show_k_icon'];
$iconColor = $imageFlds['icon_color'];
$largeImg = $imageFlds['larger_image'];
$smallImg = $imageFlds['smaller_image'];

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <div class="headline__wrap to_animate">
    <?php headlineText($headlineText, $headlineSEO); ?>
  </div>
  
  <div class="columns">
    
    <div class="column column__left">
      
      <?php if( $showIcon ) : ?>
      <?php renderKustomTimberIcon($iconColor); ?>
      <?php endif; ?>
      
      <div data-speed="0.4" class="img__wrap to_parallax_scroll to_parallax_bottom">
        <img <?= acf_responsive_image($largeImg['id'], '', '1094px', $lazyload); ?> alt="<?= $largeImg['alt']; ?>"/>
      </div>
      
    </div>
    
    <div class="column column__right">
      
      <div class="info to_animate">
        
        <?php if( !empty($textSummary) ) : ?>
        <div class="text__summary">
          <?= $textSummary; ?>
        </div>
        <?php endif; ?>
        <?php if( !empty($button['button_link']) ) : ?>
        <?php button($button); ?>
        <?php endif; ?>
        
      </div>
      
      <div data-speed="0.3" class="img__wrap to_parallax_scroll">
        <img <?= acf_responsive_image($smallImg['id'], '', '647px', $lazyload); ?> alt="<?= $smallImg['alt']; ?>"/>
      </div>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>