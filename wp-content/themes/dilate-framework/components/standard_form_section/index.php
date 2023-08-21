<?php $layoutName = 'standard_form_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php
$data = $sectionObject;
$dataFlds = $data->data_fields;
$headlineText = $dataFlds['main_headline_text'];
$headlineSEO = $dataFlds['seo_tag'];
$textSummary = $dataFlds['text_summary'];
$form_shortcode = $dataFlds['form_shortcode'];

$lazyload = $data->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--heading">
  
  <div class="content__wrap">
    
    <?php headlineText($headlineText, $headlineSEO); ?>
    
    <?php if( !empty($textSummary) ) : ?>

      <div class="text__summary">
        <?= $textSummary; ?>
      </div>

    <?php endif; ?>

  </div>
  
</div>

<div class="row row--form">
  
  <div class="product__selection_wrap">
    <?php
    $ranges = get_terms([
      'taxonomy' => 'range',
      'hide_empty' => false,
      'exclude' => array( 50 ),
    ]);
    ?>

    <?php foreach( $ranges as $idx=>$range ) : ?>

      <div class="range__item">

        <label class="range__name"><?= $range->name; ?></label>

        <?php
        $args = array(
          'post_type'       => 'timber-product',
          'posts_per_page'  => -1,
          'order_by'        => 'date',
          'order'           =>  'ASC',
          'post_status '    => array('publish'),
          'tax_query'       => array(
            array(
              'taxonomy' => 'range',
              'field' => 'slug',
              'terms' => $range->slug
            )
          )
        );
        $result = new WP_Query( $args );
        $new_search = $result->posts;
        ?>

        <div class="product__list">

          <?php foreach( $new_search as $obj ) :
            $title = get_the_title($obj);
            $img = get_field('product_image', $obj);
            $ref = strtolower( str_replace(" ", "_", $title) );
          ?>
          
          <div class="product__item">

            <label for="<?= $ref; ?>">
              
              <input id="<?= $ref; ?>" type="checkbox" name="productselection" value="<?= $title ?>"/>
              
              <div class="data">
                <span class="img__wrap">
                  <?php acf_responsive_image3($img, true); ?>
                </span>
                <label class="product__name"><?= $title; ?></label>
              </div>

            </label>

          </div>
          
          <?php endforeach; ?>

        </div>

      </div>

    <?php endforeach; ?>


    <?php
    $corkranges = get_terms([
      'taxonomy' => 'cork-range',
      'hide_empty' => false,
    ]);
    ?>

    <?php foreach( $corkranges as $idx=>$range ) : ?>

      <div class="range__item">

        <label class="range__name"><?= $range->name; ?></label>

        <?php
        $args = array(
          'post_type'       => 'cork-product',
          'posts_per_page'  => -1,
          'order_by'        => 'date',
          'order'           =>  'ASC',
          'post_status '    => array('publish'),
          'tax_query'       => array(
            array(
              'taxonomy' => 'cork-range',
              'field' => 'slug',
              'terms' => $range->slug
            )
          )
        );
        $result = new WP_Query( $args );
        $new_search = $result->posts;
        ?>

        <div class="product__list">

          <?php foreach( $new_search as $obj ) :
            $title = get_the_title($obj);
            $img = get_field('product_image', $obj);
            $ref = strtolower( str_replace(" ", "_", $title) );
          ?>
          
          <div class="product__item">

            <label for="<?= $ref; ?>">
              
              <input id="<?= $ref; ?>" type="checkbox" name="productselection" value="<?= $title ?>"/>
              
              <div class="data">
                <span class="img__wrap">
                  <?php acf_responsive_image3($img, true); ?>
                </span>
                <label class="product__name"><?= $title; ?></label>
              </div>

            </label>

          </div>
          
          <?php endforeach; ?>

        </div>

      </div>

    <?php endforeach; ?>
    
  </div>
  <?php if( !empty($form_shortcode) ) : ?>
    <?= do_shortcode( $form_shortcode ); ?>
  <?php endif; ?>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>