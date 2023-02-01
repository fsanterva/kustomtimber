<?php $layoutName = 'project_child_hero_section' ?>
<?php if( $row_layout == $layoutName ): ?>
<?php

$projID = get_the_ID();
$projTitle = get_the_title($projID);
$projFeatImgData = getFeaturedImage($projID);
$projBuilderName = get_field( 'builder_name', $projID );
$projBuilderLink = get_field( 'builder_link', $projID );
$projDesignerName = get_field( 'designer_name', $projID );
$projDesignerLink = get_field( 'designer_link', $projID );
$projFinishID = get_field( 'finish', $projID );
$productName = get_the_title( $projFinishID );
$productImg = get_field( 'product_image', $projFinishID );
$projPattern = get_field( 'pattern', $projID );
$description = get_field( 'description', $projID );
$collectionID = yoast_get_primary_term_id( 'range', $projID );
$collectionTerm = get_term_by('id', $collectionID, 'range');

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <h1 class="headline__text"><?= $projTitle; ?></h1>
  <?php if( !empty($projFeatImgData) ) : ?>
  <span class="featured__image">
    <img data-src="<?= $projFeatImgData['url']; ?>" alt="<?= $projFeatImgData['alt']; ?>" />
  </span>
  <?php endif; ?>
  
</div>

<div class="row row--data">
  
  <div class="left">
    
    <label class="headline__text h2"><?= $projTitle ?></label>
    
    <?php if( !empty( $projBuilderName ) ) : ?>
    <div class="data__block">
      
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
    <div class="data__block">
      
      <label>designer</label>
      <h4>
        <?php if( !empty( $projDesignerLink ) ) : ?>
        <a class="data" href="<?= $projDesignerLink ?>"><?= $projDesignerName; ?></a>
        <?php else : ?>
        <span class="data"><?= $projDesignerName; ?></span>
        <?php endif; ?>
      </h4>
      
    </div>
    <?php endif; ?>
    
  </div>
  
  <div class="right">
    
    <div class="product__image">
      
      <?php if( !empty( $productImg ) ) : ?>
      
      <span class="img__wrap">
        <img data-src="<?= $productImg['url']; ?>"/>
      </span>
      
      <?php endif; ?>
      
    </div>
    
    <div class="right__blocks">
      
      <div class="data__block data__block--collection">
      
        <label>collection</label>
        <h4>
          <span class="data"><?= $collectionTerm->name; ?></span>
        </h4>

      </div>
      
      <div class="data__block data__block--finish">
      
        <label>finish</label>
        <h4>
          <span class="data"><?= $productName; ?></span>
        </h4>

      </div>
      
      <div class="data__block data__block--plank">
      
        <label>plank</label>
        <h4>
          <span class="data"><?= $projPattern['label']; ?></span>
        </h4>

      </div>
      
      <div class="data__block data__block--description">
      
        <label>about the project</label>
        <h4>
          <span class="data"><?= $description; ?></span>
        </h4>

      </div>
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>