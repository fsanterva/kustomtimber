<?php ob_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <link rel="preconnect" href="https://js.hsforms.net/" crossorigin />
  <link rel="dns-prefetch" href="https://js.hsforms.net/" />
  <link rel="preconnect" href="https://forms.hsforms.com/" crossorigin />
  <link rel="dns-prefetch" href="https://forms.hsforms.com/" />
  <link rel="preconnect" href="https://forms-na1.hsforms.com/" crossorigin />
  <link rel="dns-prefetch" href="https://forms-na1.hsforms.com/" />
  
  <script type="module"><?php require get_template_directory() . '/assets/js/delayjs.js'; ?></script>
  <title><?php wp_title(); ?></title>
  
	<?php wp_head(); ?>
  
  <style><?php //require get_template_directory() . '/assets/css/fonts.css'; ?></style>
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
  $floatingRequestButton = get_field('floating_request_sample_button', 'option');
  $stickyHeader = get_field('sticky_header', 'option');
  $showHeaderPhone = get_field('show_header_phone', 'option');
  $showHeaderCTA = get_field('show_header_cta', 'option');
  $headerCTA = get_field('header_cta', 'option');
  $headerLogo = get_field('default_header_logo', 'option');
  
  $isProductChild = is_singular( array( 'timber-product', 'cork-product', 'product' ) );
  $headerType = get_field( 'header_type', get_the_ID() );
  $wooCat = is_product_category();
  $wooShop = is_shop();
  $wooCart = is_cart();
  $wooCheckout = is_checkout();

  if($wooCat || $wooShop || $wooCart || $wooCheckout){
    $headerType = 'narrow';
  }

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
  <style><?php require get_template_directory() . '/assets/css/critical.min.css'; ?></style>
  <?php critical_component_layout2(); ?>
	
	<!-- Google Tag Manager -->
	<script type="dilatelazyloadscript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KZJ78ZP');</script>
	<!-- End Google Tag Manager -->

  <?php 
    $range = get_query_var( 'range' ); //echo $range; 
  ?>
  <?php if($range): ?>
    <!-- GETTER RANGE -->
    <script>      
        /* <![CDATA[ */
        var global_data = {"range":"<?php echo $range; ?>"};
        /* ]]> */
    </script>
  <?php else: ?>
    <!-- GETTER RANGE -->
    <script>      
        /* <![CDATA[ */
        var global_data = {};
        /* ]]> */
    </script>
  <?php endif; ?>
</head>

<body <?php body_class( array($btnLook, $headerType, ($isProductChild) ? 'narrow' : '' ) ); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZJ78ZP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<?php wp_body_open(); ?>


<header id="main-header" class="<?= ($stickyHeader) ? 'sticky' : '' ?> <?= ($isProductChild) ? 'narrow' : '' ?> <?= $headerType; ?> scalable__elements">
  
  <div class="row">
    
    <div class="site__logo">
      
      <a href="<?= home_url(); ?>" class="logo__wrap" aria-label="Kustom Timber Logo">
        <?php if( !empty( $headerLogo ) ) : ?>
        <picture class="no-lazy">
          <img src=" <?= $headerLogo['url']; ?> " alt="<?= $headerLogo['alt']; ?>"/>
        </picture>
        <?php endif; ?>
      </a>
      
    </div>
    
    <nav>
      <?= do_shortcode('[menu name="main-menu-primary"]'); ?>
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
        button( $headerCTA['site_button'] );
      endif;
      ?>
      
      <button class="burgermenu__toggle" aria-label="Burger Menu">
        <span class="line1"></span>
        <span class="line2"></span>
      </button>
      
    </div>
    
  </div>
  
</header>
  
<div class="burgermenu scalable__elements">
  
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
  
<div class="range__megamenu_wrap range__megamenu_wrap--timber sub-menu">
  <?php
  $ranges = get_terms([
    'taxonomy' => 'range',
    'hide_empty' => false,
    'exclude' => array( 50 ),
  ]);
  ?>
  
  <div class="range__list">
    <?php foreach( $ranges as $idx=>$range ) : ?>
    <a href="/our-range/<?= $range->slug; ?>/" class="<?= ( $idx == 0 ) ? 'active' : '' ?>" data-slug="<?= $range->slug; ?>" data-id="<?= $range->term_id; ?>"><?= $range->name; ?></a>
    <?php endforeach; ?>
  </div>
  
  <div class="product__list">
    <?php foreach( $ranges as $idx=>$range ) :
      $args = array(
        'post_type'       => 'timber-product',
        'posts_per_page'  => 12,
        'order_by'        => 'date',
        'order'           =>  'ASC',
        'post_status '    => array('publish'),
        'tax_query'       => array(
          array(
            'taxonomy' => 'range',
            'field' => 'slug',
            'terms' => $range->slug
          )
        )
      );
      $result = new WP_Query( $args );
      $new_search = $result->posts;
    ?>
    <div class="products__holder <?= ( $idx == 0 ) ? 'active' : '' ?>" id="rangemenu__<?= $range->slug ?>">
      
      <?php foreach( $new_search as $obj ) :
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $img = get_field('product_image', $obj);
      ?>
      
      <a href="<?= $perm; ?>">
        <span class="img__wrap">
          <?php acf_responsive_image_menu($img, true); ?>
        </span>
        <label class="title"><?= $title; ?></label>
      </a>
      
      <?php endforeach; ?>
      
      <a href="/our-range/<?= $range->slug; ?>/" class="view__all">View all <?= $range->name; ?></a>
      
    </div>
    <?php endforeach; ?>
  </div>
  
