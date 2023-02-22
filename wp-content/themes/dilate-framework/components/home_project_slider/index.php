<?php $layoutName = 'home_project_slider' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$textFlds = $data->data_fields;
$headlineText = $textFlds['main_headline_text'];
$headlineSEO = $textFlds['seo_tag'];
$textSummary = $textFlds['text_summary'];
$button = $textFlds['site_button'];

$projects = $data->select_project;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <div class="data__wrap">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
  
    <div class="desc__block">
      
      <?php if( !empty($textSummary) ) : ?>
    
        <div class="text__summary"><?= $textSummary ?></div>

      <?php endif; ?>

      <?php button($button); ?>
      
    </div>

  </div>
  
</div>

<div class="row row--projects">
  
  <div class="projects__slider">
    
    <?php foreach( $projects as $item ) : 
      $title  = get_the_title($item);
      $perm   = get_the_permalink($item);
      $featImg = getFeaturedImage($item->ID);
      $finish = get_field('finish', $item);
      $finishImg = get_field('product_image', $finish);
      $finishTitle = get_the_title($finish);
    ?>
    <div class="item">
      
      <div class="img__wrap">
        <img <?= acf_responsive_image($featImg['id'], '', '1300px'); ?> alt="<?= $featImg['alt']; ?>"/>
      </div>
      <div class="data__wrap">
        
        <span class="finish__wrap">
          <img <?= acf_responsive_image($finishImg['id'], '', '450px'); ?> alt="<?= $finishImg['alt']; ?>"/>
          <label class="name"><?= $finishTitle; ?></label>
        </span>
        
        <div class="project__info">
          <label><?= $title; ?></label>
          <a href="<?= $perm; ?>">
            <span class="text">View project</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
            </span>
          </a>
        </div>
        
      </div>
      
    </div>
    <?php endforeach; ?>
    
  </div>
  
  <div class="slick__navs">
    
    <div class="arrows__wrap">
      
    </div>
    
    <div class="dots__wrap">
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>