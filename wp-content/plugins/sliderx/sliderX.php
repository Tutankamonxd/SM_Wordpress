<?php
/**
 * Plugin Name: SliderX
 * Description: Create Attractive slider / Carousel on WordPress website easily.
 * Version: 1.0.5
 * Author: Spark Coder
 * Author URI: https://sparkcoder.com
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Slug: sliderx
 * Text Domain: sliderx
 * Domain Path: /languages
 */


if( ! defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}

/*========================
CONSTANT
=========================*/
define('SLIDERX_DIR_PATH', plugin_dir_path( __FILE__ ));
define('SLIDERX_DIR_URI', plugin_dir_url( __FILE__ ));

// Load Text domain
function sliderx_plugin_textdomain() {
    load_plugin_textdomain('sliderx', false, SLIDERX_DIR_URI . '/languages');
}
// Hook into the init action and load the text domain
add_action('init', 'sliderx_plugin_textdomain');
// Check if SliderX Free plugin is active
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
// Check if the pro version is active
if (!is_plugin_active('sliderx-pro/sliderx-pro.php')) {
// Check class exist or not
    if( !class_exists('SLIDERX_GENERATOR_CORE')){
        class SLIDERX_GENERATOR_CORE{

            public function __construct(){
                /******* Includes Files *******/
                require( SLIDERX_DIR_PATH.'includes/assets.php' );
                // require( SLIDERX_DIR_PATH.'views/public/shortcode/sliderx-shortcode.php' );
                require_once plugin_dir_path(__FILE__) . 'views/public/shortcode/sliderx-shortcode.php';
                require( SLIDERX_DIR_PATH.'includes/deactivation.php' );
                // require( SLIDERX_DIR_PATH.'includes/api/sliderx-api.php' );
                // Dashboard Menu
                require( SLIDERX_DIR_PATH.'views/admin/sliderx-admin-menu.php' );

                /******* Includes Classes *******/
                require( SLIDERX_DIR_PATH.'classes/SliderX-ajax-handling.php' );  
                require( SLIDERX_DIR_PATH.'classes/SliderX_dbManagement.php' );  

                /******* Hook *******/
                $db_management = new SLIDERX_DB_Management();
                register_activation_hook( __FILE__, array( $db_management, 'sliderX_newProjectSetup' ));
                register_activation_hook( __FILE__, array( $db_management, 'sliderX_dataSave' ));
                register_activation_hook( __FILE__, array( $db_management, 'sliderX_settings' ));
                register_activation_hook( __FILE__, array( $db_management, 'sliderX_styleSettings' ));
                register_uninstall_hook( __FILE__, 'sliderX_dbTableCleaner');
                
                add_shortcode('sliderX', 'sliderX_shortcode' );
                add_action( 'admin_enqueue_scripts', 'sliderx_admin_assets');
                add_action( 'wp_enqueue_scripts', 'sliderX_frontend_assets_free');
                add_action( 'admin_menu', 'sliderx_settings_admin_menu_page' );

                /*======= Ajax Request =====*/
                $ajaxHandler = new SLIDERX_Ajax_Handle();
                add_action('wp_ajax_initial_setup_action', array( $ajaxHandler, 'sliderX_initialProjectSetup') );
                add_action('wp_ajax_sliderXData_action', array( $ajaxHandler, 'sliderX_dataSave') );
                add_action('wp_ajax_sliderXSettings_action', array( $ajaxHandler, 'sliderX_settingsSave') );
                add_action('wp_ajax_update_sliderXData_action', array( $ajaxHandler, 'sliderX_dataUpdate') );
                add_action('wp_ajax_update_sliderXSettings_action', array( $ajaxHandler, 'sliderX_settingsUpdate') );
                add_action('wp_ajax_delete_sliderx_action', array( $ajaxHandler, 'sliderX_slider_delete') );
                add_action('wp_ajax_delete_sliderxItem_action', array( $ajaxHandler, 'sliderX_sliderItem_delete') );
            }
        }
        $SLIDERX_GENERATOR_CORE = new SLIDERX_GENERATOR_CORE();
    }

}



// Sanitizer Function
if (!function_exists('sliderx_Sanitize')) {
    function sliderx_Sanitize($data) {
        if (is_array($data)) {
            // Sanitize each element of the array
            return array_map('sliderx_Sanitize', $data);
        } elseif (is_object($data)) {
            // Sanitize each property of the object
            foreach ($data as $key => $value) {
                $data->$key = sliderx_Sanitize($value);
            }
            return $data;
        } elseif (is_string($data)) {
            // Use appropriate string sanitization functions
            return sanitize_text_field($data);
        } elseif (is_numeric($data)) {
            // Use appropriate numeric sanitization functions
            return intval($data);
        } else {
            // For other types,
            return $data;
        }
    }
}


add_action('admin_notices', function() {
    // Check if the current page is your plugin page
    if (is_sliderx_plugin_page()) {
        global $wp_filter;

        // Remove admin notices
        if (isset($wp_filter['admin_notices'])) {
            unset($wp_filter['admin_notices']);
        }
        if (isset($wp_filter['all_admin_notices'])) {
            unset($wp_filter['all_admin_notices']);
        }
    }
}, 100);

/**
 * Check if the current page is the SliderX plugin page.
 *
 * @return bool
 */
if (!function_exists('is_sliderx_plugin_page')) {
    function is_sliderx_plugin_page() {
        $screen = get_current_screen();
        return (
            $screen && 
            $screen->base === ' toplevel_page_sliderx' &&
            $screen->id === 'toplevel_page_sliderx ' && // Adjust this to your plugin's page ID
            isset($_GET['sliderx']) && $_GET['sliderx'] === 'update' &&
            isset($_GET['sliderxId'])
        );
    }
}


/**
 * Register Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_sliderx_widget_free( $widgets_manager ) {

	require_once( SLIDERX_DIR_PATH . 'includes/widgets/elementorAddons/Shortcode_Widget.php' );

	$widgets_manager->register( new \SliderX_Widget() );

}
add_action( 'elementor/widgets/register', 'register_sliderx_widget_free' );