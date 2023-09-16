<?php
//Remove Gutenberg Block Library CSS from loading on the frontend
function remove_wp_block_library_css() {
  wp_dequeue_style( 'dashicons' );
  wp_dequeue_style( 'wp-block-library' );
  wp_deregister_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-blocks-style' );
  wp_deregister_style('classic-theme-styles');
  wp_dequeue_style('classic-theme-styles');
}

function init_enqueue(){
  add_action( 'wp_enqueue_scripts', 'assets', 10 );
  add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
  add_action( 'admin_init', 'admin_files' );
}

function assets() {
  wp_enqueue_script( 'dilate-lazyload', get_template_directory_uri() . '/assets/js/lazyload.js', [], '', true );
  wp_enqueue_script( 'dilate-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '', true );
  wp_enqueue_script( 'dilate-panellum', get_template_directory_uri() . '/assets/js/panellum.js', [], '', true );
  wp_enqueue_script( 'dilate-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', true );
  wp_enqueue_script( 'dilate-vivus', get_template_directory_uri() . '/assets/js/vivus.min.js', [], '', true );

  $isChildAssetDir = is_dir( get_stylesheet_directory() . '/assets' );
  $dir = ( is_child_theme() && $isChildAssetDir ) ? get_stylesheet_directory_uri() . '/assets' : get_template_directory_uri() . '/assets';
  wp_register_script( 'dilate-fonts', $dir . '/js/fonts.js', [], '', true );
  wp_localize_script('dilate-fonts', 'script_vars', array(
    'path' => $dir
  ));
  wp_enqueue_script( 'dilate-fonts' );
  wp_enqueue_style( 'dilate-main', get_template_directory_uri() . '/assets/css/tempstyle.css', '', true );
}

function admin_files() {
  wp_register_style( 'dilate-admin-acf', get_template_directory_uri() .'/assets/css/admin_acf.css' );
  wp_enqueue_style( 'dilate-admin-acf' );
  wp_register_script( 'dilate-admin-script', get_template_directory_uri() .'/assets/js/admin_acf.js' );
  wp_enqueue_script( 'dilate-admin-script' );
}

init_enqueue();