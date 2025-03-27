<?php
/*
* @Pakage SliderX.
*/
require_once(SLIDERX_DIR_PATH . 'includes/helper/sliderX-merge.php');

// Check if function is_plugin_active exists
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
  
// sliderX Shortcode
function sliderX_shortcode( $attr ) {

    // Extract attributes for ease of use
    $id = !empty($attr['id']) ? absint($attr['id']) : '';
    $type = !empty($attr['type']) ? sanitize_text_field($attr['type']) : 'slider';
    
    $attrs = shortcode_atts(
        array(
            'id'  => $id,
            'type' => $type
        ), $attr );  ob_start(); ?>
    <style>
    /* query for Change direction  */
    /* @media (max-width: 760px) {
      .swiper-button-next {
        right: 20px;
        transform: rotate(90deg);
      }
      .swiper-button-prev {
        left: 20px;
        transform: rotate(90deg);
      }
    } */

    </style>

    <?php 
    global $wpdb;
    /* sliderX Content Data */

    $sliderData = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}sliderx_data WHERE sliderId = %d", $id));

    /* sliderX Settings */
    $sliderSettings = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}sliderx_settings WHERE sliderId = %d", $id));
    
    // TextContent
    $contentSettings = isset($sliderSettings[0]->content) ? json_decode($sliderSettings[0]->content) : null;

    // --- Content Box ---
    $contentBox = isset($contentSettings->contentBox) ? $contentSettings->contentBox : '' ;
    $sliderImg = isset($contentSettings->sliderImg) ? $contentSettings->sliderImg : '' ;

    $contentBox_width = isset( $contentBox->width) ? sanitize_text_field($contentBox->width) : 85 ;
    $contentBox_alignment = isset( $contentBox->alignment ) ? sanitize_text_field($contentBox->alignment) : 'flex-start' ;

    // --- Slider Image ---
    $image_alignment = isset( $sliderImg->alignment ) ? sanitize_text_field($sliderImg->alignment) : 'left' ;

    // Title
    $titleVal = '';
    $titleStyle = '';
    if ($contentSettings !== null) {
        $titleVal = isset($contentSettings->title) ? sanitize_text_field($contentSettings->title) : '';
        // Style
        $titleStyle = $contentSettings->titleStyle;
    }
    $titleAlignment = isset($titleStyle->alignment) ? sanitize_text_field($titleStyle->alignment) : '';
    $titleFontsize = isset($titleStyle->fontsize) ? sanitize_text_field($titleStyle->fontsize) : '';
    $titleColor = isset($titleStyle->fontColor) ? sanitize_text_field($titleStyle->fontColor) : '';
    $titleBg = isset($titleStyle->titleBg) ? sanitize_text_field($titleStyle->titleBg) : '';
    // $titleBg = hex2rgba($titleBg, 0.7);

    // Subtitle
    $subtitleVal = '';
    $subtitleStyle = '';
    if ($contentSettings !== null) {
        $subtitleVal = isset($contentSettings->subtitle) ? sanitize_text_field($contentSettings->subtitle) : '';
        // Style
        $subtitleStyle = $contentSettings->subTitleStyle;
    }
    $subtitleAlignment = isset($subtitleStyle->alignment) ? sanitize_text_field($subtitleStyle->alignment) : '';
    $subtitleFontsize = isset($subtitleStyle->fontsize) ? sanitize_text_field($subtitleStyle->fontsize) : '';
    $subtitleColor = isset($subtitleStyle->color) ? sanitize_text_field($subtitleStyle->color) : '';
    $subtitleBg = isset($subtitleStyle->bgColor) ? sanitize_text_field($subtitleStyle->bgColor) : '';
    // $subtitleBg = hex2rgba($subtitleBg, 0.7);

    // Description
    $descriptionVal = '';
    $descriptionStyle = '';
    if ($contentSettings !== null) {
        $descriptionVal = isset($contentSettings->desc) ? sanitize_text_field($contentSettings->desc) : '';
        // Style
        $descriptionStyle = $contentSettings->descStyle;
    }
    $descriptionAlignment = isset($descriptionStyle->alignment) ? sanitize_text_field($descriptionStyle->alignment) : '';
    $descriptionFontsize = isset($descriptionStyle->fontsize) ? sanitize_text_field($descriptionStyle->fontsize) : '';
    $descriptionColor = isset($descriptionStyle->color) ? sanitize_text_field($descriptionStyle->color) : '';
    $descriptionBg = isset($descriptionStyle->bgColor) ? sanitize_text_field($descriptionStyle->bgColor) : '';
    // $descriptionBg = hex2rgba($descriptionBg, 0.7);

    // CTA
    $ctaVal = '';
    $ctaStyle = '';
    if ($contentSettings !== null) {
        $ctaVal = isset($contentSettings->cta) ? sanitize_text_field($contentSettings->cta) : '';
        // Style
        $ctaStyle = sliderx_Sanitize($contentSettings->ctaStyle ?? new stdClass());
    }
    $ctaAlignment1 = isset($ctaStyle->alignment) ? sanitize_text_field($ctaStyle->alignment) : '';
    $ctaFontsize = isset($ctaStyle->fontsize) ? sanitize_text_field($ctaStyle->fontsize) : '';
    $ctaColor = isset($ctaStyle->color) ? sanitize_text_field($ctaStyle->color) : '';
    $ctaBg = isset($ctaStyle->bgColor) ? sanitize_text_field($ctaStyle->bgColor) : '';

      // .sliderX_cta_btn -- CTA Button Wrapper
      $ctaAlignment = "";
      if ($ctaAlignment1 === "right") {
          $ctaAlignment = "flex-end";
      } elseif ($ctaAlignment1 === "center") {
          $ctaAlignment = "center";
      }else {
        $ctaAlignment = 'flex-start';
      }



    // $color = '#ffa226';
    // $rgb = hex2rgba($color);
    // $ctaBg = hex2rgba($ctaBg, 0.7);

    //Navigation 
    $navigationSettings = isset($sliderSettings[0]->navigation) ? $sliderSettings[0]->navigation : "false";
    $navigationSettings = json_decode($navigationSettings);

    $navigationVal = $navigationSettings->navigation;
    $navType = $navigationSettings->navType;
    $navStyle = $navigationSettings->style;

    // Style
    $navSize = isset($navStyle->fontsize) ? sanitize_text_field( $navStyle->fontsize ) : '';
    $navColor = isset($navStyle->color) ? sanitize_text_field( $navStyle->color ) : '';
    $navBg = isset($navStyle->bgColor) ? sanitize_text_field( $navStyle->bgColor ) : '';
    // $navBg = hex2rgba($navBg, 0.7);

    //Pagination 
    $paginationSettings = isset($sliderSettings[0]->pagination) ? $sliderSettings[0]->pagination : "false";
    $paginationSettings = json_decode($sliderSettings[0]->pagination);

    $paginationVal = $paginationSettings->paginationVal;
    $paginationType = $paginationSettings->paginationType;
    // Style
    $paginationStyle = $paginationSettings->style;
    $paginationSize = isset($paginationStyle->fontsize) ? sanitize_text_field( $paginationStyle->fontsize ) : '';
    $paginationColor = isset($paginationStyle->color) ? sanitize_text_field( $paginationStyle->color ) : '';
    $paginationBg = isset($paginationStyle->bgColor) ? sanitize_text_field( $paginationStyle->bgColor ) : '';
    $paginationBg = hex2rgba($paginationBg, 0.7);
    // Active Style
    $paginationActiveStyle = $paginationSettings->activeStyle;
    $paginationActiveSize = isset($paginationActiveStyle->fontsize) ? sanitize_text_field( $paginationActiveStyle->fontsize ) : '';
    $paginationActiveColor = isset($paginationActiveStyle->color) ? sanitize_text_field( $paginationActiveStyle->color ) : '';
    // General Settings Data
    $generalSettings = isset($sliderSettings[0]->general) ? json_decode($sliderSettings[0]->general) : '';
    // Layout Settings
    $layoutSettings = $generalSettings->layout;
    $centeredSlide = $generalSettings->centeredSlide;


    $layoutType = isset($layoutSettings->layoutType) ? sanitize_text_field( $layoutSettings->layoutType ) : '';
    $dimension = $layoutSettings->dimension;

    $sliderX_width = !empty($dimension->width) ? absint($dimension->width) : "";
    $sliderX_height = !empty($dimension->height) ? absint($dimension->height) : "";
    $autoHeight = isset($layoutSettings->autoHeight) ? sanitize_text_field($layoutSettings->autoHeight) : "";

    // Api Url
    $api_url = isset($sliderSettings[0]->api_url) ? sanitize_text_field($sliderSettings[0]->api_url) : '';
  ?>


  <style>
  /*===== Dynamic Style ====== */
  <?php echo '#sliderX-' . esc_attr($id); ?> {
  width: <?php echo esc_attr(($layoutType === "boxed" && !empty($sliderX_width)) ? $sliderX_width . 'px' : '100%'); ?>;
  height: <?php 
      if (($layoutType === "boxed" && !empty($sliderX_height)) || ($layoutType === "fullWidth" && $autoHeight === "false" && !empty($sliderX_height))) {
          echo esc_attr($sliderX_height) . 'px';
      } else {
          echo  $type === "slider" ? "50vh": "auto";
      } 
  ?>;
  }

  /* TextContent */
  /* ---Title--- */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_title'; ?> {
    text-align: <?php echo esc_attr($titleAlignment); ?>;
    font-size: <?php echo esc_attr($titleFontsize); ?>px;
    color: <?php echo esc_attr($titleColor); ?>;
    background-color: <?php echo esc_attr($titleBg); ?>;
  }
  /* Extension css */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_extension_item .slierX_overlay'; ?> {
    background-color: <?php echo esc_attr($titleBg); ?>;
  }

  /* ---subtitle--- */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_subtitle'; ?> {
    text-align: <?php echo esc_attr($subtitleAlignment); ?>;
    font-size: <?php echo esc_attr($subtitleFontsize); ?>px;
    color: <?php echo esc_attr($subtitleColor); ?>;
    background-color: <?php echo esc_attr($subtitleBg); ?>;
  }

  /* --- Description --- */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_description'; ?> {
    text-align: <?php echo esc_attr($descriptionAlignment); ?>;
    font-size: <?php echo esc_attr($descriptionFontsize); ?>px;
    color: <?php echo esc_attr($descriptionColor); ?>;
    background-color: <?php echo esc_attr($descriptionBg); ?>;
  }

  /* CTA Button Wrapper  */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_cta_btn'; ?> {
    justify-content: <?php echo esc_attr($ctaAlignment); ?>;
  }

  /* --- CTA --- */
  <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_btn'; ?> {
    text-align: <?php echo esc_attr($ctaAlignment1); ?>;
    font-size: <?php echo esc_attr($ctaFontsize); ?>px;
    color: <?php echo esc_attr($ctaColor); ?> !important;
    background-color: <?php echo esc_attr($ctaBg); ?> !important;
  }
  /* Navigation */
  <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-button-next::after, '; ?> 
  <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-button-prev::after'; ?>  { 
      font-size: <?php echo esc_attr($navSize); ?>px;
      color: <?php echo esc_attr($navColor); ?> !important;
      /* background-color: <?php echo esc_attr($navBg); ?>; */
  }
  /* Pagination */
  <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-pagination-bullet'; ?>  { 
    width: <?php echo esc_attr($paginationSize); ?>px;
    height: <?php echo esc_attr($paginationSize); ?>px;
    color: <?php echo esc_attr($paginationColor); ?> !important;
    background-color: <?php echo esc_attr($paginationBg); ?>;
  }
  /* Active Style */
  <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-pagination-bullet-active'; ?>  { 
    width: <?php echo esc_attr($paginationActiveSize); ?>px;
    height: <?php echo esc_attr($paginationActiveSize); ?>px;
    background-color: <?php echo esc_attr($paginationActiveColor); ?> !important;
  }

  </style>


    <?php if($type === "centermode" && $centeredSlide === "true" ): ?>
      <style>
        /* Center Mode css */

        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX-slide'; ?> {
          box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
          /* width: 100% !important; */
          max-width: 50% !important;
        }
        <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-slide .sliderX_Item'; ?>{
          display: flex;
          justify-content: center;
          align-items: center;
          flex-flow: column nowrap;
        }
        <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-slide .sliderX_Item .sliderX_content'; ?>{
          position: relative;
          top: 0;
        }
        <?php echo '#sliderX-' . esc_attr($id) . ' .swiper-slide img'; ?>{
          height: auto;
          width: 100%;
        }


      </style>
    <?php endif; ?>

    <?php if( $type === "carowave" ): ?>
      <style>
      <?php echo '#sliderX-' . esc_attr($id); ?> {
        height: auto;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item'; ?> {
        background-color: #f3faf7;
        margin-top: 0;
        transition: margin-top 0.5s ease-in-out;
        /* width: 25%; */
        margin: 0 7px;
        padding: 25px 20px;
        height: <?php 
            if (($layoutType === "boxed" && !empty($sliderX_height)) || ($layoutType === "fullWidth" && $autoHeight === "false" && !empty($sliderX_height))) {
                echo esc_attr($sliderX_height) . 'px';
            } else {
                echo  $type === "slider" ? "50vh": "auto";
            } 
        ?>;
        min-height: 250px;
        max-height: 100%;
        display: flex;
        justify-content: center;
        align-items: normal;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item.swiper-slide-active'; ?>  {
        background-color: #d2f8e8;
        margin-top: 0;
        transform: scale(1);
        transition: all 0.5s ease-in-out;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item.swiper-slide-prev'; ?>, 
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item.swiper-slide-next'; ?> {
        background-color: #f3faf7;
        margin-top: 50px;
        transition: margin-top 0.5s ease-in-out;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item .sliderX_Item'; ?> {
        /* width: 65%; */
        display: flex;
        align-items: center;
        justify-content: center;
        flex-flow: column nowrap;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item .sliderX_Item .sliderX_image'; ?> {
        position: relative;
        padding: 5;
        max-width: 50% !important;
        height: auto;
        margin-bottom: 20px;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item .sliderX_Item .sliderX_content'; ?> {
        position: relative;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_content_inner_wrapper'; ?> {
        width: 100%;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_title'; ?> {
        /* font-size: 22px; */
        background: transparent;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_subtitle'; ?> {
        /* font-size: 18px; */
        background: transparent;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderXContent_description'; ?> {
        background: transparent;
      }
      @media (max-width: 991.98px) {
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item'; ?> {
          width: 50%;
        }
      }
      @media (max-width: 767.98px) {
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item'; ?> {
          width: 50%;
        }
      }
      @media (max-width: 575.98px) {
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_slider_item'; ?> {
          width: 100%;
        }
      }

      </style>
    <?php endif; ?>

    <?php if( $type === "group" ): ?>
      <style>
      @media (max-width: 990.98px) {
        
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_smart_right_content .sliderX_smart_item'; ?> {
          width: 46%;
        }
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_smart_full_content .sliderX_smart_item'; ?> {
          width: 23%;
        }
      }
      @media (max-width: 767.98px) {
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_smart_right_content .sliderX_smart_item'; ?> {
          width: 46%;
        }
      }
      @media (max-width: 575.98px) {
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_smart_right_content .sliderX_smart_item'; ?> {
          width: 45%;
        }
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_smart_full_content .sliderX_smart_item'; ?> {
          width: 22.5%;
        }

      }

      </style>
    <?php endif; ?>
    <!-- Carousel -->
    <?php if( $type === "carousel" ): ?>
      <style>
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX-slide .sliderX_Item .sliderX_content .sliderX_content_inner_wrapper'; ?> {
        width: 100%;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX-slide .sliderX_Item .sliderX_content'; ?> {
        height: auto;
        position: relative;
        top: 0;
        border: 1px solid #ddd;
      }

      </style>
    <?php endif; ?>

    <!-- Thumbnail -->
    <?php if( $type === "thumbnail" ): ?>
      <style>
      <?php echo '#sliderX-' . esc_attr($id); ?> {
        height: auto;
      }
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX-slide .sliderX_Item .sliderX_image'; ?> {
        height: auto;
      }
      </style>
    <?php endif; ?>

     <!-- Slider -->
    <?php if( $type === "slider" ): ?>
      <style>
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX-slide'; ?> {
        width: 100%;
        background-size: cover;
      }

      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_content'; ?> {
        /* align-items: <?php echo esc_attr($contentBox_alignment); ?> !important; */
        padding: 35px;
      }

      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_content_inner_wrapper'; ?> {
        width: <?php echo esc_attr($contentBox_width); ?>%;
        justify-content: <?php echo esc_attr($contentBox_alignment); ?>;
      }
      </style>
      
    <?php endif; ?>

     <!-- Featured -->
    <?php if( $type === "featured" && $image_alignment === "right" ): ?>
      <style>
      <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_featured_content'; ?> {
        flex-direction: row-reverse;
      }
      </style>
    <?php else: ?>
      <style>
        <?php echo '#sliderX-' . esc_attr($id) . ' .sliderX_featured_content'; ?> {
          flex-direction: initial;
        }
      </style>
    <?php endif; ?>

    <?php

      foreach ($sliderData as $key => $data) {
        $sliderId = $data->sliderId;
        $sliderData = json_decode($data->sliderData);

        $apiData = array();
        // Call the default function
        $sliderX_data = sliderX_mergeData($sliderData, $apiData);
        // Apply custom filter to merge data if the hook is used, otherwise use default merge
        $sliderX_merged_data = apply_filters('sliderX_slider_data', $sliderX_data, $sliderData, $apiData, $api_url);

        if($type === "group"){
          // Split the data
          $sliderX_merged_data = sliderX_splitSliderData($sliderX_merged_data);
        }

      ?>
        <div class="swiper sliderX full-width" id="sliderX-<?php echo esc_attr($sliderId); ?>">
          <div class="swiper-wrapper">
            <?php 
            $i = 0;
            foreach ($sliderX_merged_data as $key => $sliderItemData) : 

              $image = isset($sliderItemData['image']) ? esc_url_raw($sliderItemData['image']) : '';
              $xSlide_title = isset($sliderItemData['title']) ? sanitize_text_field($sliderItemData['title']) : '';
              $xSlide_subtitle = isset($sliderItemData['subtitle']) ? sanitize_text_field($sliderItemData['subtitle']) : '';
              $xSlide_desc = isset($sliderItemData['description']) ? sanitize_text_field($sliderItemData['description']) : '';
              $xSlide_btnText1 = isset($sliderItemData['btnText1']) ? sanitize_text_field($sliderItemData['btnText1']) : '';
              $xSlide_btnText2 = isset($sliderItemData['btnText2']) ? sanitize_text_field($sliderItemData['btnText2']) : '';
              $xSlide_btnLink1 = isset($sliderItemData['btnLink1']) ? sanitize_text_field($sliderItemData['btnLink1']) : '';
              $xSlide_btnLink2 = isset($sliderItemData['btnLink2']) ? sanitize_text_field($sliderItemData['btnLink2']) : '';
              ?>

                <?php if($type === 'group'): ?>
                  <div class="swiper-slide sliderX-slide">
                    <?php 
                      if($i === 0):  $slidex_Data[] = $sliderX_merged_data[$i]; ?>
                        <div class="sliderX_Item smart_item">
                          <?php foreach ($slidex_Data  as $key => $slideData ) :  ?>
                            <div class="sliderX_smart_left_content">
                              <div class="sliderX_image">
                                <img src="<?php echo esc_url($slideData[0]['image']); ?>" alt="">
                              </div>
                            </div>

                            <div class="sliderX_smart_right_content">
                              <div class="sliderX_smart_item">
                                <div class="sliderX_image">
                                  <img src="<?php echo esc_url($slideData[1]['image']); ?>" alt="">
                                </div>
                              </div>

                              <div class="sliderX_smart_item">
                                <div class="sliderX_image">
                                  <img src="<?php echo esc_url($slideData[2]['image']); ?>" alt="">
                                </div>
                              </div>

                              <div class="sliderX_smart_item">
                                <div class="sliderX_image">
                                  <img src="<?php echo esc_url($slideData[3]['image']); ?>" alt="">
                                </div>
                              </div>

                              <div class="sliderX_smart_item">
                                <div class="sliderX_image">
                                  <img src="<?php echo esc_url($slideData[4]['image']); ?>" alt="">
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                          <div class="sliderX_Item smart_item">
                            <div class="sliderX_smart_full_content">
                              <?php foreach ($sliderX_merged_data[$i] as $key => $slideData ) :  ?>
                                <div class="sliderX_smart_item">
                                  <div class="sliderX_image">
                                    <img src="<?php echo esc_url($slideData['image']); ?>" alt="">
                                  </div>
                                </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                      <?php endif; ?>
                  </div>
                <!-- Thumbnail -->
                <?php elseif($type === 'thumbnail'): ?>
                  <div class="swiper-slide sliderX-slide" style="background-image: url();">
                  <div class="sliderX_Item">
                      <div class="sliderX_image">
                        <img src="<?php echo esc_url($image); ?>" alt="">
                      </div>
                  </div>
                </div>

                <?php elseif($type === 'featured'): ?>
                <!-- Featured Slider -->
                <div class="swiper-slide sliderX-slide">
                  <div class="sliderX_Item">
                      <div class="sliderX_featured_content">
                        <div class="sliderX_featured_left">
                          <img src="<?php echo esc_url($image); ?>" />
                        </div>
                        <div class="sliderX_featured_right">
                          <!-- Title -->
                          <?php if($titleVal === "true" && !empty($xSlide_title)): ?>
                            <div class="sliderXContent_title">
                              <?php echo esc_html($xSlide_title); ?>
                            </div>
                          <?php endif; ?>
                          <!-- Subtitle -->
                          <?php if($subtitleVal === "true" && !empty($xSlide_subtitle)): ?>
                            <div class="sliderXContent_subtitle">
                              <?php echo esc_html($xSlide_subtitle); ?>
                            </div>
                          <?php endif; ?>
                          <!-- Description -->
                          <?php if($descriptionVal === "true" && !empty($xSlide_desc)): ?>
                            <div class="sliderXContent_description">
                              <?php echo esc_html($xSlide_desc);?>
                            </div>
                          <?php endif; ?>
                          <!-- CTA -->
                          <?php if($ctaVal  === "true"): ?>
                            <div class="sliderX_cta_btn">
                              <?php if(isset($xSlide_btnText1) && !empty($xSlide_btnText1)): ?>
                              <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                              <?php endif; ?>

                              <?php if(isset($xSlide_btnText2) && !empty($xSlide_btnText2)): ?>
                              <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- Center Mode Slider -->
                <?php elseif($type === 'centermode' && $centeredSlide !== "false"): ?>
                <div class="swiper-slide sliderX-slide">
                  <div class="sliderX_Item">
                      <div class="sliderX_image">
                        <img src="<?php echo esc_url($image); ?>" alt="">
                      </div>
                      <div class="sliderX_content">
                        <div class="sliderX_content_inner_wrapper">
                          <!-- Title -->
                          <?php if($titleVal  === "true"  && !empty($xSlide_title)): ?>
                            <div class="sliderXContent_title">
                              <?php echo esc_html($xSlide_title); ?>
                            </div>
                          <?php endif; ?>
                          <!-- Subtitle -->
                          <?php if($subtitleVal  === "true" && !empty($xSlide_subtitle)): ?>
                            <div class="sliderXContent_subtitle">
                              <?php echo esc_html($xSlide_subtitle); ?>
                            </div>
                          <?php endif; ?>

                          <!-- Description -->
                          <?php if($descriptionVal  === "true" && !empty($xSlide_desc)): ?>
                            <div class="sliderXContent_description">
                              <?php echo esc_html($xSlide_desc); ?>
                            </div>
                          <?php endif; ?>

                          <!-- CTA -->
                          <?php if($ctaVal  === "true"): ?>

                            <div class="sliderX_cta_btn">
                              <?php if(isset($xSlide_btnText1) && !empty($xSlide_btnText1)): ?>
                              <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                              <?php endif; ?>

                              <?php if(isset($xSlide_btnText2) && !empty($xSlide_btnText2)): ?>
                              <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                              <?php endif; ?>
                            </div>

                          <?php endif; ?>

                        </div>
                      </div>
                  </div>
                </div>
                <!-- Carousel Wave -->
                <?php elseif($type === 'carowave'): ?>
                  <div class="swiper-slide sliderX_slider_item sliderX_caroWave" >
                    <div class="sliderX_Item">
                        <div class="sliderX_image">
                          <img src="<?php echo esc_url($image); ?>" alt="">
                        </div>
                        <div class="sliderX_content">
                          <div class="sliderX_content_inner_wrapper">
                            <!-- Title -->
                            <?php if($titleVal  === "true"  && !empty($xSlide_title)): ?>
                              <div class="sliderXContent_title">
                                <?php echo esc_html($xSlide_title); ?>
                              </div>
                            <?php endif; ?>
                            <!-- Subtitle -->
                            <?php if($subtitleVal  === "true" && !empty($xSlide_subtitle)): ?>
                              <div class="sliderXContent_subtitle">
                                <?php echo esc_html($xSlide_subtitle); ?>
                              </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if($descriptionVal  === "true" && !empty($xSlide_desc)): ?>
                              <div class="sliderXContent_description">
                                <?php echo esc_html($xSlide_desc); ?>
                              </div>
                            <?php endif; ?>

                            <!-- CTA -->
                            <?php if($ctaVal  === "true"): ?>

                              <div class="sliderX_cta_btn">
                                <?php if(isset($xSlide_btnText1) && !empty($xSlide_btnText1)): ?>
                                <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                                <?php endif; ?>

                                <?php if(isset($xSlide_btnText2) && !empty($xSlide_btnText2)): ?>
                                <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                                <?php endif; ?>
                              </div>

                            <?php endif; ?>

                          </div>
                        </div>
                    </div>
                  </div>

                <!-- Carousel -->
                <?php elseif($type === 'carousel'): ?>
                  <div class="swiper-slide sliderX-slide" >
                    <div class="sliderX_Item">
                        <div class="sliderX_content">
                          <div class="sliderX_image">
                            <img src="<?php echo esc_url($image); ?>" alt="">
                          </div>
                          <?php if($titleVal  === "true" || $subtitleVal  === "true" || $descriptionVal  === "true"): ?>
                          <div class="sliderX_content_inner_wrapper">
                            <!-- Title -->
                            <?php if($titleVal  === "true" && !empty($xSlide_title)): ?>
                              <div class="sliderXContent_title">
                                <?php echo esc_html($xSlide_title); ?>
                              </div>
                            <?php endif; ?>
                            <!-- SubtitleVal -->
                            <?php if($subtitleVal  === "true" && !empty($xSlide_subtitle)): ?>
                              <div class="sliderXContent_subtitle">
                                <?php echo esc_html($xSlide_subtitle); ?>
                              </div>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if($descriptionVal  === "true" && !empty($xSlide_desc)): ?>
                              <div class="sliderXContent_description">
                                <?php echo esc_html($xSlide_desc); ?>
                              </div>
                            <?php endif; ?>

                            <!-- CTA -->
                            <?php if($ctaVal  === "true"): ?>
                              <div class="sliderX_cta_btn">
                                <?php if(isset($xSlide_btnText1) && !empty($xSlide_btnText1)): ?>
                                <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                                <?php endif; ?>

                                <?php if(isset($xSlide_btnText2) && !empty($xSlide_btnText2)): ?>
                                <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>

                          </div>
                          <?php endif; ?>
                          
                        </div>
                    </div>
                  </div>
                <?php elseif(is_plugin_active('sliderx-extension/sliderX-extension.php') && $type === 'slider'): ?>
                  <div class="swiper-slide sliderX-slide"  style="background-image: url(<?php echo esc_url($image); ?>);">
                    <div class="sliderX_Item sliderX_extension_item">
                        <div class="sliderX_image">
                          <!-- Overlay -->
                          <div class="slierX_overlay">
                            <div class="slierX_overlay_content">
                              <?php if(!empty($xSlide_title)): ?>
                              <div class="overlay_title sliderXContent_title">
                                <?php echo esc_html($xSlide_title); ?>
                              </div>
                              <?php endif; ?>
                              <!-- <div class="overlay_dateTime">
                                <p>16.08.2024</p>
                              </div> -->

                              <!-- CTA -->
                              <?php if($ctaVal  === "true"): ?>
                                <div class="overlay_cta sliderX_cta_btn">
                                  <?php if(isset($xSlide_btnText1) && !empty($xSlide_btnText1)): ?>
                                  <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                                  <?php endif; ?>

                                  <?php if(isset($xSlide_btnText2) && !empty($xSlide_btnText2)): ?>
                                  <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                                  <?php endif; ?>
                                </div>
                              <?php endif; ?>

                              <?php ?>
                            </div>
                          </div>
                        </div>

                        <div class="sliderX_content sliderX__content">
                          <?php if( $subtitleVal  === "true" || $descriptionVal  === "true"): ?>
                            <div class="sliderX_content_inner_wrapper">
                              <!-- SubtitleVal -->
                              <?php if($subtitleVal  === "true" && !empty($xSlide_subtitle)): ?>
                                <div class="sliderXContent_subtitle">
                                  <?php echo esc_html($xSlide_subtitle); ?>
                                </div>
                              <?php endif; ?>

                              <!-- Description -->
                              <?php if($descriptionVal  === "true" && !empty($xSlide_desc)): ?>
                                <div class="sliderXContent_description">
                                  <?php echo esc_html($xSlide_desc); ?>
                                </div>
                              <?php endif; ?>
                              
                            </div>
                          <?php endif; ?>
                        </div>
 
                    </div>
                  </div>
                <?php else: ?>
                  <!-- Default Slider -->
                  <div class="swiper-slide sliderX-slide"  style="background-image: url(<?php echo esc_url($image); ?>);">
                    <div class="sliderX_Item">
   
                        <div class="sliderX_content">
                          <div class="sliderX_content_inner_wrapper">
                            <?php if($titleVal  === "true" && !empty($xSlide_title)): ?>
                              <div class="sliderXContent_title">
                                <?php echo esc_html($xSlide_title);?>
                              </div>
                            <?php endif; ?>

                            <?php if($subtitleVal  === "true" && !empty($xSlide_subtitle)): ?>
                              <div class="sliderXContent_subtitle">
                                <?php echo esc_html($xSlide_subtitle); ?>
                              </div>
                            <?php endif; ?>

                            <?php if($descriptionVal  === "true" && !empty($xSlide_desc)): ?>
                              <div class="sliderXContent_description">
                                <?php echo esc_html($xSlide_desc); ?>
                              </div>
                            <?php endif; ?>
                            
                            <?php if($ctaVal  === "true"): ?>
                              <div class="sliderX_cta_btn">
                                <?php if(!empty($xSlide_btnText1)): ?>
                                  <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink1); ?>"><?php echo esc_html( $xSlide_btnText1 ); ?></a>
                                <?php endif; ?>

                                <?php if(!empty($xSlide_btnText2)): ?>
                                  <a class="sliderX_btn" href="<?php echo esc_url($xSlide_btnLink2); ?>"><?php echo esc_html( $xSlide_btnText2 ); ?></a>
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                    </div>
                  </div>
                <?php endif; ?>
              <?php 
              $i++; 
            endforeach;  ?>
          </div>
          <!-- Add Navigation -->
          <?php 
            if($navigationVal === "true"){
                if($navType === "nav_arrow"){
                  ?>
                    <div class="swiper-button-prev sliderX_nav_prev"></div>
                    <div class="swiper-button-next sliderX_nav_next"></div>
                  <?php
                }else {
                  ?>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  <?php
                }
              }
          ?>
          <!-- Add Pagination -->
          <?php if($paginationVal === "true") : ?>
            <div class="swiper-pagination"></div>
          <?php endif; ?>
        </div>
        <!-- Thumbnail -->
        <?php if($type === 'thumbnail'): ?>
          <div thumbsSlider="" class="swiper sliderX_thumbnail" id="sliderX_thumbnail-<?php echo esc_attr($sliderId); ?>">
            <div class="swiper-wrapper">
              <?php foreach ($sliderX_merged_data as $key => $sliderItemData) :  $image = $sliderItemData['image']; ?>
                <div class="swiper-slide sliderX-slide">
                  <div class="sliderX_Item">
                    <img src="<?php echo esc_url($image); ?>" />
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php 
      }
    ?>

  <?php
  // Get the buffered output and clean the buffer
  $output = ob_get_clean();
  return $output;
}



// Callback function for split slider data
if(!function_exists('sliderX_splitSliderData')){
  function sliderX_splitSliderData($data) {
    $result = [];
    $firstBatchSize = 5;
    $subsequentBatchSize = 8;
    
    // Get the total number of items in the data array
    $totalItems = count($data);
  
    // Handle the first batch of 5 items
    if ($totalItems > 0) {
        $result[] = array_slice($data, 0, $firstBatchSize);
    }
  
    // Handle subsequent batches of 6 items
    for ($i = $firstBatchSize; $i < $totalItems; $i += $subsequentBatchSize) {
        $result[] = array_slice($data, $i, $subsequentBatchSize);
    }
  
    return $result;
  }
}





// Convert hexdec color string to rgb(a) string */
if(!function_exists('hex2rgba')){
  function hex2rgba($color, $opacity = false) {
    $default = '';

    // Return default if no color provided
    if (empty($color)) {
        return $default;
    }

    // Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    // Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    // Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    // Check if opacity is set (rgba or rgb)
    if ($opacity !== false) {
        // Ensure opacity is between 0 and 1
        $opacity = min(1, max(0, floatval($opacity)));
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    // Return rgb(a) color string
    return $output;
  }
}
