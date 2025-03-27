<?php
/*
* @Pakage sliderX.
*/
if( !defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}

global $wpdb;
// Check class already exist or not
if( !class_exists('SLIDERX_DB_Management')){

    class SLIDERX_DB_Management{
        
        // Initial Project Setup Table
        public function sliderX_newProjectSetup() {
            global $wpdb;
            // Get the correct charset collate
            $charset_collate = $wpdb->get_charset_collate();
            // Check if the table exists
            $table_name = "{$wpdb->prefix}sliderx_initial_projectsetup";
            $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));

            // Create the table if it does not exist
            if (!$table_exists) {
                $sql = "CREATE TABLE $table_name (
                        `id` int(10) NOT NULL AUTO_INCREMENT,
                        `projectName` VARCHAR(200) NOT NULL,
                        `sliderType` VARCHAR(200) NOT NULL,
                        PRIMARY KEY (`id`)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }
        }

        // sliderX - Slides data Table
        public function sliderX_dataSave() {
            global $wpdb;

            // Get the correct charset collate
            $charset_collate = $wpdb->get_charset_collate();
            // Check if the table exists
            $table_name = "{$wpdb->prefix}sliderx_data";
            $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));

            // Create the table if it does not exist
            if (!$table_exists) {
                $sql = "CREATE TABLE $table_name (
                        `id` int(10) NOT NULL AUTO_INCREMENT,
                        `sliderId` int(15) NOT NULL,
                        `sliderData` TEXT NOT NULL,
                        PRIMARY KEY (`id`)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }
        }

        // sliderX - Settings data Table
        public function sliderX_settings() {
            global $wpdb;
            // Get the correct charset collate
            $charset_collate = $wpdb->get_charset_collate();
            // Check if the table exists
            $table_name = "{$wpdb->prefix}sliderx_settings";
            $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));
        
            // Create the table if it does not exist
            if (!$table_exists) {
                $sql = "CREATE TABLE $table_name (
                        `id` int(10) NOT NULL AUTO_INCREMENT,
                        `sliderId` int(15) NOT NULL,
                        `sliderType` VARCHAR(30) NOT NULL,
                        `sliderTitle` VARCHAR(150) NOT NULL,
                        `general` TEXT NOT NULL,
                        `content` TEXT DEFAULT NULL,
                        `navigation` TEXT DEFAULT NULL,
                        `pagination` TEXT DEFAULT NULL,
                        `api_url` TEXT DEFAULT NULL,
                        PRIMARY KEY (`id`)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                if (dbDelta($sql) === false) {
                    error_log("Error creating table: " . $wpdb->last_error);
                }
            }
        }

        // sliderX - Settings data Table
        public function sliderX_styleSettings() {
            global $wpdb;
        
            // Get the correct charset collate
            $charset_collate = $wpdb->get_charset_collate();
            // Check if the table exists
            $table_name = "{$wpdb->prefix}sliderx_style_settings";
            $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));
        
            // Create the table if it does not exist
            if (!$table_exists) {
                $sql = "CREATE TABLE $table_name (
                        `id` int(10) NOT NULL AUTO_INCREMENT,
                        `sliderId` int(15) NOT NULL,
                        `general` TEXT DEFAULT NULL,
                        `content` TEXT DEFAULT NULL,
                        `navigation` TEXT DEFAULT NULL,
                        `pagination` TEXT DEFAULT NULL,
                        PRIMARY KEY (`id`)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                if (dbDelta($sql) === false) {
                    error_log("Error creating table: " . $wpdb->last_error);
                }
            }
        }
    } // End of Class.

}

