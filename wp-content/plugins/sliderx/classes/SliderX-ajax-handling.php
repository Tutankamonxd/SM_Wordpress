<?php 
/*
* @Pakage sliderX.
*/
if( !defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}

// Check class already exist or not
if( !class_exists('SLIDERX_Ajax_Handle')){
    
    class SLIDERX_Ajax_Handle{

        // Initial Slider Setup
        public function sliderX_initialProjectSetup() {

            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderx_initial_nonce' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }

            $projectName = isset($_POST["projectName"]) ? sanitize_text_field( $_POST["projectName"] ) : '';
            $sliderType = isset($_POST["sliderType"]) ? sanitize_text_field( $_POST["sliderType"] ) : '';
 
            $table_name = "{$wpdb->prefix}sliderx_initial_projectsetup";
            $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

            if ( $table_exists ) {
                $wpdb->insert($table_name, array(
                    'projectName' => $projectName,
                    'sliderType' => $sliderType,
                ));
            }
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }

        // sliderX Slides Data
        public function sliderX_dataSave() {

            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderXData_nonce' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }

            $sliderId = isset($_POST["sliderId"]) ? intval($_POST["sliderId"]) : 0;
            $sliderData = sliderx_Sanitize($_POST["sliderData"]);

            $table_name = "{$wpdb->prefix}sliderx_data";
            $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

            if ($table_exists) {
                $existingData = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d",
                        $sliderId
                    )
                );
            
                if (count($existingData) > 0) {
                    $result = $wpdb->update(
                        $table_name,
                        array('sliderData' => wp_json_encode($sliderData)),
                        array('sliderId' => $sliderId)
                    );
                } else {
                    $result = $wpdb->insert(
                        $table_name,
                        array(
                            'sliderId' => $sliderId,
                            'sliderData' => wp_json_encode($sliderData)
                        )
                    );
                }
            }
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }

        // sliderX Settings
        public function sliderX_settingsSave() {

            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderXSettings_nonce' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }


            $sliderId = isset($_POST["sliderId"]) ? intval($_POST["sliderId"]) : 0;
            $settingsData = sliderx_Sanitize($_POST["settingsData"]);

            $sliderx_apiUrl= isset($settingsData["apiUrl"]) ? sanitize_text_field($settingsData["apiUrl"]) : '';

            $sliderType = isset($settingsData["sliderType"]) ? sanitize_text_field( $settingsData["sliderType"]) : '';

            $general     = wp_json_encode($settingsData["general"]);
            $textContent = wp_json_encode($settingsData["textContent"]);
            $navigation =  wp_json_encode($settingsData["navigation"]);
            $pagination =  wp_json_encode($settingsData["pagination"]);


            $table_name = "{$wpdb->prefix}sliderx_settings";
            $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

            // Update Initial table sliderType
            $initialTable_name = "{$wpdb->prefix}sliderx_initial_projectsetup";
            $initialData_exist = $wpdb->get_row($wpdb->prepare("SELECT projectName FROM {$initialTable_name} WHERE id = %d", $sliderId));


            $initialSlider_title = sliderx_Sanitize($initialData_exist->projectName ?? '');
            if( !empty($initialData_exist) && property_exists($initialData_exist, 'sliderType') ){
                $result = $wpdb->update(
                    $initialTable_name,
                    array(
                        'sliderType' => $sliderType,
                    ),
                    array('id' => $sliderId)
                );
            }


            if ($table_exists) {
                $existingData = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}sliderx_settings WHERE sliderId = %d", $sliderId));

                // if (count($existingData) > 0) {
                //     $result = $wpdb->update(
                //         $table_name,
                //         array(
                //             'sliderType'  => $sliderType,
                //             'sliderTitle' => $initialSlider_title,
                //             'general'  => $general,
                //             'content'  => $textContent,
                //             'navigation'  => $navigation,
                //             'pagination'  => $pagination,
                //             'api_url'  => $sliderx_apiUrl
                //         ),
                //         array('sliderId' => $sliderId)
                //     );
                // } else {
                //     $result = $wpdb->insert(
                //         $table_name,
                //         array(
                //             'sliderId' => $sliderId,
                //             'sliderType' => $sliderType,
                //             'sliderTitle' => $initialSlider_title,
                //             'general'  => $general,
                //             'content'  => $textContent,
                //             'navigation'  => $navigation,
                //             'pagination'  => $pagination,
                //             'api_url'  => $sliderx_apiUrl
                //         )
                //     );
                // }

                if (count($existingData) > 0) {
                    $result = $wpdb->update(
                        $table_name,
                        array(
                            'sliderType'  => $sliderType,
                            'sliderTitle' => $initialSlider_title,
                            'general'     => $general,
                            'content'     => $textContent,
                            'navigation'  => $navigation,
                            'pagination'  => $pagination,
                            'api_url'     => $sliderx_apiUrl
                        ),
                        array('sliderId' => $sliderId)
                    );
                } else {
                    $result = $wpdb->insert(
                        $table_name,
                        array(
                            'sliderId'    => $sliderId,
                            'sliderType'  => $sliderType,
                            'sliderTitle' => $initialSlider_title,
                            'general'     => $general,
                            'content'     => $textContent,
                            'navigation'  => $navigation,
                            'pagination'  => $pagination,
                            'api_url'     => $sliderx_apiUrl
                        )
                    );
                }
                
                // Check for errors
                if ($result === false) {
                    // Log or display the error
                    error_log("Database error: " . $wpdb->last_error);
                    echo "Database error: " . $wpdb->last_error;
                } else {
                    echo "Operation successful!";
                }
                

            }
            
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }

        // ======== Update =======
        // sliderX Slides Data
        public function sliderX_dataUpdate() {

            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderXSlideUpdate_nonce' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }

            $sliderId = isset($_POST["updateId"]) ? intval($_POST["updateId"]) : 0;
            $sliderData = sliderx_Sanitize($_POST["sliderData"]);

            $table_name = "{$wpdb->prefix}sliderx_data";
            $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

            if ($table_exists) {
                $existingData = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d",
                        $sliderId
                    )
                );
                
                if (count($existingData) > 0) {
                    $result = $wpdb->update(
                        $table_name,
                        array('sliderData' => wp_json_encode($sliderData)),
                        array('sliderId' => $sliderId)
                    );
                }
            }
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }

        // sliderX Settings
        public function sliderX_settingsUpdate() {
            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderXSettingsUpdate_nonce' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }
            $updateId      = isset($_POST["updateId"]) ? intval($_POST["updateId"]) : 0;
            $settingsData  = sliderx_Sanitize($_POST["settingsData"]);
            $sliderType    = isset($settingsData["sliderType"]) ? sanitize_text_field($settingsData["sliderType"]) : '';
            $sliderTitle    = isset($settingsData["projectName"]) ? sanitize_text_field($settingsData["projectName"]) : '';

            $sliderx_apiUrl= isset($settingsData["apiUrl"]) ? sanitize_text_field($settingsData["apiUrl"]) : '';

            $general     = wp_json_encode($settingsData["general"]);
            $textContent = wp_json_encode($settingsData["textContent"]);
            $navigation  = wp_json_encode($settingsData["navigation"]);
            $pagination  = wp_json_encode($settingsData["pagination"]);

            $table_name = "{$wpdb->prefix}sliderx_settings";
            $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );
            
            // Update Initial table sliderType
            $initialTable_name = "{$wpdb->prefix}sliderx_initial_projectsetup";
            $initialData_exist = $wpdb->get_row($wpdb->prepare("SELECT sliderType FROM {$wpdb->prefix}sliderx_initial_projectsetup WHERE id = %d", $updateId));

            if( !empty($initialData_exist) && property_exists($initialData_exist, 'sliderType') ){
                $result = $wpdb->update(
                    $initialTable_name,
                    array(
                        'sliderType' => $sliderType,
                    ),
                    array('id' => $updateId)
                );
            }

            if ($table_exists) {
                $existingData = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}sliderx_settings WHERE sliderId = %d", $updateId));

                if (count($existingData) > 0) {
                    $result = $wpdb->update(
                        $table_name,
                        array(
                            'sliderType' => $sliderType,
                            'sliderTitle' => $sliderTitle,
                            'general'  => $general,
                            'content'  => $textContent,
                            'navigation'  => $navigation,
                            'pagination'  => $pagination,
                            'api_url'  => $sliderx_apiUrl
                        ),
                        array('sliderId' => $updateId)
                    );
                }
            
            }
            
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }

        // sliderX Delete
        public function sliderX_slider_delete() {
            global $wpdb;
            // Verify the nonce
            if (! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'sliderx_delete_none' ) ) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }

            $slider_delId = isset($_POST["delId"]) ? intval($_POST["delId"]) : '';
            // Prepare the queries
            $queries = [
                $wpdb->prepare("DELETE FROM {$wpdb->prefix}sliderx_initial_projectsetup WHERE id = %d", $slider_delId),
                $wpdb->prepare("DELETE FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d", $slider_delId),
                $wpdb->prepare("DELETE FROM {$wpdb->prefix}sliderx_settings WHERE sliderId = %d", $slider_delId)
            ];
            // Execute the queries
            foreach ($queries as $query) {
                $wpdb->query($query);
            }
            // Send a JSON response with the status
            wp_send_json_success( array(
                    'status' => "success",
                    )
            );
            wp_die();
        }
        
         // sliderX Item Delete
         public function sliderX_sliderItem_delete() {
            global $wpdb;
            
            // Verify the nonce
            if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'sliderxItem_delete_none')) {
                wp_send_json_error(array('error' => 'Permission check failed'));
            }
        
            $nonce = isset($_POST["nonce"]) ? sanitize_text_field($_POST["nonce"]) : '';
            $slider_id = isset($_POST["sliderId"]) ? intval($_POST["sliderId"]) : '';
            $item_id = isset($_POST["itemId"]) ? intval($_POST["itemId"]) : '';
        
            if (empty($slider_id) || empty($item_id)) {
                wp_send_json_error(array('error' => 'Invalid sliderId or itemId'));
            }
        
            $table_name = "{$wpdb->prefix}sliderx_data";
            // Check if the table exists
            $table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));
        
            if (!$table_exists) {
                wp_send_json_error(array('error' => 'Table does not exist'));
            }
        
            $dataQuery = $wpdb->get_results($wpdb->prepare("SELECT sliderId, sliderData FROM {$table_name} WHERE sliderId = %d", $slider_id));
        
            $item_deleted = false;
        
            // Loop through slider data
            foreach ($dataQuery as $row) {
                $sliderData = json_decode($row->sliderData, true); // Decode JSON data to array
        
                if (json_last_error() !== JSON_ERROR_NONE) {
                    wp_send_json_error(array('error' => 'Error decoding JSON data'));
                }
        
                // Convert item_id to zero-based index
                $item_index = $item_id - 1;
        
                // Remove the item if item_index matches
                if (isset($sliderData[$item_index])) {
                    unset($sliderData[$item_index]);
        
                    // Re-index the array
                    $sliderData = array_values($sliderData);
                    $updatedSliderData = json_encode($sliderData);
        
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        wp_send_json_error(array('error' => 'Error encoding JSON data'));
                    }
        
                    // Update the database with the new JSON data
                    $updated = $wpdb->update(
                        $table_name,
                        array('sliderData' => $updatedSliderData),
                        array('sliderId' => $slider_id)
                    );
        
                    if ($updated === false) {
                        wp_send_json_error(array('error' => 'Failed to update database'));
                    }
        
                    $item_deleted = true;
                    break; // Break loop since we found and deleted the item
                }
            }

            if ($item_deleted) {
                wp_send_json_success(
                    array(
                    'status' => 'success', 
                    'message' => 'Item deleted successfully'
                ));
            } else {
                wp_send_json_error(array('error' => 'Item not found'));
            }
            wp_die();
        }
        
    }

}

