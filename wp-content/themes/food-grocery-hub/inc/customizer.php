<?php
/**
 * Food Grocery Hub: Customizer
 *
 * @package Food Grocery Hub
 * @subpackage food_grocery_hub
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Food_Grocery_Hub_Customize_register( $wp_customize ) {

	require get_parent_theme_file_path('/inc/controls/range-slider-control.php');

	require get_parent_theme_file_path('/inc/controls/icon-changer.php');
	
	// Register the custom control type.
	$wp_customize->register_control_type( 'Food_Grocery_Hub_Toggle_Control' );
	
	//Register the sortable control type.
	$wp_customize->register_control_type( 'Food_Grocery_Hub_Control_Sortable' );

	//add home page setting pannel
	$wp_customize->add_panel( 'food_grocery_hub_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Home page', 'food-grocery-hub' ),
	    'description' => __( 'Description of what this panel does.', 'food-grocery-hub' ),
	) );
	
	//TP GENRAL OPTION
	$wp_customize->add_section('food_grocery_hub_tp_general_settings',array(
        'title' => __('TP General Option', 'food-grocery-hub'),
        'priority' => 1,
        'panel' => 'food_grocery_hub_panel_id'
    ) );

    $wp_customize->add_setting('food_grocery_hub_tp_body_layout_settings',array(
        'default' => 'Full',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
    $wp_customize->add_control('food_grocery_hub_tp_body_layout_settings',array(
        'type' => 'radio',
        'label'     => __('Body Layout Setting', 'food-grocery-hub'),
        'description'   => __('This option work for complete body, if you want to set the complete website in container.', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_tp_general_settings',
        'choices' => array(
            'Full' => __('Full','food-grocery-hub'),
            'Container' => __('Container','food-grocery-hub'),
            'Container Fluid' => __('Container Fluid','food-grocery-hub')
        ),
	) );

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('food_grocery_hub_sidebar_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_sidebar_post_layout',array(
        'type' => 'radio',
        'label'     => __('Post Sidebar Position', 'food-grocery-hub'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_tp_general_settings',
        'choices' => array(
            'full' => __('Full','food-grocery-hub'),
            'left' => __('Left','food-grocery-hub'),
            'right' => __('Right','food-grocery-hub'),
            'three-column' => __('Three Columns','food-grocery-hub'),
            'four-column' => __('Four Columns','food-grocery-hub'),
            'grid' => __('Grid Layout','food-grocery-hub')
        ),
	) );

	// Add Settings and Controls for post sidebar Layout
	$wp_customize->add_setting('food_grocery_hub_sidebar_single_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_sidebar_single_post_layout',array(
        'type' => 'radio',
        'label'     => __('Single Post Sidebar Position', 'food-grocery-hub'),
        'description'   => __('This option work for single blog page', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_tp_general_settings',
        'choices' => array(
            'full' => __('Full','food-grocery-hub'),
            'left' => __('Left','food-grocery-hub'),
            'right' => __('Right','food-grocery-hub'),
        ),
	) );

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('food_grocery_hub_sidebar_page_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_sidebar_page_layout',array(
        'type' => 'radio',
        'label'     => __('Page Sidebar Position', 'food-grocery-hub'),
        'description'   => __('This option work for pages.', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_tp_general_settings',
        'choices' => array(
            'full' => __('Full','food-grocery-hub'),
            'left' => __('Left','food-grocery-hub'),
            'right' => __('Right','food-grocery-hub')
        ),
	) );

	$wp_customize->add_setting( 'food_grocery_hub_sticky', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_sticky', array(
		'label'       => esc_html__( 'Show Sticky Header', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_tp_general_settings',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_sticky',
	) ) );

	//tp typography option
	$food_grocery_hub_font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Amatic SC'              => 'Amatic SC',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One',
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower',
		'Inter'                  => 'Inter',
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit',
		'Karla'                  => 'Karla',
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two',
		'Manrope'                => 'Manrope',
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda',
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli',
		'Marck Script'           => 'Marck Script',
		'Noto Serif'             => 'Noto Serif',
		'Open Sans'              => 'Open Sans',
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen',
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display',
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik',
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo',
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn',
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	$wp_customize->add_section('food_grocery_hub_typography_option',array(
		'title'         => __('TP Typography Option', 'food-grocery-hub'),
		'priority' => 1,
		'panel' => 'food_grocery_hub_panel_id'
   	));

   	$wp_customize->add_setting('food_grocery_hub_heading_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'food_grocery_hub_sanitize_choices',
	));
	$wp_customize->add_control(	'food_grocery_hub_heading_font_family', array(
		'section' => 'food_grocery_hub_typography_option',
		'label'   => __('heading Fonts', 'food-grocery-hub'),
		'type'    => 'select',
		'choices' => $food_grocery_hub_font_array,
	));

	$wp_customize->add_setting('food_grocery_hub_body_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'food_grocery_hub_sanitize_choices',
	));
	$wp_customize->add_control(	'food_grocery_hub_body_font_family', array(
		'section' => 'food_grocery_hub_typography_option',
		'label'   => __('Body Fonts', 'food-grocery-hub'),
		'type'    => 'select',
		'choices' => $food_grocery_hub_font_array,
	));

	//TP Preloader Option
	$wp_customize->add_section('food_grocery_hub_prelaoder_option',array(
		'title'         => __('TP Preloader Option', 'food-grocery-hub'),
		'priority' => 1,
		'panel' => 'food_grocery_hub_panel_id'
	) );

	$wp_customize->add_setting( 'food_grocery_hub_preloader_show_hide', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_preloader_show_hide', array(
		'label'       => esc_html__( 'Show / Hide Preloader Option', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_prelaoder_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_preloader_show_hide',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_tp_preloader_color1_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_preloader_color1_option', array(
			'label'     => __('Preloader First Ring Color', 'food-grocery-hub'),
	    'description' => __('It will change the complete theme preloader ring 1 color in one click.', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_prelaoder_option',
	    'settings' => 'food_grocery_hub_tp_preloader_color1_option',
  	)));

  	$wp_customize->add_setting( 'food_grocery_hub_tp_preloader_color2_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_preloader_color2_option', array(
			'label'     => __('Preloader Second Ring Color', 'food-grocery-hub'),
	    'description' => __('It will change the complete theme preloader ring 2 color in one click.', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_prelaoder_option',
	    'settings' => 'food_grocery_hub_tp_preloader_color2_option',
  	)));

  	$wp_customize->add_setting( 'food_grocery_hub_tp_preloader_bg_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_preloader_bg_color_option', array(
			'label'     => __('Preloader Background Color', 'food-grocery-hub'),
	    'description' => __('It will change the complete theme preloader bg color in one click.', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_prelaoder_option',
	    'settings' => 'food_grocery_hub_tp_preloader_bg_color_option',
  	)));

	//TP Color Option
	$wp_customize->add_section('food_grocery_hub_color_option',array(
     'title'         => __('TP Color Option', 'food-grocery-hub'),
     'priority' => 1,
     'panel' => 'food_grocery_hub_panel_id'
    ) );
    
	$wp_customize->add_setting( 'food_grocery_hub_tp_color_option_first', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_color_option_first', array(
			'label'     => __('Theme First Color', 'food-grocery-hub'),
	    'description' => __('It will change the complete theme color in one click.', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_color_option',
	    'settings' => 'food_grocery_hub_tp_color_option_first',
  	)));

  	$wp_customize->add_setting( 'food_grocery_hub_tp_color_option_second', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_color_option_second', array(
			'label'     => __('Theme Second Color', 'food-grocery-hub'),
	    'description' => __('It will change the complete theme color in one click.', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_color_option',
	    'settings' => 'food_grocery_hub_tp_color_option_second',
  	)));

	//TP Blog Option
	$wp_customize->add_section('food_grocery_hub_blog_option',array(
        'title' => __('TP Blog Option', 'food-grocery-hub'),
        'priority' => 1,
        'panel' => 'food_grocery_hub_panel_id'
    ) );

    $wp_customize->add_setting('food_grocery_hub_edit_blog_page_title',array(
		'default'=> 'Home',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_edit_blog_page_title',array(
		'label'	=> __('Change Blog Page Title','food-grocery-hub'),
		'section'=> 'food_grocery_hub_blog_option',
		'type'=> 'text'
	));

	/** Meta Order */
    $wp_customize->add_setting('blog_meta_order', array(
        'default' => array('date', 'author', 'comment','category'),
        'sanitize_callback' => 'food_grocery_hub_sanitize_sortable',
    ));
    $wp_customize->add_control(new Food_Grocery_Hub_Control_Sortable($wp_customize, 'blog_meta_order', array(
    	'label' => esc_html__('Meta Order', 'food-grocery-hub'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'food-grocery-hub') ,
        'section' => 'food_grocery_hub_blog_option',
        'choices' => array(
            'date' => __('date', 'food-grocery-hub') ,
            'author' => __('author', 'food-grocery-hub') ,
            'comment' => __('comment', 'food-grocery-hub') ,
            'category' => __('category', 'food-grocery-hub') ,
        ) ,
    )));

    $wp_customize->add_setting( 'food_grocery_hub_excerpt_count', array(
		'default'              => 35,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'food_grocery_hub_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'food_grocery_hub_excerpt_count', array(
		'label'       => esc_html__( 'Edit Excerpt Limit','food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('food_grocery_hub_read_more_text',array(
		'default'=> __('Read More','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_read_more_text',array(
		'label'	=> __('Edit Button Text','food-grocery-hub'),
		'section'=> 'food_grocery_hub_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_post_image_round', array(
	  'default' => '0',
      'sanitize_callback' => 'food_grocery_hub_sanitize_number_range',
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Range_Slider($wp_customize, 'food_grocery_hub_post_image_round', array(
       'section' => 'food_grocery_hub_blog_option',
      'label' => esc_html__('Edit Post Image Border Radius', 'food-grocery-hub'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 180,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('food_grocery_hub_post_image_width', array(
	  'default' => '',
      'sanitize_callback' => 'food_grocery_hub_sanitize_number_range',
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Range_Slider($wp_customize, 'food_grocery_hub_post_image_width', array(
       'section' => 'food_grocery_hub_blog_option',
      'label' => esc_html__('Edit Post Image Width', 'food-grocery-hub'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 367,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('food_grocery_hub_post_image_length', array(
	  'default' => '',
      'sanitize_callback' => 'food_grocery_hub_sanitize_number_range',
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Range_Slider($wp_customize, 'food_grocery_hub_post_image_length', array(
       'section' => 'food_grocery_hub_blog_option',
      'label' => esc_html__('Edit Post Image height', 'food-grocery-hub'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 900,
        'step' => 1
    )
	)));
	
	$wp_customize->add_setting( 'food_grocery_hub_remove_read_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_remove_read_button', array(
		'label'       => esc_html__( 'Show / Hide Read More Button', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_remove_read_button',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_remove_tags', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_remove_tags', array(
		'label'       => esc_html__( 'Show / Hide Tags Option', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_remove_tags',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_remove_category', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_remove_category', array(
		'label'       => esc_html__( 'Show / Hide Category Option', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_remove_category',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_remove_comment', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_remove_comment', array(
	 'label'       => esc_html__( 'Show / Hide Comment Form', 'food-grocery-hub' ),
	 'section'     => 'food_grocery_hub_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'food_grocery_hub_remove_comment',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_remove_related_post', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
 	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_remove_related_post', array(
	 'label'       => esc_html__( 'Show / Hide Related Post', 'food-grocery-hub' ),
	 'section'     => 'food_grocery_hub_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'food_grocery_hub_remove_related_post',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_related_post_heading',array(
		'default'=> __('Related Posts','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_related_post_heading',array(
		'label'	=> __('Edit Section Title','food-grocery-hub'),
		'section'=> 'food_grocery_hub_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'food_grocery_hub_related_post_per_page', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'food_grocery_hub_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'food_grocery_hub_related_post_per_page', array(
		'label'       => esc_html__( 'Related Post Per Page','food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 3,
			'max'              => 9,
		),
	) );

	$wp_customize->add_setting( 'food_grocery_hub_related_post_per_columns', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'food_grocery_hub_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'food_grocery_hub_related_post_per_columns', array(
		'label'       => esc_html__( 'Related Post Per Row','food-grocery-hub' ),
		'section'     => 'food_grocery_hub_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	) );

	$wp_customize->add_setting('food_grocery_hub_post_layout',array(
        'default' => 'image-content',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_post_layout',array(
        'type' => 'radio',
        'label'     => __('Post Layout', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_blog_option',
        'choices' => array(
            'image-content' => __('Media-Content','food-grocery-hub'),
            'content-image' => __('Content-Media','food-grocery-hub'),
        ),
	) );

	//MENU TYPOGRAPHY
	$wp_customize->add_section( 'food_grocery_hub_menu_typography', array(
    	'title'      => __( 'Menu Typography', 'food-grocery-hub' ),
    	'priority' => 2,
		'panel' => 'food_grocery_hub_panel_id'
	) );

	$wp_customize->add_setting('food_grocery_hub_menu_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'food_grocery_hub_sanitize_choices',
	));
	$wp_customize->add_control(	'food_grocery_hub_menu_font_family', array(
		'section' => 'food_grocery_hub_menu_typography',
		'label'   => __('Menu Fonts', 'food-grocery-hub'),
		'type'    => 'select',
		'choices' => $food_grocery_hub_font_array,
	));

	$wp_customize->add_setting('food_grocery_hub_menu_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_menu_font_weight',array(
     'type' => 'radio',
     'label'     => __('Font Weight', 'food-grocery-hub'),
     'section' => 'food_grocery_hub_menu_typography',
     'type' => 'select',
     'choices' => array(
         '100' => __('100','food-grocery-hub'),
         '200' => __('200','food-grocery-hub'),
         '300' => __('300','food-grocery-hub'),
         '400' => __('400','food-grocery-hub'),
         '500' => __('500','food-grocery-hub'),
         '600' => __('600','food-grocery-hub'),
         '700' => __('700','food-grocery-hub'),
         '800' => __('800','food-grocery-hub'),
         '900' => __('900','food-grocery-hub')
     ),
	) );

	$wp_customize->add_setting('food_grocery_hub_menu_text_tranform',array(
		'default' => '',
		'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
 	));
 	$wp_customize->add_control('food_grocery_hub_menu_text_tranform',array(
		'type' => 'select',
		'label' => __('Menu Text Transform','food-grocery-hub'),
		'section' => 'food_grocery_hub_menu_typography',
		'choices' => array(
		   'Uppercase' => __('Uppercase','food-grocery-hub'),
		   'Lowercase' => __('Lowercase','food-grocery-hub'),
		   'Capitalize' => __('Capitalize','food-grocery-hub'),
		),
	) );
	$wp_customize->add_setting('food_grocery_hub_menu_font_size', array(
	  'default' => '',
      'sanitize_callback' => 'food_grocery_hub_sanitize_number_range',
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Range_Slider($wp_customize, 'food_grocery_hub_menu_font_size', array(
        'section' => 'food_grocery_hub_menu_typography',
        'label' => esc_html__('Font Size', 'food-grocery-hub'),
        'input_attrs' => array(
          'min' => 0,
          'max' => 20,
          'step' => 1
    )
	)));

	$wp_customize->add_setting( 'food_grocery_hub_menu_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_menu_color', array(
			'label'     => __('Change Menu Color', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_menu_typography',
	    'settings' => 'food_grocery_hub_menu_color',
  	)));

	// Top Bar
	$wp_customize->add_section( 'food_grocery_hub_topbar', array(
    	'title'      => __( 'Header Details', 'food-grocery-hub' ),
    	'priority' => 2,
    	'description' => __( 'Add your contact details', 'food-grocery-hub' ),
		'panel' => 'food_grocery_hub_panel_id'
	) );

	$wp_customize->add_setting( 'food_grocery_hub_cart_language_translator', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_cart_language_translator', array(
		'label'       => esc_html__( 'Show / Hide Language Translator', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_topbar',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_cart_language_translator',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_delivery_time',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_delivery_time',array(
		'label'	=> __('Add Product Delivery Time','food-grocery-hub'),
		'section'=> 'food_grocery_hub_topbar',
		'type'=> 'text'
	));	
	
	$wp_customize->add_setting('food_grocery_hub_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_phone_number'
	));
	$wp_customize->add_control('food_grocery_hub_call',array(
		'label'	=> __('Add Phone Number','food-grocery-hub'),
		'section'=> 'food_grocery_hub_topbar',
		'type'=> 'text'
	));

	// Social Link
	$wp_customize->add_section( 'food_grocery_hub_social_media', array(
    	'title'      => __( 'Social Media Links', 'food-grocery-hub' ),
    	'description' => __( 'Add your Social Links', 'food-grocery-hub' ),
		'panel' => 'food_grocery_hub_panel_id',
      'priority' => 2,
	) );

	$wp_customize->add_setting( 'food_grocery_hub_header_ins_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_header_ins_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_social_media',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_header_ins_new_tab',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_instagram_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_instagram_url',array(
		'label'	=> __('Instagram Link','food-grocery-hub'),
		'section'=> 'food_grocery_hub_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('food_grocery_hub_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Icon_Changer(
        $wp_customize,'food_grocery_hub_instagram_icon',array(
		'label'	=> __('Instagram Icon','food-grocery-hub'),
		'transport' => 'refresh',
		'section'	=> 'food_grocery_hub_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'food_grocery_hub_header_fb_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_header_fb_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_social_media',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_header_fb_new_tab',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_facebook_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_facebook_url',array(
		'label'	=> __('Facebook Link','food-grocery-hub'),
		'section'=> 'food_grocery_hub_social_media',
		'type'=> 'url'
	));

	$wp_customize->selective_refresh->add_partial( 'food_grocery_hub_facebook_url', array(
		'selector' => '.social-media',
		'render_callback' => 'Food_Grocery_Hub_Customize_partial_food_grocery_hub_facebook_url',
	) );

	$wp_customize->add_setting('food_grocery_hub_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Icon_Changer(
        $wp_customize,'food_grocery_hub_facebook_icon',array(
		'label'	=> __('Facebook Icon','food-grocery-hub'),
		'transport' => 'refresh',
		'section'	=> 'food_grocery_hub_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'food_grocery_hub_header_linkedin_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_header_linkedin_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_social_media',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_header_linkedin_new_tab',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_linkedin_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_linkedin_url',array(
		'label'	=> __('Linkedin Link','food-grocery-hub'),
		'section'=> 'food_grocery_hub_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('food_grocery_hub_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Icon_Changer(
        $wp_customize,'food_grocery_hub_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','food-grocery-hub'),
		'transport' => 'refresh',
		'section'	=> 'food_grocery_hub_social_media',
		'type'		=> 'icon'
	)));


	$wp_customize->add_setting( 'food_grocery_hub_header_twt_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );

	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_header_twt_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_social_media',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_header_twt_new_tab',
	) ) );
	$wp_customize->add_setting('food_grocery_hub_twitter_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('food_grocery_hub_twitter_url',array(
		'label'	=> __('Twitter Link','food-grocery-hub'),
		'section'=> 'food_grocery_hub_social_media',
		'type'=> 'url'
	));
	$wp_customize->add_setting('food_grocery_hub_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Icon_Changer(
        $wp_customize,'food_grocery_hub_twitter_icon',array(
		'label'	=> __('Twitter Icon','food-grocery-hub'),
		'transport' => 'refresh',
		'section'	=> 'food_grocery_hub_social_media',
		'type'		=> 'icon'
	)));

	//home page slider
	$wp_customize->add_section( 'food_grocery_hub_slider_section' , array(
    	'title'      => __( 'Slider Section', 'food-grocery-hub' ),
    	'priority' => 2,
		'panel' => 'food_grocery_hub_panel_id'
	) );

	$wp_customize->add_setting( 'food_grocery_hub_slider_arrows', array(
		'default'           =>  false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_slider_arrows', array(
		'label'       => esc_html__( 'Show / Hide slider', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_slider_section',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_slider_arrows',
	) ) );

	for ( $food_grocery_hub_count = 1; $food_grocery_hub_count <= 4; $food_grocery_hub_count++ ) {

		$wp_customize->add_setting( 'food_grocery_hub_slider_page' . $food_grocery_hub_count, array(
			'default'           => '',
			'sanitize_callback' => 'food_grocery_hub_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'food_grocery_hub_slider_page' . $food_grocery_hub_count, array(
			'label'    => __( 'Select Slide Image Page', 'food-grocery-hub' ),
			'section'  => 'food_grocery_hub_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('food_grocery_hub_slider_short_heading',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_slider_short_heading',array(
		'label'	=> __('Add short Heading','food-grocery-hub'),
		'section'=> 'food_grocery_hub_slider_section',
		'type'=> 'text'
	));

	// Banner Section
	$wp_customize->add_section('food_grocery_hub_banner_main_sec', array(
	    'title'    => __('Our Product Section', 'food-grocery-hub'),
	    'panel'    => 'food_grocery_hub_panel_id',
	    'priority' => 3,
	));

	$wp_customize->add_setting( 'food_grocery_hub_banner_main_show', array(
		'default'           =>  false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_banner_main_show', array(
		'label'       => esc_html__( 'Show / Hide Product Section', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_banner_main_sec',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_banner_main_show',
	) ) );

	// banner1
	$wp_customize->add_setting('food_grocery_hub_product_banner_one',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'food_grocery_hub_product_banner_one',array(
	    'label' => __('Select Product Banner Image 1','food-grocery-hub'),
	     'section' => 'food_grocery_hub_banner_main_sec'
	)));

	$wp_customize->add_setting('food_grocery_hub_product_banner_one_title1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_one_title1',array(
		'label'	=> __('Add Product Banner Title 1','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_one_btn_text1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_one_btn_text1',array(
		'label'	=> esc_html__('Add Product Button Text for Banner 1','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_one_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_one_btn_link1',array(
		'label'	=> esc_html__('Add Product Button link for Banner 1','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'url'
	));

	// banner2
	$wp_customize->add_setting('food_grocery_hub_product_banner_two',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'food_grocery_hub_product_banner_two',array(
	    'label' => __('Select Product Banner Image 2','food-grocery-hub'),
	     'section' => 'food_grocery_hub_banner_main_sec'
	)));

	$wp_customize->add_setting('food_grocery_hub_product_banner_two_title1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_two_title1',array(
		'label'	=> __('Add Product Banner Title 2','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_two_btn_text1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_two_btn_text1',array(
		'label'	=> esc_html__('Add Product Button Text for Banner 2','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_two_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_two_btn_link1',array(
		'label'	=> esc_html__('Add Product Button link for Banner 2','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'url'
	));

	// banner3
	$wp_customize->add_setting('food_grocery_hub_product_banner_three',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'food_grocery_hub_product_banner_three',array(
	    'label' => __('Select Product Banner Image 3','food-grocery-hub'),
	     'section' => 'food_grocery_hub_banner_main_sec'
	)));

	$wp_customize->add_setting('food_grocery_hub_product_banner_three_title1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_three_title1',array(
		'label'	=> __('Add Product Banner Title 3','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_three_btn_text1',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_three_btn_text1',array(
		'label'	=> esc_html__('Add Product Button Text for Banner 3','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_product_banner_three_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('food_grocery_hub_product_banner_three_btn_link1',array(
		'label'	=> esc_html__('Add Product Button link for Banner 3','food-grocery-hub'),
		'section'=> 'food_grocery_hub_banner_main_sec',
		'type'=> 'url'
	));

	//footer
	$wp_customize->add_section('food_grocery_hub_footer_section',array(
		'title'	=> __('Footer Widget Settings','food-grocery-hub'),
		'panel' => 'food_grocery_hub_panel_id',
		'priority' => 4,
	));

	$wp_customize->add_setting('food_grocery_hub_footer_columns',array(
		'default'	=> 4,
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_footer_columns',array(
		'label'	=> __('Footer Widget Columns','food-grocery-hub'),
		'section'	=> 'food_grocery_hub_footer_section',
		'setting'	=> 'food_grocery_hub_footer_columns',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	));
	$wp_customize->add_setting( 'food_grocery_hub_tp_footer_bg_color_option', array(
		'default' => '#151515',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_tp_footer_bg_color_option', array(
		'label'     => __('Footer Widget Background Color', 'food-grocery-hub'),
		'description' => __('It will change the complete footer widget backgorund color.', 'food-grocery-hub'),
		'section' => 'food_grocery_hub_footer_section',
		'settings' => 'food_grocery_hub_tp_footer_bg_color_option',
	)));

	$wp_customize->add_setting('food_grocery_hub_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'food_grocery_hub_footer_widget_image',array(
       'label' => __('Footer Widget Background Image','food-grocery-hub'),
       'section' => 'food_grocery_hub_footer_section'
	)));

	//footer widget title font size
	$wp_customize->add_setting('food_grocery_hub_footer_widget_title_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_footer_widget_title_font_size',array(
		'label'	=> __('Change Footer Widget Title Font Size in PX','food-grocery-hub'),
		'section'	=> 'food_grocery_hub_footer_section',
	    'setting'	=> 'food_grocery_hub_footer_widget_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'food_grocery_hub_footer_widget_title_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_footer_widget_title_color', array(
			'label'     => __('Change Footer Widget Title Color', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_footer_section',
	    'settings' => 'food_grocery_hub_footer_widget_title_color',
  	)));
  	
	$wp_customize->add_setting( 'food_grocery_hub_return_to_header', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_return_to_header', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_footer_section',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_return_to_header',
	) ) );

	$wp_customize->add_setting('food_grocery_hub_return_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Food_Grocery_Hub_Icon_Changer(
       $wp_customize,'food_grocery_hub_return_icon',array(
		'label'	=> __('Return to header Icon','food-grocery-hub'),
		'transport' => 'refresh',
		'section'	=> 'food_grocery_hub_footer_section',
		'type'		=> 'icon'
	)));

	//footer
	$wp_customize->add_section('food_grocery_hub_footer_copyright_section',array(
		'title'	=> __('Footer Copyright Settings','food-grocery-hub'),
		'description'	=> __('Add copyright text.','food-grocery-hub'),
		'panel' => 'food_grocery_hub_panel_id',
		'priority' => 5,
	));

	$wp_customize->add_setting('food_grocery_hub_footer_text',array(
		'default'	=> 'Food Grocery Hub WordPress Theme',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_footer_text',array(
		'label'	=> __('Copyright Text','food-grocery-hub'),
		'section'	=> 'food_grocery_hub_footer_copyright_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('food_grocery_hub_footer_copyright_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_footer_copyright_font_size',array(
		'label'	=> __('Change Footer Copyright Font Size in PX','food-grocery-hub'),
		'section'	=> 'food_grocery_hub_footer_copyright_section',
	    'setting'	=> 'food_grocery_hub_footer_copyright_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'food_grocery_hub_footer_copyright_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_footer_copyright_text_color', array(
			'label'     => __('Change Footer Copyright Text Color', 'food-grocery-hub'),
	    'section' => 'food_grocery_hub_footer_copyright_section',
	    'settings' => 'food_grocery_hub_footer_copyright_text_color',
  	)));

  	$wp_customize->add_setting('food_grocery_hub_footer_copyright_top_bottom_padding',array(
		'default'	=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_footer_copyright_top_bottom_padding',array(
		'label'	=> __('Change Footer Copyright Padding in PX','food-grocery-hub'),
		'section'	=> 'food_grocery_hub_footer_copyright_section',
	    'setting'	=> 'food_grocery_hub_footer_copyright_top_bottom_padding',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	// Add Settings and Controls for Scroll top
	$wp_customize->add_setting('food_grocery_hub_copyright_text_position',array(
        'default' => 'Center',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_copyright_text_position',array(
        'type' => 'radio',
        'label'     => __('Copyright Text Position', 'food-grocery-hub'),
        'description'   => __('This option work for Copyright', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_footer_copyright_section',
        'choices' => array(
            'Right' => __('Right','food-grocery-hub'),
            'Left' => __('Left','food-grocery-hub'),
            'Center' => __('Center','food-grocery-hub')
        ),
	) );

	//Mobile resposnsive
	$wp_customize->add_section('food_grocery_hub_mobile_media_option',array(
		'title'         => __('Mobile Responsive media', 'food-grocery-hub'),
		'description' => __('Control will not function if the toggle in the main settings is off.', 'food-grocery-hub'),
		'priority' => 5,
		'panel' => 'food_grocery_hub_panel_id'
	) );

	$wp_customize->add_setting( 'food_grocery_hub_return_to_header_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_return_to_header_mob', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_return_to_header_mob',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_slider_buttom_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_slider_buttom_mob', array(
		'label'       => esc_html__( 'Show / Hide Slider Button', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_slider_buttom_mob',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_related_post_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_related_post_mob', array(
		'label'       => esc_html__( 'Show / Hide Related Post', 'food-grocery-hub' ),
		'section'     => 'food_grocery_hub_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_related_post_mob',
	) ) );

    // Add Settings and Controls for Scroll top
	$wp_customize->add_setting('food_grocery_hub_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_scroll_top_position',array(
        'type' => 'radio',
        'label'     => __('Scroll to top Position', 'food-grocery-hub'),
        'description'   => __('This option work for scroll to top', 'food-grocery-hub'),
        'section' => 'food_grocery_hub_footer_section',
        'choices' => array(
            'Right' => __('Right','food-grocery-hub'),
            'Left' => __('Left','food-grocery-hub'),
            'Center' => __('Center','food-grocery-hub')
        ),
	) );
	
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	//site Title
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'Food_Grocery_Hub_Customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'Food_Grocery_Hub_Customize_partial_blogdescription',
	) );

	$wp_customize->add_setting( 'food_grocery_hub_site_title', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_site_title', array(
		'label'       => esc_html__( 'Show / Hide Site Title', 'food-grocery-hub' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_site_title',
	) ) );

	// logo site title size
	$wp_customize->add_setting('food_grocery_hub_site_title_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_site_title_font_size',array(
		'label'	=> __('Site Title Font Size in PX','food-grocery-hub'),
		'section'	=> 'title_tagline',
		'setting'	=> 'food_grocery_hub_site_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
		    'step'             => 1,
			'min'              => 0,
			'max'              => 30,
			),
	));

	$wp_customize->add_setting( 'food_grocery_hub_site_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_site_tagline_color', array(
			'label'     => __('Change Site Title Color', 'food-grocery-hub'),
	    'section' => 'title_tagline',
	    'settings' => 'food_grocery_hub_site_tagline_color',
  	)));

	$wp_customize->add_setting( 'food_grocery_hub_site_tagline', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_site_tagline', array(
		'label'       => esc_html__( 'Show / Hide Site Tagline', 'food-grocery-hub' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_site_tagline',
	) ) );

	// logo site tagline size
	$wp_customize->add_setting('food_grocery_hub_site_tagline_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_site_tagline_font_size',array(
		'label'	=> __('Site Tagline Font Size in PX','food-grocery-hub'),
		'section'	=> 'title_tagline',
		'setting'	=> 'food_grocery_hub_site_tagline_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 30,
		),
	));

	$wp_customize->add_setting( 'food_grocery_hub_logo_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_logo_tagline_color', array(
			'label'     => __('Change Site Tagline Color', 'food-grocery-hub'),
	    'section' => 'title_tagline',
	    'settings' => 'food_grocery_hub_logo_tagline_color',
  	)));

    $wp_customize->add_setting('food_grocery_hub_logo_width',array(
	   'default' => 80,
	   'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_logo_width',array(
		'label'	=> esc_html__('Here You Can Customize Your Logo Size','food-grocery-hub'),
		'section'	=> 'title_tagline',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('food_grocery_hub_per_columns',array(
		'default'=> 3,
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_per_columns',array(
		'label'	=> __('Product Per Row','food-grocery-hub'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting('food_grocery_hub_product_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'food_grocery_hub_sanitize_number_absint'
	));
	$wp_customize->add_control('food_grocery_hub_product_per_page',array(
		'label'	=> __('Product Per Page','food-grocery-hub'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'food_grocery_hub_product_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Shop Page Sidebar', 'food-grocery-hub' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_product_sidebar',
	) ) );
	$wp_customize->add_setting('food_grocery_hub_sale_tag_position',array(
        'default' => 'right',
        'sanitize_callback' => 'food_grocery_hub_sanitize_choices'
	));
	$wp_customize->add_control('food_grocery_hub_sale_tag_position',array(
        'type' => 'radio',
        'label'     => __('Sale Badge Position', 'food-grocery-hub'),
        'description'   => __('This option work for Archieve Products', 'food-grocery-hub'),
        'section' => 'woocommerce_product_catalog',
        'choices' => array(
            'left' => __('Left','food-grocery-hub'),
            'right' => __('Right','food-grocery-hub'),
        ),
	) );
	$wp_customize->add_setting( 'food_grocery_hub_single_product_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_single_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Product Page Sidebar', 'food-grocery-hub' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_single_product_sidebar',
	) ) );

	$wp_customize->add_setting( 'food_grocery_hub_related_product', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'food_grocery_hub_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Food_Grocery_Hub_Toggle_Control( $wp_customize, 'food_grocery_hub_related_product', array(
		'label'       => esc_html__( 'Show / Hide related product', 'food-grocery-hub' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'food_grocery_hub_related_product',
	) ) );

	
	//Page template settings
	$wp_customize->add_panel( 'food_grocery_hub_page_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Page Template Settings', 'food-grocery-hub' ),
	    'description' => __( 'Description of what this panel does.', 'food-grocery-hub' ),
	) );

	// 404 PAGE
	$wp_customize->add_section('food_grocery_hub_404_page_section',array(
		'title'         => __('404 Page', 'food-grocery-hub'),
		'description'   => 'Here you can customize 404 Page content.',
		'panel' => 'food_grocery_hub_page_panel_id'
	) );

	$wp_customize->add_setting('food_grocery_hub_edit_404_title',array(
		'default'=> __('Oops! That page cant be found.','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('food_grocery_hub_edit_404_title',array(
		'label'	=> __('Edit Title','food-grocery-hub'),
		'section'=> 'food_grocery_hub_404_page_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('food_grocery_hub_edit_404_text',array(
		'default'=> __('It looks like nothing was found at this location. Maybe try a search?','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_edit_404_text',array(
		'label'	=> __('Edit Text','food-grocery-hub'),
		'section'=> 'food_grocery_hub_404_page_section',
		'type'=> 'text'
	));

	// Search Results
	$wp_customize->add_section('food_grocery_hub_no_result_section',array(
		'title'         => __('Search Results', 'food-grocery-hub'),
		'description'   => 'Here you can customize Search Result content.',
		'panel' => 'food_grocery_hub_page_panel_id'
	) );

	$wp_customize->add_setting('food_grocery_hub_edit_no_result_title',array(
		'default'=> __('Nothing Found','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('food_grocery_hub_edit_no_result_title',array(
		'label'	=> __('Edit Title','food-grocery-hub'),
		'section'=> 'food_grocery_hub_no_result_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('food_grocery_hub_edit_no_result_text',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','food-grocery-hub'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('food_grocery_hub_edit_no_result_text',array(
		'label'	=> __('Edit Text','food-grocery-hub'),
		'section'=> 'food_grocery_hub_no_result_section',
		'type'=> 'text'
	));

	 // Header Image Height
    $wp_customize->add_setting(
        'food_grocery_hub_header_image_height',
        array(
            'default'           => 400,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'food_grocery_hub_header_image_height',
        array(
            'label'       => esc_html__( 'Header Image Height', 'food-grocery-hub' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the height of the header image. Default is 350px.', 'food-grocery-hub' ),
            'input_attrs' => array(
                'min'  => 220,
                'max'  => 1000,
                'step' => 1,
            ),
        )
    );

    // Header Background Position
    $wp_customize->add_setting(
        'food_grocery_hub_header_background_position',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'food_grocery_hub_header_background_position',
        array(
            'label'       => esc_html__( 'Header Background Position', 'food-grocery-hub' ),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'     => array(
                'top'    => esc_html__( 'Top', 'food-grocery-hub' ),
                'center' => esc_html__( 'Center', 'food-grocery-hub' ),
                'bottom' => esc_html__( 'Bottom', 'food-grocery-hub' ),
            ),
            'description' => esc_html__( 'Choose how you want to position the header image.', 'food-grocery-hub' ),
        )
    );

    // Header Image Parallax Effect
    $wp_customize->add_setting(
        'food_grocery_hub_header_background_attachment',
        array(
            'default'           => 1,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'food_grocery_hub_header_background_attachment',
        array(
            'label'       => esc_html__( 'Header Image Parallax', 'food-grocery-hub' ),
            'section'     => 'header_image',
            'type'        => 'checkbox',
            'description' => esc_html__( 'Add a parallax effect on page scroll.', 'food-grocery-hub' ),
        )
    );

    $wp_customize->add_setting(
        'food_grocery_hub_header_image_title_font_size',
        array(
            'default'           => 62,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'food_grocery_hub_header_image_title_font_size',
        array(
            'label'       => esc_html__( 'Change Header Image Title Font Size', 'food-grocery-hub' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the font Size of the header image title. Default is 32px.', 'food-grocery-hub' ),
            'input_attrs' => array(
                'min'  => 10,
                'max'  => 200,
                'step' => 1,
            ),
        )
    );

	$wp_customize->add_setting( 'food_grocery_hub_header_image_title_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_grocery_hub_header_image_title_text_color', array(
			'label'     => __('Change Header Image Title Color', 'food-grocery-hub'),
	    'section' => 'header_image',
	    'settings' => 'food_grocery_hub_header_image_title_text_color',
  	)));

}
add_action( 'customize_register', 'Food_Grocery_Hub_Customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Food Grocery Hub 1.0
 * @see Food_Grocery_Hub_Customize_register()
 *
 * @return void
 */
function Food_Grocery_Hub_Customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Food Grocery Hub 1.0
 * @see Food_Grocery_Hub_Customize_register()
 *
 * @return void
 */
function Food_Grocery_Hub_Customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! defined( 'FOOD_GROCERY_HUB_PRO_THEME_NAME' ) ) {
	define( 'FOOD_GROCERY_HUB_PRO_THEME_NAME', esc_html__( 'Food Grocery Pro Theme', 'food-grocery-hub'));
}
if ( ! defined( 'FOOD_GROCERY_HUB_PRO_THEME_URL' ) ) {
	define( 'FOOD_GROCERY_HUB_PRO_THEME_URL', esc_url('https://www.themespride.com/products/grocery-store-wordpress-theme', 'food-grocery-hub'));
}
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Food_Grocery_Hub_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Food_Grocery_Hub_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Food_Grocery_Hub_Customize_Section_Pro(
				$manager,
				'food_grocery_hub_section_pro',
				array(
					'priority'   => 9,
					'title'    => FOOD_GROCERY_HUB_PRO_THEME_NAME,
					'pro_text' => esc_html__( 'Upgrade Pro', 'food-grocery-hub' ),
					'pro_url'  => esc_url( FOOD_GROCERY_HUB_PRO_THEME_URL, 'food-grocery-hub' ),
				)
			)
		);

	}
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'food-grocery-hub-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'food-grocery-hub-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Food_Grocery_Hub_Customize::get_instance();