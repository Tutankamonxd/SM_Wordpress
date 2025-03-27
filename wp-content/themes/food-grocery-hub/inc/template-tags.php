<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function food_grocery_hub_categorized_blog() {
	$food_grocery_hub_category_count = get_transient( 'food_grocery_hub_categories' );

	if ( false === $food_grocery_hub_category_count ) {
		// Create an array of all the categories that are attached to posts.
		$food_grocery_hub_categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$food_grocery_hub_category_count = count( $food_grocery_hub_categories );

		set_transient( 'food_grocery_hub_categories', $food_grocery_hub_category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $food_grocery_hub_category_count > 1;
}

if ( ! function_exists( 'food_grocery_hub_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Food Grocery Hub
 */
function food_grocery_hub_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Flush out the transients used in food_grocery_hub_categorized_blog.
 */
function food_grocery_hub_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'food_grocery_hub_categories' );
}
add_action( 'edit_category', 'food_grocery_hub_category_transient_flusher' );
add_action( 'save_post',     'food_grocery_hub_category_transient_flusher' );