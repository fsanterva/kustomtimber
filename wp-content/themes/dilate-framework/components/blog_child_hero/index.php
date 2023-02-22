<?php 
    $layoutName      = 'blog_child_hero';
    $pID             = get_the_ID();
    $blogFeatImgData = getFeaturedImage($pID);
    $blogTitle       = get_the_title();
    $blogDate        = get_the_date('M d, Y');

?>
<?php if( $row_layout == $layoutName ): ?>

    <?php require get_template_directory() . '/inc/component-wrapper-top.php'; ?>


        <div class="blog-banner row row--full">
  
            <div class="info-banner">
                <span class="headline-date"><?php echo $blogDate; ?></span>
                <h1 class="headline__text h1"><?php echo $blogTitle; ?></h1>
            </div>

            <?php if( !empty($blogFeatImgData) ) : ?>
                <span class="featured__image to_parallax_bg">
                    <img <?php acf_responsive_image($blogFeatImgData['id'], '', '2200px'); ?> alt="<?php echo $blogFeatImgData['alt']; ?>" />
                </span>
            <?php endif; ?>
    
        </div>    


    <?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>


<?php endif; ?>