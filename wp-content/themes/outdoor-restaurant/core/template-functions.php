<?php
/**
 * @package Outdoor Restaurant
 */

function outdoor_restaurant_customizer_add_defaults( $default_options) {
	$defaults = array(
		'outdoor_restaurant_excerpt_length'    => 30,
	);
	$updated_defaults = wp_parse_args( $defaults, $default_options );

	return $updated_defaults;
}
add_filter( 'outdoor_restaurant_customizer_defaults', 'outdoor_restaurant_customizer_add_defaults' );

function outdoor_restaurant_gtm( $option ) {
	$defaults = apply_filters( 'outdoor_restaurant_customizer_defaults', true );

	return isset( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );
}

if ( ! function_exists( 'outdoor_restaurant_excerpt_length' ) ) :
	function outdoor_restaurant_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		$length	= outdoor_restaurant_gtm( 'outdoor_restaurant_excerpt_length' );

		return absint( $length );
	} 
endif;
add_filter( 'excerpt_length', 'outdoor_restaurant_excerpt_length', 999 );