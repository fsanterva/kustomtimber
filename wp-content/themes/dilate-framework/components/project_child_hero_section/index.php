<?php $layoutName = 'project_child_hero_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$projID = get_the_ID();
$projTitle = get_the_title($projID);
$projBuilderName = get_field( 'builder_name', $projID );
$projBuilderLink = get_field( 'builder_link', $projID );
$projDesignerName = get_field( 'designer_name', $projID );
$projDesignerLink = get_field( 'designer_link', $projID );
$projArchitectName = get_field( 'architect_name', $projID );
$projArchitectLink = get_field( 'architect_link', $projID );
$projFinishID = get_field( 'finish', $projID );
$productPostType = get_post_type( $projFinishID );
$productRange = '';
$productName = get_the_title( $projFinishID );
$productImg = get_field( 'product_image', $projFinishID );
$productPerm = get_the_permalink($projFinishID);
$projPattern = get_field( 'pattern', $projID );
// $collectionID = yoast_get_primary_term_id( 'range', $projID );
// $collectionID = get_post_meta( $projFinishID, 'rank_math_primary_range', true );
// $collectionTerm = get_term_by('id', $collectionID, 'range');
// $collectionTerm = wp_get_post_terms( $projFinishID, 'range');

if( $productPostType == 'timber-product' ) {
  
  $productRange = get_the_terms( $projFinishID, 'range' );

}elseif ( $productPostType == 'cork-product' ) {
  
  $productRange = get_the_terms( $projFinishID, 'cork-range' );

}


$description = get_field( 'description', $projID );
$descCount = strlen($description);
$charLimit = 676;

$lazyload = $sectionObject->lazyload;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <h1 class="headline__text h1"><?= $projTitle; ?></h1>
  <span class="featured__image to_parallax_bg">
    <?php getFeaturedImage($projID, $lazyload); ?>
  </span>
  
</div>

<div class="row row--data">
  
  <div class="left">
    
    <label class="headline__text h2"><?= $projTitle ?></label>
    
    <?php if( !empty( $projBuilderName ) ) : ?>
    <div class="data__block">
      
      <label>builder</label>
      <h4>
        <?php if( !empty( $projBuilderLink ) ) : ?>
        <a class="data" href="<?= $projBuilderLink ?>" target="_blank"><?= $projBuilderName; ?></a>
        <?php else : ?>
        <span class="data"><?= $projBuilderName; ?></span>
        <?php endif; ?>
      </h4>
      
    </div>
    <?php endif; ?>
    
    <?php if( !empty( $projDesignerName ) ) : ?>
    <div class="data__block">
      
      <label>interior designer</label>
      <h4>
        <?php if( !empty( $projDesignerLink ) ) : ?>
        <a class="data" href="<?= $projDesignerLink ?>" target="_blank"><?= $projDesignerName; ?></a>
        <?php else : ?>
        <span class="data"><?= $projDesignerName; ?></span>
        <?php endif; ?>
      </h4>
      
    </div>
    <?php endif; ?>

    <?php if( !empty( $projArchitectName ) ) : ?>
    <div class="data__block">
      
      <label>Architect</label>
      <h4>
        <?php if( !empty( $projArchitectLink ) ) : ?>
        <a class="data" href="<?= $projArchitectLink ?>" target="_blank"><?= $projArchitectName; ?></a>
        <?php else : ?>
        <span class="data"><?= $projArchitectName; ?></span>
        <?php endif; ?>
      </h4>
      
    </div>
    <?php endif; ?>


    
  </div>
  
  <div class="right">
    
    <div class="product__image">
      
      <?php if( !empty( $productImg ) ) : ?>
      
      <span class="img__wrap">
        <?php acf_responsive_image3($productImg, $lazyload); ?>
      </span>
      
      <?php endif; ?>
      
      <?php
      button(
        array(
          'button_style'=>'outlinedark',
          'button_arrow'=>1,
          'button_link'=>array(
            'title'=>'ENQUIRE THIS PRODUCT',
            'url'=>$productPerm.'#comp_product_child_enquire_form_1',
            'target'=>''
          ),
          'popup_id'=>'',
          'button_text'=>'',
          'button_custom_class'=>'',
          'button_function'=>'normal'
        )
      );
      ?>
      
    </div>
    
    <div class="right__blocks">
      
      <?php if( !empty( $projBuilderName ) ) : ?>
      <div class="data__block data__block--builder mobile__only">

        <label>builder</label>
        <h4>
          <?php if( !empty( $projBuilderLink ) ) : ?>
          <a class="data" href="<?= $projBuilderLink ?>"><?= $projBuilderName; ?></a>
          <?php else : ?>
          <span class="data"><?= $projBuilderName; ?></span>
          <?php endif; ?>
        </h4>

      </div>
      <?php endif; ?>

      <?php if( !empty( $projDesignerName ) ) : ?>
      <div class="data__block data__block--designer mobile__only">

        <label>interior designer</label>
        <h4>
          <?php if( !empty( $projDesignerLink ) ) : ?>
          <a class="data" href="<?= $projDesignerLink ?>"><?= $projDesignerName; ?></a>
          <?php else : ?>
          <span class="data"><?= $projDesignerName; ?></span>
          <?php endif; ?>
        </h4>

      </div>
      <?php endif; ?>

      <?php if( !empty( $projArchitectName ) ) : ?>
      <div class="data__block data__block--designer mobile__only">
        
        <label>Architect</label>
        <h4>
          <?php if( !empty( $projArchitectLink ) ) : ?>
          <a class="data" href="<?= $projArchitectLink ?>" target="_blank"><?= $projArchitectName; ?></a>
          <?php else : ?>
          <span class="data"><?= $projArchitectName; ?></span>
          <?php endif; ?>
        </h4>
        
      </div>
      <?php endif; ?>
      
      <div class="data__block data__block--collection">
      
        <label>collection</label>
        <h4>
          <span class="data"><?= ($projFinishID) ? $productRange[0]->name : '--'; ?></span>
        </h4>

      </div>
      
      <div class="data__block data__block--finish">
      
        <label>finish</label>
        <h4>
          <span class="data"><?= ($projFinishID) ? $productName : '--'; ?></span>
        </h4>

      </div>
      
      <div class="data__block data__block--plank">
      
        <label>pattern</label>
        <h4>
          <span class="data"><?= ($projPattern) ? $projPattern['label'] : '--'; ?></span>
        </h4>

      </div>
      
      <?php if ( ! empty($description) ) : ?>
      <div class="data__block data__block--description">
      
        <label>about the project</label>
        <p>
          <?php if( $descCount > $charLimit ) : 
            $part1 = substr($description, 0, $charLimit+1);
            $part2 = substr($description, $charLimit, $descCount);
          ?>
          
            <?= $part1; ?>
            <span class="part2"><?= $part2; ?></span>
            <button class="readmore">Read more</button>
          
          <?php else : ?>
          
            <?= $description; ?>
          
          <?php endif; ?>
        </p>

      </div>
      <?php endif; ?>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>