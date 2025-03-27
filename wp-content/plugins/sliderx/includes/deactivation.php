<?php
/*
* @Pakage sliderX.
*/

if( !defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}
// Define the function to clean up database tables

if (!function_exists('sliderX_dbTableCleaner')) {
    function sliderX_dbTableCleaner() {

        global $wpdb;
        // Check if the current user has the necessary permissions
        if (!current_user_can('activate_plugins')) {
            return;
        }
        // Define an array of table names
        $table_names = array(
            'sliderx_initial_projectsetup',
            'sliderx_data',
            'sliderx_settings',
            'sliderx_style_settings',
        );
        // Delete plugin's database tables
        foreach ($table_names as $table) {
            $table_name = $wpdb->prefix . $table;
            $deleteQuery = $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %s", $table_name));
            if ($wpdb->last_error !== '') {
                // Handle error if any
                error_log("Error dropping table {$table_name}: {$wpdb->last_error}");
                // You might also want to display feedback to the user in case of errors
            }
        }
    }
}

