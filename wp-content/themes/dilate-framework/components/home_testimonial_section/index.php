<?php $layoutName = 'home_testimonial_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$showKIcon = $dataFlds['show_k_icon'];
$IconColor = $dataFlds['icon_color'];

$textReviews = get_field('normal_reviews', 'option');
$videoReviews = get_field('video_reviews', 'option');

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="top__row">
    
    <div class="left">
      <?php if( $showKIcon ) :
      renderKustomTimberIcon($IconColor);
      endif; ?>
    </div>
    
    <div class="right">
      
      <?php headlineText($headlineText, $headlineSEO); ?>
      
      <?php if( !empty($videoReviews) ) : ?>
      <div class="videoreview__slider">
        <?php foreach( $videoReviews as $vid ) : ?>
        <div class="item">
          
          <div class="video__block">
    
            <span class="img_wrap">
              <?php acf_responsive_image3($vid['video_placeholder'], $lazyload); ?>
            </span>
            <iframe class="video__frame" data-src="<?=$vid['video_url'];?>" controls=0 rel=0 modestbranding allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <button class="play__button" aria-label="Kustom Timber Play Testimonial">
                <svg xmlns="http://www.w3.org/2000/svg" width="25.348" height="28.912" viewBox="0 0 25.348 28.912"><path d="M587.166,3749.5a2,2,0,0,1,0,3.455l-21.348,12.453a2,2,0,0,1-3.008-1.728v-24.906a2,2,0,0,1,3.008-1.728Z" transform="translate(-562.81 -3736.773)"/></svg>
            </button>

          </div>
          
          <div class="info">
            <label class="name"><?= $vid['name']; ?></label>
            <span class="location"><?= $vid['location']; ?></span>
          </div>
          
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      
    </div>

  </div>
  
  <?php if( !empty($textReviews) ) : ?>
  <div class="bot__row to_animate">
    
    <div class="normalreview__slider">
      <?php foreach( $textReviews as $rev ) : ?>
      <div class="item">
        <p>
          "<?= $rev['review']; ?>"
        </p>
        <label class="name"><?= $rev['name']; ?></label>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>