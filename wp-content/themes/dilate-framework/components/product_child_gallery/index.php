<?php $layoutName = 'product_child_gallery' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];
$showDownloadCatalogue = $dataFlds['show_download_catalogue'];

$galleryImgs = $data->gallery_images;

$prodID = get_the_ID();
$download = get_field('download_catalogue', $prodID);

$lazyload = $data->lazyload;


require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <div class="columns">
    
    <div class="column column__left to_animate">
    
      <?php headlineText($headlineText, $headlineSEO); ?>

      <?php if( !empty($textSummary) ) : ?>

        <div class="text__summary"><?= $textSummary ?></div>

      <?php endif; ?>

      <div class="button__group">
        <?php if( $showDownloadCatalogue ) : ?>
        <a class="downloadCatalogueBtn site__button site__button_style--outlinedark" data-fileid="<?= $download['id']; ?>" aria-label="Kustom Timber <?=$title?> Catalogue Download">
          <span class="text">Download Catalogue</span>
          <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
          </span>
        </a>
        <?php endif; ?>
        <?php button($button); ?>
      </div>


    </div>

    <div class="column column__right">

      <?php if( !empty($galleryImgs) ) : ?>
      <div class="carousel__wrap">

        <?php foreach( $galleryImgs as $img ) : ?>
        <div class="item">
          <span><img <?php acf_responsive_image($img['id'], '', '600px', $lazyload); ?> alt="<?= $img['alt']; ?>"/></span>
        </div>
        <?php endforeach; ?>

      </div>
      <?php endif; ?>

    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>