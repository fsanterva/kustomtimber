<?php
//ADVANCE TAB
$animate = $sectionObject->animate;
$lazyload = $sectionObject->lazyload;
$zindex = $sectionObject->z_index;
$custom_id = $sectionObject->css_id;
$custom_class = $sectionObject->css_class;
$custom_css = $sectionObject->custom_css;
$fontcolor = $sectionObject->font_color;
$bggroup = $sectionObject->section_background_color;
$bgtype = $bggroup['background_type'];
$solidColor = $bggroup['solid_color'];
$gradientColor1 = $bggroup['gradient_color_1'];
$gradientColor2 = $bggroup['gradient_color_2'];
$angle = $bggroup['angle'];
$bgimage = $bggroup['background_image'];
$bgimagemobile = $bggroup['background_image_mobile'];
$bgimagecoloroverlay = $bggroup['background_image_color_overlay'];

$slantedEdges = $sectionObject->slanted_edges;
$slantedTop = $slantedEdges['enable_slanted_top'];
$slantedTopPos = $slantedEdges['slanted_top_position'];
$slantedTopColor = $slantedEdges['slanted_top_color'];
$slantedBottom = $slantedEdges['enable_slanted_bottom'];
$slantedBottomPos = $slantedEdges['slanted_bottom_position'];
$slantedBottomColor = $slantedEdges['slanted_bottom_color'];
?>

<?php
if( !isset( $once[$row_layout] ) ) : 
$once[$row_layout] = 0;
endif;
$once[$row_layout]++;
?>

<section id="<?= ( !empty($custom_id) ) ? $custom_id : 'comp_'.$layoutName.'_'.$once[$row_layout]; ?>" class="compSection compSection_<?=$el_cnt;?> comp_<?=$layoutName?> comp_<?=$layoutName.'_'.$once[$row_layout];?> <?= ( !empty($custom_class) ) ? $custom_class : '' ; ?> textcolor__<?= $fontcolor; ?> <?= ($slantedTop) ? 'is_slanted_top' : '' ?> <?= ($slantedBottom) ? 'is_slanted_bottom' : '' ?>" data-animate="<?= ( $animate ) ? 1 : 0 ; ?>" 
style="<?php if( $bgtype == 'solid' && !empty($solidColor) ) : ?>
background-color:<?= $solidColor; ?>;
<?php elseif( $bgtype == 'gradient' && !empty($gradientColor1) && !empty($gradientColor2) ) : ?>
background:linear-gradient(<?= $angle ?>deg, <?= $gradientColor1 ?>,<?= $gradientColor2 ?>);
<?php endif; ?>
 z-index:<?=$zindex?>">
  <?php if( $bgtype == 'image' ) : ?>
  <span class="section__bgimage">
    
    <?php
    $ext = strtolower(pathinfo($bgimage['url'], PATHINFO_EXTENSION));
    $ext2 = strtolower(pathinfo($bgimagemobile['url'], PATHINFO_EXTENSION));

    $isWebPMob = isImageExists( $bgimage['sizes']['small-b'].'.webp' );
    $mobImgFormat = ($isWebPMob) ? '.webp' : '';
    $mobSrcset = $bgimage['sizes']['small-b'] . $mobImgFormat;

    $isWebPCustomMob = isImageExists( $bgimagemobile['url'].'.webp' );
    $customMobImgFormat = ($isWebPCustomMob) ? '.webp' : '';
    $customMobSrcset = $bgimagemobile['url'] . $customMobImgFormat;

    $finalMobSrcset = ( !empty( $bgimagemobile ) ) ? $customMobSrcset : $mobSrcset;
    $finalMobType   = ( !empty( $bgimagemobile ) ) ? imageSourceTypeHandler($ext2, $isWebPCustomMob) : imageSourceTypeHandler($ext, $isWebPMob);
  
    $isWebPDesk = isImageExists( $bgimage['url'].'.webp' );
    $deskImgFormat = ($isWebPDesk) ? '.webp' : '';
    $deskSrcset = $bgimage['url'] . $deskImgFormat;
    
    if( $lazyload ) {
      
      $srcMob = '<source media="(max-width: 480px)" data-srcset="'. $finalMobSrcset .'" type="'. $finalMobType .'" />';
      $srcDesk = '<source media="(min-width: 481px)" data-srcset="'.$deskSrcset.'" type="'.imageSourceTypeHandler($ext, $isWebPDesk).'" />';
      $source = ( ($ext != 'svg') && ($ext != 'gif') ) ? $srcMob.$srcDesk : '';
      
      echo '<picture>'.
            $source.
            '<img data-src="'.$bgimage['url'].'" alt="'.$bgimage['alt'].'" width="'.$bgimage['sizes']['small-b-width'].'" height="'.$bgimage['sizes']['small-b-height'].'" />'.
            '</picture>';
      
    } else {
      
      $srcMob = '<source media="(max-width: 480px)" srcset="'. $finalMobSrcset .'" type="'. $finalMobType .'" />';
      $srcDesk = '<source media="(min-width: 481px)" srcset="'.$deskSrcset.'" type="'.imageSourceTypeHandler($ext, $isWebPDesk).'" />';
      $source = ( ($ext != 'svg') && ($ext != 'gif') ) ? $srcMob.$srcDesk : '';
      
      echo '<picture class="no-lazy">'.
            $source.
            '<img src="'.$bgimage['url'].'" alt="'.$bgimage['alt'].'" width="'.$bgimage['sizes']['small-b-width'].'" height="'.$bgimage['sizes']['small-b-height'].'" />'.
            '</picture>';
      
    }
    ?>
    
    <?php if( !empty($bgimagecoloroverlay) ) :?>
    <span class="overlay" style="background-color:<?= $bgimagecoloroverlay ?>;"></span>
    <?php endif; ?>
    
  </span>
  <?php endif; ?>

  <?php if( $slantedTop ) : ?>
    <?php
    $slantedTopColorVal = ( $slantedTopPos == 'left' ) ? $slantedTopColor.' transparent transparent transparent' : 'transparent '. $slantedTopColor .' transparent transparent';
    ?>
    <span class="slanted__edge slanted__edge--top slanted__edge--top<?=$slantedTopPos?>" style="border-color:<?= $slantedTopColorVal ?>;"></span>
  <?php endif; ?>
 