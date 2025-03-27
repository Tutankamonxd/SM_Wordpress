<?php
/*
* Display header
*/
?>
<div class="header-details">
    <div class="main-header-box">
        <div class="headerbox">
            <div class="header-main container">
                <div class="row mx-0">
                    <div class="col-lg-4 col-md-4 align-self-center d-flex align-items-center justify-content-md-end justify-content-center top-left py-md-2">
                        <div class="langauge-box">
                            <span class="translate-btn d-flex">
                                <?php if (get_theme_mod('food_grocery_hub_cart_language_translator', false) && class_exists('GTranslate')) : ?>
                                    <div class="translate-lang position-relative d-md-inline-block me-3">
                                        <?php echo wp_kses_post(do_shortcode('[gtranslate]')); ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="delivery-text">
                            <?php 
                            if ($food_grocery_hub_delivery_time = get_theme_mod('food_grocery_hub_delivery_time')) : ?>
                                <p class="discount-top m-md-0 my-2"><i class="far fa-clock me-2"></i><?php echo esc_html($food_grocery_hub_delivery_time); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="logo text-center">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php endif; ?>

                            <?php if (get_theme_mod('food_grocery_hub_site_title', true)) : ?>
                                <?php if (is_front_page() && is_home()) : ?>
                                    <h1 class="text-capitalize">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                    </h1>
                                <?php else : ?>
                                    <p class="text-capitalize site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php
                            $food_grocery_hub_description = get_bloginfo('description', 'display');
                            if ($food_grocery_hub_description || is_customize_preview()) :
                                if (get_theme_mod('food_grocery_hub_site_tagline', false)) :
                            ?>
                                <p class="site-description my-1 text-capitalize"><?php echo esc_html($food_grocery_hub_description); ?></p>
                            <?php
                                endif;
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 align-self-center py-md-2">
                        <div class="top-last-content">
                            <div class="main-call">
                                <?php 
                                $food_grocery_hub_contact_number = get_theme_mod('food_grocery_hub_call');
                                if (!empty($food_grocery_hub_contact_number)) : ?>
                                    <p class="mb-md-0 mb-2 contact-content">
                                        <a href="tel:<?php echo esc_attr($food_grocery_hub_contact_number); ?>">
                                            <i class="fas fa-phone me-1" aria-hidden="true"></i><?php echo esc_html($food_grocery_hub_contact_number); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="social-media">
                              <?php
                                $food_grocery_hub_header_fb_new_tab = esc_attr(get_theme_mod('food_grocery_hub_header_fb_new_tab', 'true'));
                                $food_grocery_hub_header_twt_new_tab = esc_attr(get_theme_mod('food_grocery_hub_header_twt_new_tab', 'true'));
                                $food_grocery_hub_header_ins_new_tab = esc_attr(get_theme_mod('food_grocery_hub_header_ins_new_tab', 'true'));
                                $food_grocery_hub_header_linkedin_new_tab = esc_attr(get_theme_mod('food_grocery_hub_header_linkedin_new_tab', 'true'));
                              ?>
                              <?php if (get_theme_mod('food_grocery_hub_instagram_url') != '') : ?>
                                <a <?php if ($food_grocery_hub_header_ins_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url(get_theme_mod('food_grocery_hub_instagram_url', '')); ?>"><i class="me-xl-3 me-lg-2 me-3 <?php echo esc_attr(get_theme_mod('food_grocery_hub_instagram_icon', 'fab fa-instagram')); ?>"></i></a>
                              <?php endif; ?>
                              <?php if (get_theme_mod('food_grocery_hub_facebook_url') != '') : ?>
                                <a <?php if ($food_grocery_hub_header_fb_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url(get_theme_mod('food_grocery_hub_facebook_url', '')); ?>"><i class="me-xl-3 me-lg-2 me-3 <?php echo esc_attr(get_theme_mod('food_grocery_hub_facebook_icon', 'fab fa-facebook-f')); ?>"></i></a>
                              <?php endif; ?>
                              <?php if (get_theme_mod('food_grocery_hub_linkedin_url') != '') : ?>
                                <a <?php if ($food_grocery_hub_header_linkedin_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url(get_theme_mod('food_grocery_hub_linkedin_url', '')); ?>"><i class="me-xl-3 me-lg-2 me-3 <?php echo esc_attr(get_theme_mod('food_grocery_hub_linkedin_icon', 'fab fa-linkedin-in')); ?>"></i></a>
                              <?php endif; ?>
                              <?php if (get_theme_mod('food_grocery_hub_twitter_url') != '') : ?>
                                <a <?php if ($food_grocery_hub_header_twt_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url(get_theme_mod('food_grocery_hub_twitter_url', '')); ?>"><i class="<?php echo esc_attr(get_theme_mod('food_grocery_hub_twitter_icon', 'fab fa-twitter')); ?>"></i></a>
                              <?php endif; ?>
                            </div>
                            <div class="search-account">
                                <p class="mb-0">
                                    <?php if (class_exists('WooCommerce')): ?>
                                        <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                                            <i class="<?php echo is_user_logged_in() ? 'fas' : 'far'; ?> fa-user" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </p>
                                <span class="search-bar">
                                    <button type="button" class="open-search"><i class="fas fa-search"></i></button>
                                </span>
                                <?php if (get_theme_mod('food_grocery_hub_cart_icon', true) != '') : ?>
                                    <?php if (class_exists('woocommerce')) : ?>
                                        <span class="product-cart text-center position-relative">
                                            <a href="<?php if (function_exists('wc_get_cart_url')) {
                                                            echo esc_url(wc_get_cart_url());
                                                        } ?>" title="<?php esc_attr_e('shopping cart', 'food-grocery-hub'); ?>"><i class="fas fa-shopping-cart"></i></a>
                                            <?php
                                            $food_grocery_hub_cart_count = WC()->cart->get_cart_contents_count();
                                            if ($food_grocery_hub_cart_count > 0) : ?>
                                                <span class="cart-count"><?php echo esc_html($food_grocery_hub_cart_count); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="search-outer">
                        <div class="inner_searchbox w-100 h-100">
                            <?php get_search_form(); ?>
                        </div>
                        <button type="button" class="search-close"><?php esc_html_e('CLOSE', 'food-grocery-hub'); ?></button>
                    </div> 
                </div>
            </div>
        </div>
         <div class="clearfix"></div>
        <div class="main-navhead">
            <div class="menubox text-center">
                <div class="container">
                    <div class="menu-content">
                        <?php get_template_part('template-parts/navigation/site-nav'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>