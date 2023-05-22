<?php $layoutName = 'service_child_variations_gallery' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$variations = $data->variations;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <div class="columns">
    
    <div class="column column__left">
      
      <?php headlineText($headlineText, $headlineSEO); ?>
      
    </div>
    
    <div class="column column__right">
      
      <?php if( !empty($textSummary) ) : ?>
      <div class="text__summary">
        <?= $textSummary; ?>
      </div>
      <?php endif; ?>
      <?php button($button); ?>
      
    </div>
    
  </div>
  
</div>

<div class="row row--variations to_animate">
  
  <div class="variations__wrap">
    
    <div class="tab__navs">
      <?php foreach( $variations as $idx => $item ) : ?>
      <button class="<?= ($idx == 0) ? 'active' : '' ?>" data-id="variation__tab_<?= $idx; ?>" aria-label="Kustom Timber "<?= $item['variation_label']; ?>>
        <span class="icon__wrap">
          <img data-src="<?= $item['variation_image']['url']; ?>" alt="<?= $item['variation_image']['alt']; ?>"/>
        </span>
        <span class="label"><?= $item['variation_label']; ?></span>
      </button>
      <?php endforeach; ?>
    </div>
    
    <div class="tab__contents">
      
      <?php foreach( $variations as $idx => $item ) : ?>
      <div id="variation__tab_<?= $idx; ?>" class="content <?= ($idx == 0) ? 'active' : '' ?>">
        
        <div class="variation__gallery_slider">
          <?php foreach( $item['variation_gallery'] as $img ) : ?>
          <?php acf_responsive_image3($img, $lazyload); ?>
          <?php endforeach; ?>
        </div>
        
      </div>
      <?php endforeach; ?>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>