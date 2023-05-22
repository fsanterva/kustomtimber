<?php

function critical_component_layout(){
    $path2 = get_template_directory() . '/components/';
    $dir2 = new DirectoryIterator($path2);
  
    $isChildTheme2 = is_child_theme();
    $childDir2 = ( $isChildTheme2 ) ? get_stylesheet_directory() . '/components/' : '';
    $childDir2Exists = ( !empty($childDir2) && is_dir($childDir2) ) ? true : false;

    // Check value exists.
    $sections2 = get_field('sections'); 
    $firstSectionName = $sections2[0]['acf_fc_layout'];
    if( $sections2 ):
      foreach ($dir2 as $fileinfo2) {
        if ($fileinfo2->isDir() && !$fileinfo2->isDot()) {
          if( $fileinfo2->getFilename() == $firstSectionName ) {
            $componentStyle2 = get_template_directory() . '/components/' . $fileinfo2->getFilename() . '/style.css';
            $componentScript2 = get_template_directory() . '/components/' . $fileinfo2->getFilename() . '/script.js';
            
            $componentStyle2 = ( $childDir2Exists && in_array( $firstSectionName, scandir($childDir2) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo2->getFilename() . '/style.css' : get_template_directory() . '/components/' . $fileinfo2->getFilename() . '/style.css';
            $componentScript2 = ( $childDir2Exists && in_array( $firstSectionName, scandir($childDir2) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo2->getFilename() . '/script.js' : get_template_directory() . '/components/' . $fileinfo2->getFilename() . '/script.js';
            
            if(file_exists($componentStyle2)) {
            ?><style><?php require $componentStyle2; ?></style><?php
            }
            if(file_exists($componentScript2)) {
            ?><script><?php require $componentScript2; ?></script><?php
            }
          }
        }
      }
    endif;
  }

?>