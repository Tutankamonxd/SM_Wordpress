<?php
/**
 * Template part for displaying Banner section.
 *
 * @package food_grocery_hub
 * @subpackage food_grocery_hub
 */

$food_grocery_hub_banner_main_sec = get_theme_mod('food_grocery_hub_banner_main_show', 'false');

if ($food_grocery_hub_banner_main_sec) : ?>
    <div id="main-banner-sec" class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 align-self-center">
                    <?php if (get_theme_mod('food_grocery_hub_product_banner_one') != '' || get_theme_mod('food_grocery_hub_product_banner_one_title1') != '' || get_theme_mod('food_grocery_hub_product_banner_one_btn_text1') != '') { ?>
                        <div class="banner-1 mb-3 mb-md-0 position-relative">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 align-self-center">
                                    <div class="product-content first">
                                        <?php if (get_theme_mod('food_grocery_hub_product_banner_one_title1') !== '') : ?>
                                            <h2 class="my-2"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_one_title1')); ?></h2>
                                        <?php endif; ?>
                                        <div class="product-btn mt-3" data-wow-duration="2s">
                                            <?php if (get_theme_mod('food_grocery_hub_product_banner_one_btn_text1') != '') { ?>
                                                <a href="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_one_btn_link1')); ?>">
                                                    <?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_one_btn_text1')); ?><i class="fas fa-arrow-right ms-lg-3 ms-1"></i>
                                                    <span class="screen-reader-text"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_one_btn_text1')); ?></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 align-self-center">
                                    <?php if (get_theme_mod('food_grocery_hub_product_banner_one') != '') { ?>
                                        <div class="product-img">
                                            <img src="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_one')); ?>" alt="<?php esc_attr_e( 'Banner Product Image One','food-grocery-hub' ); ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 align-self-center">
                    <?php if (get_theme_mod('food_grocery_hub_product_banner_two') != '' || get_theme_mod('food_grocery_hub_product_banner_two_title1') != '' || get_theme_mod('food_grocery_hub_product_banner_two_btn_text1') != '') { ?>
                        <div class="banner-1 banner-two mb-3 mb-md-0 position-relative mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 align-self-center">
                                    <div class="product-content second">
                                        <?php if (get_theme_mod('food_grocery_hub_product_banner_two_title1') !== '') : ?>
                                            <h2 class="my-2"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_two_title1')); ?></h2>
                                        <?php endif; ?>
                                        <div class="product-btn mt-3" data-wow-duration="2s">
                                            <?php if (get_theme_mod('food_grocery_hub_product_banner_two_btn_text1') != '') { ?>
                                                <a href="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_two_btn_link1')); ?>">
                                                    <?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_two_btn_text1')); ?><i class="fas fa-arrow-right ms-lg-3 ms-1"></i>
                                                    <span class="screen-reader-text"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_two_btn_text1')); ?></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 align-self-center">
                                     <?php if (get_theme_mod('food_grocery_hub_product_banner_two') != '') { ?>
                                        <div class="product-img">
                                            <img src="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_two')); ?>" alt="<?php esc_attr_e( 'Banner Product Image Two','food-grocery-hub' ); ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (get_theme_mod('food_grocery_hub_product_banner_three') != '' || get_theme_mod('food_grocery_hub_product_banner_three_title1') != '' || get_theme_mod('food_grocery_hub_product_banner_three_btn_text1') != '') { ?>
                        <div class="banner-1 banner-third mt-3 mb-md-0 position-relative">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 align-self-center">
                                    <?php if (get_theme_mod('food_grocery_hub_product_banner_three') != '') { ?>
                                        <div class="product-img">
                                            <img src="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_three')); ?>" alt="<?php esc_attr_e( 'Banner Product Image Three','food-grocery-hub' ); ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6 col-md-6 align-self-center">
                                    <div class="product-content first">
                                        <?php if (get_theme_mod('food_grocery_hub_product_banner_three_title1') !== '') : ?>
                                            <h2 class="my-2"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_three_title1')); ?></h2>
                                        <?php endif; ?>
                                        <div class="product-btn mt-3" data-wow-duration="2s">
                                            <?php if (get_theme_mod('food_grocery_hub_product_banner_three_btn_text1') != '') { ?>
                                                <a href="<?php echo esc_url(get_theme_mod('food_grocery_hub_product_banner_three_btn_link1')); ?>">
                                                    <?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_three_btn_text1')); ?><i class="fas fa-arrow-right ms-lg-3 ms-1"></i>
                                                    <span class="screen-reader-text"><?php echo esc_html(get_theme_mod('food_grocery_hub_product_banner_three_btn_text1')); ?></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>