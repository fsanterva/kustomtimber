<?php $layoutName = 'service_child_steps' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$steps = $data->steps;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <?php headlineText($headlineText, $headlineSEO); ?>
      
  <?php if( !empty($textSummary) ) : ?>
  <div class="text__summary">
    <?= $textSummary; ?>
  </div>
  <?php endif; ?>
  
</div>

<div class="row row--steps to_animate_manual">
  
  <div class="steps__wrap">
    
    <?php foreach( $steps as $idx => $step ) : ?>
    <div class="step">
      
      <div class="img__wrap">
        <img <?= acf_responsive_image($step['image']['id'], '', '600px', $lazyload); ?> alt="<?= $step['image']['alt']; ?>"/>
      </div>
      
      <div class="content__wrap">
        
        <span class="count">0<?= $idx+1; ?></span>
        <label><?= $step['label']; ?></label>
        <div class="desc">
          <?= $step['description']; ?>
        </div>
        
      </div>
      
    </div>
    <?php endforeach; ?>
    
  </div>
  
  <?php button($button); ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>