<?php
function clean($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function component_layout(){
    $path = get_template_directory() . '/components/';
    $dir = new DirectoryIterator($path);
  
    $isChildTheme = is_child_theme();
    $childDir = ( $isChildTheme ) ? get_stylesheet_directory() . '/components/' : '';
    $childDirExists = ( !empty($childDir) && is_dir($childDir) ) ? true : false;

    // Check value exists.
    $sections = get_field('sections');
    $globalsections = get_field('sections', 'option');
    $excludedPages = get_field('excluded_pages', 'option');
    $firstSection = $sections[0]['acf_fc_layout'];

    $tmp_layout = '';
    $once = array();
    $el_cnt = 0;
    if( $sections ):
        // Loop through rows.
        
        foreach($sections as $sectionIndex => $section){
            $el_cnt++;
            foreach ($dir as $fileinfo) {
                if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                   
                   $row_layout = $section['acf_fc_layout'];

                   $sectionObject = (object) $section[ $section['acf_fc_layout'] ];
                   if($sectionObject){
                        
                        $componentIndex = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/index.php' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/index.php';
                        $componentStyle = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/style.css' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/style.css';
                        $componentScript = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/script.js' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/script.js';
                        if(file_exists($componentIndex)){
                            require $componentIndex;
                       }
                    }

                }
            }
    }
    endif;
  
  if( empty($excludedPages) || ( !empty($excludedPages) && !in_array(get_the_ID(), $excludedPages)) ) :
    if( $globalsections ):

        foreach($globalsections as $sectionIndex => $section){
            $el_cnt++;
            foreach ($dir as $fileinfo) {
                if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                   
                   $row_layout = $section['acf_fc_layout'];

                   $sectionObject = (object) $section[ $section['acf_fc_layout'] ];
                   if($sectionObject){
                        
                        $componentIndex = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/index.php' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/index.php';
                        $componentStyle = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/style.css' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/style.css';
                        $componentScript = ( $childDirExists && in_array( $row_layout, scandir($childDir) ) ) ? get_stylesheet_directory() . '/components/' . $fileinfo->getFilename() . '/script.js' : get_template_directory() . '/components/' . $fileinfo->getFilename() . '/script.js';
                        if(file_exists($componentIndex)){
                            require $componentIndex;
                       }
                    }

                }
            }
    }
    endif;
  endif;
}