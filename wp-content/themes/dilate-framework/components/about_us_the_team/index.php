<?php $layoutName = 'about_us_the_team' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$showKIcon = $dataFlds['show_k_icon'];
$IconColor = $dataFlds['icon_color'];

$boss = $data->the_boss;
$bossImage = $boss['boss_image'];
$boss1 = $boss['boss_1'];
$boss2 = $boss['boss_2'];

$staff = $data->the_staff;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--boss">
  
  <div class="columns">
    
    <div class="column column__left">
      
      <div class="heading to_animate">
    
        <?php headlineText($headlineText, $headlineSEO); ?>

        <span>
          <?php if( !empty($textSummary) ) : ?>
            <div class="text__summary"><?= $textSummary ?></div>
          <?php endif; ?>
        </span>

      </div>
      
      <span class="img__wrap to_parallax_scroll to_parallax_bottom">
        <img <?php acf_responsive_image($bossImage['id'], '', '864px', $lazyload); ?> alt="<?= $bossImage['alt']; ?>"/>
      </span>
      
    </div>
    
    <div class="column column__right">
      
      <?php if( $showKIcon ) :
        renderKustomTimberIcon($IconColor);
      endif; ?>
      
      <div class="boss__bios to_animate">
        
        <div class="boss boss__1">
          <label class="name"><?= $boss1['name']; ?></label>
          <span class="position"><?= $boss1['position']; ?></span>
          <div class="bio">
            <?= $boss1['bio']; ?>
          </div>
        </div>
        
        <div class="boss boss__2">
          <label class="name"><?= $boss2['name']; ?></label>
          <span class="position"><?= $boss2['position']; ?></span>
          <div class="bio">
            <?= $boss2['bio']; ?>
          </div>
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</div>

<div class="row row--staff">
  
  <div class="staff__grid">
    
    <?php foreach( $staff as $item ) : ?>
  
    <div class="staff__item to_animate">
      <label class="name"><?= $item['name']; ?></label>
      <span class="position"><?= $item['position']; ?></span>
      <span class="img__wrap">
        <img <?php acf_responsive_image($item['image']['id'], '', '864px', $lazyload); ?> alt="<?= $item['image']['alt']; ?>"/>
      </span>
    </div>

    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>