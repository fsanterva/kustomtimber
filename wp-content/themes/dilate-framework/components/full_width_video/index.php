<?php $layoutName = 'full_width_video' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$videoFlds = $data->video_fields;
$videoURL = $videoFlds['video_url'];
$videoPoster = $videoFlds['video_poster'];

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
  <?php headlineText($headlineText, $headlineSEO); ?>
  
  <?php if( !empty($textSummary) ) : ?>

    <div class="text__summary"><?= $textSummary ?></div>

  <?php endif; ?>

  <?php if( !empty($button['button_link']) ) : ?>
  <?php button($button); ?>
  <?php endif; ?>
  
</div>

<div class="row row--video">
  
  <div class="video__block">
    
    <span class="img_wrap"><img data-src="<?= $videoPoster; ?>"/></span>
    <iframe class="video__frame" data-src="<?=$videoURL;?>" controls=0 rel=0 modestbranding allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    
    <button class="play__button">
      <span class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="25.348" height="28.912" viewBox="0 0 25.348 28.912"><path d="M587.166,3749.5a2,2,0,0,1,0,3.455l-21.348,12.453a2,2,0,0,1-3.008-1.728v-24.906a2,2,0,0,1,3.008-1.728Z" transform="translate(-562.81 -3736.773)"/></svg>
      </span>
      <span class="text">PLAY VIDEO</span>
    </button>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>