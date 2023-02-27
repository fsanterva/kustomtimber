<?php $enableCache = get_field('enable_browser_cache', 'option'); ?>
<?php if( $enableCache ) : ?>
<?php require get_template_directory() . '/inc/top-cache.php'; ?>
<?php endif; ?>

<?php get_header(); ?>
<div id="beforemain_wrap">
<main id="main-areaarticle">
  <article id="main-area">
    
    <?php 
      if(!is_shop() && !is_cart() && !is_checkout() && !is_product_category()){
        component_layout(); 
      } else { ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="page-width">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
        <?php endwhile;         
      } 
    ?>
  </article>
</main>
<?php get_footer(); ?>
  
<?php if( $enableCache ) : ?>
<?php require get_template_directory() . '/inc/bottom-cache.php'; ?>
<?php endif; ?>
