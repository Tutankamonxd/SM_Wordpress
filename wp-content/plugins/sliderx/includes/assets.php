<?php
/*
* @Pakage SliderX.
*/
if( !defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}

 // Check if function already exist.
if( ! function_exists('sliderx_admin_assets') ){
    // Admin Assets
    function sliderx_admin_assets() {
        if (is_admin()) {
            wp_enqueue_media();
        }

        $screen = get_current_screen();
        if ($screen && $screen->id === 'toplevel_page_sliderx') {

        wp_register_style( 'sliderx-bootsrap-css', SLIDERX_DIR_URI .'assets/css/bootstrap.min.css');
        // Coloris
        wp_register_style('sliderx-coloris-css', SLIDERX_DIR_URI .'assets/css/coloris.min.css');
        wp_register_style('sliderx-style', SLIDERX_DIR_URI .'assets/css/sliderx.css');
        wp_register_style('sliderx-custom-style', SLIDERX_DIR_URI .'assets/css/sliderx-style.css');

        // Google Fonts
        wp_enqueue_style("gFonts-satisfy", '//fonts.googleapis.com/css2?family=Agbalumo&family=Satisfy&display=swap');
        wp_enqueue_style("gFonts-great", '//fonts.googleapis.com/css2?family=Agbalumo&family=Great+Vibes&family=Satisfy&display=swap');

        // Register the script
        wp_register_script( 'sliderx-bootsrap-js', SLIDERX_DIR_URI .'assets/js/bootstrap.min.js', array('jquery'), 'v5.3.0', true );
        // Coloris
        wp_register_script( 'sliderx-coloris-js', SLIDERX_DIR_URI . 'assets/js/coloris.min.js', array(), 'v0.24.0', true );
        wp_register_script( 'sliderx-custom-script',  SLIDERX_DIR_URI .'assets/js/sliderx-script.js', array('jquery'), '1.0.0', true );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'current_userId' => get_current_user_id(),
            'nonce' => wp_create_nonce( 'sliderx_initial_nonce' )
        );
        wp_localize_script( 'sliderx-custom-script', 'AjaxObj', $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'current_userId' => get_current_user_id(),
            'nonce' => wp_create_nonce( 'sliderXData_nonce' )
        );
        wp_localize_script( 'sliderx-custom-script', 'ObjSlide', $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'current_userId' => get_current_user_id(),
            'nonce' => wp_create_nonce( 'sliderXSettings_nonce' )
        );
        wp_localize_script( 'sliderx-custom-script', 'settingsObj', $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'current_userId' => get_current_user_id(),
            'nonce' => wp_create_nonce( 'sliderXSettingsUpdate_nonce' )
        );
        wp_localize_script( 'sliderx-custom-script', 'updateSettings', $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'current_userId' => get_current_user_id(),
            'nonce' => wp_create_nonce( 'sliderXSlideUpdate_nonce' )
        );
        wp_localize_script( 'sliderx-custom-script', 'updateData', $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'sliderx_delete_none' )
        );
        wp_localize_script( 'sliderx-custom-script', 'sliderDelObj',  $args );

        $args = array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'sliderxItem_delete_none' )
        );
        wp_localize_script( 'sliderx-custom-script', 'sliderItemObj',  $args );

        wp_enqueue_style('sliderx-bootsrap-css');
        wp_enqueue_style('sliderx-coloris-css');
        wp_enqueue_style('sliderx-style');
        wp_enqueue_style('sliderx-custom-style');
        // Enqueue the script
        wp_enqueue_script( 'sliderx-bootsrap-js' );
        wp_enqueue_script( 'sliderx-coloris-js' );
        wp_enqueue_script( 'sliderx-custom-script' );
    }

    }

}


 // Check if function already exists

if ( ! function_exists('sliderX_frontend_assets_free') ) {
    // Shortcode Assets
    function sliderX_frontend_assets_free() {
        global $post, $wpdb;

        // Check if the function esc_like exists, and include it if not
        if ( ! function_exists( 'esc_like' ) ) {
            require_once( ABSPATH . WPINC . '/formatting.php' );
        }

        // Define the shortcodes to look for
        $shortcodes = ['sliderX', 'sliderX_test']; // Add your shortcodes here

        // Determine whether this page contains any of the specified shortcodes
        $shortcode_found = false;

        // Check if Elementor editor is active
        $is_elementor_editor = isset($_GET['action']) && $_GET['action'] === 'elementor';

        if (isset($post) && !is_null($post)) {
            foreach ($shortcodes as $shortcode) {
                if (has_shortcode($post->post_content, $shortcode)) {
                    $shortcode_found = true;
                    break;
                }
            }

            if (!$shortcode_found && isset($post->ID)) {
                foreach ($shortcodes as $shortcode) {
                    $result = $wpdb->get_var($wpdb->prepare(
                        "SELECT count(*) FROM $wpdb->postmeta " .
                        "WHERE post_id = %d AND meta_value LIKE %s",
                        $post->ID,
                        '%' . $wpdb->esc_like($shortcode) . '%'
                    ));
                    if (!empty($result)) {
                        $shortcode_found = true;
                        break;
                    }
                }
            }
        }

         if ( $shortcode_found || $is_elementor_editor ) {
            wp_register_style( 'sliderx-swiper-css', SLIDERX_DIR_URI . 'assets/css/swiper.min.css' );
            wp_register_style( 'sliderx-css', SLIDERX_DIR_URI . 'assets/css/sliderx.css' );
            wp_register_style( 'sliderx-style', SLIDERX_DIR_URI . 'assets/css/sliderx-style.css' );

            // Register the script
            wp_register_script( 'sliderx-swiper-js', SLIDERX_DIR_URI . 'assets/js/swiper.min.js', array(), '11.1.4', true );
            wp_register_script( 'sliderx-custom-script', SLIDERX_DIR_URI . 'assets/js/sliderx-script.js', array('jquery'), time(), true );

            wp_register_script( 'sliderx-config-js', SLIDERX_DIR_URI . 'assets/js/sliderx.config.js', array('sliderx-swiper-js'), time(), true );

            $configData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sliderx_settings", ARRAY_A);
            wp_localize_script( 'sliderx-config-js', 'configObj', array('settings' => $configData) );

            wp_enqueue_style( 'sliderx-swiper-css' );
            wp_enqueue_style( 'sliderx-css' );
            wp_enqueue_style( 'sliderx-style' );

            // Enqueue the script
            wp_enqueue_script( 'sliderx-swiper-js' );
            wp_enqueue_script( 'sliderx-config-js' );
            wp_enqueue_script( 'sliderx-custom-script' );
        }
    }
}
