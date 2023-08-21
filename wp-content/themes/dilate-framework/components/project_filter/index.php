<?php $layoutName = 'project_filter' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;

$urlCollection = ( isset($_GET['collection']) ) ? $_GET['collection'] : '';
$urlFinish = ( isset($_GET['finish']) ) ? $_GET['finish'] : '';
$urlPattern = ( isset($_GET['pattern']) ) ? $_GET['pattern'] : '';

$ranges = get_terms([
    'taxonomy' => 'range',
    'hide_empty' => false,
]);
$finish = new WP_Query( array(
  'post_type'       => 'timber-product',
  'posts_per_page'  => -1,
  'order_by'        => 'date',
  'order'           =>  'ASC',
  'post_status '    => array('publish')
) );

$metaData = acf_get_fields('group_63d9de0009059');

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<span class="ajaxloader"></span>
<div class="row row--project__filter">
  
  <div class="project__filter_wrap">
    
    <div class="filter__box filter__box--search">
      <label class="label">Search Project</label>
      <input id="searchProjectFld" type="text" placeholder="Enter keywords here..."/>
      <button id="searchProjectBtn">
        <img src="/wp-content/uploads/2023/02/searchIcon.svg" alt="Search Project Button"/>
      </button>
    </div>

    <!-- COLLECTION -->
    <div class="filter__box filter__box--collection filter__box--select">

      <label class="label">Collection</label>

      <?php if( !empty( $ranges ) ) : ?>
      <select id="collectionSelectFld">

        <option value="">Select Collection</option>
        <?php foreach( $ranges as $range ) : ?>
        <option value="<?= $range->slug; ?>" <?= (!empty($urlCollection) && $urlCollection == $range->slug) ? 'selected' : ''; ?> ><?= $range->name; ?></option>
        <?php endforeach; ?>

      </select>
      <?php endif; ?>

    </div>

    <!-- FINISH -->
    <div class="filter__box filter__box--finish filter__box--select">

      <label class="label">Finish</label>

      <?php if( !empty( $finish->posts ) ) : ?>
      <select id="finishSelectFld">

        <option value="">Select Finish</option>
        <?php foreach( $finish->posts as $obj ) : ?>
        <option value="<?= $obj->ID; ?>" <?= (!empty($urlFinish) && $urlFinish == $obj->ID) ? 'selected' : ''; ?> ><?= get_the_title($obj); ?></option>
        <?php endforeach; ?>

      </select>
      <?php endif; ?>

    </div>

    <!-- PATTERN -->
    <div class="filter__box filter__box--pattern filter__box--select">

      <label class="label">Pattern</label>

      <select id="patternSelectFld">

        <?php foreach( $metaData as $s ) : ?>

          <?php if( $s['name'] == 'pattern' ) : ?>

            <option value="">Select Pattern</option>

            <?php foreach( $s['choices'] as $idx=>$v ) : ?>

            <option value="<?= $idx; ?>" <?= (!empty($urlPattern) && $urlPattern == $idx) ? 'selected' : ''; ?> ><?= $v; ?></option>

            <?php endforeach; ?>

          <?php endif; ?>

        <?php endforeach; ?>

      </select>

    </div>
    
  </div>
  
</div>
<div class="row row--projectlist">

  <div id="projectListContainer">
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>