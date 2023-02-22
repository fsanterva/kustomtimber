<?php 
    $layoutName      = 'blog_child_related_articles';
?>
<?php if( $row_layout == $layoutName ): ?>
    <?php require get_template_directory() . '/inc/component-wrapper-top.php'; ?>
        <?php 
            $pID     = get_the_ID();
            $related = dilate_get_related_posts($pID, 2);

            $prev_post = get_previous_post(); 
            $id = $prev_post->ID ;
            $prev_permalink = get_permalink( $id );

            $next_post = get_next_post();
            if($next_post){
                $nid = $next_post->ID ;
                $next_permalink = get_permalink($nid);
            }
        ?> 

        <div class="row navigation">
            <?php if($prev_permalink): ?>
                <a href="<?php echo $prev_permalink; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="83.747" height="19.297" viewBox="0 0 83.747 19.297"><path d="M779.367,314.685l.681.676-8.54,8.493h81.906v.958H771.508l8.54,8.492-.681.678-9.7-9.649Z" transform="translate(-769.667 -314.685)" fill="#333230"></path></svg>
                    <span class="text">Previous</span>
                </a>
            <?php endif; ?>
            <?php if($next_post): ?>
                <a href="#">
                    <span class="text">Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="83.747" height="19.297" viewBox="0 0 83.747 19.297"><path d="M843.714,314.685l-.681.676,8.54,8.493H769.667v.958h81.906l-8.54,8.492.681.678,9.7-9.649Z" transform="translate(-769.667 -314.685)" fill="#333230"></path></svg>
                </a>
            <?php endif; ?>
        </div>
        <div class="row row-custom">
                
                <div class="container-head">
                    <h2 class="related-headings">Related Articles</h2>
                    <a class="view-all" href="/blog/">
                        View all articles 
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095">
                                <path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="articles__wrapper">

                    <?php 
                        foreach($related->posts as $r){
                            post_card($r->ID);
                        }
                    ?>
                  
                </div>
        </div>

    <?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>
<?php endif; ?>