<?php
/* ADD MENU TO ANY PAGE OR TEMPLATES VIA SHORTCODE */
add_shortcode('menu', 'print_menu_shortcode');
function print_menu_shortcode($atts, $content = null) {
  extract(shortcode_atts(array( 'name' => null, 'class' => 'nav__menu' ), $atts));
  return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
}