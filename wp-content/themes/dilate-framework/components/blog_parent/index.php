<?php $layoutName = 'blog_parent' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php 
  $headline__text = $sectionObject->headline_text;
  $description__text = $sectionObject->description_text;
  $categories = get_categories( array('orderby' => 'name','order'   => 'ASC') );   
  $ranges = get_categories( array('taxonomy'=>'range','orderby' => 'name','order'   => 'ASC') );   
?>


<?php require get_template_directory() . '/inc/component-wrapper-top.php'; ?>

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
            <label>Search Project</label>
            <div class="seartch-container">
              <input id="blogFilterSearchField" type="text" placeholder="Enter keywords here..."/>
              <button class="searchBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.247" height="22.211" viewBox="0 0 22.247 22.211"><path id="Path_189" data-name="Path 189" d="M16.865,14.836a9.374,9.374,0,1,0-2.029,2.029l5.382,5.346,2.029-2.029ZM9.337,15.8A6.464,6.464,0,1,1,15.8,9.337,6.471,6.471,0,0,1,9.337,15.8" fill="#183a64"/></svg>
              </button>
            </div>
        </div>
        <div class="filter__field--optionSelect filter-cat">
            <label>Filter By Category</label>
            <div class="select">
              <select id="blogFilterCategoryField" name="cat">
                  <option value="">Show All</option>
                  <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="filter__field--optionSelect filter-product">
            <label>Filter By Product</label>
            <div class="select">
              <select id="blogFilterCategoryFieldRange" name="range">
                  <option value="">Show All</option>
                  <?php foreach($ranges as $range): ?>
                    <option value="<?php echo $range->slug; ?>"><?php echo $range->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
      </div>

    </div>
    <div class="blog__list_container">
      <span class="ajaxloader"></span>
    </div>

    <button data-page="2" id="loadmore">Load More</button>
  </div>      
</div>

<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>
