<?php $layoutName = 'product_child_hero' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$data = $sectionObject;
$prodID = get_the_ID();
$title = get_the_title($prodID);
$download = get_field('download_catalogue', $prodID);
$desc = get_field('description', $prodID);
$descLimit = 361;
$descCount = strlen($desc);
$prodImageID = get_field('product_image', $prodID);
$plankVars = get_field('plank_variations', $prodID);
$plankVarsCount = count($plankVars);
$otherSpecs = get_field('other_specs', $prodID);

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
  <div class="columns">
    
    <div class="column column__left">
      
      <span class="img__wrap">
        <img <?php acf_responsive_image($prodImageID['id'], '', '331px', $lazyload); ?> alt="<?= $prodImageID['alt']; ?>"/>
      </span>
      
    </div>
    
    <div class="column column__right">
      
      <div class="top__info">
        
        <span class="mobile__image img__wrap">
          <img <?php acf_responsive_image($prodImageID['id'], '', '331px', $lazyload); ?> alt="<?= $prodImageID['alt']; ?>"/>
        </span>
        
        <div class="title__block">
          <h1 class="headline__text h2"><?= $title ?></h1>
          <a class="downloadCatalogueBtn site__button site__button_style--outlinedark" data-fileid="<?= $download['id']; ?>" aria-label="Kustom Timber <?=$title?> Catalogue Download">
            <span class="text">Download Catalogue</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
            </span>
          </a>
          <a href="#" class="enquireNowBtn site__button site__button_style--outlinedark">
            <span class="text">Enquire Now</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
            </span>
          </a>
        </div>

        <div class="desc__block">
          <label>Description</label>
          <p>
            <?php if( $descCount > $descLimit ) : 
              $part1 = substr($desc, 0, $descLimit+1);
              $part2 = substr($desc, $descLimit, $descCount);
            ?>

              <?= $part1; ?>
              <span class="part2"><?= $part2; ?></span>
              <button class="readmore">
                <span class="text">Read more</span>
                <span class="icon"><img src="/wp-content/uploads/2023/01/down-arrow.png" alt="Read more description"/></span>
              </button>

            <?php else : ?>

              <?= $desc; ?>

            <?php endif; ?>
          </p>
        </div>
        
      </div>
      
      <div class="data__info">
        
        <?php if( $plankVarsCount > 0 ) : ?>
        <div class="plank__variations">
          <label>Plank Variations</label>
          <?php foreach( $plankVars as $idx=>$plank ) : ?>
          <div class="data__item plank__item">
            <span class="name"><?= $plank['name']; ?></span>
            <span class="desc"><?= $plank['description']; ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <?php if( !empty( $otherSpecs ) ) : ?>
        <div class="other__data">
          
          <?php foreach( $otherSpecs as $spec ) : ?>
          
          <div class="data__item">
            <label><?= $spec['spec_name']; ?></label>
            <span class="value"><?= $spec['spec_value']; ?></span>
          </div>
          
          <?php endforeach; ?>
          
        </div>
        <?php endif; ?>
        
      </div>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>