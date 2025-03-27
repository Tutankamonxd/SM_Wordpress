<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

get_header(); ?>

<div class="box-image">
  	<div class="single-page-img"></div>
  	 <div class="box-text">
    	<h2><?php esc_html_e( '404', 'food-grocery-hub' ); ?></h2>  
    </div> 
</div>

<div class="container">
	<main id="tp_content" role="main">
		<div id="primary" class="content-area">
			<section class="error-404 not-found">
				<h1 class="page-title text-center pt-3"><?php echo esc_html(get_theme_mod('food_grocery_hub_edit_404_title',__('Oops! That page can&rsquo;t be found.','food-grocery-hub')));?></h1>
				<div class="page-content text-center">
					<p class="py-3"><?php echo esc_html(get_theme_mod('food_grocery_hub_edit_404_text',__('It looks like nothing was found at this location. Maybe try a search?','food-grocery-hub')));?></p>
					<?php get_search_form(); ?>
				</div>
			</section>
		</div>
	</main>
</div>

<?php get_footer();