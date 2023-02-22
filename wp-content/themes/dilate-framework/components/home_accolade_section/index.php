<?php $layoutName = 'home_accolade_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$textFlds = $data->data_fields;
$headlineText = $textFlds['main_headline_text'];
$headlineSEO = $textFlds['seo_tag'];
$textSummary = $textFlds['text_summary'];
$accoladeIcon = $textFlds['accolade_icon'];
$accoladeDesc = $textFlds['accolade_description'];
$image = $data->image;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <div class="columns">
    
    <div class="column column__left">
      
      <?php if( !empty($accoladeIcon) ) : ?>
      <span class="icon">
        <img <?= acf_responsive_image($accoladeIcon['id'], '', '250px'); ?> alt="<?= $accoladeIcon['alt']; ?>"/>
      </span>
      <?php endif; ?>
      
      <?php if( !empty($accoladeDesc) ) : ?>
      <span class="desc">
        <?= $accoladeDesc; ?>
      </span>
      <?php endif; ?>
      
    </div>
    
    <div class="column column__right">
      
      <?php headlineText($headlineText, $headlineSEO); ?>
      
      <?php if( !empty($textSummary) ) : ?>
    
        <div class="text__summary"><?= $textSummary ?></div>

      <?php endif; ?>
      
    </div>

  </div>
  
</div>

<?php if( !empty($image) ) : ?>
<div class="row row--image">
  
  <span class="desc to_parallax_bg">
    <img <?= acf_responsive_image($image['id'], '', '2200px'); ?> alt="<?= $image['alt']; ?>"/>
  </span>
  
</div>

<?php endif; ?>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>