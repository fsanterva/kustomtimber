<?php 
    $layoutName      = 'blog_child_gallery';
?>
<?php if( $row_layout == $layoutName ): ?>
    <?php 
        $data               = $sectionObject;
        $dataFlds           = $data->data_fields;
        $dataInfos          = $dataFlds['information'];
        $layout_select      = $data->layout_select;
        $link               = get_permalink();
        $title              = get_the_title();
    ?>
    <?php require get_template_directory() . '/inc/component-wrapper-top.php'; ?>
    <div class="row">
    
        <?php foreach($dataInfos as $dataInfo): ?>
        
            <div class="columns column-info">
                <div class="column column__left to_animate">
                    <?php if($dataInfo['social_share'] == 1): ?>
                        <div class="social-share">
                            <div class="share-label">
                                SHARE
                            </div>
                            <div class="share-icon">
                                <a target="_blank" class="fb-share" href="https://www.facebook.com/sharer.php?u=<?php echo $link; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                                </a>
                                <a target="_blank" class="twitter-share" href="https://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $link; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
                                </a>
                                <a target="_blank" class="linkedin-share" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link; ?>&title=<?php echo $title; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="column column__right">
                    <?php if($dataInfo['main_headline_text']): ?>
                        <?php headlineText($dataInfo['main_headline_text'], $dataInfo['seo_tag']); ?>
                    <?php endif; ?>
                    <?php if($dataInfo['text_summary']): ?>
                        <?php $dataInfosSub = $dataInfo['headline_sub_text']; ?>

                        <?php if($dataInfosSub['headline_sub_text']): ?>
                            <?php headlineText($dataInfosSub['headline_sub_text'], $dataInfosSub['seo_tag']); ?>
                        <?php endif; ?>
                        <?php echo $dataInfo['text_summary']; ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; ?>

        <?php $layout = $layout_select['layout_select']; ?>
                
        <?php if( $layout == 'layout1' ) : ?>

            <div class="columns column-info">

                <div class="column column__left to_animate">
                    <div class="img__wrap to_parallax_bg">
                        <img <?= acf_responsive_image($layout_select['layout_1']['narrow_image']['id'], '', '600px'); ?> alt="<?= $layout_select['layout_1']['narrow_image']['alt']; ?>"/>
                    </div>
                </div>
            
                <div class="column column__right">
                    <div class="img__wrap to_parallax_bg">
                        <img <?= acf_responsive_image($layout_select['layout_1']['wider_image']['id'], '', '1200px'); ?> alt="<?= $layout_select['layout_1']['wider_image']['alt']; ?>"/>
                    </div>
                </div>
            
            </div>

         <?php endif; ?>

         <?php if( $layout == 'layout2' ) : ?>

            <div class="columns column-info">

                <div class="column full-width to_animate">
                    <div class="img__wrap to_parallax_bg">
                        <img <?= acf_responsive_image($layout_select['layout_2']['id'], '', '2200px'); ?> alt="<?= $layout_select['layout_2']['alt']; ?>"/>
                    </div>
                </div>

            </div>

        <?php endif; ?>

        <?php if( $layout == 'layout3' ) : ?>
            <?php 
              $videoURL           = $layout_select['layout_3']['video_fields']['video_url'];
              $videoPoster        = $layout_select['layout_3']['video_fields']['video_poster'];                    
            ?>

            <div class="columns  column-info">
                <div class="column full-width">
                    <div class="video__block">
                        <span class="img_wrap to_parallax_bg"><img data-src="<?= $videoPoster; ?>" alt=""/></span>
                        <iframe class="video__frame" data-src="<?=$videoURL;?>" controls=0 rel=0 modestbranding allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        
                        <button class="play__button">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25.348" height="28.912" viewBox="0 0 25.348 28.912"><path d="M587.166,3749.5a2,2,0,0,1,0,3.455l-21.348,12.453a2,2,0,0,1-3.008-1.728v-24.906a2,2,0,0,1,3.008-1.728Z" transform="translate(-562.81 -3736.773)"/></svg>
                        </span>
                        <span class="text">PLAY VIDEO</span>
                        </button>
                    </div>
                </div>
            </div>

        <?php endif; ?>
                     
    </div>
    <?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>
<?php endif; ?>