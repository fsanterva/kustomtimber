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
$collectionID = yoast_get_primary_term_id( 'range', $projID );
$collectionTerm = get_term_by('id', $collectionID, 'range');

$description = get_field( 'description', $projID );
$descCount = strlen($description);
$charLimit = 676;

require get_template_directory() . '/inc/component-wrapper-top.php';
?>

<div class="row row--full">
  
  <h1 class="headline__text h1"><?= $projTitle; ?></h1>
  <?php if( !empty($projFeatImgData) ) : ?>
  <span class="featured__image to_parallax_bg">
    <img src="<?= $projFeatImgData['url']; ?>" alt="<?= $projFeatImgData['alt']; ?>" />
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
        <img data-src="<?= $productImg['url']; ?>" alt="<?= $productImg['alt']; ?>"/>
      </span>
      
      <?php endif; ?>
      
      <?php
      button(
        array(
          'button_style'=>'outlinedark',
          'button_arrow'=>1,
          'button_link'=>array(
            'title'=>'ENQUIRE THIS PRODUCT',
            'url'=>'#',
            'target'=>''
          ),
          'button_custom_class'=>'',
          'button_function'=>''
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
      
    </div>
    
  </div>
  
</div>
  
<?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>

<?php endif; ?>