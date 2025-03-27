<?php

$food_grocery_hub_tp_theme_css = '';

$food_grocery_hub_theme_lay = get_theme_mod( 'food_grocery_hub_tp_body_layout_settings','Full');
if($food_grocery_hub_theme_lay == 'Container'){
$food_grocery_hub_tp_theme_css .='body{';
$food_grocery_hub_tp_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
$food_grocery_hub_tp_theme_css .='}';
$food_grocery_hub_tp_theme_css .='@media screen and (max-width:575px){';
$food_grocery_hub_tp_theme_css .='body{';
	$food_grocery_hub_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left: 0px';
$food_grocery_hub_tp_theme_css .='} }';
$food_grocery_hub_tp_theme_css .='.scrolled{';
$food_grocery_hub_tp_theme_css .='width: auto; left:0; right:0;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_theme_lay == 'Container Fluid'){
$food_grocery_hub_tp_theme_css .='body{';
$food_grocery_hub_tp_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
$food_grocery_hub_tp_theme_css .='}';
$food_grocery_hub_tp_theme_css .='@media screen and (max-width:575px){';
$food_grocery_hub_tp_theme_css .='body{';
	$food_grocery_hub_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left:0px';
$food_grocery_hub_tp_theme_css .='} }';
$food_grocery_hub_tp_theme_css .='.scrolled{';
$food_grocery_hub_tp_theme_css .='width: auto; left:0; right:0;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_theme_lay == 'Full'){
$food_grocery_hub_tp_theme_css .='body{';
$food_grocery_hub_tp_theme_css .='max-width: 100%;';
$food_grocery_hub_tp_theme_css .='}';
}

$food_grocery_hub_scroll_position = get_theme_mod( 'food_grocery_hub_scroll_top_position','Right');
if($food_grocery_hub_scroll_position == 'Right'){
$food_grocery_hub_tp_theme_css .='#return-to-top{';
$food_grocery_hub_tp_theme_css .='right: 20px;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_scroll_position == 'Left'){
$food_grocery_hub_tp_theme_css .='#return-to-top{';
$food_grocery_hub_tp_theme_css .='left: 20px;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_scroll_position == 'Center'){
$food_grocery_hub_tp_theme_css .='#return-to-top{';
$food_grocery_hub_tp_theme_css .='right: 50%;left: 50%;';
$food_grocery_hub_tp_theme_css .='}';
}

// related post
$food_grocery_hub_related_post_mob = get_theme_mod('food_grocery_hub_related_post_mob', true);
$food_grocery_hub_related_post = get_theme_mod('food_grocery_hub_remove_related_post', true);
$food_grocery_hub_tp_theme_css .= '.related-post-block {';
if ($food_grocery_hub_related_post == false) {
    $food_grocery_hub_tp_theme_css .= 'display: none;';
}
$food_grocery_hub_tp_theme_css .= '}';
$food_grocery_hub_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($food_grocery_hub_related_post == false || $food_grocery_hub_related_post_mob == false) {
    $food_grocery_hub_tp_theme_css .= '.related-post-block { display: none; }';
}
$food_grocery_hub_tp_theme_css .= '}';

// slider btn
$food_grocery_hub_slider_buttom_mob = get_theme_mod('food_grocery_hub_slider_buttom_mob', true);
$food_grocery_hub_slider_button = get_theme_mod('food_grocery_hub_slider_button', true);
$food_grocery_hub_tp_theme_css .= '#slider .more-btn {';
if ($food_grocery_hub_slider_button == false) {
    $food_grocery_hub_tp_theme_css .= 'display: none;';
}
$food_grocery_hub_tp_theme_css .= '}';
$food_grocery_hub_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($food_grocery_hub_slider_button == false || $food_grocery_hub_slider_buttom_mob == false) {
    $food_grocery_hub_tp_theme_css .= '#slider .more-btn { display: none; }';
}
$food_grocery_hub_tp_theme_css .= '}';

//return to header mobile               
$food_grocery_hub_return_to_header_mob = get_theme_mod('food_grocery_hub_return_to_header_mob', true);
$food_grocery_hub_return_to_header = get_theme_mod('food_grocery_hub_return_to_header', true);
$food_grocery_hub_tp_theme_css .= '.return-to-header{';
if ($food_grocery_hub_return_to_header == false) {
    $food_grocery_hub_tp_theme_css .= 'display: none;';
}
$food_grocery_hub_tp_theme_css .= '}';
$food_grocery_hub_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($food_grocery_hub_return_to_header == false || $food_grocery_hub_return_to_header_mob == false) {
    $food_grocery_hub_tp_theme_css .= '.return-to-header{ display: none; }';
}
$food_grocery_hub_tp_theme_css .= '}';


