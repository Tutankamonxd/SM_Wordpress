<?php 
/*
* @Pakage SliderX.
*/

// Include necessary WordPress files
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');


add_action('rest_api_init', 'sliderX_endpoint');
function sliderX_endpoint() {
    // SliderX data
    register_rest_route('sx/v1/sliderx', '/data', array(
        'methods'  => 'POST',
        'callback' => 'sliderx_dataApi_Callback',
        // 'permission_callback' => 'mbfc_authorize_request'
    ));

}

// **** ==== SliderX ==== ***
function sliderx_dataApi_Callback($request) {

    $req_siteUrl = $request->get_param('site_url'); 
    $siteUrl = get_site_url();

    // Receive products data
    // $productsData = $request->get_json_params();
    $sliderX_data = $request->get_json_params();
    // $products_data = $products_data['body'];
    // return $products_data;

    // if ($req_siteUrl !== $siteUrl) {
    //     return new WP_REST_Response('Invalid site URL to Import.', 400);
    // }

    // if (empty($sliderX_data)) {
    //     return new WP_REST_Response('No products data found to Import.', 400);
    // }

    // global $wpdb;
    // $table_name = $wpdb->prefix . 'sliderx_settings';
    // $table_exists = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");

    // if (!$table_exists) {
    //     return new WP_REST_Response('Database table not found.', 500);
    // }

    // if($table_exists){
    //     $result = $wpdb->update(
    //         $table_name,
    //         array(
    //             'api_data' => $sliderX_data,
    //         ),
    //         array('sliderId' => $updateId)
    //     );

    // }



    return $sliderX_data;

    
    // $report = array(
    //     'total_data' => $total_products,
    //     'successful_import' => $inserted_count,
    //     'successful_import_ids' => $successes,
    //     'failed_imports' => $errors,
    //     'duplicate_entry' => $duplicate,
    //     'failed_to_imports' => $skipped_count,
    // );
    // return new WP_REST_Response($report, 200);
}











