<?php $layoutName = 'ENTER ACF COMPONENT/BLOCK NAME HERE' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$lazyload = $data->lazyload;


require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row">
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>