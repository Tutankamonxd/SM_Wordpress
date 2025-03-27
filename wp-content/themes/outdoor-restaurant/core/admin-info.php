<?php
/**
 * Theme Admin Info class
 */
class Outdoor_Restaurant_Admin_Info {
    /**
     * Initialize the theme
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_menu'));
        add_action('after_switch_theme', array($this, 'reset_notification_dismissal'));
        $this->check_rt_easy_builder_freemius();
    }
    
    /**
     * Add theme page
     */
    public function add_menu() {
        add_theme_page(
            esc_html__('Outdoor Restaurant Theme', 'outdoor-restaurant'),
            esc_html__('Outdoor Restaurant Theme', 'outdoor-restaurant'),
            'edit_theme_options',
            'outdoor-restaurant',
            array($this, 'theme_page_display')
        );
    }

    /**
     * Display About page
     */
    public function theme_page_display() {
        $theme = wp_get_theme();
        include_once dirname( __FILE__ ) . '/../core/admin/theme-info.php';
    }
       
    public function check_rt_easy_builder_freemius() {
        // Add your actions
        add_action( 'admin_notices', array( $this, 'compatible_check' ) );
        add_action( 'admin_footer', array( $this, 'admin_notice_script' ) );
        add_action( 'wp_ajax_dismiss_outdoor_restaurant_notification', array( $this, 'dismiss_notification_ajax_handler' ) );
    }

    /**
     * Reset the notification dismissal state when the theme is activated
     */
    public function reset_notification_dismissal() {
        delete_transient('outdoor_restaurant_notification_dismissed');
    }

    /**
     * Check compatibility and display notification
     */
    public function compatible_check() {
        $dismissed = get_option('outdoor_restaurant_notification_dismissed');
        if (!$dismissed) {
            include_once dirname( __FILE__ ) . '/../core/admin/theme-notice.php';
        }
    }
    
    /**
     * Dismiss the notification
     */
    public function dismiss_notification() {
        update_option('outdoor_restaurant_notification_dismissed', true);
    }
    
    /**
     * Dismiss the notification via AJAX
     */
    public function dismiss_notification_ajax_handler() {
        check_ajax_referer('dismiss_notification_nonce', 'nonce');
        $this->dismiss_notification();
        echo 'success'; // Add this line to send a response
        wp_die();
    }

    /**
     * Enqueue admin notice script
     */
    public function admin_notice_script() {
        ?>
        <script>
            (function($) {
                $(document).on('click', '.notice.is-dismissible .notice-dismiss', function() {
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'dismiss_outdoor_restaurant_notification',
                            nonce: '<?php echo wp_create_nonce( 'dismiss_notification_nonce' ); ?>'
                        }
                    });
                });
            })(jQuery);
        </script>
        <?php
    }

}

new Outdoor_Restaurant_Admin_Info();