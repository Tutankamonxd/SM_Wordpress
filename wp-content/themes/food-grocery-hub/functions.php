<?php
/**
 * Food Grocery Hub functions and definitions
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

function food_grocery_hub_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'food-grocery-hub-featured-image', 2000, 1200, true );
	add_image_size( 'food-grocery-hub-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'    => __( 'Primary Menu', 'food-grocery-hub' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
    	'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', food_grocery_hub_fonts_url() ) );
}
add_action( 'after_setup_theme', 'food_grocery_hub_setup' );

/**
 * Register custom fonts.
 */
function food_grocery_hub_fonts_url(){
	$food_grocery_hub_font_url = '';
	$food_grocery_hub_font_family = array();
	$food_grocery_hub_font_family[] = 'Oswald:200,300,400,500,600,700';
	$food_grocery_hub_font_family[] = 'Roboto:100,100i,300,400,400i,500,500i,700,700i,900,900i';

	$food_grocery_hub_font_family[] = 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Bad Script';
	$food_grocery_hub_font_family[] = 'Bebas Neue';
	$food_grocery_hub_font_family[] = 'Fjalla One';
	$food_grocery_hub_font_family[] = 'PT Sans:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'PT Serif:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
	$food_grocery_hub_font_family[] = 'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Alex Brush';
	$food_grocery_hub_font_family[] = 'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Playball';
	$food_grocery_hub_font_family[] = 'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Julius Sans One';
	$food_grocery_hub_font_family[] = 'Arsenal:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Slabo 13px';
	$food_grocery_hub_font_family[] = 'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900';
	$food_grocery_hub_font_family[] = 'Overpass Mono:wght@300;400;500;600;700';
	$food_grocery_hub_font_family[] = 'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900';
	$food_grocery_hub_font_family[] = 'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900';
	$food_grocery_hub_font_family[] = 'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700';
	$food_grocery_hub_font_family[] = 'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Quicksand:wght@300;400;500;600;700';
	$food_grocery_hub_font_family[] = 'Padauk:wght@400;700';
	$food_grocery_hub_font_family[] = 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$food_grocery_hub_font_family[] = 'Inconsolata:wght@200;300;400;500;600;700;800;900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$food_grocery_hub_font_family[] = 'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$food_grocery_hub_font_family[] = 'Pacifico';
	$food_grocery_hub_font_family[] = 'Indie Flower';
	$food_grocery_hub_font_family[] = 'VT323';
	$food_grocery_hub_font_family[] = 'Dosis:wght@200;300;400;500;600;700;800';
	$food_grocery_hub_font_family[] = 'Frank Ruhl Libre:wght@300;400;500;700;900';
	$food_grocery_hub_font_family[] = 'Fjalla One';
	$food_grocery_hub_font_family[] = 'Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Oxygen:wght@300;400;700';
	$food_grocery_hub_font_family[] = 'Arvo:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Noto Serif:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Lobster';
	$food_grocery_hub_font_family[] = 'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Yanone Kaffeesatz:wght@200;300;400;500;600;700';
	$food_grocery_hub_font_family[] = 'Anton';
	$food_grocery_hub_font_family[] = 'Libre Baskerville:ital,wght@0,400;0,700;1,400';
	$food_grocery_hub_font_family[] = 'Bree Serif';
	$food_grocery_hub_font_family[] = 'Gloria Hallelujah';
	$food_grocery_hub_font_family[] = 'Abril Fatface';
	$food_grocery_hub_font_family[] = 'Varela Round';
	$food_grocery_hub_font_family[] = 'Vampiro One';
	$food_grocery_hub_font_family[] = 'Shadows Into Light';
	$food_grocery_hub_font_family[] = 'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Rokkitt:wght@100;200;300;400;500;600;700;800;900';
	$food_grocery_hub_font_family[] = 'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Francois One';
	$food_grocery_hub_font_family[] = 'Orbitron:wght@400;500;600;700;800;900';
	$food_grocery_hub_font_family[] = 'Patua One';
	$food_grocery_hub_font_family[] = 'Acme';
	$food_grocery_hub_font_family[] = 'Satisfy';
	$food_grocery_hub_font_family[] = 'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Architects Daughter';
	$food_grocery_hub_font_family[] = 'Russo One';
	$food_grocery_hub_font_family[] = 'Monda:wght@400;700';
	$food_grocery_hub_font_family[] = 'Righteous';
	$food_grocery_hub_font_family[] = 'Lobster Two:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Hammersmith One';
	$food_grocery_hub_font_family[] = 'Courgette';
	$food_grocery_hub_font_family[] = 'Permanent Marke';
	$food_grocery_hub_font_family[] = 'Cherry Swash:wght@400;700';
	$food_grocery_hub_font_family[] = 'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700';
	$food_grocery_hub_font_family[] = 'Poiret One';
	$food_grocery_hub_font_family[] = 'BenchNine:wght@300;400;700';
	$food_grocery_hub_font_family[] = 'Economica:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Handlee';
	$food_grocery_hub_font_family[] = 'Cardo:ital,wght@0,400;0,700;1,400';
	$food_grocery_hub_font_family[] = 'Alfa Slab One';
	$food_grocery_hub_font_family[] = 'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Cookie';
	$food_grocery_hub_font_family[] = 'Chewy';
	$food_grocery_hub_font_family[] = 'Great Vibes';
	$food_grocery_hub_font_family[] = 'Coming Soon';
	$food_grocery_hub_font_family[] = 'Philosopher:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Days One';
	$food_grocery_hub_font_family[] = 'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Shrikhand';
	$food_grocery_hub_font_family[] = 'Tangerine:wght@400;700';
	$food_grocery_hub_font_family[] = 'IM Fell English SC';
	$food_grocery_hub_font_family[] = 'Boogaloo';
	$food_grocery_hub_font_family[] = 'Bangers';
	$food_grocery_hub_font_family[] = 'Fredoka One';
	$food_grocery_hub_font_family[] = 'Volkhov:ital,wght@0,400;0,700;1,400;1,700';
	$food_grocery_hub_font_family[] = 'Shadows Into Light Two';
	$food_grocery_hub_font_family[] = 'Marck Script';
	$food_grocery_hub_font_family[] = 'Sacramento';
	$food_grocery_hub_font_family[] = 'Unica One';
	$food_grocery_hub_font_family[] = 'Dancing Script:wght@400;500;600;700';
	$food_grocery_hub_font_family[] = 'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$food_grocery_hub_font_family[] = 'DM Serif Display:ital@0;1';
	$food_grocery_hub_font_family[] = 'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800';
	$food_grocery_hub_font_family[] = 'Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800';
	$food_grocery_hub_font_family[] = 'Amatic SC:wght@400;700';
	$food_grocery_hub_font_family[] = 'Manrope:wght@200..800';

	$food_grocery_hub_query_args = array(
		'family'	=> rawurlencode(implode('|',$food_grocery_hub_font_family)),
	);
	$food_grocery_hub_font_url = add_query_arg($food_grocery_hub_query_args,'//fonts.googleapis.com/css');
	return $food_grocery_hub_font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $food_grocery_hub_font_url ) );
}