$food_grocery_hub_footer_widget_image = get_theme_mod('food_grocery_hub_footer_widget_image');
if($food_grocery_hub_footer_widget_image != false){
$food_grocery_hub_tp_theme_css .='#footer{';
$food_grocery_hub_tp_theme_css .='background: url('.esc_attr($food_grocery_hub_footer_widget_image).');';
$food_grocery_hub_tp_theme_css .='}';
}

//Social icon Font size
$food_grocery_hub_social_icon_fontsize = get_theme_mod('food_grocery_hub_social_icon_fontsize');
$food_grocery_hub_tp_theme_css .='.social-media a i{';
$food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_social_icon_fontsize).'px;';
$food_grocery_hub_tp_theme_css .='}';

// site title and tagline font size option
$food_grocery_hub_site_title_font_size = get_theme_mod('food_grocery_hub_site_title_font_size', ''); {
$food_grocery_hub_tp_theme_css .='.logo h1 a, .logo p a{';
$food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_site_title_font_size).'px !important;';
$food_grocery_hub_tp_theme_css .='}';
}

$food_grocery_hub_site_tagline_font_size = get_theme_mod('food_grocery_hub_site_tagline_font_size', '');{
$food_grocery_hub_tp_theme_css .='.logo p{';
$food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_site_tagline_font_size).'px;';
$food_grocery_hub_tp_theme_css .='}';
}

$food_grocery_hub_related_product = get_theme_mod('food_grocery_hub_related_product',true);
if($food_grocery_hub_related_product == false){
$food_grocery_hub_tp_theme_css .='.related.products{';
	$food_grocery_hub_tp_theme_css .='display: none;';
$food_grocery_hub_tp_theme_css .='}';
}

//menu font size
$food_grocery_hub_menu_font_size = get_theme_mod('food_grocery_hub_menu_font_size', '');{
$food_grocery_hub_tp_theme_css .='.main-navigation a, .main-navigation li.page_item_has_children:after, .main-navigation li.menu-item-has-children:after{';
	$food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_menu_font_size).'px;';
$food_grocery_hub_tp_theme_css .='}';
}

// menu text transform
$food_grocery_hub_menu_text_tranform = get_theme_mod( 'food_grocery_hub_menu_text_tranform','');
if($food_grocery_hub_menu_text_tranform == 'Uppercase'){
$food_grocery_hub_tp_theme_css .='.main-navigation a {';
	$food_grocery_hub_tp_theme_css .='text-transform: uppercase;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_text_tranform == 'Lowercase'){
$food_grocery_hub_tp_theme_css .='.main-navigation a {';
	$food_grocery_hub_tp_theme_css .='text-transform: lowercase;';
$food_grocery_hub_tp_theme_css .='}';
}
else if($food_grocery_hub_menu_text_tranform == 'Capitalize'){
$food_grocery_hub_tp_theme_css .='.main-navigation a {';
	$food_grocery_hub_tp_theme_css .='text-transform: capitalize;';
$food_grocery_hub_tp_theme_css .='}';
}

//sale position
$food_grocery_hub_scroll_position = get_theme_mod( 'food_grocery_hub_sale_tag_position','right');
if($food_grocery_hub_scroll_position == 'right'){
$food_grocery_hub_tp_theme_css .='.woocommerce ul.products li.product .onsale{';
    $food_grocery_hub_tp_theme_css .='right: 25px !important;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_scroll_position == 'left'){
$food_grocery_hub_tp_theme_css .='.woocommerce ul.products li.product .onsale{';
    $food_grocery_hub_tp_theme_css .='left: 25px !important; right: auto !important;';
$food_grocery_hub_tp_theme_css .='}';
}

//Font Weight
$food_grocery_hub_menu_font_weight = get_theme_mod( 'food_grocery_hub_menu_font_weight','');
if($food_grocery_hub_menu_font_weight == '100'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 100;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '200'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 200;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '300'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 300;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '400'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 400;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '500'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 500;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '600'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 600;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '700'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 700;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '800'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 800;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_menu_font_weight == '900'){
$food_grocery_hub_tp_theme_css .='.main-navigation a{';
    $food_grocery_hub_tp_theme_css .='font-weight: 900;';
$food_grocery_hub_tp_theme_css .='}';
}

