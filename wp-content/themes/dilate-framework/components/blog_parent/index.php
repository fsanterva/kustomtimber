<?php $layoutName = 'blog_parent' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$fields = $data->fields;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading to_animate">
  
  <div class="left">
    <?php standardContentBlock($fields); ?>
  </div>
  <div class="right">
    <div class="searchFieldWrap">
      <input type="text" class="searchField" placeholder="Search Blog..."/>
      <button class="searchButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="30.621" height="30.621" viewBox="0 0 30.621 30.621">
          <g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(-3 -3)">
            <path d="M28.5,16.5a12,12,0,1,1-12-12A12,12,0,0,1,28.5,16.5Z" fill="none" stroke="#ad926f" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
            <path d="M31.5,31.5l-6.525-6.525" fill="none" stroke="#ad926f" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
          </g>
        </svg>
      </button>
    </div>
  </div>
  
</div>

<div class="row row--articles to_animate">
  
  <div class="left">
    
    <div class="filter__block to_animate">
      <label>Topics</label>
      <div class="filter__wrap">
        <button class="mobileFilterToggleBtn">
          <span class="text">All Articles</span>
          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" viewBox="0 0 8 5"><path d="M425.5,65.6l4,3.9,4-3.9-1.119-1.1L429.5,67.306,426.619,64.5Z" transform="translate(-425.5 -64.499)"/></svg></span>
        </button>
        <ul>
          <li class="active"><a data-val="">All</a></li>
          <?php
          $cat_terms = get_terms(
            array('category'),
            array(
              'hide_empty'    => true,
            )
          );
          ?>
          <?php foreach( $cat_terms as $cat ) : ?>
          <li><a data-val="<?= $cat->slug ?>"><?= $cat->name ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    
  </div>
  
  <div class="right">
    
    <div id="blog_main__results">
      <span class="ajaxloader"></span>
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>