/**
 * Register widget area.
 */
function food_grocery_hub_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'food-grocery-hub' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'food-grocery-hub' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'food-grocery-hub' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'food-grocery-hub' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'food-grocery-hub' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'food-grocery-hub' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'food-grocery-hub' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'food-grocery-hub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'food_grocery_hub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function food_grocery_hub_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'food-grocery-hub-fonts', food_grocery_hub_fonts_url(), array(), null );

	// owl
	wp_enqueue_style( 'owl-carousel-css', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );

	// Bootstrap
	wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'food-grocery-hub-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/tp-theme-color.php' );
	wp_add_inline_style( 'food-grocery-hub-style',$food_grocery_hub_tp_theme_css );
	wp_style_add_data('food-grocery-hub-style', 'rtl', 'replace');
	require get_parent_theme_file_path( '/tp-body-width-layout.php' );
	wp_add_inline_style( 'food-grocery-hub-style',$food_grocery_hub_tp_theme_css );
	wp_style_add_data('food-grocery-hub-style', 'rtl', 'replace');

	// Theme block stylesheet.
	wp_enqueue_style( 'food-grocery-hub-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'food-grocery-hub-style' ), '1.0' );

	// Fontawesome
	wp_enqueue_style( 'fontawesome-css', get_theme_file_uri( '/assets/css/fontawesome-all.css' ) );
	

	wp_enqueue_script( 'food-grocery-hub-custom-scripts', get_template_directory_uri() . '/assets/js/food-grocery-hub-custom.js', array('jquery'), true );


	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), true );

	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ), true );

	wp_enqueue_script( 'food-grocery-hub-focus-nav', get_template_directory_uri() . '/assets/js/focus-nav.js', array('jquery'), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$food_grocery_hub_body_font_family = get_theme_mod('food_grocery_hub_body_font_family', '');

	$food_grocery_hub_heading_font_family = get_theme_mod('food_grocery_hub_heading_font_family', '');

	$food_grocery_hub_menu_font_family = get_theme_mod('food_grocery_hub_menu_font_family', '');

	$food_grocery_hub_tp_theme_css = '
		body, p.simplep, .more-btn a{
		    font-family: '.esc_html($food_grocery_hub_body_font_family).';
		}
		h1,h2, h3, h4, h5, h6, .menubar,.logo h1, .logo p.site-title, p.simplep a, #slider p.slidertop-title, .more-btn a,.wc-block-checkout__actions_row .wc-block-components-checkout-place-order-button,.wc-block-cart__submit-container a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, #theme-sidebar button[type="submit"],
#footer button[type="submit"]{
		    font-family: '.esc_html($food_grocery_hub_heading_font_family).';
		}
	';
	wp_add_inline_style('food-grocery-hub-style', $food_grocery_hub_tp_theme_css);
}
add_action( 'wp_enqueue_scripts', 'food_grocery_hub_scripts' );

