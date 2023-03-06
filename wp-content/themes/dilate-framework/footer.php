<?php

$headerLogo = get_field('default_header_logo', 'option');
$defPhone = get_field('default_phone', 'option');
$defEmail = get_field('default_email', 'option');

$footNav1 = get_field('footer_navigation_1', 'option');
$footNav2 = get_field('footer_navigation_2', 'option');
$footNav3 = get_field('footer_navigation_3', 'option');
$showrooms = get_field('our_showrooms', 'option');

$socialMedia = get_field('social_media', 'option');
$footCopyrightRow = get_field('footer_copyright_row', 'option');
$footCopyRightGuarantee = $footCopyrightRow['copyright_guarantee'];
$footCopyRightGroup = $footCopyrightRow['copyright_right_group'];
$footCopyrightText = $footCopyRightGroup['copyright_text'];
$footCopyrightShowSocial = $footCopyRightGroup['show_social_links'];
$footerDilateAttribDefault = $footCopyRightGroup['dilate_attribution_default'];
$footerDilateAttribHome = $footCopyRightGroup['dilate_attribution_homepage'];

?>
<footer>
  <div class="row">
    
    <div class="nav__row">
    
      <div class="left">

        <a href="<?= home_url(); ?>" class="footer__logo" aria-label="Kustom Timber Logo">
          <img data-src="<?= $headerLogo['url']; ?>" alt="<?= $headerLogo['alt']; ?>"/>
        </a>

      </div>

      <div class="right">

        <div class="navs__column">

          <div class="menu__wrap menu__wrap--range">
            <label><?= $footNav1['menu_label']; ?></label>
            <?= do_shortcode('[menu name='.$footNav1['menu_name'].']'); ?>
          </div>

          <div class="menu__wrap menu__wrap--services">
            <label><?= $footNav2['menu_label']; ?></label>
            <?= do_shortcode('[menu name='.$footNav2['menu_name'].']'); ?>
          </div>

          <div class="menu__wrap menu__wrap--highlight">
            <?= do_shortcode('[menu name='.$footNav3['menu_name'].']'); ?>
          </div>

        </div>

        <div class="showroom__column">

          <?php if( !empty( $showrooms ) ) : ?>

            <?php foreach( $showrooms as $idx=>$sr ) : ?>

            <div class="showroom__item <?= ( $idx+1 == count($showrooms) ) ? 'last__item' : ''; ?>">
              <label class="name"><?= $sr['name']; ?></label>

              <?php if( !empty( $sr['phone'] ) ) : ?>
              <a class="tel" href="tel:<?= $sr['phone'] ?>"><?= $sr['phone']; ?></a>
              <?php endif; ?>

              <?php if( !empty( $sr['address'] ) ) : ?>
                <?php if( !empty( $sr['google_map_link'] ) ) : ?>
                <a class="address" href="<?= $sr['google_map_link'] ?>" target="_blank"><?= $sr['address']; ?></a>
                <?php else : ?>
                <span class="address"><?= $sr['address']; ?></span>
                <?php endif; ?>
              <?php endif; ?>

              <?php if( !empty( $sr['info'] ) ) : ?>
              <div class="info">
                <?= $sr['info']; ?>
              </div>
              <?php endif; ?>

            </div>

            <?php endforeach; ?>

          <?php endif; ?>
        
          <div class="ctas">
            <a href="/contact-us">Get in touch</a>
            <a href="tel:<?=$defPhone;?>"><?= $defPhone; ?></a>
            <a href="mailto:<?=$defEmail;?>"><?= $defEmail; ?></a>
          </div>

        </div>

      </div>

    </div>

    <div class="copyright__row">

      <div class="left">

        <p><?= $footCopyRightGuarantee; ?></p>

      </div>

      <div class="right">

        <div class="copyright__text">
          <p><?= $footCopyrightText ?></p>
        </div>

        <div class="copyright__links">

          
          <?php if( is_front_page() ) : ?>

            <p class="dilate__attribution"><?= $footerDilateAttribHome; ?></p>

          <?php else : ?>

            <p><?= $footerDilateAttribDefault; ?></p>

          <?php endif; ?>

          <?php if( $footCopyrightShowSocial && !empty( $socialMedia ) ) : ?>

          <div class="social__links">
            <?php foreach( $socialMedia as $soc ) : ?>
            <a href="<?= $soc['url']; ?>" aria-label="Social media links"><?= $soc['platform']['label']; ?></a>
            <?php endforeach; ?>
          </div>

          <?php endif; ?>

        </div>

      </div>

    </div>
    
  </div>
  
</footer>
</div>
  <style> <?php require get_template_directory() . '/assets/css/footer.css'; ?> </style>
	<?php wp_footer(); ?>
</body>
</html>
