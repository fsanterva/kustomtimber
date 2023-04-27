<?php $layoutName = 'room_visualizer' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$embedCode = $data->embed_code;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
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
      
    </div>
    
  </div>
  
</div>

<div class="row row--visualizer">
  
  <?php if( !empty($embedCode) ) : ?>
  <div class="frame__wrap">
    <?= $embedCode; ?>
  </div>
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>