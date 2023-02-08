<?php $layoutName = 'blog_parent' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php r_inspect($sectionObject); 

$headline__text = $sectionObject->headline_text;
$description__text = $sectionObject->description_text;

?>

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

          <div class="head">
              <span class="heading__title">
                <?= $headline__text; ?>
              </span>
              <span class="heading__description">
                <?= $description__text; ?>
              </span>
          </div>

          <div class="tail">
            <div class="filter__field--search">
                <input id="blogFilterSearchField" type="text" placeholder="Enter keywords here..."/>
                <button class="searchBtn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22.247" height="22.211" viewBox="0 0 22.247 22.211"><path id="Path_189" data-name="Path 189" d="M16.865,14.836a9.374,9.374,0,1,0-2.029,2.029l5.382,5.346,2.029-2.029ZM9.337,15.8A6.464,6.464,0,1,1,15.8,9.337,6.471,6.471,0,0,1,9.337,15.8" fill="#183a64"/></svg>
                </button>
            </div>
            <div class="filter__field--optionSelect">Option Select</div>
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
