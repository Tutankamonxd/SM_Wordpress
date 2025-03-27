<?php
	
	$food_grocery_hub_tp_theme_css = '';

	// 1st color
	$food_grocery_hub_tp_color_option_first = get_theme_mod('food_grocery_hub_tp_color_option_first', '#117D3B');
	if ($food_grocery_hub_tp_color_option_first) {
		$food_grocery_hub_tp_theme_css .= ':root {';
		$food_grocery_hub_tp_theme_css .= '--color-primary1: ' . esc_attr($food_grocery_hub_tp_color_option_first) . ';';
		$food_grocery_hub_tp_theme_css .= '}';
	}

	// 2ns color
	$food_grocery_hub_tp_color_option_second = get_theme_mod('food_grocery_hub_tp_color_option_second', '#FDD61F');
	if ($food_grocery_hub_tp_color_option_second) {
		$food_grocery_hub_tp_theme_css .= ':root {';
		$food_grocery_hub_tp_theme_css .= '--color-primary2: ' . esc_attr($food_grocery_hub_tp_color_option_second) . ';';
		$food_grocery_hub_tp_theme_css .= '}';
	}

	// preloader
	$food_grocery_hub_tp_preloader_color1_option = get_theme_mod('food_grocery_hub_tp_preloader_color1_option');

	if($food_grocery_hub_tp_preloader_color1_option != false){
	$food_grocery_hub_tp_theme_css .='.center1{';
		$food_grocery_hub_tp_theme_css .='border-color: '.esc_attr($food_grocery_hub_tp_preloader_color1_option).' !important;';
	$food_grocery_hub_tp_theme_css .='}';
	}
	if($food_grocery_hub_tp_preloader_color1_option != false){
	$food_grocery_hub_tp_theme_css .='.center1 .ring::before{';
		$food_grocery_hub_tp_theme_css .='background: '.esc_attr($food_grocery_hub_tp_preloader_color1_option).' !important;';
	$food_grocery_hub_tp_theme_css .='}';
	}

	$food_grocery_hub_tp_preloader_color2_option = get_theme_mod('food_grocery_hub_tp_preloader_color2_option');

	if($food_grocery_hub_tp_preloader_color2_option != false){
	$food_grocery_hub_tp_theme_css .='.center2{';
		$food_grocery_hub_tp_theme_css .='border-color: '.esc_attr($food_grocery_hub_tp_preloader_color2_option).' !important;';
	$food_grocery_hub_tp_theme_css .='}';
	}
	if($food_grocery_hub_tp_preloader_color2_option != false){
	$food_grocery_hub_tp_theme_css .='.center2 .ring::before{';
		$food_grocery_hub_tp_theme_css .='background: '.esc_attr($food_grocery_hub_tp_preloader_color2_option).' !important;';
	$food_grocery_hub_tp_theme_css .='}';
	}

	$food_grocery_hub_tp_preloader_bg_color_option = get_theme_mod('food_grocery_hub_tp_preloader_bg_color_option');

	if($food_grocery_hub_tp_preloader_bg_color_option != false){
	$food_grocery_hub_tp_theme_css .='.loader{';
		$food_grocery_hub_tp_theme_css .='background: '.esc_attr($food_grocery_hub_tp_preloader_bg_color_option).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	$food_grocery_hub_tp_footer_bg_color_option = get_theme_mod('food_grocery_hub_tp_footer_bg_color_option');


	if($food_grocery_hub_tp_footer_bg_color_option != false){
	$food_grocery_hub_tp_theme_css .='#footer{';
		$food_grocery_hub_tp_theme_css .='background: '.esc_attr($food_grocery_hub_tp_footer_bg_color_option).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	// logo tagline color
	$food_grocery_hub_site_tagline_color = get_theme_mod('food_grocery_hub_site_tagline_color');

	if($food_grocery_hub_site_tagline_color != false){
	$food_grocery_hub_tp_theme_css .='.logo h1 a, .logo p a, .logo p.site-title a{';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_site_tagline_color).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	$food_grocery_hub_logo_tagline_color = get_theme_mod('food_grocery_hub_logo_tagline_color');
	if($food_grocery_hub_logo_tagline_color != false){
	$food_grocery_hub_tp_theme_css .='p.site-description{';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_logo_tagline_color).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	// footer widget title color
	$food_grocery_hub_footer_widget_title_color = get_theme_mod('food_grocery_hub_footer_widget_title_color');
	if($food_grocery_hub_footer_widget_title_color != false){
	$food_grocery_hub_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_footer_widget_title_color).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	// copyright text color
	$food_grocery_hub_footer_copyright_text_color = get_theme_mod('food_grocery_hub_footer_copyright_text_color');
	if($food_grocery_hub_footer_copyright_text_color != false){
	$food_grocery_hub_tp_theme_css .='#footer .site-info p, #footer .site-info a {';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_footer_copyright_text_color).'!important;';
	$food_grocery_hub_tp_theme_css .='}';
	}

	// header image title color
	$food_grocery_hub_header_image_title_text_color = get_theme_mod('food_grocery_hub_header_image_title_text_color');
	if($food_grocery_hub_header_image_title_text_color != false){
	$food_grocery_hub_tp_theme_css .='.box-text h2{';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_header_image_title_text_color).';';
	$food_grocery_hub_tp_theme_css .='}';
	}

	// menu color
	$food_grocery_hub_menu_color = get_theme_mod('food_grocery_hub_menu_color');
	if($food_grocery_hub_menu_color != false){
	$food_grocery_hub_tp_theme_css .='.main-navigation a{';
	$food_grocery_hub_tp_theme_css .='color: '.esc_attr($food_grocery_hub_menu_color).';';
	$food_grocery_hub_tp_theme_css .='}';
}