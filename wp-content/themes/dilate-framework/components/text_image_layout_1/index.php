<?php $layoutName = 'text_image_layout_1' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$readmore = $dataFlds['read_more'];
$button = $dataFlds['site_button'];

$imageFlds = $data->image_fields;
$showKIcon = $imageFlds['show_k_icon'];
$IconColor = $imageFlds['icon_color'];
$image = $imageFlds['image'];

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="column__left to_animate">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <?php if( !empty($textSummary) ) : ?>
    
      <div class="text__summary">
        <?= $textSummary ?>
        <?php if( !empty( $readmore ) ) : ?>

          <span class="readmore"><?= $readmore; ?></span>

          <label class="readmore__toggle">
            <input type="checkbox">
            Read more
          </label>

        <?php endif; ?>
      </div>
    
    <?php endif; ?>
    
    <?php button($button); ?>

  </div>
  
  <div class="column__right">
    
    <?php if( $showKIcon ) :
    renderKustomTimberIcon($IconColor);
    endif; ?>
    
    <?php if( !empty($image) ) : ?>
    <div data-speed="0.8" class="img__wrap to_parallax_scroll">
      <?php acf_responsive_image3($image, $lazyload); ?>
    </div>
    <?php endif; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>