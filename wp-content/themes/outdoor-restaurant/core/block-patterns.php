<?php
/**
 * Outdoor Restaurant: Block Patterns
 *
 * @since Outdoor Restaurant 1.0
 */

function outdoor_restaurant_register_block_patterns() {

	$patterns = array();

	$block_pattern_categories = array(
		'outdoor-restaurant' => array( 'label' => __( 'Outdoor Restaurant', 'outdoor-restaurant' ) )
	);
	$block_pattern_categories = apply_filters( 'outdoor_restaurant_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', 'outdoor_restaurant_register_block_patterns', 9 );