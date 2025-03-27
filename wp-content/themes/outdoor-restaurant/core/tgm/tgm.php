<?php

require get_template_directory() . '/core/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function outdoor_restaurant_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'outdoor-restaurant' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'outdoor_restaurant_register_recommended_plugins' );