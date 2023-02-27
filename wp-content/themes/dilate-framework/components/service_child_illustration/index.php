<?php $layoutName = 'service_child_illustration' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$mediaFlds = $data->media_fields;
$mediaType = $mediaFlds['media_type'];
$image = $mediaFlds['image'];
$video = $mediaFlds['video'];

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
  <?php headlineText($headlineText, $headlineSEO); ?>
      
  <?php if( !empty($textSummary) ) : ?>
  <div class="text__summary">
    <?= $textSummary; ?>
  </div>
  <?php endif; ?>
  <?php button($button); ?>
  
</div>

<div class="row row--media">
  
  <div class="media__wrapper media__<?= ( $mediaType == 'image' ) ? 'image' : 'video' ?>">
    
    <?php if( $mediaType == 'image' ) : ?>
      <img <?= acf_responsive_image($image['id'], '', '1700px', $lazyload); ?> alt="<?= $image['alt']; ?>"/>
    <?php else : ?>
      <video muted loop>
        <source data-src="<?= $video['url']; ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    <?php endif; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>