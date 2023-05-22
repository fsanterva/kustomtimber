<?php $layoutName = 'service_child_gallery_layout' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];
$showKIcon = $dataFlds['show_k_icon'];
$IconColor = $dataFlds['icon_color'];
$carousel = $data->image_gallery;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
  <?php if( $showKIcon ) :
    renderKustomTimberIcon($IconColor);
  endif; ?>
    
  <div class="content to_animate">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
    
    <span>
      <?php if( !empty($textSummary) ) : ?>
        <div class="text__summary"><?= $textSummary ?></div>
      <?php endif; ?>

      <?php button($button); ?>
    </span>
    
  </div>
  
</div>

<div class="row row--full row--carousel to_animate">
  
  <div class="image__carousel">
    
    <?php foreach( $carousel as $index => $item ) : 
      $label  = $item['image_label'];
      $image  = $item['image'];
    ?>

    <div class="item">

      <div class="img__wrap">
        <?php acf_responsive_image3($image, $lazyload); ?>
        <label><?= $label; ?></label>
      </div>

    </div>

    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>