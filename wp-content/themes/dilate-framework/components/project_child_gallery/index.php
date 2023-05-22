<?php $layoutName = 'project_child_gallery' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$gallery = $data->gallery;

$lazyload = $data->lazyload;

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

<?php if( !empty( $gallery ) ) : ?>

  <?php foreach( $gallery as $idx=>$item ) : 
  $layout = $item['layout'];
  ?>

  <div class="row <?= ($layout == 'layout4') ? 'row--full' : ''; ?> <?=$layout;?>">
  
  <?php if( $layout == 'layout1' ) : ?>
    <div class="columns">
      
      <div class="column column__wide">
        <div class="img__wrap to_parallax_bg">
          <?php acf_responsive_image3($item['layout_1_fields']['wider_image'], $lazyload); ?>
        </div>
      </div>
      
      <div class="column column__narrow">
        <div data-speed="0.4" class="img__wrap to_parallax_scroll">
          <?php acf_responsive_image3($item['layout_1_fields']['narrow_image'], $lazyload); ?>
        </div>
      </div>
      
    </div>
  <?php endif; ?>
    
  <?php if( $layout == 'layout2' ) : ?>
    <div class="columns to_animate">
      
      <div class="column column__caption">
        <p>
          <?= $item['layout_2_fields']['caption']; ?>
        </p>
      </div>
      
      <div class="column column__image">
        <div data-speed="0.3" class="img__wrap to_parallax_scroll to_parallax_left">
          <?php acf_responsive_image3($item['layout_2_fields']['image'], $lazyload); ?>
        </div>
      </div>
      
    </div>
  <?php endif; ?>
    
  <?php if( $layout == 'layout3' ) : ?>
    <div class="columns to_animate">
      
      <div class="column column__image">
        <div data-speed="0.3" class="img__wrap to_parallax_scroll to_parallax_right">
          <?php acf_responsive_image3($item['layout_3_fields']['image'], $lazyload); ?>
        </div>
      </div>
      
      <div class="column column__caption">
        <p>
          <?= $item['layout_3_fields']['caption']; ?>
        </p>
      </div>
      
    </div>
  <?php endif; ?>
    
  <?php if( $layout == 'layout4' ) : ?>
    <div id="<?= 'comp_'.$layoutName.'_'.$once[$row_layout].'_layout4_'.$idx; ?>" class="panorama__container" data-url="<?= $item['layout_4_fields']['panoramic_image']['url']; ?>" alt="<?= $item['layout_4_fields']['panoramic_image']['alt']; ?>">
      
    </div>
  <?php endif; ?>
    
  <?php if( $layout == 'layout5' ) : ?>
    <div class="columns to_animate">
      
      <div class="column column__short">
        <div data-speed="0.5" class="img__wrap to_parallax_scroll">
          <?php acf_responsive_image3($item['layout_5_fields']['smaller_image'], $lazyload); ?>
        </div>
      </div>
      
      <div class="column column__tall">
        <div data-speed="0.3" class="img__wrap to_parallax_scroll to_parallax_bottom">
          <?php acf_responsive_image3($item['layout_5_fields']['taller_image'], $lazyload); ?>
        </div>
      </div>
      
    </div>
  <?php endif; ?>
  
  </div>

  <?php endforeach; ?>

<?php endif; ?>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>