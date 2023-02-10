<?php

$headerLogo = get_field('default_header_logo', 'option');

$footNav1 = get_field('footer_navigation_1', 'option');
$footNav2 = get_field('footer_navigation_2', 'option');
$footNav3 = get_field('footer_navigation_3', 'option');

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
  
  <div class="nav__row">
    
    <div class="left">
      
      <a class="footer__logo">
        <img data-src="<?= $headerLogo['url']; ?>" alt="<?= $headerLogo['alt']; ?>"/>
      </a>
      
    </div>
    
    <div class="right">
      
      <div class="navs__column">
        
        <div class="menu__wrap menu__wrap--range">
          <label><?= $footNav1['menu_label']; ?></label>
        </div>
        
      </div>
      
      <div class="showroom__column">
        
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
        
        <p class="dilate__attribution">
          <?php if( is_front_page() ) : ?>
          
            <?= $footerDilateAttribHome; ?>
          
          <?php else : ?>
          
            <?= $footerDilateAttribDefault; ?>
          
          <?php endif; ?>
        </p>
        
        <?php if( $footCopyrightShowSocial && !empty( $socialMedia ) ) : ?>
        
        <div class="social__links">
          <?php foreach( $socialMedia as $soc ) : ?>
          <a href="<?= $soc['url']; ?>"><?= $soc['platform']['label']; ?></a>
          <?php endforeach; ?>
        </div>
        
        <?php endif; ?>
        
      </div>
      
    </div>
    
  </div>
  
</footer>
</div>
  <style> <?php require get_template_directory() . '/assets/css/footer.css'; ?> </style>
	<?php wp_footer(); ?>
</body>
</html>
