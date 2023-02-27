<?php $layoutName = 'our_services_carousel' ?>
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
$carousel = $data->services_carousel;

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

<div class="row row--carousel to_animate">
  
  <div class="services__carousel">
    
    <?php foreach( $carousel as $index => $item ) : 
      $num = ( ($index+1) < 10 ) ? '0'.($index+1) : $index;
      $service_name   = $item['service_name'];
      $service_image  = $item['service_image'];
      $service_link   = $item['service_link'];
    ?>

    <div class="item">

      <div class="name">
        <span class="number"><?= $num; ?></span>
        <h4><?= $service_name; ?></h4>
      </div>
      <div class="img__wrap">
        <img <?= acf_responsive_image($service_image['id'], '', '450px', $lazyload); ?> alt="<?= $service_image['alt']; ?>"/>
        <a href="<?= $service_link['url'] ?>">Learn more</a>
      </div>

    </div>

    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>