</div>


<div class="range__megamenu_wrap range__megamenu_wrap--cork sub-menu">
  <?php
  $ranges = get_terms([
    'taxonomy' => 'cork-range',
    'hide_empty' => false,
  ]);
  ?>
  
  <div class="range__list">
    <?php foreach( $ranges as $idx=>$range ) : ?>
    <a href="/cork-range?range=<?= $range->slug; ?>" class="<?= ( $idx == 0 ) ? 'active' : '' ?>" data-slug="<?= $range->slug; ?>" data-id="<?= $range->term_id; ?>"><?= $range->name; ?></a>
    <?php endforeach; ?>
  </div>
  
  <div class="product__list">
    <?php foreach( $ranges as $idx=>$range ) :
      $args = array(
        'post_type'       => 'cork-product',
        'posts_per_page'  => 12,
        'order_by'        => 'date',
        'order'           =>  'ASC',
        'post_status '    => array('publish'),
        'tax_query'       => array(
          array(
            'taxonomy' => 'cork-range',
            'field' => 'slug',
            'terms' => $range->slug
          )
        )
      );
      $result = new WP_Query( $args );
      $new_search = $result->posts;
    ?>
    <div class="products__holder <?= ( $idx == 0 ) ? 'active' : '' ?>" id="rangemenu__<?= $range->slug ?>">
      
      <?php foreach( $new_search as $obj ) :
        $title = get_the_title($obj);
        $perm = get_the_permalink($obj);
        $img = get_field('product_image', $obj);
      ?>
      
      <a href="<?= $perm; ?>">
        <span class="img__wrap">
          <?php acf_responsive_image_menu($img, true); ?>
        </span>
        <label class="title"><?= $title; ?></label>
      </a>
      
      <?php endforeach; ?>
      
      <a href="/cork-range?range=<?= $range->slug; ?>" class="view__all">View all <?= $range->name; ?></a>
      
    </div>
    <?php endforeach; ?>
  </div>
  
</div>


<!-- <button class="requestFreeSampleTrigger scalable__elements">REQUEST FREE SAMPLES</button> -->
<?php button( $floatingRequestButton['site_button'] ); ?>
<div class="popup__form_wrap scalable__elements">
  
  <div class="inner__wrap">
    
    <button class="closePopupForm">CLOSE</button>
    
    <div id="downloadCatalogueForm" class="form__block">
      
      <div class="form__heading">
        <label>Download our latest catalogue</label>
      </div>
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
      <script>
        (function($) {
          hbspt.forms.create({
            region: "na1",
            portalId: "3910169",
            formId: "de6a6851-db92-4bab-b56a-d7e2195c8af3",
            onFormSubmit: function() {
				dataLayer.push({'event': 'submitForm', 'formName': 'Hubspot - Catalogue Download'})
			}
          });
        } (window.jQuery || window.$) );
      </script>
      <?php //do_shortcode('[forminator_form id="1161"]'); ?>
    </div>
    
    
  </div>
  
</div>

<!--  FORM POPUPS  -->
<?php
  $args = array(
    'post_type'       => 'popup',
    'posts_per_page'  => -1,
    'post_status '    => array('publish'),
  );
  $popupsObj = new WP_Query( $args );
  $popupList = $popupsObj->posts;
  ?>
  
  <?php if( !empty( $popupList ) ) : ?>
  
    <?php foreach( $popupList as $pop ) : 
      $pid = $pop->ID;
      $popupType = get_field('popup_type', $pid);
      $isActive = get_field('active', $pid);
      $shortcode = get_field('shortcode_field', $pid);
      $embed = get_field('embed_field', $pid);
    ?>
  
      <?php if( $isActive ) : ?>
  
        <div data-id="<?= $pid; ?>" data-type="<?= $popupType; ?>" class="form__popup scalable__elements">
          
          <div class="inner__wrap">
            
            <button class="popClose">
              <span class="line line1"></span>
              <span class="line line2"></span>
            </button>
            
            <?php if( $popupType == 'shortcode' ) : ?>
            
              <?= do_shortcode($shortcode); ?>
            
            <?php elseif( $popupType == 'embed' ) : ?>
            
              <?= $embed; ?>
            
            <?php endif; ?>
            
          </div>
          
        </div>
  
      <?php endif; ?>
  
    <?php endforeach; ?>
  
  <?php endif; ?>