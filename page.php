<?php $enableCache = get_field('enable_browser_cache', 'option'); ?>
<?php if( $enableCache ) : ?>
<?php require get_template_directory() . '/inc/top-cache.php'; ?>
<?php endif; ?>

<?php get_header(); ?>
<div id="beforemain_wrap">
<main id="main-areaarticle">
  <article id="main-area">
    <?php component_layout(); ?>
  </article>
</main>
<?php get_footer(); ?>
  
<?php if( $enableCache ) : ?>
<?php require get_template_directory() . '/inc/bottom-cache.php'; ?>
<?php endif; ?>
