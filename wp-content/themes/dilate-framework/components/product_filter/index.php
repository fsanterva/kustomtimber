<?php $layoutName = 'product_filter' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$button = $dataFlds['site_button'];

$urlRange = ( isset($_GET['range']) ) ? $_GET['range'] : '';
$urlColour = ( isset($_GET['colour']) ) ? $_GET['colour'] : '';
$urlGrade = ( isset($_GET['grade']) ) ? $_GET['grade'] : '';

$ranges = get_terms([
    'taxonomy' => 'range',
    'hide_empty' => false,
]);
$colours = get_terms([
    'taxonomy' => 'colour',
    'hide_empty' => false,
]);
$grades = get_terms([
    'taxonomy' => 'grade',
    'hide_empty' => false,
]);
$metaData = acf_get_fields('group_63cfe2afbd1f3');

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<span class="ajaxloader"></span>
<div class="row row--filter__wrapper product__filter_wrap">
  
  <div class="secondary__filter_wrap">
    
    <div class="secondary__filter">
    
      <div class="filter__box filter__box--search">
        <label class="label">SEARCH</label>
        <input id="searchProductName" type="text" placeholder="Enter keywords here..."/>
      </div>

      <div class="filter__box filter__box--colour">

        <div class="data__result">
          <label class="label">COLOURS</label>
          <span>-select-</span>
        </div>

        <div class="data__options">
          <?php foreach( $colours as  $color ) :
          $colourID = $color->term_id;
          $colourSlug = $color->slug;
          $colourName = $color->name;
          $colourImg = get_field('image', 'colour_'.$colourID);
          ?>
          <label for="colour_<?= $colourID; ?>">
            <input id="colour_<?= $colourID; ?>" type="radio" name="colourOption" data-id="<?= $colourID; ?>" data-name="<?= $colourName; ?>" value="<?= $colourSlug; ?>" <?= (!empty($urlColour) && $urlColour == $colourSlug) ? 'checked' : '' ?>/>
            <span class="img__wrap">
              <img data-src="<?= $colourImg; ?>" alt="Kustom Timber Colours"/>
            </span>
          </label>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="filter__box filter__box--grade">

        <div class="data__result">
          <label class="label">GRADE</label>
          <span>-select-</span>
        </div>

        <div class="data__options">
          <?php foreach( $grades as  $grade ) :
          $gradeID = $grade->term_id;
          $gradeSlug = $grade->slug;
          $gradeName = $grade->name;
          $gradeImg = get_field('image', 'colour_'.$gradeID);
          ?>
          <label for="colour_<?= $gradeID; ?>">
            <input id="colour_<?= $gradeID; ?>" type="radio" name="gradeOption" data-id="<?= $gradeID; ?>" data-name="<?= $gradeName; ?>" value="<?= $gradeSlug; ?>" <?= (!empty($urlGrade) && $urlGrade == $gradeSlug) ? 'checked' : '' ?>/>
            <span class="img__wrap">
              <img data-src="<?= $gradeImg; ?>" alt="Kustom Timber Grade"/>
            </span>
          </label>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="filter__box filter__box--width filter__box--select">

        <div class="data__result">
          <label class="label">WIDTH</label>
          <select id="widthSelectFld">

            <?php foreach( $metaData as $s ) : ?>

              <?php if( $s['name'] == 'width' ) : ?>

                <option value="">-select-</option>

                <?php foreach( $s['choices'] as $idx=>$v ) : ?>

                <option value="<?= $idx; ?>"><?= $v; ?></option>

                <?php endforeach; ?>

              <?php endif; ?>

            <?php endforeach; ?>

          </select>
        </div>

        <div class="img__wrap">
          <img data-src="/wp-content/uploads/2023/01/filter-width-icon.svg" alt="Kustom Timber Width"/>
        </div>

      </div>

      <div class="filter__box filter__box--length filter__box--select">

        <div class="data__result">
          <label class="label">LENGTH</label>
          <select id="lengthSelectFld">

            <?php foreach( $metaData as $s ) : ?>

              <?php if( $s['name'] == 'length' ) : ?>

                <option value="">-select-</option>

                <?php foreach( $s['choices'] as $idx=>$v ) : ?>

                <option value="<?= $idx; ?>"><?= $v; ?></option>

                <?php endforeach; ?>

              <?php endif; ?>

            <?php endforeach; ?>

          </select>
        </div>

        <div class="img__wrap">
          <img data-src="/wp-content/uploads/2023/01/filter-length-icon.svg" alt="Kustom Timber Length"/>
        </div>

      </div>

      <div class="filter__box filter__box--thickness filter__box--select">

        <div class="data__result">
          <label class="label">THICKNESS</label>
          <select id="thicknessSelectFld">

            <?php foreach( $metaData as $s ) : ?>

              <?php if( $s['name'] == 'thickness' ) : ?>

                <option value="">-select-</option>

                <?php foreach( $s['choices'] as $idx=>$v ) : ?>

                <option value="<?= $idx; ?>"><?= $v; ?></option>

                <?php endforeach; ?>

              <?php endif; ?>

            <?php endforeach; ?>

          </select>
        </div>

        <div class="img__wrap">
          <img data-src="/wp-content/uploads/2023/01/filter-thickness-icon.svg" alt="Kustom Timber Thickness"/>
        </div>

      </div>

    </div>
    
  </div>
  
  <div class="primary__filter">
    
    <?php if( !empty( $ranges ) ) : ?>
    <div class="nav__wrap">
      
      <button class="mobile__toggle">All Products</button>
      
      <ul class="range__nav">
        <li class="<?= (!empty($urlRange)) ? '' : 'active' ?>"><a data-slug="" data-id="">All Products</a></li>
        <?php foreach( $ranges as $range ) : ?>
        <li class="<?= (!empty($urlRange) && $urlRange == $range->slug) ? 'active' : '' ?>"><a data-slug="<?= $range->slug; ?>" data-id="<?= $range->term_id; ?>"><?= $range->name; ?></a></li>
        <?php endforeach; ?>
      </ul>
      
    </div>
    <?php endif; ?>
    
    <div class="buttons__wrap">
      
      <button class="reset__filters">
        <span class="text">Reset Filters</span>
      </button>
      
      <button class="hide__filters">
        <span class="icon">
          <img data-src="/wp-content/uploads/2023/01/hide-filter-icon.svg"/>
        </span>
        <span class="text">Hide Filters</span>
      </button>
      
      <?php button($button); ?>
      
    </div>
    
  </div>
  
</div>
<div class="row row--productlist">
  
  <label class="headline__text h2">All Products</label>

  <div id="productListContainer">
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>