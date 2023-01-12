<?php ob_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <script><?php require get_template_directory() . '/assets/js/delayjs.js'; ?></script>
  <title><?php wp_title(); ?></title>
  
	<?php wp_head(); ?>
  
  <style><?php require get_template_directory() . '/assets/css/fonts.css'; ?></style>
  <?php
  $bodybg = get_field('body_background', 'option');
  $color1 = get_field('accent_color_1', 'option');
  $color2 = get_field('accent_color_2', 'option');
  $color3 = get_field('heading_text_color', 'option');
  $color4 = get_field('body_text_color', 'option');
  $btnLook = get_field('button_look', 'option');
  $fontSize = get_field('base_font_size_desktop', 'option');
  $fontSizeMob = get_field('base_font_size_mobile', 'option');
  $defPhone = get_field('default_phone', 'option');
  $defEmail = get_field('default_email', 'option');
  $stickyHeader = get_field('sticky_header', 'option');
  $showHeaderPhone = get_field('show_header_phone', 'option');
  $showHeaderCTA = get_field('show_header_cta', 'option');
  $headerCTA = get_field('header_cta', 'option');
  $headerLogo = get_field('default_header_logo', 'option');
  $flyoutmenuvisibility = get_field('menu_visibility', 'option');
  ?>
  <style>
  :root {
    --fontfamily: Fakt,"Trebuchet MS", Helvetica, sans-serif;
    --fontsize-desktop: <?= $fontSize ?>px;
    --fontsize-mobile: <?= $fontSizeMob ?>px;
    --colorbodybg: <?= $bodybg ?>;
    --color1: <?= $color1 ?>;
    --color2: <?= $color2 ?>;
    --color-headingtext: <?= $color3 ?>;
    --color-bodytext: <?= $color4 ?>;
    --easing: cubic-bezier(.55,.43,.31,.99);
    --content-width: 1758px;
  }
  </style>
  <style><?php require get_template_directory() . '/assets/css/critical.css'; ?></style>
  <?php critical_component_layout(); ?>
</head>

<body <?php body_class($btnLook); ?>>
<?php wp_body_open(); ?>


<header id="main-header" class="<?= ($stickyHeader) ? 'sticky' : '' ?>">
  
  <div class="row">
    
    <div class="site__logo">
      
      <a href="<?php home_url(); ?>" class="logo__wrap">
        <?php if( !empty( $headerLogo ) ) : ?>
        <img src=" <?= $headerLogo['url']; ?> "/>
        <?php endif; ?>
      </a>
      
    </div>
    
    <nav>
      <?= do_shortcode('[menu name="main-menu]'); ?>
    </nav>
    
    <div class="cta__wrapper">
      
      <?php if( $showHeaderPhone ) : ?>
      <a class="phone" href="tel:<?= $defPhone; ?>">
        <span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="13.909" height="14" viewBox="0 0 13.909 14"><path d="M313.379,14.918c-.069-.053-.14-.107-.206-.161-.353-.284-.728-.546-1.092-.8l-.226-.158a2.253,2.253,0,0,0-1.279-.486,1.657,1.657,0,0,0-1.379.874.733.733,0,0,1-.629.382,1.249,1.249,0,0,1-.507-.127,6.1,6.1,0,0,1-3.187-3.1c-.3-.666-.2-1.1.321-1.456A1.474,1.474,0,0,0,306,8.59a7.381,7.381,0,0,0-2.6-3.543,1.473,1.473,0,0,0-1,0A2.9,2.9,0,0,0,300.6,6.53a2.763,2.763,0,0,0,.039,2.229,17.984,17.984,0,0,0,3.944,6.007,19.119,19.119,0,0,0,5.984,3.975,3.311,3.311,0,0,0,.592.176c.055.012.1.023.137.032a.229.229,0,0,0,.058.008h.018a3.4,3.4,0,0,0,2.819-2.146C314.546,15.81,313.9,15.315,313.379,14.918Z" transform="translate(-300.384 -4.958)"/></svg>
        </span>
        <span class="text"><?= $defPhone; ?></span>
      </a>
      <?php endif; ?>
      
      <?php
      if( $showHeaderCTA ) :
      button(array(
        'button_style'=>'outlinelight',
        'button_arrow'=>0,
        'button_link'=>$headerCTA,
        'button_custom_class'=>'',
        'button_function'=>''
      ));
      endif;
      ?>
      
      <button class="burgermenu__toggle <?= ($flyoutmenuvisibility == 'both') ? 'both' : 'mobileonly' ?>">
        <span class="line1"></span>
        <span class="line2"></span>
      </button>
      
    </div>
    
  </div>
  
</header>
  
<div class="burgermenu">
  
  <div class="outer__wrap">
    
    <div class="menu__wrap">
      <?= do_shortcode('[menu name="flyout-burger-menu"]'); ?>
    </div>

    <?php
    if( $showHeaderCTA ) :
    button(array(
      'button_style'=>'outlinedark',
      'button_arrow'=>1,
      'button_link'=>$headerCTA,
      'button_custom_class'=>'',
      'button_function'=>''
    ));
    endif;
    ?>
    
  </div>
  
</div>