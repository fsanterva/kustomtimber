<?php $layoutName = 'usps' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$usps = $data->usps_items;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--usps to_animate">
  
  <div class="usps__wrapper">
    
    <?php foreach( $usps as $item ) : 
      $usp_title    = $item['usp_title'];
      $usp_icon     = $item['usp_icon'];
      $usp_summary  = $item['usp_summary'];
    ?>

    <div class="item">
      
      <?php if( !empty($usp_icon) ) : ?>
      <div class="icon_wrap">
        <img data-src="<?= $usp_icon['url']; ?>"/>
      </div>
      <?php endif; ?>
      <h3 class="usp__title"><?= $usp_title; ?></h3>
      <p class="usp__summary">
        <?= $usp_summary; ?>
      </p>

    </div>

    <?php endforeach; ?>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>