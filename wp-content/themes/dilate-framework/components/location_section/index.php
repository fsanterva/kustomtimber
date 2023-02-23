<?php $layoutName      = 'location_section'; ?>

<?php if( $row_layout == $layoutName ): ?>
    <?php 
         $data               = $sectionObject;
         $dataFlds           = $data->data_fields;
         $map_locations      = get_field('our_showrooms', 'options');
         $count              = 0;

         //echo '<pre>' .print_r($map_locations,1). '</pre>';
    
        require get_template_directory() . '/inc/component-wrapper-top.php';     
    ?>

        <div class="row row__full">
                <?php if($dataFlds['main_headline_text']): ?>
                    <?php headlineText($dataFlds['main_headline_text'], $dataFlds['seo_tag']); ?>
                <?php endif; ?>

                <div class="map-location map-desktop">
                    <div class="map-info">
                        <?php foreach($map_locations as $ml): ?>
                            <?php if($ml['enable_map_in_contact_page'] == 1): $count+= 1; ?>
                                <div data-tab="<?php echo $count; ?>" class="info <?php echo ($count == 1) ? 'active' : ''; ?>">
                                    <span class="name"><?php echo $ml['name'] ?></span>
                                    <span class="phone"><?php echo $ml['phone'] ?></span>
                                    <span class="address"><?php echo $ml['address'] ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="map-gmap">
                        <?php  $count = 0; foreach($map_locations as $ml): ?>
                            <?php if($ml['enable_map_in_contact_page'] == 1): $count+= 1; ?>
                                <div data-tab="<?php echo $count; ?>"  class="map <?php echo ($count == 1) ? 'active' : ''; ?>">
                                    <?php if($ml['map_type'] == "map1"): ?>
                                        <?php echo $ml['map_embed']; ?>
                                    <?php else: ?>
                                        <div data-lng="<?php echo $ml['lng']; ?>" data-lat="<?php echo $ml['lat']; ?>" class="map<?php echo $count; ?>"></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="map-location map-mobile">
                    <div class="map-info map-gmap">
                        <?php $count = 0; foreach($map_locations as $ml): ?>
                            <?php if($ml['enable_map_in_contact_page'] == 1): $count+= 1; ?>
                             <div class="vertical-tab">
                                    <div data-tab="<?php echo $count; ?>" class="info  <?php echo ($count == 1) ? 'active' : ''; ?>">
                                        <span class="name"><?php echo $ml['name'] ?></span>
                                        <span class="phone"><?php echo $ml['phone'] ?></span>
                                        <span class="address"><?php echo $ml['address'] ?></span>
                                    </div>
                                    <div data-tab="<?php echo $count; ?>" class="map <?php echo ($count == 1) ? 'active' : ''; ?>">
                                        <?php if($ml['map_type'] == "map1"): ?>
                                            <?php echo $ml['map_embed']; ?>
                                        <?php else: ?>
                                            <div data-lng="<?php echo $ml['lng']; ?>" data-lat="<?php echo $ml['lat']; ?>" class="map<?php echo $count; ?>"></div>
                                        <?php endif; ?>
                                    </div>
                              </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>

    <?php require get_template_directory() . '/inc/component-wrapper-bottom.php'; ?>
<?php endif; ?>