/*radio button sanitization*/
function food_grocery_hub_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Sanitize Sortable control.
function food_grocery_hub_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}
/* Excerpt Limit Begin */
function food_grocery_hub_excerpt_function($excerpt_count = 35) {
    $food_grocery_hub_excerpt = get_the_excerpt();

    $food_grocery_hub_text_excerpt = wp_strip_all_tags($food_grocery_hub_excerpt);

    $food_grocery_hub_excerpt_limit = esc_attr(get_theme_mod('food_grocery_hub_excerpt_count', $excerpt_count));

    $food_grocery_hub_theme_excerpt = implode(' ', array_slice(explode(' ', $food_grocery_hub_text_excerpt), 0, $food_grocery_hub_excerpt_limit));

    return $food_grocery_hub_theme_excerpt;
}

function food_grocery_hub_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'food_grocery_hub_loop_columns');
if (!function_exists('food_grocery_hub_loop_columns')) {
	function food_grocery_hub_loop_columns() {
		$columns = get_theme_mod( 'food_grocery_hub_per_columns', 3 );
		return $columns;
	}
}

// Category count 
function food_grocery_hub_display_post_category_count() {
    $food_grocery_hub_category = get_the_category();
    $food_grocery_hub_category_count = ($food_grocery_hub_category) ? count($food_grocery_hub_category) : 0;
    $food_grocery_hub_category_text = ($food_grocery_hub_category_count === 1) ? 'category' : 'categories'; // Check for pluralization
    echo $food_grocery_hub_category_count . ' ' . $food_grocery_hub_category_text;
}

//post tag
function food_grocery_hub_custom_tags_filter($food_grocery_hub_tag_list) {
    // Replace the comma (,) with an empty string
    $food_grocery_hub_tag_list = str_replace(', ', '', $food_grocery_hub_tag_list);

    return $food_grocery_hub_tag_list;
}
add_filter('the_tags', 'food_grocery_hub_custom_tags_filter');

function food_grocery_hub_custom_output_tags() {
    $food_grocery_hub_tags = get_the_tags();

    if ($food_grocery_hub_tags) {
        $food_grocery_hub_tags_output = '<div class="post_tag">Tags: ';

        $food_grocery_hub_first_tag = reset($food_grocery_hub_tags);

        foreach ($food_grocery_hub_tags as $tag) {
            $food_grocery_hub_tags_output .= '<a href="' . esc_url(get_tag_link($tag)) . '" rel="tag" class="me-2">' . esc_html($tag->name) . '</a>';
            if ($tag !== $food_grocery_hub_first_tag) {
                $food_grocery_hub_tags_output .= ' ';
            }
        }

        $food_grocery_hub_tags_output .= '</div>';

        echo $food_grocery_hub_tags_output;
    }
}
//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'food_grocery_hub_per_page', 20 );
function food_grocery_hub_per_page( $food_grocery_hub_cols ) {
  	$food_grocery_hub_cols = get_theme_mod( 'food_grocery_hub_product_per_page', 9 );
	return $food_grocery_hub_cols;
}

function food_grocery_hub_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function food_grocery_hub_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function food_grocery_hub_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function food_grocery_hub_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 */
function food_grocery_hub_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template','food_grocery_hub_front_page_template' );

// logo
function food_grocery_hub_logo_width(){

	$food_grocery_hub_logo_width   = get_theme_mod( 'food_grocery_hub_logo_width', 80 );

	echo "<style type='text/css' media='all'>"; ?>
		img.custom-logo{
		    width: <?php echo absint( $food_grocery_hub_logo_width ); ?>px;
		    max-width: 100%;
		}
	<?php echo "</style>";
}

add_action( 'wp_head', 'food_grocery_hub_logo_width' );


/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Load Theme Web File
 */
require get_parent_theme_file_path('/inc/wptt-webfont-loader.php' );
/**
 * Load Theme Web File
 */
require get_parent_theme_file_path( '/inc/controls/customize-control-toggle.php' );
/**
 * load sortable file
 */
require get_parent_theme_file_path( '/inc/controls/sortable-control.php' );

/**
 * TGM Recommendation
 */
require get_parent_theme_file_path( '/inc/TGM/tgm.php' );