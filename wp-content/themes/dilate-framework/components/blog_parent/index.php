<?php $layoutName = 'blog_parent' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php r_inspect($sectionObject); ?>

<?php
if( !isset( $once[$row_layout] ) ) : 
$once[$row_layout] = 0;
endif;
$once[$row_layout]++;
?>

  <section id="<?= ( !empty($custom_id) ) ? $custom_id : 'comp_'.$layoutName.'_'.$once[$row_layout]; ?>" class="compSection compSection_<?=$el_cnt;?> comp_<?=$layoutName;?> <?= ( !empty($custom_class) ) ? $custom_class : '' ; ?>" data-animate="<?= ( $animate ) ? 1 : 0 ; ?>">
    <div class="row">
      <div class="module">
        <div class="filter__block">
          <div class="left">
          </div>
        </div>
        <div class="blog__list_container">
          <span class="ajaxloader"></span>
        </div>
      </div>
    </div>
  </section>
  
  <?php if($once[$row_layout] == 1) : ?>
    <?php if( $layoutName != $firstSection ) : ?>

      <?php if(file_exists($componentStyle)) : ?>
          <style><?php require $componentStyle; ?></style>
      <?php endif; ?>

      <!-- IF COMPONENT HAS CUSTOM CSS SET WITHIN ACF -->
      <?php if( !empty( $custom_css ) ) : ?>
          <style><?php require $custom_css; ?></style>
      <?php endif; ?>

      <?php if(file_exists($componentScript)) : ?>
          <script><?php require $componentScript; ?></script>
      <?php endif; ?>

    <?php endif; ?>

  <?php endif; ?>
<?php endif; ?>
