<?php
/**
 * Template Name: Custom Home Page
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

get_header(); ?>

<main id="tp_content" role="main">
	<?php do_action( 'food_grocery_hub_before_slider' ); ?>

	<?php get_template_part( 'template-parts/home/slider' ); ?>
	<?php do_action( 'food_grocery_hub_after_slider' ); ?>

	<?php get_template_part( 'template-parts/home/product-sec' ); ?>
	<?php do_action( 'food_grocery_hub_after_product-sec' ); ?>

	<?php get_template_part( 'template-parts/home/home-content' ); ?>
	<?php do_action( 'food_grocery_hub_after_home_content' ); ?>
</main>

<?php get_footer();