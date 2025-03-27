<?php
/*
* @Pakage SliderX.
*/

if( !defined( 'ABSPATH' ) ){
    exit; // Exit if directly access.
}

// Check if class exist or not
if(!function_exists('sliderx_settings_admin_menu_page')){
    function sliderx_settings_admin_menu_page() {
        // Generate nonce
        $nonce = wp_create_nonce('sliderx_settings_nonce');
       add_menu_page(
           __('SliderX', 'sliderx'), 
           __('SliderX', 'sliderx'), 
           'manage_options',
           'sliderx', 
           'sliderx_menu_callback',
            'dashicons-welcome-learn-more',
           30
       );
   }
}

// The callback function to render the menu page
if(!function_exists('sliderx_menu_callback')){
function sliderx_menu_callback() { ?>
    <div id="wpbody" role="main">
        <div id="wpbody-content">
                <div class="wrap">
                    <!-- Start Custom Wrapper -->
                    <div class="sliderx_custom_wrapper">

                            <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
                                <div class="container-fluid">

                                    <div class="brand_logo">
                                        <a class="navbar-brand" href="<?php echo esc_url(admin_url( 'admin.php?page=sliderx' )); ?>"><?php esc_html_e( "SliderX", "sliderx" ); ?></a>
                                    </div>

                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-navigations="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarText">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 sliderx-navbar">
                                        <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo esc_url(admin_url( 'admin.php?page=sliderx' )); ?>"><span class="dashicons dashicons-admin-home"></span><?php esc_html_e( "Dashboard", "sliderx" ); ?></a>
                                        </li>
                                    </ul>
                                    <!-- Navbar here -->
                                    </div>
                                </div>
                            </nav>

                            <div class="container-fluid my-4">
                            <?php  

                                global $wpdb;
                                 
                                $table_name = "{$wpdb->prefix}sliderx_initial_projectsetup";
                                $table_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

                                $id = '';
                                $sliderXName = '';
                                $initial_sliderType = '';

                                $initialSetupData = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}sliderx_initial_projectsetup ORDER BY id DESC LIMIT 1");

                                if( $initialSetupData ){

                                    $id = isset( $initialSetupData->id) ? sanitize_text_field( $initialSetupData->id ) : '';
                                    $sliderXName = isset( $initialSetupData->projectName ) ? sanitize_text_field( $initialSetupData->projectName ) : '';
                                    $initial_sliderType = isset($initialSetupData->sliderType) ? sanitize_text_field( $initialSetupData->sliderType ) : '';
                                }
                                // Settings Data from database.
                                $settingsData = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}sliderx_settings ORDER BY id DESC LIMIT 1");

                                $sliderType = isset($settingsData->sliderType) ? sanitize_text_field($settingsData->sliderType) : '';

                                // General
                                $generalData = isset($settingsData->general) ? json_decode($settingsData->general) : null;

                                // Layout
                                $layout_settings = isset($generalData->layout) ? $generalData->layout : new stdClass();
                                $layoutType = isset($layout_settings->layoutType) ? sanitize_text_field($layout_settings->layoutType) : "fullWidth";
                                $dimensionWidth = isset($layout_settings->dimension->width) ? sanitize_text_field($layout_settings->dimension->width) : "1200";
                                $dimensionHeight = isset($layout_settings->dimension->height) ? sanitize_text_field($layout_settings->dimension->height) : "550";
                                $dimensionRatio = isset($layout_settings->dimension->ratio) ? absint($layout_settings->dimension->ratio) : 0;
                                $autoHeight = isset($layout_settings->autoHeight) ? sanitize_text_field($layout_settings->autoHeight) : "false";
                                
                                // Accessing other properties
                                $layoutDir = isset($generalData->layoutDir) ? sanitize_text_field($generalData->layoutDir) : '';
                                $autoPlay = isset($generalData->autoPlay) ? sanitize_text_field($generalData->autoPlay) : '';
                                $autoPlayProp = isset($generalData->autoPlayProp) ? (object) $generalData->autoPlayProp : new stdClass();
                                
                                $autoPlayDelay = isset($autoPlayProp->autoPlayDelay) ? absint($autoPlayProp->autoPlayDelay) : 2000;
                                $pauseOnHover = isset($autoPlayProp->pauseOnHover) ? sanitize_text_field($autoPlayProp->pauseOnHover) : "false";
                                $disableOnInteraction = isset($autoPlayProp->disableOnInteraction) ? sanitize_text_field($autoPlayProp->disableOnInteraction) : "false";
                                $loop = isset($generalData->loop) ? sanitize_text_field($generalData->loop) : '';
                                $keyboardControl = isset($generalData->KeyboardControl) ? sanitize_text_field($generalData->KeyboardControl) : '';
                                $mouseWheel = isset($generalData->mouseWheel) ? sanitize_text_field($generalData->mouseWheel) : '';
                                $centeredSlide = isset($generalData->centeredSlide) ? sanitize_text_field($generalData->centeredSlide) : '';
                                
                                // Text Content ====
                                $textContentData = isset($settingsData->content) ? json_decode($settingsData->content) : null;
                                // --- Content Box ---
                                $contentBox = isset($textContentData->contentBox) ? $textContentData->contentBox : '' ;
                                $sliderImg = isset($textContentData->sliderImg) ? $textContentData->sliderImg : '' ;

                                $contentBox_width = isset( $contentBox->width ) ? sanitize_text_field($contentBox->width) : '' ;
                                $contentBox_alignment = isset( $contentBox->alignment ) ? sanitize_text_field($contentBox->alignment) : '' ;
                                // --- Slider Image ---
                                $image_alignment = isset( $sliderImg->alignment ) ? sanitize_text_field($sliderImg->alignment) : '' ;

                                // --- Title ---
                                $titleVal = isset( $textContentData->title ) ? sanitize_text_field($textContentData->title) : '' ;
                                // style
                                $titleStyle = isset( $textContentData->titleStyle ) ? sanitize_text_field(  $textContentData->titleStyle ) : '' ;;
                                $titleAlignment = isset($titleStyle->alignment) ? sanitize_text_field($titleStyle->alignment) : "left";
                                $titleFontsize = isset($titleStyle->fontsize) ? htmlspecialchars($titleStyle->fontsize) : "30";
                                $titleColor=  isset($titleStyle->fontColor) ? htmlspecialchars($titleStyle->fontColor) : "#ffffff";
                                $titleTitleBg= isset($titleStyle->titleBg) ? htmlspecialchars($titleStyle->titleBg) : '';

                                // --- SubTitle ---
                                $subtitleVal = isset($textContentData->subtitle) ? sanitize_text_field($textContentData->subtitle) : '';

                                // style
                                $subtitleStyle = isset($textContentData->subTitleStyle) ? sanitize_text_field( $textContentData->subTitleStyle ) : '';
                                // echo gettype($subtitleStyle);
                                $subtitleAlignment =isset($subtitleStyle->alignment) ? sanitize_text_field($subtitleStyle->alignment) : "left";
                                $subtitleFontsize = isset($subtitleStyle->fontsize) ? htmlspecialchars($subtitleStyle->fontsize) : "20";
                                $subtitleColor=  isset($subtitleStyle->color) ? htmlspecialchars($subtitleStyle->color) : "#ffffff";
                                $subtitleBg= isset($subtitleStyle->bgColor) ? htmlspecialchars($subtitleStyle->bgColor) : "#333333";

                                // --- Description ---
                                $descVal = isset($textContentData->desc) ? sanitize_text_field($textContentData->desc) : '';
                                // style
                                $descStyle = isset($textContentData->descStyle) ? sanitize_text_field( $textContentData->descStyle ) : '';
                                $descAlignment =isset($descStyle->alignment) ? sanitize_text_field($descStyle->alignment) : "left";
                                $descFontsize = isset($descStyle->fontsize) ? htmlspecialchars($descStyle->fontsize) : "16";
                                $descColor=  isset($descStyle->color) ? htmlspecialchars($descStyle->color) : "#ffffff";
                                $descBg= isset($descStyle->bgColor) ? htmlspecialchars($descStyle->bgColor) : "#333333";

                                // --- CTA ---
                                $ctaVal = isset($textContentData->cta) ? sanitize_text_field($textContentData->cta) : '';
                                // style
                                $ctaStyle = isset($textContentData->ctaStyle) ? sanitize_text_field( $textContentData->ctaStyle ) : '';
                                $ctaAlignment =isset($ctaStyle->alignment) ? sanitize_text_field($ctaStyle->alignment) : "left";
                                $ctaFontsize = isset($ctaStyle->fontsize) ? absint($ctaStyle->fontsize) : "16";
                                $ctaColor=  isset($ctaStyle->color) ? htmlspecialchars($ctaStyle->color) : "#ffffff";
                                $ctaBg= isset($ctaStyle->bgColor) ? htmlspecialchars($ctaStyle->bgColor) : "#30336b";
                                
                                // Navigation
                                $navigationData = isset($settingsData->navigation) ? json_decode($settingsData->navigation) : null;
                                $sliderx_navigation = isset($navigationData->navigation) ? sanitize_text_field($navigationData->navigation) : '';
                                $sliderx_navType = isset($navigationData->navType)? sanitize_text_field($navigationData->navType) : '';
                                // Style
                                $sliderx_navStyle = isset($navigationData->style) ? sanitize_text_field($navigationData->style) : '';
                                $sliderx_navFontSize = isset($sliderx_navStyle->fontsize) ? htmlspecialchars($sliderx_navStyle->fontsize) : 40;
                                $sliderx_navColor = isset($sliderx_navStyle->color) ? htmlspecialchars($sliderx_navStyle->color) : "#007aff";
                                
                                // Pagination
                                $paginationData = isset($settingsData->pagination) ? json_decode($settingsData->pagination) : null;
                                $sliderx_pagination = isset($paginationData->paginationVal) ? sanitize_text_field($paginationData->paginationVal) : '';
                                $sliderx_paginationType = isset($paginationData->paginationType) ? sanitize_text_field($paginationData->paginationType) : '';
                                $sliderx_paginationPosition= isset($paginationData->position) ? sanitize_text_field($paginationData->position) : '' ;
                                // Style
                                $paginationStyle = isset($paginationData->style) ? sanitize_text_field( $paginationData->style ) : '';
                                $pagiSize = isset($paginationStyle->fontsize) ? htmlspecialchars($paginationStyle->fontsize) : 14;
                                $sliderx_pagiColor = isset($paginationStyle->color) ? htmlspecialchars($paginationStyle->color) : "#cbcbcb";

                                // Active Style
                                $pagination_ActiveStyle = isset($paginationData->activeStyle) ? sanitize_text_field( $paginationData->activeStyle ) : '';
                                $pagiActiveSize = isset($pagination_ActiveStyle->fontsize) ? htmlspecialchars($pagination_ActiveStyle->fontsize) : 14;
                                $pagiActiveColor = isset($pagination_ActiveStyle->color) ? htmlspecialchars($pagination_ActiveStyle->color) : "#007aff";

                                // API Url ====
                                $api_url = '';
                                
                                if (isset($_GET['page']) && sanitize_text_field($_GET['page']) === 'sliderx' &&
                                     isset($_GET['sliderx']) && sanitize_text_field($_GET['sliderx']) === 'slider-editor'):
                                     
                                ?>

                                <!-- Section Publish -->
                                <div class="sliderx_section section_publish">
                                    <h3 class="section_title"><?php esc_html_e( "Publish", "sliderx" ); ?></h3>
                                    <div class="row my-3">
                                        <div class="col-lg-6">
                                            <div class="section_publish_item first mb-2">
                                                <h3 class="publish_item_title"><?php esc_html_e( "Shortcode", "sliderx" ); ?></h3>
                                                <p class="publish_item_txt"><?php esc_html_e( "Copy and paste this shortcode into your posts or pages:", "sliderx" ); ?></p>
                                                <div class="shortcode_field">
                                                    [sliderX type="<?php echo esc_attr($initial_sliderType); ?>" id="<?php echo esc_html($id); ?>" /]
                                                </div>
                                                <div class="shortcode_copy_btn"><?php esc_html_e("Copy Shortcode", "sliderx"); ?></div>
                                            </div>
                                        </div>
                             
                                        <div class="col-lg-6">
                                            <div class="section_publish_item mb-2">
                                                <h3 class="publish_item_title"><?php esc_html_e( "PHP Code", "sliderx" ); ?></h3>
                                                <p class="publish_item_txt"><?php esc_html_e( "Paste the PHP code into your theme's file:", "sliderx" ); ?></p>
            
                                                <div class="shortcode_field">
                                                    &lt;?php echo do_shortcode('[sliderX type="<?php echo esc_attr($initial_sliderType); ?>" id="<?php echo esc_attr($id); ?>" /]'); ?&gt;
                                                </div>
                                                <div class="shortcode_copy_btn"><?php esc_html_e("Copy Shortcode", "sliderx"); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Create Slider -->
                                <div class="sliderx_section section_slider_config pb-0 mb-4">
                                    <div class="sliderx_section_header">
                                        <h3 class="section_title">
                                            <span class="project_title_wrapper">
                                                <span class="sliderx_projectId">
                                                    <?php esc_html_e( "ID : ", "sliderx" ); ?> <?php echo esc_html($id); ?>
                                                </span>
                                                <span class="sliderx_projectName">
                                                    <?php echo esc_html($sliderXName); ?>
                                                </span>
                                            </span>
                                        </h3>
                                    </div>

                                    <div class="row my-3 px-4 createSlidesWrapper">
                                        <input type="hidden" name="sliderxId" id="sliderxId" value="<?php echo esc_attr($id); ?>">
                                        <div class="col-lg-6">

                                            <div class="sliderx_creation">

                                                <div class="sliderx_create_btn_wrapper">
                                                    <a id="sliderx_create_buttonOne" class="sliderx_create_btn" href="javascript:void(0)"><span class="dashicons dashicons-plus"></span> <?php esc_html_e( "Create Slides", "sliderx" ); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="accordion sliderx_accordion" id="sliderx_slidesOne">
                                                <?php 
                                                    global $wpdb;
                                                    $id = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}sliderx_initial_projectsetup ORDER BY id DESC LIMIT 1");

                                                    $sliderXData = $wpdb->get_results(
                                                        $wpdb->prepare(
                                                            "SELECT * FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d",
                                                            $id
                                                        )
                                                    );
                                                ?>
                                                <!-- Accordion Item will append here -->
                                                <?php 
                                                if( count($sliderXData) > 0):                                 
                                                    foreach ($sliderXData as $key => $data): 
                                                        $sliderData = json_decode($data->sliderData);
                                                        // Check if $sliderData is an array and not empty
                                                        if (is_array($sliderData) && !empty($sliderData)) :
                                                            $i=0;
                                                            foreach ($sliderData as $data) :
                                                                $i++;
                                                                // Sanitize each property
                                                                $image = esc_url($data->image ?? '');
                                                                $title = sanitize_text_field($data->title ?? '');
                                                                $subtitle = sanitize_text_field($data->subtitle ?? '');
                                                                $description = wp_kses_post($data->description ?? '');
                                                                $btnText1 = sanitize_text_field($data->btnText1 ?? '');
                                                                $btnLink1 = esc_url($data->btnLink1 ?? '');
                                                                $btnText2 = sanitize_text_field($data->btnText2 ?? '');
                                                                $btnLink2 = esc_url($data->btnLink2 ?? '');

                                                                ?>

                                                                <div class="accordion-item xSlides_item" id="accordion-itemOne-<?php echo esc_attr($i); ?>">
                                                                    <h3 class="accordion-header" id="headingOne<?php echo esc_attr($i); ?>">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sliderX_collapseOne<?php echo esc_attr($i); ?>" aria-expanded="false" aria-controls="sliderX_collapseOne<?php echo esc_attr($i); ?>">
                                                                            <?php echo esc_html__("Slide Item #", "sliderx") . esc_attr($i); ?>
                                                                        </button>
                                                                    <!-- Duplicate Button -->
                                                                    <div class="accordionItemAction_duplicate" data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate" >
                                                                        <span type="button" class="btn sliderX_itemDuplicate" ><span class="dashicons dashicons-admin-page"></span></span>
                                                                    </div>
                                                                    <!-- Delete Button -->
                                                                    <div class="accordionItemAction" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                        <span type="button" class="btn btn-danger sliderX_itemDelete" ><span class="dashicons dashicons-no-alt"></span></span>
                                                                    </div>

                                                                    </h3>
                                                                    <div id="sliderX_collapseOne<?php echo esc_attr($i); ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo esc_attr($i); ?>" data-bs-parent="#sliderx_slidesOne">
                                                                        <div class="accordion-body sliderX_body">

                                                                            <div class="sliderX_media_wrapper mb-3">
                                                                                <div class="sliderx-uploaded-media" id="sliderx-uploaded-media-<?php echo esc_attr($i); ?>">
                                                                                    <img src="<?php echo esc_url($image); ?>" alt="Uploaded Media">
                                                                                </div>
                                                                                <input type="button" onclick="sliderXMedia(<?php echo esc_attr($i); ?>)" class="sliderX-media-upload-button" id="sliderx-media-upload-<?php echo esc_attr($i); ?>" value="Update Image">
                                                                            </div>

                                                                            <div class="sliderX_title_wrapper">
                                                                                <div class="sliderX_title_input"><?php esc_html_e( "Title", "sliderx" ); ?></div>
                                                                                <input type="text" class="form-control sliderx_title_input" value ="<?php echo esc_attr($title); ?>" placeholder="Enter Title">
                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Title', 'sliderx' ); ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="sliderX_subtitle_wrapper mt-2">
                                                                                <div class="sliderX_subtitle_input"><?php esc_html_e( "Subtitle", "sliderx" ); ?></div>
                                                                                <input type="text" class="form-control sliderx_subtitle_input" value="<?php echo esc_html($subtitle); ?>" placeholder="Enter Subtitle">
                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Subtitle', 'sliderx' ); ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="sliderX_desc_wrapper my-2">
                                                                                <div class="sliderX_title mb-1"><?php esc_html_e( "Description", "sliderx" ); ?></div>
                                                                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px"><?php echo esc_html($description); ?></textarea>>

                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Desc', 'sliderx' ); ?>
                                                                                </div>

                                                                            </div>

                                                                            <div class="sliderX_cta_button_wrapper my-2">
                                                                                <div class="sliderX_title mb-1"><?php esc_html_e( "CTA Button", "sliderx" ); ?></div>
                                                                                <div class="sliderx_button_item">
                                                                                    <input type="text" class="form-control sliderx_btnText1" value="<?php echo esc_html($btnText1); ?>" placeholder="Button Text 1">
                                                                                    <input type="text" class="form-control sliderx_btnLink1" value="<?php echo esc_attr($btnLink1); ?>" placeholder="Button Link 1">
                                                                                </div>

                                                                                <div class="sliderx_button_item">
                                                                                    <input type="text" class="form-control sliderx_btnText2" value="<?php echo esc_html($btnText2); ?>" placeholder="Button Text 2">
                                                                                    <input type="text" class="form-control sliderx_btnLink2" value="<?php echo esc_attr($btnLink2); ?>" placeholder="Button Link 2">
                                                                                </div>
                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use CTA', 'sliderx' ); ?>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                             
                                        <div class="col col-lg-6">
                                            <div class="sliderx_settings_btn">
                                                <a class="sliderx_settingsBtn" href=""><span class="dashicons dashicons-admin-generic"></span></a>
                                            </div>
                                            <div class="sliderx_settings_panel">
                                                <ul class="nav nav-tabs" id="sliderxSettings_tabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-navigations="general" aria-selected="true"><?php esc_html_e( "General", "sliderx" ); ?></button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="textContent-tab" data-bs-toggle="tab" data-bs-target="#textContent" type="button" role="tab" aria-navigations="textContent" aria-selected="false"><?php esc_html_e( "Content", "sliderx" ); ?></button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="navigation-tab" data-bs-toggle="tab" data-bs-target="#navigation" type="button" role="tab" aria-navigations="navigation" aria-selected="false"><?php esc_html_e( "Navigation", "sliderx" ); ?></button>
                                                    </li>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="sliderx_pagination-tab" data-bs-toggle="tab" data-bs-target="#sliderx_pagination" type="button" role="tab" aria-navigations="sliderx_pagination" aria-selected="false"><?php esc_html_e( "Pagination", "sliderx" ); ?></button>
                                                    </li>
                                                    <!-- SliderX hook --- Navigation tab -->
                                                    <?php  do_action('sliderX_tab_head'); ?>

                                                </ul>
                                                <div class="tab-content mt-4" id="sliderxSettings_content">

                                                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                                                        <!-- Slider Type -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <h5 class="sliderx_settings_option_title mb-2"><?php esc_html_e( "Type", "sliderx" ); ?>
                                                            </h5>

                                                            <div class="sliderx_type_wrapper">

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_slider" name="sliderXType" value="slider" <?php echo esc_attr(($sliderType === NUll && $initial_sliderType === "slider") || $initial_sliderType === "slider" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_slider">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/slider.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Slider", "sliderx"); ?></div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_carousel" name="sliderXType" value="carousel" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "carousel") || $initial_sliderType === "carousel" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_carousel">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/carousel.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Carousel", "sliderx"); ?></div>
                                                                </div>
                                                                <!-- Carousel Wave -->
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_carousel_wave" name="sliderXType" value="carowave" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "carowave") || $initial_sliderType === "carowave" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_carousel_wave">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/carowave.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("CaroWave", "sliderx"); ?></div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_group" name="sliderXType" value="group" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "group") || $initial_sliderType === "group" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_group">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/group.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Group", "sliderx"); ?></div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_thumbnail" name="sliderXType" value="thumbnail" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "thumbnail") || $initial_sliderType === "thumbnail" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_thumbnail">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/thumbnail.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Thumbnail", "sliderx"); ?></div>
                                                                </div>

                                                                <!-- Featured -->
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_featured" name="sliderXType" value="featured" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "featured") || $initial_sliderType === "featured" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_featured">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/featured.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Featured", "sliderx"); ?></div>
                                                                </div>

                                                                <!-- Center Mode -->
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_centerMode" name="sliderXType" value="featured" <?php echo esc_attr( ($sliderType === NUll && $initial_sliderType === "centermode") || $initial_sliderType === "centermode" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_centerMode">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/centermode.svg'); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name"><?php echo esc_html__("Center Mode", "sliderx"); ?></div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        
                                                        <!-- Layout -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Layout", "sliderx" ); ?></h5>

                                                            <div class="sliderX_multipleOption_wrapper sliderXLayoutType_wrapper">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="sliderx_fullWidth" name="sliderx_layoutType" value="fullWidth" <?php echo esc_attr($layoutType === "fullWidth") ? "checked" : ""; ?> />
                                                                    <label for="sliderx_fullWidth"><?php esc_html_e( "Full Width", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="sliderx_boxed" name="sliderx_layoutType" value="boxed" <?php echo esc_attr($layoutType === "boxed") ? "checked" : ""; ?> />
                                                                    <label for="sliderx_boxed"><?php esc_html_e( "Boxed", "sliderx" ); ?></label>
                                                                </div>

                                                            </div>

                                                            <!-- Auto Height -- Switcher -->
                                                            <div class="sliderx_settings_option mt-3 autoHeight_switcher_div">
                                                                <div class="sliderx_box_option d-flex">

                                                                    <div class="sliderx_switcher">
                                                                        <input type="checkbox" id="layoutAutoHeight" class="toggle-input" <?php echo esc_attr($autoHeight === "true") ? "checked" : ""; ?>>
                                                                        <label for="layoutAutoHeight" class="toggle-label"></label>
                                                                    </div>
                                                                    <span class="sliderx_switcher_title ms-3"><?php esc_html_e( "Auto Height", "sliderx" ); ?></span>
                                                                </div>
                                                                <!-- Note -->
                                                                <div class="sliderX_note sliderX_vertical">
                                                                    <?php esc_html_e("Note : Disable Auto height when use Vertical Direction !", "sliderx"); ?>
                                                                </div>
                                                            </div>
                                                            <!-- Layout Dimensions -->
                                                            <div class="sliderxLayouts_dimensions sliderx_box_option">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Dimensions", "sliderx"); ?></h6>
                                                                <div class="dimension_fields">
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_width"><?php esc_html_e("Width", "sliderx"); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_width" placeholder="1200" value="<?php esc_attr($dimensionWidth); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_height"><?php esc_html_e("Height", "sliderx"); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_height" placeholder="600" value="<?php esc_attr($dimensionHeight); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="slider_ratio"><?php esc_html_e("Ratio", "sliderx"); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                        <input type="text" id="slider_ratio" name="ratio" placeholder="2.5" value="<?php esc_attr($dimensionRatio); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Slide Direction -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <div class="sliderxLayouts_direction">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Direction", "sliderx"); ?></h6>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper">

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="layoutsDirType3"  name="layoutsDirection" value="horizontal" <?php echo esc_attr($layoutDir === "horizontal") ? "checked" : ""; ?> />
                                                                        <label for="paginationType1"><?php esc_html_e("Horizontal", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="layoutsDirType4"  name="layoutsDirection" value="vertical" <?php echo esc_attr($layoutDir === "vertical") ? "checked" : ""; ?> />
                                                                        <label for="paginationType2"><?php esc_html_e("Vertical", "sliderx"); ?></label>
                                                                    </div>

                                                                </div>
                                                                <!-- Note -->
                                                                <div class="sliderX_note sliderX_vertical">
                                                                    <?php esc_html_e("Note : Vertical Direction will work with slider , featured type slider only !", "sliderx"); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Auto Play -- Switcher -->
                                                        <div class="sliderx_settings_option">

                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("AutoPlay", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_AutoPlay" class="toggle-input" <?php echo esc_attr( $autoPlay === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_AutoPlay" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper sliderx_box_option autoPlayOptions">

                                                                <div class="sliderX_multipleOption_item">
                                                                    <label><?php esc_html_e("Delay", "sliderx"); ?></label>
                                                                    <input type="text" id="autoplayDelay" class="option-input option-inputText" value="<?php echo esc_attr($autoPlayDelay); ?>"/>

                                                                </div>
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="checkbox" class="option-input xCheckbox" id="autoPlay_pauseOnhover" <?php echo esc_attr( $pauseOnHover === "true" ? "checked" : "" ); ?> />
                                                                    <label for="autoPlay_pauseOnhover"><?php esc_html_e("Autoplay Pause on hover", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="checkbox" class="option-input xCheckbox" id="autoPlay_disableOnInteraction" <?php echo esc_attr( $disableOnInteraction === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="autoPlay_disableOnInteraction"><?php esc_html_e("Disable on interaction", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Loop -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Loop", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_loop" class="toggle-input" <?php echo esc_attr( $loop === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_loop" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Keyboard Control -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Keyboard Control", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_keyboardControl" class="toggle-input" <?php echo esc_attr( $keyboardControl === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_keyboardControl" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- MouseWheel -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Mouse Wheel Control", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_mousewheel" class="toggle-input" <?php echo esc_attr( $mouseWheel === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_mousewheel" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Centered Slide -- Switcher -->
                                                        <div class="sliderx_settings_option sliderx_centeredSlide">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Centered Slide", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_centeredSlide" class="toggle-input" <?php echo esc_attr( $centeredSlide === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_centeredSlide" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>  

                                                    </div> <!--./ Tab general -->

                                                    <div class="tab-pane fade" id="textContent" role="tabpanel" aria-labelledby="textContent-tab">
                                                        <!-- Content With -->
                                                        <div class="sliderx_settings_option sliderx_box_option sliderx_content_manage">

                                                            <div class="sliderX_helper_wrapper mb-4">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Content Box Width", "sliderx"); ?></h6>
                                                                <div class="dimension_fields">
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_contentBox_width" class="sliderx_content_boxWidth" placeholder="100" value="">
                                                                            <span class="sliderx_settings_unit">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="sliderX_helper_wrapper">
                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e("Box Alignment", "sliderx"); ?></h5>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper ">
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment1" name="sliderxContentBox_alignment" value="flex-start" checked />
                                                                        <label for="contentBoxAlignment1"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment2" name="sliderxContentBox_alignment" value="flex-end"/>
                                                                        <label for="contentBoxAlignment2"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment3" name="sliderxContentBox_alignment" value="center"/>
                                                                        <label for="contentBoxAlignment3"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Note -->
                                                            <div class="sliderX_note"><?php esc_html_e("You can Adjustment your content Box width & alignment!", "sliderx"); ?></div>
                                                        </div>
                                                        <!-- Image -->
                                                        <div class="sliderx_settings_option sliderx_box_option sliderx_image_manage">
                                                            <div class="sliderX_helper_wrapper">
                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e("Image Position", "sliderx"); ?></h5>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper ">
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="sliderxImageAlignment1" name="sliderxImage_alignment" value="left" checked/>
                                                                        <label for="sliderxImageAlignment1"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="sliderxImageAlignment2" name="sliderxImage_alignment" value="right"/>
                                                                        <label for="sliderxImageAlignment2"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Note -->
                                                            <div class="sliderX_note"><?php esc_html_e("Choose the image position for the slider: either to the left or right of the text.", "sliderx"); ?></div>
                                                        </div>



                                                        <!-- Title -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Title", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_title" class="toggle-input" <?php echo esc_attr($titleVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_title" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Title -->
                                                        <div class="sliderx_settings_option sliderx_box_option titleStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="left" <?php echo esc_attr($titleAlignment=== "left") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="right" <?php echo esc_attr($titleAlignment=== "right") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="center" <?php echo esc_attr($titleAlignment=== "center") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e("Style", "sliderx"); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_Fontsize"><?php esc_html_e("Font Size", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="title_Fontsize" value="<?php echo esc_attr($titleFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_FontColor"><?php esc_html_e("Color", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="tex" id="title_FontColor" value="<?php echo esc_attr($titleColor); ?>"  data-coloris>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_FontBg"><?php esc_html_e("Background", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="tex" id="title_FontBg" value="<?php echo esc_attr($titleTitleBg); ?>"  data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Subtitle -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Subtitle", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_subtitle" class="toggle-input" <?php echo esc_attr($subtitleVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_subtitle" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Subtitle -->
                                                        <div class="sliderx_settings_option sliderx_box_option subtitleStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentLeft" name="subTitleAlignment" value="left" <?php echo esc_attr($subtitleAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentLeft"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentRight" name="subTitleAlignment" value="right" <?php echo esc_attr($subtitleAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentRight"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentCenter" name="subTitleAlignment" value="center" <?php echo esc_attr($subtitleAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentCenter"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e("Style", "sliderx"); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_FontSize"><?php esc_html_e("Font Size", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="subTitle_FontSize" value="<?php echo esc_attr($subtitleFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_FontColor"><?php esc_html_e("Color", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="subTitle_FontColor" value="<?php echo esc_attr($subtitleColor); ?>" data-coloris>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_bgColor"><?php esc_html_e("Background", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="subTitle_bgColor" value="<?php echo esc_attr($subtitleBg); ?>"  data-coloris >
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Description -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Description", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_desc" class="toggle-input" <?php echo esc_attr($descVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_desc" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Description -->
                                                        <div class="sliderx_settings_option sliderx_box_option descriptionStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentLeft" name="descAlignment" value="left" <?php echo esc_attr($descAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentLeft"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentRight" name="descAlignment" value="right" <?php echo esc_attr($descAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentRight"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentCenter" name="descAlignment" value="center" <?php echo esc_attr($descAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentCenter"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( "Style", "sliderx" ); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_FontSize"><?php esc_html_e( "Font Size", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="desc_FontSize" value="<?php echo esc_attr($descFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_FontColor"><?php esc_html_e( "Color", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="desc_FontColor" value="<?php echo esc_attr($descColor); ?>"  data-coloris>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_bgColor"><?php esc_html_e( "Background", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="desc_bgColor" value="<?php echo esc_attr($descBg); ?>" data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- CTA -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e( "CTA", "sliderx" ); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_cta" class="toggle-input" <?php echo esc_attr($ctaVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_cta" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Style for -- CTA -->
                                                        <div class="sliderx_settings_option sliderx_box_option ctaStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Text Alignment", "sliderx" ); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentLeft" name="ctaAlignment" value="left" <?php echo esc_attr($ctaAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentLeft"><?php esc_html_e( "Left", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentRight" name="ctaAlignment" value="right" <?php echo esc_attr($ctaAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentRight"><?php esc_html_e( "Right", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentCenter" name="ctaAlignment" value="center" <?php echo esc_attr($ctaAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentCenter"><?php esc_html_e( "Center", "sliderx" ); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( "Style", "sliderx" ); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_fontSize"><?php esc_html_e( "Font Size", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="sliderx_cta_fontSize" value="<?php echo esc_attr($ctaFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_color"><?php esc_html_e( "Color", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="sliderx_cta_color" value="<?php echo esc_attr($ctaColor); ?>"  data-coloris>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_bg"><?php esc_html_e( "Background", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="sliderx_cta_bg" value="<?php echo esc_attr($ctaBg); ?>"  data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div> <!--./ Tab textContent -->

                                                    <div class="tab-pane fade" id="navigation" role="tabpanel" aria-labelledby="navigation-tab">
                                                        <!-- Navigation -->
                                                        <div class="sliderx_navigation_option_wrapper">

                                                            <div class="sliderx_navigation_option sliderx_box_option">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e( 'Arrow', 'sliderx'  ); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="nav_arrow" class="toggle-input" <?php echo esc_attr($sliderx_navigation === "true") ? "checked" : ""; ?>>
                                                                    <label for="nav_arrow" class="toggle-label"></label>
                                                                </div>

                                                            </div>

                                                            <!-- Navigation Style list -->
                                                            <div class="sliderx_type sliderx_navigation_options_list sliderx_box_option">

                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Next / Previous buttons style:", "sliderx" ); ?></h5>

                                                                <div class="sliderx_type_item_wrapper">

                                                                    <div class="sliderx_type_item sliderx_navigation_type_item">
                                                                        <input type="radio" id="sliderx_nav_angle" name="navigationType" value="nav_angle" <?php echo esc_attr($sliderx_navType === "nav_angle") ? "checked" : ""; ?>>
                                                                        <label for="sliderx_nav_angle">
                                                                            <div class="sliderxType_img">
                                                                                <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/angle.png'); ?>" alt="">
                                                                            </div>
                                            
                                                                        </label>
                                                                    </div>


                                                                    <div class="sliderx_type_item sliderx_navigation_type_item">
                                                                        <input type="radio" id="sliderx_nav_arrow" name="navigationType" value="nav_arrow" <?php echo esc_attr($sliderx_navType === "nav_arrow") ? "checked" : ""; ?>>
                                                                        <label for="sliderx_nav_arrow">
                                                                            <div class="sliderxType_img">
                                                                                <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/arrow.png'); ?>" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <h5 class="sliderx_settings_option_title mt-4"><?php esc_html_e( 'Style', 'sliderx'  ); ?></h5>

                                                                <div class="sliderx_style_wrapper">

                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_nav_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_nav_size" value="<?php echo esc_attr($sliderx_navFontSize); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_nav_color"><?php esc_html_e( 'Color', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field sliderx_color_field">
                                                                            <input type="text" id="sliderx_nav_color" value="<?php echo esc_attr($sliderx_navColor); ?>" data-coloris>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>                                                  
                                                    </div> <!--./ Tab navigation -->


                                                    <div class="tab-pane fade" id="sliderx_pagination" role="tabpanel" aria-labelledby="sliderx_pagination-tab">
                                                        <!-- Pagination -->
                                                        <div class="sliderx_pagination_option_wrapper">

                                                            <div class="sliderx_pagination_option sliderx_box_option">
                                                                <div class="sliderx_switcher_title me-2"><?php esc_html_e( 'Pagination', 'sliderx'  ); ?></div>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderxPagination" class="toggle-input" <?php echo esc_attr($sliderx_pagination === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderxPagination" class="toggle-label"></label>
                                                                </div>
                                                            </div>

                                                            <div class="sliderx_pagination_options_list">
                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <div class="sliderx_settings_option_title me-2"><?php esc_html_e( 'Pagination Type', 'sliderx'  ); ?></div>
                                                                    <!-- checkbox options -->
                                                                    <div class="sliderX_multipleOption_wrapper">

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationBullets"  name="sliderx_paginationType" value="bullets" <?php echo esc_attr($sliderx_paginationType === "bullets") ? "checked" : ""; ?>/>
                                                                            <label for="paginationDynamic"><?php esc_html_e( 'Bullets', 'sliderx'  ); ?></label>
                                                                        </div>

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationProgressbar"  name="sliderx_paginationType" value="progressbar" <?php echo esc_attr($sliderx_paginationType === "progressbar") ? "checked" : ""; ?>/>
                                                                            <label for="paginationProgressbar"><?php esc_html_e( 'Progressbar', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <div class="sliderx_settings_option_title me-2"><?php esc_html_e( 'Pagination Position', 'sliderx'  ); ?></div>
                                                                    <!-- checkbox options -->
                                                                    <div class="sliderX_multipleOption_wrapper">

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationTop"  name="sliderx_paginationPosition" value="top" <?php echo esc_attr($sliderx_paginationPosition === "top") ? "checked" : ""; ?>/>
                                                                            <label for="paginationTop"><?php esc_html_e( 'Top', 'sliderx'  ); ?></label>
                                                                        </div>

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationBottom"  name="sliderx_paginationPosition" value="bottom" <?php echo esc_attr($sliderx_paginationPosition === "bottom") ? "checked" : ""; ?>/>
                                                                            <label for="paginationBottom"><?php esc_html_e( 'Bottom', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( 'Style', 'sliderx'  ); ?></h5>

                                                                    <div class="sliderx_style_wrapper">

                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderxPagination_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                           
                                                                            <div class="sliderx_field">
                                                                                <input type="text" id="sliderxPagination_size" value="<?php echo esc_attr($pagiSize); ?>">
                                                                                <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderxPagination_color"><?php esc_html_e( 'Color', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field sliderx_color_field">
                                                                                <input type="text" id="sliderxPagination_color" value="<?php echo esc_attr($sliderx_pagiColor); ?>"  data-coloris>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( 'Active Style', 'sliderx'  ); ?></h5>

                                                                    <div class="sliderx_style_wrapper">

                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderx_paginationActive_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field">
                                                                                <input type="text" id="sliderx_paginationActive_size" value="<?php echo esc_attr($pagiActiveSize); ?>">
                                                                                <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                            </div>
                                                                        </div>
                    
                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderx_paginationActive_color"><?php esc_html_e( 'Active Color', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field sliderx_color_field">
                                                                                <input type="text" id="sliderx_paginationActive_color" value="<?php echo esc_attr($pagiActiveColor); ?>" data-coloris>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>                                                  
                                                    </div> <!--./ Tab Pagination -->

                                                    <!-- SliderX hook --- Tab content for -->
                                                    <?php  do_action('sliderX_tab_body', $api_url); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="sliderx_section_footer d-flex justify-content-end mt-4">
                                        <input type="hidden" class="sliderX_dashboard_url" value="<?php echo esc_url(admin_url( 'admin.php?page=sliderx' )); ?>">
  
                                        <a href="" class="sliderx_save_btn"><?php esc_html_e( 'Save', 'sliderx'  ); ?></a>
                                        </div>
                                    </div>

                                </div>


                                <!-- Edit / Update markup -->
                                <?php elseif ( isset( $_GET['page'], $_GET['sliderx'] ) && sanitize_text_field( $_GET['page'] ) === 'sliderx' && sanitize_text_field( $_GET['sliderx'] ) === 'update' ) : 

                                // Verify the nonce
                                if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'sliderx_update_action')) {
                                    wp_send_json_error(array('error' => 'Permission check failed'));
                                }

                                global $wpdb;
                                $edit_sliderXId = isset($_GET['sliderxId']) ? absint( $_GET['sliderxId'] ) : '';

                                $edit_sliderXData = $wpdb->get_results(
                                    $wpdb->prepare(
                                        "SELECT * FROM {$wpdb->prefix}sliderx_initial_projectsetup WHERE id = %d",
                                        $edit_sliderXId
                                    )
                                );
                                
                                $edit_xProjectId = isset($edit_sliderXData[0]->id) ? absint($edit_sliderXData[0]->id) : 0;
                                $edit_xProjectName = isset($edit_sliderXData[0]->projectName) ? sanitize_text_field($edit_sliderXData[0]->projectName) : '';
                                $edit_sliderType = isset($edit_sliderXData[0]->sliderType) ? sanitize_text_field($edit_sliderXData[0]->sliderType) : '';
                                
                                // Settings Data from database.
                                $updateSettingsData = $wpdb->get_row(
                                    $wpdb->prepare(
                                        "SELECT * FROM {$wpdb->prefix}sliderx_settings WHERE sliderId = %d",
                                        $edit_sliderXId
                                    )
                                );
                                
                                // General
                                $updateGeneral= isset($updateSettingsData->general) ? json_decode($updateSettingsData->general) : '';

                                $edit_sliderType = isset($updateSettingsData->sliderType) ? sanitize_text_field($updateSettingsData->sliderType) : '';
                                $layout_settings = isset($updateGeneral->layout) ? sliderx_Sanitize($updateGeneral->layout) : new stdClass();

                                $layoutType = sanitize_text_field($layout_settings->layoutType ?? "fullWidth");
                                $dimensionWidth = sanitize_text_field($layout_settings->dimension->width ?? "1200");
                                $dimensionHeight = sanitize_text_field($layout_settings->dimension->height ?? "600");
                                $dimensionRatio = absInt($layout_settings->dimension->ratio ?? 0 );
                                $autoHeight = sanitize_text_field($layout_settings->autoHeight ?? "false");

                                // Accessing other properties
                                $layoutDir = isset($updateGeneral->layoutDir) ? sanitize_text_field($updateGeneral->layoutDir) : 'horizontal';
                                $autoPlay = isset($updateGeneral->autoPlay) ? sanitize_text_field($updateGeneral->autoPlay) : '';
                                $autoPlayProp = isset($updateGeneral->autoPlayProp) ? (object) $updateGeneral->autoPlayProp : new stdClass();
                                
                                $autoPlayDelay = isset($autoPlayProp->autoPlayDelay) ? absint($autoPlayProp->autoPlayDelay) : 5000;
                                $pauseOnHover = isset($autoPlayProp->pauseOnHover) ? sanitize_text_field($autoPlayProp->pauseOnHover) : "false";
                                $disableOnInteraction = isset($autoPlayProp->disableOnInteraction) ? sanitize_text_field($autoPlayProp->disableOnInteraction) : "false";
                                $loop = isset($updateGeneral->loop) ? sanitize_text_field($updateGeneral->loop) : '';
                                $keyboardControl = isset($updateGeneral->KeyboardControl) ? sanitize_text_field($updateGeneral->KeyboardControl) : '';
                                $mouseWheel = isset($updateGeneral->mouseWheel) ? sanitize_text_field($updateGeneral->mouseWheel) : '';
                                $centeredSlide = isset($updateGeneral->centeredSlide) ? sanitize_text_field($updateGeneral->centeredSlide) : '';

                                // Text Content ====
                                $updateTextContent = isset( $updateSettingsData->content ) ? json_decode($updateSettingsData->content) : '';

                                // --- Content Box ---
                                $contentBox = isset($updateTextContent->contentBox) ? $updateTextContent->contentBox : '' ;
                                $sliderImg = isset($updateTextContent->sliderImg) ? $updateTextContent->sliderImg : '' ;

                                $contentBox_width = isset( $contentBox->width ) ? sanitize_text_field($contentBox->width) : '' ;
                                $contentBox_alignment = isset( $contentBox->alignment ) ? sanitize_text_field($contentBox->alignment) : '' ;
                                // --- Slider Image ---
                                $image_alignment = isset( $sliderImg->alignment ) ? sanitize_text_field($sliderImg->alignment) : '' ;

                                // --- Title ---
                                $titleVal = isset($updateTextContent->title) ? sanitize_text_field($updateTextContent->title) : '';
                         
                                // style
                                $titleStyle = isset($updateTextContent->titleStyle) ?  $updateTextContent->titleStyle  : '';
                                
                                $titleAlignment = isset($titleStyle->alignment) ? sanitize_text_field($titleStyle->alignment) : "center";

                                $titleFontsize = isset($titleStyle->fontsize) ? sanitize_text_field($titleStyle->fontsize) : "30";

                                $titleColor=  isset($titleStyle->fontColor) ? htmlspecialchars($titleStyle->fontColor) : "#333333";
                                $titleTitleBg= isset($titleStyle->titleBg) ? htmlspecialchars($titleStyle->titleBg) : "#dddddd";

                                // --- SubTitle ---
                                $subtitleVal = isset( $updateTextContent->subtitle ) ? sanitize_text_field($updateTextContent->subtitle) : '';
                                // style
                                $subtitleStyle = isset( $updateTextContent->subTitleStyle ) ? $updateTextContent->subTitleStyle : '';
                                $subtitleAlignment =isset($subtitleStyle->alignment) ? sanitize_text_field($subtitleStyle->alignment) : "center";
                                $subtitleFontsize = isset($subtitleStyle->fontsize) ? htmlspecialchars($subtitleStyle->fontsize) : "20";
                                $subtitleColor=  isset($subtitleStyle->color) ? htmlspecialchars($subtitleStyle->color) : "#333333";
                                $subtitleBg= isset($subtitleStyle->bgColor) ? htmlspecialchars($subtitleStyle->bgColor) : "#dddddd";

                                // Description
                                $descVal = isset($updateTextContent->desc) ? sanitize_text_field($updateTextContent->desc) : '';
                                // Style
                                $descStyle = isset($updateTextContent->descStyle) ? $updateTextContent->descStyle : '';
                                $descAlignment = isset($descStyle->alignment) ? sanitize_text_field($descStyle->alignment) : "center";
                                $descFontsize = isset($descStyle->fontsize) ? absint($descStyle->fontsize) : 18;
                                $descColor = isset($descStyle->color) ? sanitize_hex_color($descStyle->color) : "#333333";
                                $descBg = isset($descStyle->bgColor) ? sanitize_hex_color($descStyle->bgColor) : "#dddddd";

                                // CTA
                                $ctaVal = isset($updateTextContent->cta) ? sanitize_text_field($updateTextContent->cta) : '';

                                // Style
                                $ctaStyle = isset($updateTextContent->ctaStyle) ? $updateTextContent->ctaStyle : new stdClass();
                                $ctaAlignment = isset($ctaStyle->alignment) ? sanitize_text_field($ctaStyle->alignment) : "center";
                                $ctaFontsize = isset($ctaStyle->fontsize) ? absint($ctaStyle->fontsize) : 16;
                                $ctaColor = isset($ctaStyle->color) ? sanitize_hex_color($ctaStyle->color) : "#333333";
                                $ctaBg = isset($ctaStyle->bgColor) ? sanitize_hex_color($ctaStyle->bgColor) : "#dddddd";

                                // Decode JSON strings
                                $updateNavigation = isset($updateSettingsData->navigation) ? json_decode($updateSettingsData->navigation) : new stdClass();
                                $updatePagination = isset($updateSettingsData->pagination) ? json_decode($updateSettingsData->pagination) : new stdClass();

                                // Navigation
                                $sliderx_navigation = isset($updateNavigation->navigation) ? sanitize_text_field($updateNavigation->navigation) : '';
                                $sliderx_navType = isset($updateNavigation->navType) ? sanitize_text_field($updateNavigation->navType) : '';

                                // Style
                                $sliderx_navStyle = isset($updateNavigation->style) ? $updateNavigation->style : new stdClass();
                                $sliderx_navFontSize = isset($sliderx_navStyle->fontsize) ? absint($sliderx_navStyle->fontsize) : 40;
                                $sliderx_navColor = isset($sliderx_navStyle->color) ? sanitize_hex_color($sliderx_navStyle->color) : "#007aff";

                                // Pagination
                                $sliderx_pagination = isset($updatePagination->paginationVal) ? sanitize_text_field($updatePagination->paginationVal) : '';
                                $sliderx_paginationType = isset($updatePagination->paginationType) ? sanitize_text_field($updatePagination->paginationType) : '';
                                $sliderx_paginationPosition = isset($updatePagination->position) ? sanitize_text_field($updatePagination->position) : '';

                                // Style
                                $paginationStyle = isset($updatePagination->style) ? $updatePagination->style : new stdClass();
                                $pagiSize = isset($paginationStyle->fontsize) ? absint($paginationStyle->fontsize) : 14;
                                $sliderx_pagiColor = isset($paginationStyle->color) ? sanitize_hex_color($paginationStyle->color) : "#cbcbcb";

                                // Active Style
                                $pagination_ActiveStyle = isset($updatePagination->activeStyle) ? $updatePagination->activeStyle : new stdClass();
                                $pagiActiveSize = isset($pagination_ActiveStyle->fontsize) ? absint($pagination_ActiveStyle->fontsize) : 14;
                                $pagiActiveColor = isset($pagination_ActiveStyle->color) ? sanitize_hex_color($pagination_ActiveStyle->color) : "#007aff";

                                // updated/ existing api url
                                $update_ApiUrl = isset( $updateSettingsData->api_url ) ? sanitize_text_field($updateSettingsData->api_url) : '';

                                // Slider Title / Project Name
                                $settings_project_title = isset( $updateSettingsData->sliderTitle ) ? sanitize_text_field($updateSettingsData->sliderTitle) : '';

                                $initial_projectTitle = $edit_xProjectName;
                                $projectTitle = !empty($settings_project_title ) ? $settings_project_title : $initial_projectTitle;

                                ?>

                                <!-- Section update Slider -->

                                <!-- Section Publish -->
                                <div class="sliderx_section section_publish">
                                    <h3 class="section_title"><?php esc_html_e( "Publish", "sliderx" ); ?></h3>
                                    <div class="row my-3">
                                        <div class="col-lg-6">
                                            <div class="section_publish_item first mb-2">
                                                <h3 class="publish_item_title"><?php esc_html_e( "Shortcode", "sliderx" ); ?></h3>
                                                <p class="publish_item_txt"><?php esc_html_e( "Copy and paste this shortcode into your posts or pages:", "sliderx" ); ?></p>
                                                <div class="shortcode_field">
                                                    [sliderX type="<?php echo esc_attr($edit_sliderType); ?>" id="<?php echo esc_html($edit_sliderXId); ?>" /]
                                                </div>
                                                <div class="shortcode_copy_btn"><?php esc_html_e("Copy Shortcode", "sliderx"); ?></div>
                                            </div>
                                        </div>
                             
                                        <div class="col-lg-6">
                                            <div class="section_publish_item mb-2">
                                                <h3 class="publish_item_title"><?php esc_html_e( "PHP Code", "sliderx" ); ?></h3>
                                                <p class="publish_item_txt"><?php esc_html_e( "Paste the PHP code into your theme's file:", "sliderx" ); ?></p>
            
                                                <div class="shortcode_field">
                                                    &lt;?php echo do_shortcode('[sliderX type="<?php echo esc_attr($edit_sliderType); ?>" id="<?php echo esc_html($edit_sliderXId); ?>" /]'); ?&gt;
                                                </div>
                                                <div class="shortcode_copy_btn"><?php esc_html_e("Copy Shortcode", "sliderx"); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sliderx_section section_slider_config pb-0 mb-4">
                                    <div class="sliderx_section_header">
                                        <h3 class="section_title">
                                            <span class="project_title_wrapper">
                                                <span class="sliderx_projectId">
                                                    <?php esc_html_e( "ID : ", "sliderx" ); ?> <?php echo esc_html($edit_xProjectId); ?>
                                                </span>
                                                <span class="sliderx_projectName">
                                                    <input type="text" name="sliderx_projectName" value="<?php echo esc_attr($projectTitle); ?>">
                                                </span>
                                            </span>
                                        </h3>

                                    </div>

                                    <div class="row my-3 px-4 createSlidesWrapper">
                                        <input type="hidden" name="sliderx_updateId" id="sliderx_updateId" value="<?php echo esc_attr($edit_xProjectId); ?>">
                                        <div class="col-lg-6">

                                            <div class="sliderx_creation">
                                                <div class="sliderx_create_btn_wrapper">
                                                    <a id="sliderx_create_buttonTwo" class="sliderx_create_btn" href="javascript:void(0)"><span class="dashicons dashicons-plus"></span> <?php esc_html_e( "Create Slides", "sliderx" ); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="accordion sliderx_accordion" id="sliderx_slidesTwo">
                                                <?php 
                                                    global $wpdb;
                                                    $sliderXData = $wpdb->get_results(
                                                        $wpdb->prepare(
                                                            "SELECT * FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d",
                                                            $edit_sliderXId
                                                        )
                                                    );
                                                ?>
                                                <!-- Accordion Item will append here -->
                                                <?php 
                                                if( count($sliderXData) > 0):                                 
                                                    foreach ($sliderXData as $key => $data): 
                                                        $sliderData = json_decode($data->sliderData);
                                                        // Check if $sliderData is an array and not empty
                                                        if (is_array($sliderData) && !empty($sliderData)) :
                                                            $i=0;
                                                            foreach ($sliderData as $data) :
                                                                $i++;
                                                                // Sanitize each property
                                                                $image = esc_url($data->image ?? '');
                                                                $title = sanitize_text_field($data->title ?? '');
                                                                $subtitle = sanitize_text_field($data->subtitle ?? '');
                                                                $description = wp_kses_post($data->description ?? '');
                                                                $btnText1 = sanitize_text_field($data->btnText1 ?? '');
                                                                $btnLink1 = esc_url($data->btnLink1 ?? '');
                                                                $btnText2 = sanitize_text_field($data->btnText2 ?? '');
                                                                $btnLink2 = esc_url($data->btnLink2 ?? '');

                                                                ?>

                                                                <div class="accordion-item xSlides_item" id="accordion-itemTwo-<?php echo esc_attr($i); ?>">
                                                                    <h3 class="accordion-header" id="headingTwo<?php echo esc_attr($i); ?>">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sliderX_collapseTwo<?php echo esc_attr($i); ?>" aria-expanded="true" aria-controls="sliderX_collapseTwo<?php echo esc_attr($i); ?>">
                                                                            <?php echo esc_html__("Slide Item #", "sliderx") . esc_attr($i); ?>
                                                                        </button>

                                                                    <!-- Duplicate Button -->
                                                                    <div class="accordionItemAction_duplicate" data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate">
                                                                        <span type="button" class="btn sliderX_itemDuplicate" slider_id="<?php echo esc_attr($edit_sliderXId); ?>" data-item="<?php echo esc_attr($i); ?>"><span class="dashicons dashicons-admin-page"></span></span>
                                                                    </div>

                                                                    <!-- Delete Button -->
                                                                    <div class="accordionItemAction"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                        <span type="button" class="btn btn-danger sliderX_itemDelete" slider_id="<?php echo esc_attr($edit_sliderXId); ?>" data-item="<?php echo esc_attr($i); ?>"><span class="dashicons dashicons-no-alt"></span></span>
                                                                    </div>


                                                                    </h3>
                                                                    <div id="sliderX_collapseTwo<?php echo esc_attr($i); ?>" class="accordion-collapse collapse" aria-labelledby="headingTwo<?php echo esc_attr($i); ?>" data-bs-parent="#sliderx_slidesTwo">
                                                                        <div class="accordion-body sliderX_body">

                                                                            <div class="sliderX_media_wrapper mb-3">
                                                                                <div class="sliderx-uploaded-media" id="sliderx-uploaded-media-<?php echo esc_attr($i); ?>">
                                                                                    <img src="<?php echo esc_url($image); ?>" alt="Uploaded Media">
                                                                                </div>
                                                                                <input type="button" onclick="sliderXMedia(<?php echo esc_attr($i); ?>)" class="sliderX-media-upload-button" id="sliderx-media-upload-<?php echo esc_attr($i); ?>" value="Update Image">
                                                                            </div>

                                                                            <div class="sliderX_title_wrapper">
                                                                                <div class="sliderX_title_input"><?php esc_html_e( "Title", "sliderx" ); ?></div>
                                                                                <input type="text" class="form-control sliderx_title_input" value ="<?php echo esc_html($title); ?>" placeholder="Enter Title">
                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Title', 'sliderx'  ); ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="sliderX_subtitle_wrapper mt-2">
                                                                                <div class="sliderX_subtitle_input"><?php esc_html_e( "Subtitle", "sliderx" ); ?></div>
                                                                                <input type="text" class="form-control sliderx_subtitle_input" value="<?php echo esc_attr($subtitle); ?>" placeholder="Enter Subtitle">

                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Subtitle', 'sliderx'  ); ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="sliderX_desc_wrapper my-2">
                                                                                <div class="sliderX_title mb-1"> <?php esc_html_e( "Description ", "sliderx" ); ?></div>
                                                                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px"><?php echo esc_html($description); ?></textarea>
                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use Desc', 'sliderx'  ); ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="sliderX_cta_button_wrapper my-2">
                                                                                <div class="sliderX_title mb-1"> <?php esc_html_e( "CTA Button", "sliderx" ); ?></div>
                                                                                <div class="sliderx_button_item">
                                                                                    <input type="text" class="form-control sliderx_btnText1" value="<?php echo esc_attr($btnText1); ?>" placeholder="Button Text 1">
                                                                                    <input type="text" class="form-control sliderx_btnLink1" value="<?php echo esc_attr($btnLink1); ?>" placeholder="Button Link 1">
                                                                                </div>

                                                                                <div class="sliderx_button_item">
                                                                                    <input type="text" class="form-control sliderx_btnText2" value="<?php echo esc_attr($btnText2); ?>" placeholder="Button Text 2">
                                                                                    <input type="text" class="form-control sliderx_btnLink2" value="<?php echo esc_attr($btnLink2); ?>" placeholder="Button Link 2">
                                                                                </div>

                                                                                <div class="sliderX_helper_text mb-1">
                                                                                    <?php esc_html_e( 'Leave blank if you don\'t want to use CTA', 'sliderx'  ); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                             
                                        <div class="col col-lg-6">
                                            <div class="sliderx_settings_btn">
                                                <a class="sliderx_settingsBtn" href=""><span class="dashicons dashicons-admin-generic"></span></a>
                                            </div>
                                            <div class="sliderx_settings_panel">
                                                <ul class="nav nav-tabs" id="sliderxSettings_tabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-navigations="general" aria-selected="true"><?php esc_html_e( "General", "sliderx" ); ?></button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="textContent-tab" data-bs-toggle="tab" data-bs-target="#textContent" type="button" role="tab" aria-navigations="textContent" aria-selected="false"><?php esc_html_e( "Content", "sliderx" ); ?></button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="navigation-tab" data-bs-toggle="tab" data-bs-target="#navigation" type="button" role="tab" aria-navigations="navigation" aria-selected="false"><?php esc_html_e( "Navigation", "sliderx" ); ?></button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="sliderx_pagination-tab" data-bs-toggle="tab" data-bs-target="#sliderx_pagination" type="button" role="tab" aria-navigations="sliderx_pagination" aria-selected="false"><?php esc_html_e( "Pagination", "sliderx" ); ?></button>
                                                    </li>


                                                    <?php  do_action('sliderX_tab_head'); ?>
        
                                                    
                                                </ul>
                                                <div class="tab-content mt-4" id="sliderxSettings_content">

                                                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                                                        <!-- Slider Type -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <h5 class="sliderx_settings_option_title mb-2"><?php esc_html_e( "Type", "sliderx" ); ?></h5>

                                                            <div class="sliderx_type_wrapper">

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_slider" name="sliderXType" value="slider" <?php echo esc_attr( $edit_sliderType === "slider" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_slider">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/slider.svg') ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("Slider", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_carousel" name="sliderXType" value="carousel" <?php echo esc_attr( $edit_sliderType === "carousel" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_carousel">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/carousel.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("Carousel", "sliderx"); ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Carousel Wave -->
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_carousel_wave" name="sliderXType" value="carowave" <?php echo esc_attr( $edit_sliderType === "carowave" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_carousel_wave">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/carowave.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("CaroWave", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_group" name="sliderXType" value="group" <?php echo esc_attr( $edit_sliderType === "group" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_group">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/group.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("group", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_thumbnail" name="sliderXType" value="thumbnail" <?php echo esc_attr( $edit_sliderType === "thumbnail" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_thumbnail">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/thumbnail.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("thumbnail", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_featured" name="sliderXType" value="featured" <?php echo esc_attr( $edit_sliderType === "featured" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_featured">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/featured.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("Featured", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Center Mode -->
                                                                <div class="sliderx_type_item">
                                                                    <input type="radio" id="sliderx_type_centerMode" name="sliderXType" value="centermode" <?php echo esc_attr( $edit_sliderType === "centermode" ) ? "checked" : ""; ?>>
                                                                    <label for="sliderx_type_centerMode">
                                                                        <div class="sliderxTypeImg">
                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/centermode.svg' ); ?>" alt="">
                                                                        </div>
                                                                    </label>
                                                                    <div class="sliderx_type_name">
                                                                        <?php esc_html_e("Center Mode", "sliderx"); ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <!-- Layout -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Layout", "sliderx" ); ?></h5>

                                                            <div class="sliderX_multipleOption_wrapper sliderXLayoutType_wrapper">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="sliderx_fullWidth" name="sliderx_layoutType" value="fullWidth" <?php echo esc_attr($layoutType === "fullWidth") ? "checked" : ""; ?> />
                                                                    <label for="sliderx_fullWidth"><?php esc_html_e( "Full Width", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="sliderx_boxed" name="sliderx_layoutType" value="boxed" <?php echo esc_attr($layoutType === "boxed") ? "checked" : ""; ?> />
                                                                    <label for="sliderx_boxed"><?php esc_html_e( "Boxed", "sliderx" ); ?></label>
                                                                </div>
                                                            </div>

                                                            <!-- Auto Height -- Switcher -->
                                                            <div class="sliderx_settings_option mt-3 autoHeight_switcher_div">
                                                                <div class="sliderx_box_option d-flex">

                                                                    <div class="sliderx_switcher">
                                                                        <input type="checkbox" id="layoutAutoHeight" class="toggle-input" <?php echo esc_attr($autoHeight === "true") ? "checked" : ""; ?>>
                                                                        <label for="layoutAutoHeight" class="toggle-label"></label>
                                                                    </div>
                                                                    <span class="sliderx_switcher_title ms-3"><?php esc_html_e( "Auto Height", "sliderx" ); ?></span>
                                                                </div>
                                                                <!-- Note -->
                                                                <div class="sliderX_note sliderX_vertical"><?php esc_html_e("Note : Disable Auto height when use Vertical Direction !", "sliderx"); ?>
                                                                </div>

                                                            </div>
                                                            <!-- Layout Dimensions -->
                                                            <div class="sliderxLayouts_dimensions sliderx_box_option">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Dimensions", "sliderx"); ?></h6>
                                                                <div class="dimension_fields">
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_width"><?php esc_html_e( "Width", "sliderx" ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_width" placeholder="1200" value="<?php echo esc_attr($dimensionWidth); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_height"><?php esc_html_e( "Height", "sliderx" ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_height" placeholder="600" value="<?php echo esc_attr($dimensionHeight); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="slider_ratio"><?php esc_html_e( "Ratio", "sliderx" ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                        <input type="text" id="slider_ratio" name="ratio" placeholder="2.5" value="<?php echo esc_attr($dimensionRatio); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Slide Direction -->
                                                        <div class="sliderx_settings_option sliderx_box_option">
                                                            <div class="sliderxLayouts_direction">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Direction", "sliderx"); ?></h6>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper">

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="layoutsDirType1"  name="layoutsDirection" value="horizontal" <?php echo esc_attr($layoutDir === "horizontal") ? "checked" : ""; ?> />
                                                                        <label for="paginationType1"><?php esc_html_e("Horizontal", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="layoutsDirType2"  name="layoutsDirection" value="vertical" <?php echo esc_attr($layoutDir === "vertical") ? "checked" : ""; ?> />
                                                                        <label for="paginationType2"><?php esc_html_e("Vertical", "sliderx"); ?></label>
                                                                    </div>
                                                                </div>
                                                                <!-- Note -->
                                                                <div class="sliderX_note sliderX_vertical"><?php esc_html_e("Note : Vertical Direction will work with slider , featured type slider only !", "sliderx"); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Auto Play -- Switcher -->
                                                        <div class="sliderx_settings_option">

                                                            <div class="sliderx_box_option d-flex">
 
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_AutoPlay" class="toggle-input" <?php echo esc_attr( $autoPlay === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_AutoPlay" class="toggle-label"></label>
                                                                </div>
                                                                <span class="sliderx_switcher_title ms-3"><?php esc_html_e("AutoPlay", "sliderx"); ?></span>


                                                            </div>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper sliderx_box_option autoPlayOptions">

                                                                <div class="sliderX_multipleOption_item">
                                                                    <label><?php esc_html_e("Delay", "sliderx"); ?></label>
                                                                    <input type="text" id="autoplayDelay" class="option-input option-inputText" value="<?php echo esc_attr($autoPlayDelay); ?>"/>

                                                                </div>
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="checkbox" class="option-input xCheckbox" id="autoPlay_pauseOnhover" <?php echo esc_attr( $pauseOnHover === "true" ? "checked" : "" ); ?> />
                                                                    <label for="autoPlay_pauseOnhover"><?php esc_html_e("Autoplay Pause on hover", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="checkbox" class="option-input xCheckbox" id="autoPlay_disableOnInteraction" <?php echo esc_attr( $disableOnInteraction === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="autoPlay_disableOnInteraction"><?php esc_html_e("Disable on interaction", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Loop -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">

                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_loop" class="toggle-input" <?php echo esc_attr( $loop === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_loop" class="toggle-label"></label>
                                                                </div>
                                                                <span class="sliderx_switcher_title ms-3"><?php esc_html_e("Loop", "sliderx"); ?></span>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Keyboard Control -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">

                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_keyboardControl" class="toggle-input" <?php echo esc_attr( $keyboardControl === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_keyboardControl" class="toggle-label"></label>
                                                                </div>
                                                                <span class="sliderx_switcher_title ms-3"><?php esc_html_e("Keyboard Control", "sliderx"); ?></span>

                                                            </div>
                                                        </div>
                                                        
                                                        <!-- MouseWheel -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">

                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_mousewheel" class="toggle-input" <?php echo esc_attr( $mouseWheel === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_mousewheel" class="toggle-label"></label>
                                                                </div>
                                                                <span class="sliderx_switcher_title ms-3"><?php esc_html_e("Mouse Wheel Control", "sliderx"); ?></span>
                                                            </div>
                                                        </div>


                                                        <!-- Centered Slide -- Switcher -->
                                                        <div class="sliderx_settings_option sliderx_centeredSlide">
                                                            <div class="sliderx_box_option d-flex">

                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_centeredSlide" class="toggle-input" <?php echo esc_attr( $centeredSlide === "true" ? "checked" : "" ); ?>/>
                                                                    <label for="sliderx_centeredSlide" class="toggle-label"></label>
                                                                </div>
                                                                <span class="sliderx_switcher_title ms-3"><?php esc_html_e("Centered Slide", "sliderx"); ?></span>
                                                            </div>
                                                        </div>  

                                                    </div> <!--./ Tab general -->

                                                    <div class="tab-pane fade" id="textContent" role="tabpanel" aria-labelledby="textContent-tab">

                                                        <!-- Content With -->
                                                        <div class="sliderx_settings_option sliderx_box_option sliderx_content_manage">

                                                            <div class="sliderX_helper_wrapper mb-4">
                                                                <h6 class="sliderx_settings_option_title fs-6 mt-3"><?php esc_html_e("Content Box Width", "sliderx"); ?></h6>
                                                                <div class="dimension_fields">
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_contentBox_width1" class="sliderx_content_boxWidth" placeholder="100" value="<?php echo esc_attr($contentBox_width); ?>">
                                                                            <span class="sliderx_settings_unit">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="sliderX_helper_wrapper">
                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e("Box Alignment", "sliderx"); ?></h5>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper ">
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment4" name="sliderxContentBox_alignment" value="flex-start" <?php echo esc_attr($contentBox_alignment=== "flex-start") ? "checked" : ""; ?>/>
                                                                        <label for="contentBoxAlignment4"><?php esc_html_e("left", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment5" name="sliderxContentBox_alignment" value="flex-end" <?php echo esc_attr($contentBox_alignment=== "flex-end") ? "checked" : ""; ?>/>
                                                                        <label for="contentBoxAlignment5"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                    </div>

                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="contentBoxAlignment6" name="sliderxContentBox_alignment" value="center" <?php echo esc_attr($contentBox_alignment=== "center") ? "checked" : ""; ?>/>
                                                                        <label for="contentBoxAlignment6"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Note -->
                                                            <div class="sliderX_note"><?php esc_html_e("You can Adjustment your content Box width & alignment!", "sliderx"); ?></div>
                                                        </div>
                                                        <!-- Image -->
                                                        <div class="sliderx_settings_option sliderx_box_option sliderx_image_manage">
                                                            <div class="sliderX_helper_wrapper">
                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e("Image Position", "sliderx"); ?></h5>
                                                                <!-- checkbox options -->
                                                                <div class="sliderX_multipleOption_wrapper ">
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="sliderxImageAlignment3" name="sliderxImage_alignment" value="left" <?php echo esc_attr($image_alignment=== "left") ? "checked" : ""; ?>/>
                                                                        <label for="sliderxImageAlignment3"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderX_multipleOption_item">
                                                                        <input type="radio" class="option-input xRadio" id="sliderxImageAlignment4" name="sliderxImage_alignment" value="right" <?php echo esc_attr($image_alignment=== "right") ? "checked" : ""; ?>/>
                                                                        <label for="sliderxImageAlignment4"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Note -->
                                                            <div class="sliderX_note"><?php esc_html_e("Choose the image position for the slider: either to the left or right of the text.", "sliderx"); ?></div>
                                                        </div>

                                                        <!-- Title -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Title", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_title" class="toggle-input" <?php echo esc_attr($titleVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_title" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Title -->
                                                        <div class="sliderx_settings_option sliderx_box_option titleStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="left" <?php echo esc_attr($titleAlignment=== "left") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="right" <?php echo esc_attr($titleAlignment=== "right") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="titleAlignment1" name="sliderXTitle_alignment" value="center" <?php echo esc_attr($titleAlignment=== "center") ? "checked" : ""; ?>/>
                                                                    <label for="titleAlignment1"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e("Style", "sliderx"); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_Fontsize"><?php esc_html_e("Font Size", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="title_Fontsize" value="<?php echo esc_attr($titleFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_FontColor"><?php esc_html_e("Color", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="title_FontColor" value="<?php echo esc_attr($titleColor); ?>"  data-coloris>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="title_FontBg"><?php esc_html_e("Background", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="title_FontBg" value="<?php echo esc_attr($titleTitleBg); ?>"  data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Subtitle -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Subtitle", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_subtitle" class="toggle-input" <?php echo esc_attr($subtitleVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_subtitle" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Subtitle -->
                                                        <div class="sliderx_settings_option sliderx_box_option subtitleStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentLeft" name="subTitleAlignment" value="left" <?php echo esc_attr($subtitleAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentLeft"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentRight" name="subTitleAlignment" value="right" <?php echo esc_attr($subtitleAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentRight"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="subAlignmentCenter" name="subTitleAlignment" value="center" <?php echo esc_attr($subtitleAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="subAlignmentCenter"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e("Style", "sliderx"); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_FontSize"><?php esc_html_e("Font Size", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="subTitle_FontSize" value="<?php echo esc_attr($subtitleFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e("PX", "sliderx"); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_FontColor"><?php esc_html_e("Color", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="subTitle_FontColor" value="<?php echo esc_attr($subtitleColor); ?>" data-coloris>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="subTitle_bgColor"><?php esc_html_e("Background", "sliderx"); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="subTitle_bgColor" value="<?php echo esc_attr($subtitleBg); ?>" data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Description -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e("Description", "sliderx"); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_desc" class="toggle-input" <?php echo esc_attr($descVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_desc" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- style for -- Description -->
                                                        <div class="sliderx_settings_option sliderx_box_option descriptionStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e("Text Alignment", "sliderx"); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentLeft" name="descAlignment" value="left" <?php echo esc_attr($descAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentLeft"><?php esc_html_e("Left", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentRight" name="descAlignment" value="right" <?php echo esc_attr($descAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentRight"><?php esc_html_e("Right", "sliderx"); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="descAlignmentCenter" name="descAlignment" value="center" <?php echo esc_attr($descAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="descAlignmentCenter"><?php esc_html_e("Center", "sliderx"); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( "Style", "sliderx" ); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_FontSize"><?php esc_html_e( "Font Size", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="desc_FontSize" value="<?php echo esc_attr($descFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_FontColor"><?php esc_html_e( "Color", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="desc_FontColor" value="<?php echo esc_attr($descColor); ?>"  data-coloris>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="desc_bgColor"><?php esc_html_e( "Background", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="desc_bgColor" value="<?php echo esc_attr($descBg); ?>" data-coloris>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- CTA -- Switcher -->
                                                        <div class="sliderx_settings_option">
                                                            <div class="sliderx_box_option d-flex">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e( "CTA", "sliderx" ); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderx_cta" class="toggle-input" <?php echo esc_attr($ctaVal === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderx_cta" class="toggle-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Style for -- CTA -->
                                                        <div class="sliderx_settings_option sliderx_box_option ctaStyleWrapper">

                                                            <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Text Alignment", "sliderx" ); ?></h5>
                                                            <!-- checkbox options -->
                                                            <div class="sliderX_multipleOption_wrapper ">
                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentLeft" name="ctaAlignment" value="left" <?php echo esc_attr($ctaAlignment === "left") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentLeft"><?php esc_html_e( "Left", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentRight" name="ctaAlignment" value="right" <?php echo esc_attr($ctaAlignment === "right") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentRight"><?php esc_html_e( "Right", "sliderx" ); ?></label>
                                                                </div>

                                                                <div class="sliderX_multipleOption_item">
                                                                    <input type="radio" class="option-input xRadio" id="ctaAlignmentCenter" name="ctaAlignment" value="center" <?php echo esc_attr($ctaAlignment === "center") ? "checked" : ""; ?>/>
                                                                    <label for="ctaAlignmentCenter"><?php esc_html_e( "Center", "sliderx" ); ?></label>
                                                                </div>
                                                            </div>

                                                            <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( "Style", "sliderx" ); ?></h5>
                                                            <div class="sliderx_style_wrapper">
                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_fontSize"><?php esc_html_e( "Font Size", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field">
                                                                        <input type="text" id="sliderx_cta_fontSize" value="<?php echo esc_attr($ctaFontsize); ?>">
                                                                        <span class="sliderx_settings_unit"><?php esc_html_e( "PX", "sliderx" ); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_color"><?php esc_html_e( "Color", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="sliderx_cta_color" value="<?php echo esc_attr($ctaColor); ?>"  data-coloris>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_field_item">
                                                                    <div class="sliderx_label">
                                                                        <label for="sliderx_cta_bg"><?php esc_html_e( "Background", "sliderx" ); ?></label>
                                                                    </div>
                                                                    <div class="sliderx_field sliderx_color_field">
                                                                        <input type="text" id="sliderx_cta_bg" value="<?php echo esc_attr($ctaBg); ?>"  data-coloris>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div> <!--./ Tab textContent -->

                                                    <div class="tab-pane fade" id="navigation" role="tabpanel" aria-labelledby="navigation-tab">
                                                        <!-- Navigation -->
                                                        <div class="sliderx_navigation_option_wrapper">

                                                            <div class="sliderx_navigation_option sliderx_box_option">
                                                                <span class="sliderx_switcher_title me-2"><?php esc_html_e( 'Arrow', 'sliderx'  ); ?></span>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="nav_arrow" class="toggle-input" <?php echo esc_attr($sliderx_navigation === "true") ? "checked" : ""; ?>>
                                                                    <label for="nav_arrow" class="toggle-label"></label>
                                                                </div>
                                                            </div>

                                                            <!-- Navigation Style list -->
                                                            <div class="sliderx_type sliderx_navigation_options_list sliderx_box_option">

                                                                <h5 class="sliderx_settings_option_title"><?php esc_html_e( "Next / Previous buttons style:", "sliderx" ); ?></h5>

                                                                <div class="sliderx_type_item_wrapper">

                                                                    <div class="sliderx_type_item sliderx_navigation_type_item">
                                                                        <input type="radio" id="sliderx_nav_angle" name="navigationType" value="nav_angle" <?php echo esc_attr($sliderx_navType === "nav_angle") ? "checked" : ""; ?>>
                                                                        <label for="sliderx_nav_angle">
                                                                            <div class="sliderxType_img">
                                                                                <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/angle.png'); ?>" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="sliderx_type_item sliderx_navigation_type_item">
                                                                        <input type="radio" id="sliderx_nav_arrow" name="navigationType" value="nav_arrow" <?php echo esc_attr($sliderx_navType === "nav_arrow") ? "checked" : ""; ?>>
                                                                        <label for="sliderx_nav_arrow">
                                                                            <div class="sliderxType_img">
                                                                                <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/arrow.png'); ?>" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                </div>

                                                                <h5 class="sliderx_settings_option_title mt-4"><?php esc_html_e( 'Style', 'sliderx'  ); ?></h5>

                                                                <div class="sliderx_style_wrapper">

                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_nav_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field">
                                                                            <input type="text" id="sliderx_nav_size" value="<?php echo esc_attr($sliderx_navFontSize); ?>">
                                                                            <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="sliderx_field_item">
                                                                        <div class="sliderx_label">
                                                                            <label for="sliderx_nav_color"><?php esc_html_e( 'Color', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                        <div class="sliderx_field sliderx_color_field">
                                                                            <input type="text" id="sliderx_nav_color" value="<?php echo esc_attr($sliderx_navColor); ?>"  data-coloris>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>                                                  
                                                    </div> <!--./ Tab navigation -->


                                                    <div class="tab-pane fade" id="sliderx_pagination" role="tabpanel" aria-labelledby="sliderx_pagination-tab">
                                                        <!-- Pagination -->
                                                        <div class="sliderx_pagination_option_wrapper">

                                                            <div class="sliderx_pagination_option sliderx_box_option">
                                                                <div class="sliderx_switcher_title me-2"><?php esc_html_e( 'Pagination', 'sliderx'  ); ?></div>
                                                                <div class="sliderx_switcher">
                                                                    <input type="checkbox" id="sliderxPagination" class="toggle-input" <?php echo esc_attr($sliderx_pagination === "true") ? "checked" : ""; ?>>
                                                                    <label for="sliderxPagination" class="toggle-label"></label>
                                                                </div>
                                                            </div>

                                                            <div class="sliderx_pagination_options_list">
                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <div class="sliderx_settings_option_title me-2"><?php esc_html_e( 'Pagination Type', 'sliderx'  ); ?></div>
                                                                    <!-- checkbox options -->
                                                                    <div class="sliderX_multipleOption_wrapper">

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationBullets"  name="sliderx_paginationType" value="bullets" <?php echo esc_attr($sliderx_paginationType === "bullets") ? "checked" : ""; ?>/>
                                                                            <label for="paginationDynamic"><?php esc_html_e( 'Bullets', 'sliderx'  ); ?></label>
                                                                        </div>

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationProgressbar"  name="sliderx_paginationType" value="progressbar" <?php echo esc_attr($sliderx_paginationType === "progressbar") ? "checked" : ""; ?>/>
                                                                            <label for="paginationProgressbar"><?php esc_html_e( 'Progressbar', 'sliderx'  ); ?></label>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <div class="sliderx_settings_option_title me-2"><?php esc_html_e( 'Pagination Position', 'sliderx'  ); ?></div>
                                                                    <!-- checkbox options -->
                                                                    <div class="sliderX_multipleOption_wrapper">

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationTop"  name="sliderx_paginationPosition" value="top" <?php echo esc_attr($sliderx_paginationPosition === "top") ? "checked" : ""; ?>/>
                                                                            <label for="paginationTop"><?php esc_html_e( 'Top', 'sliderx'  ); ?></label>
                                                                        </div>

                                                                        <div class="sliderX_multipleOption_item">
                                                                            <input type="radio" class="option-input xRadio" id="paginationBottom"  name="sliderx_paginationPosition" value="bottom" <?php echo esc_attr($sliderx_paginationPosition === "bottom") ? "checked" : ""; ?>/>
                                                                            <label for="paginationBottom"><?php esc_html_e( 'Bottom', 'sliderx'  ); ?></label>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( 'Style', 'sliderx'  ); ?></h5>

                                                                    <div class="sliderx_style_wrapper">

                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderxPagination_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                           
                                                                            <div class="sliderx_field">
                                                                                <input type="text" id="sliderxPagination_size" value="<?php echo esc_attr($pagiSize); ?>">
                                                                                <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderxPagination_color"><?php esc_html_e( 'Color', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field sliderx_color_field">
                                                                                <input type="text" id="sliderxPagination_color" value="<?php echo esc_attr($sliderx_pagiColor); ?>"  data-coloris>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="sliderx_settings_option sliderx_box_option">

                                                                    <h5 class="sliderx_settings_option_title mt-2"><?php esc_html_e( 'Active Style', 'sliderx'  ); ?></h5>

                                                                    <div class="sliderx_style_wrapper">
                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderx_paginationActive_size"><?php esc_html_e( 'Size', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field">
                                                                                <input type="text" id="sliderx_paginationActive_size" value="<?php echo esc_attr($pagiActiveSize); ?>">
                                                                                <span class="sliderx_settings_unit"><?php esc_html_e( 'PX', 'sliderx'  ); ?></span>
                                                                            </div>
                                                                        </div>
                    
                                                                        <div class="sliderx_field_item">
                                                                            <div class="sliderx_label">
                                                                                <label for="sliderx_paginationActive_color"><?php esc_html_e( 'Active Color', 'sliderx'  ); ?></label>
                                                                            </div>
                                                                            <div class="sliderx_field sliderx_color_field">
                                                                                <input type="text" id="sliderx_paginationActive_color" value="<?php echo esc_attr($pagiActiveColor); ?>" data-coloris>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                  
                                                    </div> <!--./ Tab Pagination -->

                                                    <?php  do_action('sliderX_tab_body', $update_ApiUrl); ?>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="sliderx_section_footer d-flex justify-content-end mt-4">
                                        <input type="hidden" class="sliderX_dashboard_url" value="<?php echo esc_url(admin_url( 'admin.php?page=sliderx' )); ?>">
  
                                        <a href="" class="sliderx_update_btn"><?php esc_html_e( 'Update', 'sliderx'  ); ?></a>
                                        </div>

                                    </div>

                                </div> <!-- End of Update Section -->

                                <!-- ===== Dashboard ====== -->
                                <?php  else : ?>
               
                                    <!-- Create Project -->
                                    <div class="row_createdProjectWrapper">
                                        <!-- New Project -->
                                        <div class="createNewSlider d-flex align-items-center justify-content-center">
                                            <div class="createNewInnerContent" data-bs-toggle="modal" data-bs-target="#sliderxNewProject">
                                                <a class="createProject_btn"><span class="dashicons dashicons-plus"></span></a>
                                                <h5 class="createProjectText"><?php esc_html_e( 'Create Project', 'sliderx'  ); ?></h5>
                                            </div>
                                        </div>

                                        <?php 

                                        global $wpdb;
                                        $table_name1 = "{$wpdb->prefix}sliderx_initial_projectsetup";
                                        $table_name2 = "{$wpdb->prefix}sliderx_data";

                                        // Check if both tables exist
                                        $table1_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name1 ) );
                                        $table2_exists = $wpdb->get_var($wpdb->prepare( "SHOW TABLES LIKE %s", $table_name2 ) );

                                        if ($table1_exists && $table2_exists) {
                                            // Both tables exist, retrieve data
                                            $sliderXData = $wpdb->get_results("
                                                SELECT *
                                                FROM {$wpdb->prefix}sliderx_initial_projectsetup AS projectsetup
                                                INNER JOIN {$wpdb->prefix}sliderx_data AS sliderxData ON projectsetup.id = sliderxData.sliderId
                                                ORDER BY sliderxData.sliderId DESC
                                            ");
                                            
                                            // <!-- Created Project Item -->
                                            foreach ($sliderXData as $key => $data) : 
                                                $projectName = $data->projectName;
                                                $sliderType = $data->sliderType;
                                                $sliderId = $data->sliderId;
                                                $sliderData = json_decode($data->sliderData); 
                                                // $sliderXImage = $sliderData[0]->image;
                                                $sliderXImage = !empty($sliderData) && isset($sliderData[0]->image) ? $sliderData[0]->image : '';

                                                // Generating the link with nonce
                                                $updateUrl_with_nonce = wp_nonce_url(admin_url('admin.php?page=sliderx&sliderx=update&sliderxId=' . $sliderId), 'sliderx_update_action');

                                                ?>
                                                    <div class="createdProjectSliderItem">
                                                        <div class="createProjectSliderInner">
                                                            <div class="projectImage">
                                                                <img src="<?php echo esc_url($sliderXImage); ?>" alt="">
                                                                <div class="created_project_option">
                                                                    <div class="sliderx_shortcode_option">
                                                                        <span class="sliderx_shortcode">[sliderX type="<?php echo esc_attr($sliderType); ?>" id="<?php echo esc_attr($sliderId); ?>"/]</span><span class="sliderx_shortcode_copy"><?php esc_html_e("Copy", "sliderx"); ?></span>
                                                                    </div>
                                                                    <div class="sliderX_action">
                                                                        <div class="sliderx_edit">
                                                                            <a href="<?php echo esc_url($updateUrl_with_nonce); ?>"><span class="dashicons dashicons-edit"></span></a>
                                                                        </div>
                                                                        <div class="sliderx_delete">
                                                                            <a href="" class="sliderX_delId" delId="<?php echo esc_attr($sliderId); ?>"><span class="dashicons dashicons-trash"></span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h5 class="createProjectText"><?php echo esc_html($projectName); ?></h5>
                                                        </div>
                                                    </div>
                                                <?php 
                                            endforeach; 
                                        }   ?>
                                    </div>

                                    <!-- Modal ==> Area Start -->

                                    <!-- Modal -> New Project -->
                                    <div class="modal fade" id="sliderxNewProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sliderxNewProjectLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="newProjectStart_box">
                                                        <div class="col_InnerWrapper">
                                                            <div class="row">
                                                                <div class="col_header_intro">

                                                                    <h3><?php esc_html_e("What would you like to create today?", "sliderx" ); ?></h3>

                                                                    <h5 class="fs-6"><?php esc_html_e( "Use our powerful editing options, or effortlessly import one of our existing templates.", "sliderx" ); ?></h5>
                                                                </div>

                                                                <div class="col col-lg-6">

                                                                    <a data-bs-toggle="modal" data-bs-target="#sliderX_ProjectSettings" class="newProject_btn">

                                                                    <div class="newProject_box mb-4">
                                                                        <div class="img_box">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. 'assets/images/newproject.png'); ?>" alt="create a new project">
                                                                        </div>
                                                                        <div class="info_box">
                                                                            <h4><?php esc_html_e("Create a New Project", "sliderx" ); ?></h4>
                                                                            <p class="fs-6">
                                                                                <?php echo wp_kses_post( "Start your project from the ground up and bring your vision to life. Customize every detail effortlessly and build exactly what you imagine, layer by layer." ); ?>
                                                                            </p>

                                                                        </div>
                                                                    </div>

                                                                    </a>
                                                                </div>

                                                                <div class="col col-lg-6">
                                                                <a data-bs-toggle="modal" data-bs-target="#sliderX_template" class="newProject_btn">
                                                                    <div class="chooseTemplate_box mb-4">
                                                                        <div class="img_box">
                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. 'assets/images/template.png'); ?>" alt="start with template">
                                                                        </div>
                                                                        <div class="info_box">
                                                                            <h4><?php esc_html_e( "Start with a Template", "sliderx" ); ?></h4>
                                                                            <p class="fs-6">
                                                                                <?php echo wp_kses_post("Start with a template and make it faster your workflow with the innovative and customization. You can choose from unlimited of pre-made templates." ); ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                </div>

                                                            </div>
                                                        </div> <!-- End Inner column -->
                                                    </div> <!-- End Start Box column -->
                                                </div> <!-- End Body -->

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -> New Project settings -->
                                    <div class="modal fade" id="sliderX_ProjectSettings" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sliderX_ProjectSettingsLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close settingsModal_closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="newProjectStart_settings">
                                                        <div class="col_InnerWrapper">
                                                            <div class="row">
                                                                <div class="col_header_intro">
                                                                    <h2><?php esc_html_e( 'Create new project', 'sliderx'  ); ?></h2>
                                                                </div>

                                                                <div class="col-lg-12">

                                                                    <div class="sliderxProject_settings_wrapper">

                                                                        <div class="project_name mb-4">
                                                                            <h5 class="mb-3"><?php esc_html_e( 'Project Name ', 'sliderx'  ); ?><span class="xslier_successTxt text-success"><?php esc_html_e( 'Project Created Successfully !', 'sliderx'  ); ?></span></h5>
                                                                            <input type="text" class="form-control w-75" id="projectNameInput" placeholder="Enter Project Name" required>
                                                                        </div>
                                        
                                                                        <div class="sliderx_type mb-4">
                                                                            <h5 class="mb-3"><?php esc_html_e( 'Slider type', 'sliderx'  ); ?></h5>
                                                                            <div class="sliderx_type_item_wrapper pb-4">

                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_slider" name="sliderType" value="slider" checked>
                                                                                    <label for="sliderx_slider">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url( SLIDERX_DIR_URI. '/assets/images/slider.svg' ); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Slider', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>

                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_carousel" name="sliderType" value="carousel">
                                                                                    <label for="sliderx_carousel">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/carousel.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Carousel', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>
                                                                                <!-- Carousel Wave -->
                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_carousel_wave" name="sliderType" value="carowave">
                                                                                    <label for="sliderx_carousel_wave">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/carowave.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'CaroWave', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>

                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_group" name="sliderType" value="group">
                                                                                    <label for="sliderx_group">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/group.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Group Slider', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>

                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_thumbnail" name="sliderType" value="thumbnail">
                                                                                    <label for="sliderx_thumbnail">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/thumbnail.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Thumbnail', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>

                                                                                <!-- Featured -->
                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_featured" name="sliderType" value="featured">
                                                                                    <label for="sliderx_featured">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/featured.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Featured', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>

                                                                                <!-- Center Mode -->
                                                                                <div class="sliderx_type_item">
                                                                                    <input type="radio" id="sliderx_centerMode" name="sliderType" value="centermode">
                                                                                    <label for="sliderx_centerMode">
                                                                                        <div class="sliderxType_img">
                                                                                            <img src="<?php echo esc_url(SLIDERX_DIR_URI. '/assets/images/centermode.svg'); ?>" alt="">
                                                                                        </div>
                                                                                        <h5 class="sliderxType_text"><?php esc_html_e( 'Center Mode', 'sliderx'  ); ?></h5>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <input type="hidden" value="<?php echo esc_url(admin_url( 'admin.php?page=sliderx&sliderx=slider-editor' )); ?>" id="xslierEditor_url" >
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div> <!-- End InnerWrapper -->
                                                    </div> <!-- End Start Box column -->
                                                </div> <!-- End Body -->

                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <div class="sliderx_createProjectBtn_wrapper">

                                                        <div class="sliderx_project_create_inner">
                                                            <a href="<?php echo esc_url(admin_url( 'admin.php?page=sliderx&sliderx=slider-editor' )); ?>" class="btn btn-success rounded-0" id="sliderx_createProject_btn"><?php esc_html_e( 'Create Project', 'sliderx'  ); ?></a><br>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -> New Project Template-->
                                    <div class="modal fade" id="sliderX_template" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sliderX_template" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title"><?php esc_html_e( 'Choose Template', 'sliderx'  ); ?><span class="text-muted fs-6">  <?php esc_html_e( '( It\'s under Development )', 'sliderx'  ); ?></span></h3>
                                                    <button type="button" class="btn-close settingsModal_closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="project_template_settings">

                                                        <!-- Preloader -->
                                                        <div class="sliderTemplate_preloader">
                                                            <div class="preLoaderInner">
                                                                <img src="<?php echo esc_url(SLIDERX_DIR_URI.'assets/images/preloader4.gif'); ?>" alt="preloader">
                                                            </div>
                                                        </div>

                                                        <div class="col_InnerWrapper">
                                                            <div class="row">
                                                                <div class="col_header_intro">
                                                                    <h3 class="text-start">
                                                                        <!-- <?php esc_html_e( 'Choose Template', 'sliderx'  ); ?> -->
                                                                        <span class="importer_success_msg text-success"><?php esc_html_e( 'Successfully Imported !', 'sliderx'  ); ?></span>
                                                                    </h3>
                                                                    
                                                                </div>

                                                                <div class="col-lg-12">

                                                                    <div class="sliderx_template_settings_wrapper">
                                                                        <div class="sliderx_template_type mb-4">
                                                                            <div class="sliderx_template_item_wrapper pb-4">
                                                                                <?php 
                                                                                    global $wpdb;
                                                                                    // Prepare the table names with the prefix
                                                                                    $initialTable = $wpdb->prefix . 'sliderx_initial_projectsetup';
                                                                                    $sliderDataTable = $wpdb->prefix . 'sliderx_data';
                                                                                    
                                                                                    // Define the query to select unique project names
                                                                                    $query = "
                                                                                        SELECT DISTINCT initial_setup.projectName
                                                                                        FROM $initialTable AS initial_setup
                                                                                        INNER JOIN $sliderDataTable AS sliderx_data
                                                                                        ON initial_setup.id = sliderx_data.sliderId";

                                                                                    // Execute the query
                                                                                    $results = $wpdb->get_results($query);

                                                                                ?>
                                                                                <!-- Template 1 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_1" name="templateType" value="template_1"  sliderType="slider" checked>
                                                                                        <label for="sliderx_template_1">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/slider-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Slider', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>
                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_1"): ?>
                                                                                        <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_1"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                                <!-- Template 2 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_2" name="templateType" value="template_2"  sliderType="carousel">
                                                                                        <label for="sliderx_template_2">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/carousel-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Carousel', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_2"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_2"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                                
                                                                                <!-- Template 3 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_3" name="templateType" value="template_3"  sliderType="carowave">
                                                                                        <label for="sliderx_template_3">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/carowave-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Carouwave', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_3"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_3"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                                <!-- Template 4 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_4" name="templateType" value="template_4"  sliderType="carousel">
                                                                                        <label for="sliderx_template_4">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/group-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Group Slider', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_4"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_4"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                                <!-- Template 5 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_5" name="templateType" value="template_5"  sliderType="carousel">
                                                                                        <label for="sliderx_template_5">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/thumbnail-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Thumbnail', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_5"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_5"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>

                                                                                <!-- Template 6 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_6" name="templateType" value="template_6"  sliderType="carousel">
                                                                                        <label for="sliderx_template_6">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/featured-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Featured', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_6"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_6"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                                <!-- Template 7 -->
                                                                                <div class="template_item_wrapper">
                                                                                    <div class="sliderx_template_item">
                                                                                        <input type="radio" id="sliderx_template_7" name="templateType" value="template_7"  sliderType="carousel">
                                                                                        <label for="sliderx_template_7">
                                                                                            <div class="sliderx_template_img">
                                                                                                <img src="<?php echo esc_url( SLIDERX_DIR_URI. 'assets/images/templates/centermode-1.png' ); ?>" alt="">
                                                                                            </div>
                                                                                            <h5 class="sliderx_template_text"><?php esc_html_e( 'Center Mode', 'sliderx'  ); ?></h5>
                                                                                        </label>
                                                                                    </div>

                                                                                    <!-- Import Status Info wrapper -->
                                                                                    <?php foreach($results as $template ): ?>
                                                                                        <?php if($template->projectName === "template_7"): ?>
                                                                                            <div class="template_item_status">
                                                                                            <span class="template_imported"><?php esc_html_e( 'Imported', 'sliderx'  ); ?></span>
                                                                                            <span id="<?php echo esc_attr($template->sliderId); ?>" class="template_use" data-template="template_7"><?php esc_html_e( 'Use', 'sliderx'  ); ?></span>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <input type="hidden" value="<?php echo esc_url(admin_url( 'admin.php?page=sliderx&sliderx=slider-editor' )); ?>" id="xslierEditor_url" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- End InnerWrapper -->
                                                    </div> <!-- End Start Box column -->

                                                </div> <!-- End Body -->

                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <div class="sliderx_createProjectBtn_wrapper">

                                                        <div class="sliderx_project_create_inner">
                                                            <button class="btn btn-success rounded-0" id="sliderx_import_btn" disabled><?php esc_html_e( 'Import', 'sliderx'  ); ?></button><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal ==> Area End -->
                                <?php  endif ?>
                            </div>
                        <!-- </div> -->
                    </div>
                    <!--/ End Custom Wrapper -->
                </div>
            <!--/ End WP Wrap -->
            <div class="clear"></div>
        </div><!-- wpbody-content -->
        <div class="clear"></div>
    </div>
    <!--End Main -->
<?php

}
}



















