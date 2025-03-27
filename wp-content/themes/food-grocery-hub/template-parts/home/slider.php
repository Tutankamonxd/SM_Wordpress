<?php
/**
 * Template part for displaying slider section
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

$food_grocery_hub_static_image = get_stylesheet_directory_uri() . '/assets/images/slider-img.png';
$food_grocery_hub_slider_arrows = get_theme_mod('food_grocery_hub_slider_arrows', false);
?>

<?php if ($food_grocery_hub_slider_arrows) : ?>
  <section id="slider">
    <div class="container">
      <div class="owl-carousel owl-theme">
        <?php 
        $food_grocery_hub_slide_pages = array();
        for ($food_grocery_hub_count = 1; $food_grocery_hub_count <= 4; $food_grocery_hub_count++) {
          $mod = absint(get_theme_mod('food_grocery_hub_slider_page' . $food_grocery_hub_count));
          if ($mod != 0) {
            $food_grocery_hub_slide_pages[] = $mod;
          }
        }

        if (!empty($food_grocery_hub_slide_pages)) :
          $food_grocery_hub_args = array(
            'post_type' => 'page',
            'post__in' => $food_grocery_hub_slide_pages,
            'orderby' => 'post__in'
          );
          $food_grocery_hub_query = new WP_Query($food_grocery_hub_args);
          if ($food_grocery_hub_query->have_posts()) :
            while ($food_grocery_hub_query->have_posts()) : $food_grocery_hub_query->the_post(); ?>
              <div class="item">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12 slider-content-col align-self-center">
                    <div class="carousel-caption">
                      <div class="inner_carousel">
                        <?php if (get_theme_mod('food_grocery_hub_slider_short_heading')) : ?>
                          <p class="slidetop-text mb-2"><?php echo esc_html(get_theme_mod('food_grocery_hub_slider_short_heading')); ?></p>
                        <?php endif; ?>
                        <h1 class="mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-capitalize"><?php the_title();?></a>
                        </h1>
                        <div class="more-btn mt-4">
                          <a href="<?php the_permalink(); ?>" class="text-capitalize me-lg-4 me-md-3 me-2 mb-3 slider-btn1"><?php esc_html_e('Explore Shop', 'food-grocery-hub'); ?><i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12 slider-img-col align-self-center">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php else : ?>
                      <img src="<?php echo esc_url($food_grocery_hub_static_image); ?>" alt="<?php esc_attr_e('Slider Image', 'food-grocery-hub'); ?>" />
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          else : ?>
            <div class="no-postfound"><?php esc_html_e('No posts found', 'food-grocery-hub'); ?></div>
          <?php endif;
        endif; ?>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>
<?php endif; ?>