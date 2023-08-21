<?php

function critical_component_layout2(){
    $path2 = get_template_directory() . '/components/';
    $parentDir2 = scandir($path2);
  
    $isChildTheme2 = is_child_theme();
    $childDir2 = ( $isChildTheme2 ) ? get_stylesheet_directory() . '/components/' : '';
    $childDir2Exists = ( !empty($childDir2) && is_dir($childDir2) ) ? true : false;

    $sections2 = get_field('sections'); 
    $firstSectionName = $sections2[0]['acf_fc_layout'];
    if( $sections2 ):
  
      if( in_array( $firstSectionName, $parentDir2 ) ) {
        
        $componentStyle2 = ( $childDir2Exists && in_array( $firstSectionName, scandir($childDir2) ) ) ? get_stylesheet_directory() . '/components/' . $firstSectionName . '/style.css' : get_template_directory() . '/components/' . $firstSectionName . '/style.css';
        $componentScript2 = ( $childDir2Exists && in_array( $firstSectionName, scandir($childDir2) ) ) ? get_stylesheet_directory() . '/components/' . $firstSectionName . '/script.js' : get_template_directory() . '/components/' . $firstSectionName . '/script.js';

        if(file_exists($componentStyle2)) {
        ?><style><?php require $componentStyle2; ?></style><?php
        }
        if(file_exists($componentScript2)) {
        ?><script type="module"><?php require $componentScript2; ?></script><?php
        }
        
      }
    endif;
  }

?>