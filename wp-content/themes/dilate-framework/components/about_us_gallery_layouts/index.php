<?php $layoutName = 'about_us_gallery_layouts' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$textFlds = $data->data_fields;
$headlineText = $textFlds['main_headline_text'];
$headlineSEO = $textFlds['seo_tag'];
$textSummary = $textFlds['text_summary'];
$button = $textFlds['site_button'];

$blocks = $data->block_layouts;

$lazyload =$data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading row--narrow">
  
  <div class="data__wrap to_animate">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <div class="info">
      
      <?php if( !empty($textSummary) ) : ?>
    
        <div class="text__summary"><?= $textSummary ?></div>

      <?php endif; ?>

      <?php if( !empty($button['button_link']) ) : ?>
      <?php button($button); ?>
      <?php endif; ?>
      
    </div>

  </div>
  
</div>

<?php if( !empty($blocks) ) : ?>

  <?php foreach( $blocks as $block ) : 
    $layout = $block['layout'];
  ?>

    <?php if( $layout == 'layout1' ) : 
      $group1 = $block['contained_image'];
      $gp1_image = $group1['image'];
    ?>

      <div class="row row--layout1 to_animate">
        
        <span class="img__wrap to_parallax_bg">
          <img <?php acf_responsive_image($gp1_image['id'], '', '2000px', $lazyload); ?> alt="<?= $gp1_image['alt']; ?>"/>
        </span>
        
      </div>

    <?php elseif( $layout == 'layout2' ) : 
      $group2 = $block['full_width_image'];
      $gp2_image = $group2['image'];
    ?>

      <div class="row row--layout2 row--full to_animate">
        
        <span class="img__wrap to_parallax_bg">
          <img <?php acf_responsive_image($gp2_image['id'], '', '2000px', $lazyload); ?> alt="<?= $gp2_image['alt']; ?>"/>
        </span>
        
      </div>

    <?php elseif( $layout == 'layout3' ) : 
      $group3 = $block['2_column_image_with_short_text'];
      $gp3_text = $group3['short_text'];
      $gp3_tallerImg = $group3['taller_image'];
      $gp3_shorterImg = $group3['shorter_image'];
    ?>

      <div class="row row--layout3">
        
        <div class="columns">
          
          <div class="column column__left to_animate">
            
            <span data-speed="0.5" class="img__wrap to_parallax_scroll">
              <img <?php acf_responsive_image($gp3_tallerImg['id'], '', '800px', $lazyload); ?> alt="<?= $gp3_tallerImg['alt']; ?>"/>
            </span>
            
          </div>
          
          <div class="column column__right to_animate">
            
            <?php if( !empty($gp3_text) ) : ?>
            <div class="text__summary">
              <?= $gp3_text; ?>
            </div>
            <?php endif; ?>
            
            <span data-speed="0.3" class="img__wrap to_parallax_scroll to_parallax_bottom">
              <img <?php acf_responsive_image($gp3_shorterImg['id'], '', '800px', $lazyload); ?> alt="<?= $gp3_shorterImg['alt']; ?>"/>
            </span>
            
          </div>
          
        </div>
        
      </div>

    <?php elseif( $layout == 'layout4' ) : 
      $group4 = $block['short_text_with_cta'];
      $gp4_text = $group4['short_text'];
      $gp4_cta = $group4['site_button'];
    ?>

      <div class="row row--layout4 row--narrow to_animate">
        
        <div class="columns">
          
          <div class="column column__left">
            
            <?php if( !empty($gp4_text) ) : ?>
            <div class="text__summary">
              <?= $gp4_text; ?>
            </div>
            <?php endif; ?>
            
          </div>
          
          <div class="column column__right">
            
            <?= button($gp4_cta); ?>
            
          </div>
          
        </div>
        
      </div>

    <?php elseif( $layout == 'layout5' ) : 
      $group5 = $block['two_column_text_and_image'];
      $gp5_text = $group5['short_text'];
      $gp5_cta = $group5['site_button'];
      $gp5_img = $group5['image'];
    ?>

      <div class="row row--layout5 row--narrow">
        
        <div class="columns">
          
          <div class="column column__left to_animate">
            
            <?php if( !empty($gp5_text) ) : ?>
            <div class="text__summary">
              <?= $gp5_text; ?>
            </div>
            <?php endif; ?>
            
            <?= button($gp5_cta); ?>
            
          </div>
          
          <div class="column column__right to_animate">
            
            <span data-speed="0.5" class="img__wrap to_parallax_scroll">
              <img <?php acf_responsive_image($gp5_img['id'], '', '1000px', $lazyload); ?> alt="<?= $gp5_img['alt']; ?>"/>
            </span>
            
          </div>
          
        </div>
        
      </div>

    <?php endif; ?>

  <?php endforeach; ?>

<?php endif; ?>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>