/*------------- Blog Page------------------*/
$food_grocery_hub_post_image_round = get_theme_mod('food_grocery_hub_post_image_round', 0);
if($food_grocery_hub_post_image_round != false){
    $food_grocery_hub_tp_theme_css .='.blog .box-image img{';
        $food_grocery_hub_tp_theme_css .='border-radius: '.esc_attr($food_grocery_hub_post_image_round).'px;';
    $food_grocery_hub_tp_theme_css .='}';
}

$food_grocery_hub_post_image_width = get_theme_mod('food_grocery_hub_post_image_width', '');
if($food_grocery_hub_post_image_width != false){
    $food_grocery_hub_tp_theme_css .='.blog .box-image img{';
        $food_grocery_hub_tp_theme_css .='Width: '.esc_attr($food_grocery_hub_post_image_width).'px;';
    $food_grocery_hub_tp_theme_css .='}';
}

$food_grocery_hub_post_image_length = get_theme_mod('food_grocery_hub_post_image_length', '');
if($food_grocery_hub_post_image_length != false){
    $food_grocery_hub_tp_theme_css .='.blog .box-image img{';
        $food_grocery_hub_tp_theme_css .='height: '.esc_attr($food_grocery_hub_post_image_length).'px;';
    $food_grocery_hub_tp_theme_css .='}';
}

// footer widget title font size
$food_grocery_hub_footer_widget_title_font_size = get_theme_mod('food_grocery_hub_footer_widget_title_font_size', '');{
$food_grocery_hub_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
    $food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_footer_widget_title_font_size).'px;';
$food_grocery_hub_tp_theme_css .='}';
}

// Copyright text font size
$food_grocery_hub_footer_copyright_font_size = get_theme_mod('food_grocery_hub_footer_copyright_font_size', '');{
$food_grocery_hub_tp_theme_css .='#footer .site-info p{';
    $food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_footer_copyright_font_size).'px;';
$food_grocery_hub_tp_theme_css .='}';
}

// copyright padding
$food_grocery_hub_footer_copyright_top_bottom_padding = get_theme_mod('food_grocery_hub_footer_copyright_top_bottom_padding', '');
if ($food_grocery_hub_footer_copyright_top_bottom_padding !== '') { 
    $food_grocery_hub_tp_theme_css .= '.site-info {';
    $food_grocery_hub_tp_theme_css .= 'padding-top: ' . esc_attr($food_grocery_hub_footer_copyright_top_bottom_padding) . 'px;';
    $food_grocery_hub_tp_theme_css .= 'padding-bottom: ' . esc_attr($food_grocery_hub_footer_copyright_top_bottom_padding) . 'px;';
    $food_grocery_hub_tp_theme_css .= '}';
}

// copyright position
$food_grocery_hub_copyright_text_position = get_theme_mod( 'food_grocery_hub_copyright_text_position','Center');
if($food_grocery_hub_copyright_text_position == 'Center'){
$food_grocery_hub_tp_theme_css .='#footer .site-info p{';
$food_grocery_hub_tp_theme_css .='text-align:center;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_copyright_text_position == 'Left'){
$food_grocery_hub_tp_theme_css .='#footer .site-info p{';
$food_grocery_hub_tp_theme_css .='text-align:left;';
$food_grocery_hub_tp_theme_css .='}';
}else if($food_grocery_hub_copyright_text_position == 'Right'){
$food_grocery_hub_tp_theme_css .='#footer .site-info p{';
$food_grocery_hub_tp_theme_css .='text-align:right;';
$food_grocery_hub_tp_theme_css .='}';
}

// Header Image title font size
$food_grocery_hub_header_image_title_font_size = get_theme_mod('food_grocery_hub_header_image_title_font_size', '62');{
$food_grocery_hub_tp_theme_css .='.box-text h2{';
    $food_grocery_hub_tp_theme_css .='font-size: '.esc_attr($food_grocery_hub_header_image_title_font_size).'px;';
$food_grocery_hub_tp_theme_css .='}';
}

// header
$food_grocery_hub_slider_arrows = get_theme_mod('food_grocery_hub_slider_arrows', false);
if($food_grocery_hub_slider_arrows == false){
$food_grocery_hub_tp_theme_css .='.page-template-front-page .main-header-box{';
    $food_grocery_hub_tp_theme_css .='position:static;';
$food_grocery_hub_tp_theme_css .='}';
}