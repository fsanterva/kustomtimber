<?php
function clean($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function component_layout2(){
  $path = get_template_directory() . '/components/';
  $parentDir = scandir($path);

  $isChildTheme = is_child_theme();
  $childDir = ( $isChildTheme ) ? get_stylesheet_directory() . '/components/' : '';
  $childDirExists = ( !empty($childDir) && is_dir($childDir) ) ? true : false;

  $sections = get_field('sections');
  $globalsections = get_field('sections', 'option');
  $excludedPages = get_field('excluded_pages', 'option');
  $firstSection = $sections[0]['acf_fc_layout'];

  $tmp_layout = '';
  $once = array();
  $el_cnt = 0;

  if( $sections ):

    foreach($sections as $sectionIndex => $section) {
      $el_cnt++;
      $row_layout = $section['acf_fc_layout'];

      if( in_array( $row_layout, $parentDir ) ) {

        $sectionObject = (object) $section[ $section['acf_fc_layout'] ];
        if($sectionObject) {

          $componentIndex = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/index.php' : get_template_directory() . '/components/' . $row_layout . '/index.php';
          $componentStyle = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/style.css' : get_template_directory() . '/components/' . $row_layout . '/style.css';
          $componentScript = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/script.js' : get_template_directory() . '/components/' . $row_layout . '/script.js';
          if(file_exists($componentIndex)){
              require $componentIndex;
          }

        }

      }

    }

  endif;
  
  if( empty($excludedPages) || ( !empty($excludedPages) && !in_array(get_the_ID(), $excludedPages)) ) :
  
    if( $globalsections ):
  
      foreach($globalsections as $sectionIndex => $section) {
        
        $el_cnt++;
        $row_layout = $section['acf_fc_layout'];

        if( in_array( $row_layout, $parentDir ) ) {

          $sectionObject = (object) $section[ $section['acf_fc_layout'] ];
          if($sectionObject) {

            $componentIndex = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/index.php' : get_template_directory() . '/components/' . $row_layout . '/index.php';
            $componentStyle = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/style.css' : get_template_directory() . '/components/' . $row_layout . '/style.css';
            $componentScript = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $row_layout . '/script.js' : get_template_directory() . '/components/' . $row_layout . '/script.js';
            if(file_exists($componentIndex)){
                require $componentIndex;
            }

          }

        }
        
      }
  
    endif;
  
  endif;
  
}