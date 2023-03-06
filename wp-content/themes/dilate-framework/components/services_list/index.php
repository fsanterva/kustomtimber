<?php $layoutName = 'services_list' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$button = $dataFlds['site_button'];

$services = $data->services;

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to__animate">
  
  <?php headlineText($headlineText, $headlineSEO); ?>
  
  <?php if( !empty($textSummary) ) : ?>

    <div class="text__summary"><?= $textSummary ?></div>

  <?php endif; ?>

  <?php if( !empty($button['button_link']) ) : ?>
  <?php button($button); ?>
  <?php endif; ?>
  
</div>

<?php if( !empty( $services ) ) : ?>
<div class="row row--services">
  
  <?php foreach( $services as $idx=>$item ) : ?>
  <div class="service">
    
    <div class="img__wrap">
      <?php if( !empty($item['service_link_site_button']['button_link']) ) : ?>
      <a href="<?= $item['service_link_site_button']['button_link']['url'] ?>" class="link-to-post" aria-label="Kustom Timber <?= $item['service_name']; ?>"></a>
      <?php endif; ?>
      <img <?php acf_responsive_image($item['image']['id'], '', '800px', $lazyload); ?> alt="<?= $item['image']['alt']; ?>" />
    </div>
    
    <div class="data__wrap">
      <label><?= $item['service_name']; ?></label>
      <div class="summary__block">
        <p>
          <?= $item['service_summary'] ?>
        </p>
        <?php button($item['service_link_site_button']); ?>
      </div>
    </div>
    
  </div>
  <?php endforeach; ?>
  
</div>
<?php endif; ?>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>