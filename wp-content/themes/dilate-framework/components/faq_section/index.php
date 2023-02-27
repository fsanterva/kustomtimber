<?php $layoutName = 'faq_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$faqs = $data->faqs;

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
      
      <?php if( !empty($button['button_link']) ) : ?>
      <?php button($button); ?>
      <?php endif; ?>
      
    </div>
    
  </div>
  
</div>

<div class="row row--faqs to_animate">
  
  <div class="faq__wrapper">
    
    <?php foreach( $faqs as $faq ) : ?>
    <div class="faq__item to_animate">
      <a class="title" aria-label="Kustom Timber FAQ">
        <span class="text"><?= $faq['title']; ?></span>
        <span class="toggle"></span>
      </a>
      <div class="body">
        <?= $faq['body']; ?>
      </div>
    </div>
    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>