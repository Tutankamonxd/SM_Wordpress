"use strict";
jQuery(document).ready(function ($) {

  /* ================== Project Start Modal Handling ===============
    ================================================================*/
  
  let newProjectModal = $("#sliderXNewProject");
  let projectSettingsModal = $("#sliderX_ProjectSettings");

  $(".newProject_btn").on("click", function (e) {
    e.preventDefault();

    $("#sliderXNewProject").modal('hide');
    // $("#sliderX_ProjectSettings").modal('show');

  });

  // Modal 
  let modalBackDropOpacity = $(".modal-backdrop.fade.show");
  $(".settingsModal_closeBtn").on("click", function () {
    newProjectModal.modal('hide');
    projectSettingsModal.modal('hide');

  });
 

  // Create Slides Repeater
  $("#sliderx_create_buttonOne").on('click', function (e) {
      e.preventDefault();
      
      let sliderx_slides_container = $("#sliderx_slidesOne");
  
      // Counter to keep track of the number of items created
      let itemCount = sliderx_slides_container.children('.accordion-item').length + 1;

      let sliderx_slides_item= `
          <div class="accordion-item xSlides_item" id="accordion-item-${itemCount}">
              <h2 class="accordion-header" id="heading${itemCount}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${itemCount}" aria-expanded="false" aria-controls="collapse${itemCount}">
                      Slide Item #${itemCount}
                  </button>
                  
                  <!-- Duplicate Button -->
                  <div class="accordionItemAction_duplicate" data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate">
                      <span type="button" class="btn sliderX_itemDuplicate"><span class="dashicons dashicons-admin-page"></span></span>
                  </div>

                  <!-- Delete Button -->
                  <div class="accordionItemAction" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                      <span type="button" class="btn btn-danger sliderX_itemDelete"><span class="dashicons dashicons-no-alt"></span></span>
                  </div>


              </h2>
              <div id="collapse${itemCount}" class="accordion-collapse collapse" aria-labelledby="heading-${itemCount}" data-bs-parent="#sliderx_slidesOne">
                  <div class="accordion-body sliderX_body">

                      <div class="sliderX_media_wrapper mb-3">
                        <div class="sliderx-uploaded-media" id="sliderx-uploaded-media-${itemCount}"></div>
                        <input type="button" class="sliderX-media-upload-button" id="sliderx-media-upload-${itemCount}" value="Add Slider Image">
                      </div>

                      <div class="sliderX_title_wrapper">
                        <div class="sliderX_title_input">Title </div>
                        <input type="text" class="form-control sliderx_title_input" placeholder="Title here">
                        <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Title</div>
                      </div>

                      <div class="sliderX_subtitle_wrapper mt-2">
                        <div class="sliderX_subtitle_input">Subtitle </div>
                        <input type="text" class="form-control sliderx_subtitle_input"  placeholder="Subtitle here">
                        
                        <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Subtitle</div>
                      </div>

                      
                      <div class="sliderX_desc_wrapper my-2">
                        <div class="sliderX_title mb-1"> Description </div>
                        <textarea class="form-control" placeholder="Description here" id="floatingTextarea2" style="height: 100px"></textarea>

                        <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Desc</div>
                      </div>


                      <div class="sliderX_cta_button_wrapper my-2">
                        <div class="sliderX_title mb-1"> CTA Button </div>
                        <div class="sliderx_button_item">
                          <input type="text" class="form-control sliderx_btnText1" placeholder="Button Text 1">
                          <input type="text" class="form-control sliderx_btnLink1" placeholder="Button Link 1">
                        </div>

                        <div class="sliderx_button_item">
                          <input type="text" class="form-control sliderx_btnText2" placeholder="Button Text 2">
                          <input type="text" class="form-control sliderx_btnLink2" placeholder="Button Link 2">
                        </div>

                        <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use CTA</div>

                    </div>
                  </div>
              </div>
          </div>`;
      
        sliderx_slides_container.append(sliderx_slides_item);
    
        // Attach event listener for media upload button
        $(`#sliderx-media-upload-${itemCount}`).on('click', function() {
          let frame = wp.media({
              title: 'Select or Slide Image / Media',
              button: {
                  text: 'Upload Slide Image'
              },
              multiple: false  // Set to true if you want to allow multiple media selection
          });

          frame.on('select', function() {
              let attachment = frame.state().get('selection').first().toJSON();
              // Display the selected media
              $(`#sliderx-uploaded-media-${itemCount}`).html(`<img src="${attachment.url}" alt="Uploaded Media">`);
          });

          frame.open();
        });

  });


  // Create Slides Repeater for edit
  $("#sliderx_create_buttonTwo").on('click', function (e) {
    e.preventDefault();
    
    let sliderx_slides_container = $("#sliderx_slidesTwo");

    // Counter to keep track of the number of items created
    let itemCount = sliderx_slides_container.children('.accordion-item').length + 1;

    let sliderx_slides_item= `
        <div class="accordion-item xSlides_item" id="accordion-item-${itemCount}">
            <h2 class="accordion-header" id="heading${itemCount}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${itemCount}" aria-expanded="false" aria-controls="collapse${itemCount}">
                    Slide Item #${itemCount}
                </button>

                <!-- Duplicate Button -->
                <div class="accordionItemAction_duplicate" data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate">
                    <span type="button" class="btn sliderX_itemDuplicate"><span class="dashicons dashicons-admin-page"></span></span>
                </div>

                <!-- Delete Button -->
                <div class="accordionItemAction" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                    <span type="button" class="btn btn-danger sliderX_itemDelete"><span class="dashicons dashicons-no-alt"></span></span>
                </div>

            </h2>
            <div id="collapse${itemCount}" class="accordion-collapse collapse" aria-labelledby="heading-${itemCount}" data-bs-parent="#sliderx_slidesTwo">
                <div class="accordion-body sliderX_body">

                    <div class="sliderX_media_wrapper mb-3">
                      <div class="sliderx-uploaded-media" id="sliderx-uploaded-media-${itemCount}"></div>
                      <input type="button" class="sliderX-media-upload-button" id="sliderx-media-upload-${itemCount}" value="Add Slider Image">
                    </div>

                    <div class="sliderX_title_wrapper">
                      <div class="sliderX_title_input">Title </div>
                      <input type="text" class="form-control sliderx_title_input" placeholder="Title here">
                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Title</div>
                    </div>

                    <div class="sliderX_subtitle_wrapper mt-2">
                      <div class="sliderX_subtitle_input">Subtitle </div>
                      <input type="text" class="form-control sliderx_subtitle_input"  placeholder="Subtitle here">
                      
                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Subtitle</div>
                    </div>

                    
                    <div class="sliderX_desc_wrapper my-2">
                      <div class="sliderX_title mb-1"> Description </div>
                      <textarea class="form-control" placeholder="Description here" id="floatingTextarea2" style="height: 100px"></textarea>

                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Desc</div>
                    </div>


                    <div class="sliderX_cta_button_wrapper my-2">
                      <div class="sliderX_title mb-1"> CTA Button </div>
                      <div class="sliderx_button_item">
                        <input type="text" class="form-control sliderx_btnText1" placeholder="Button Text 1">
                        <input type="text" class="form-control sliderx_btnLink1" placeholder="Button Link 1">
                      </div>

                      <div class="sliderx_button_item">
                        <input type="text" class="form-control sliderx_btnText2" placeholder="Button Text 2">
                        <input type="text" class="form-control sliderx_btnLink2" placeholder="Button Link 2">
                      </div>

                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use CTA</div>

                  </div>


                </div>
            </div>
        </div>`;
    
      sliderx_slides_container.append(sliderx_slides_item);
  
      // Attach event listener for media upload button
      $(`#sliderx-media-upload-${itemCount}`).on('click', function() {
        let frame = wp.media({
            title: 'Select or Slide Image / Media',
            button: {
                text: 'Upload Slide Image'
            },
            multiple: false  // Set to true if you want to allow multiple media selection
        });

        frame.on('select', function() {
            let attachment = frame.state().get('selection').first().toJSON();
            // Display the selected media
            $(`#sliderx-uploaded-media-${itemCount}`).html(`<img src="${attachment.url}" alt="Uploaded Media">`);
        });

        frame.open();
      });



  });


  // Create Duplicate Slides Repeater with existing data 
  $(document).on('click', '.sliderX_itemDuplicate', function (e) {
    e.preventDefault();

    let currentItem = $(this).closest('.accordion-item');

    // Fetching current slide content
    let title = currentItem.find(".sliderx_title_input").val();
    let subtitle = currentItem.find(".sliderx_subtitle_input").val();
    let description = currentItem.find("textarea").val();
    let btnText1 = currentItem.find(".sliderx_btnText1").val();
    let btnLink1 = currentItem.find(".sliderx_btnLink1").val();
    let btnText2 = currentItem.find(".sliderx_btnText2").val();
    let btnLink2 = currentItem.find(".sliderx_btnLink2").val();
    let mediaContent = currentItem.find(".sliderx-uploaded-media").html();

    let buttonLabel = mediaContent ? "Update Image" : "Add Image";

    let sliderx_slides_container = $(".sliderx_accordion");

    // Counter to keep track of the number of items created
    let itemCount = sliderx_slides_container.children('.accordion-item').length + 1;

    let sliderx_slides_item = `
        <div class="accordion-item xSlides_item" id="accordion-item-${itemCount}">
            <h2 class="accordion-header" id="heading${itemCount}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${itemCount}" aria-expanded="false" aria-controls="collapse${itemCount}">
                    Slide Item #${itemCount}
                </button>

                <!-- Duplicate Button -->
                <div class="accordionItemAction_duplicate" data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate">
                    <span type="button" class="btn sliderX_itemDuplicate"><span class="dashicons dashicons-admin-page"></span></span>
                </div>

                <!-- Delete Button -->
                <div class="accordionItemAction" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                    <span type="button" class="btn btn-danger sliderX_itemDelete"><span class="dashicons dashicons-no-alt"></span></span>
                </div>
            </h2>
            <div id="collapse${itemCount}" class="accordion-collapse collapse" aria-labelledby="heading-${itemCount}" data-bs-parent="#sliderx_slidesTwo">
                <div class="accordion-body sliderX_body">

                    <div class="sliderX_media_wrapper mb-3">
                      <div class="sliderx-uploaded-media" id="sliderx-uploaded-media-${itemCount}">${mediaContent}</div>
                      <input type="button" class="sliderX-media-upload-button" id="sliderx-media-upload-${itemCount}" value="${buttonLabel}">
                    </div>

                    <div class="sliderX_title_wrapper">
                      <div class="sliderX_title_input">Title </div>
                      <input type="text" class="form-control sliderx_title_input" placeholder="Title here" value="${title}">
                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Title</div>
                    </div>

                    <div class="sliderX_subtitle_wrapper mt-2">
                      <div class="sliderX_subtitle_input">Subtitle </div>
                      <input type="text" class="form-control sliderx_subtitle_input" placeholder="Subtitle here" value="${subtitle}">
                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Subtitle</div>
                    </div>

                    <div class="sliderX_desc_wrapper my-2">
                      <div class="sliderX_title mb-1"> Description </div>
                      <textarea class="form-control" placeholder="Description here" id="floatingTextarea2" style="height: 100px">${description}</textarea>
                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use Desc</div>
                    </div>

                    <div class="sliderX_cta_button_wrapper my-2">
                      <div class="sliderX_title mb-1"> CTA Button </div>
                      <div class="sliderx_button_item">
                        <input type="text" class="form-control sliderx_btnText1" placeholder="Button Text 1" value="${btnText1}">
                        <input type="text" class="form-control sliderx_btnLink1" placeholder="Button Link 1" value="${btnLink1}">
                      </div>

                      <div class="sliderx_button_item">
                        <input type="text" class="form-control sliderx_btnText2" placeholder="Button Text 2" value="${btnText2}">
                        <input type="text" class="form-control sliderx_btnLink2" placeholder="Button Link 2" value="${btnLink2}">
                      </div>

                      <div class="sliderX_helper_text mb-1">Leave blank if you don't want to use CTA</div>
                    </div>

                </div>
            </div>
        </div>`;
    
    sliderx_slides_container.append(sliderx_slides_item);

    // Attach event listener for media upload button
    $(`#sliderx-media-upload-${itemCount}`).on('click', function() {
        let frame = wp.media({
            title: 'Select or Slide Image / Media',
            button: {
                text: 'Upload Slide Image'
            },
            multiple: false  // Set to true if you want to allow multiple media selection
        });

        frame.on('select', function() {
            let attachment = frame.state().get('selection').first().toJSON();
            // Display the selected media
            $(`#sliderx-uploaded-media-${itemCount}`).html(`<img src="${attachment.url}" alt="Uploaded Media">`);
            $(`#sliderx-media-upload-${itemCount}`).val("Update Image");
        });

        frame.open();
    });

  });
    
  
  // Remove item on delete button click
  $(document).on('click', '.sliderX_itemDelete', function (e) {
    e.preventDefault();
    let currentItem = $(this).closest('.accordion-item');
    currentItem.remove();
  });


/* ================== Switcher Dependency for sliderX Settings ===============
  =========================================================================== */
  // Slider animation effect selector.

  $("sliderx_centeredSlide").hide();

  $("#sliderxSettings_content").on("change", function () {

    let layoutTypeValue = $('input[name="sliderx_layoutType"]:checked').val();

    let sliderType = $('input[name="sliderXType"]:checked').val();
    if (sliderType === "carowave" || sliderType === "centermode") {
      $(".sliderx_centeredSlide").show();
    } else {
      $(".sliderx_centeredSlide").hide();
    }

    // Text content box alignment
    $(".sliderx_content_manage").hide();
    $(".sliderx_image_manage").hide();
    if (sliderType === "featured" ) {
      // $(".sliderx_content_manage").show();
      $(".sliderx_image_manage").show();
    } else if(sliderType === "slider" ){
      $(".sliderx_image_manage").hide();
      $(".sliderx_content_manage").show();
    } else {
      $(".sliderx_content_manage").hide();
      $(".sliderx_image_manage").hide();
    }


  
    /* ==== General ===== */
    // Layout
    let autoHeightSwitcher_div = $('.autoHeight_switcher_div');
    // sliderxLayouts_dimensions div
    let sliderxLayouts_dimensions = $('.sliderxLayouts_dimensions');

    let sliderx_width = parseFloat($("#sliderx_width").val());
    let sliderx_height = parseFloat($("#sliderx_height").val());
    let sliderRatioVal = sliderx_height !== 0 ? (sliderx_width / sliderx_height).toFixed(1) : 0;
    
    $("#slider_ratio").val(sliderRatioVal);
    // Hide both elements by default
    autoHeightSwitcher_div.hide();
    sliderxLayouts_dimensions.hide();

    // Show or hide elements based on layoutTypeValue
    let layoutAutoHeight = $('#layoutAutoHeight').prop('checked');


    if (layoutTypeValue === "fullWidth") {
      autoHeightSwitcher_div.show();
      if (!layoutAutoHeight) {
        sliderxLayouts_dimensions.show();
      }
    } else if (layoutTypeValue === "boxed" || layoutTypeValue === "custom") {
      sliderxLayouts_dimensions.show();
    }


    // Autoplay
    let sliderxAutoPlayVal = $('#sliderx_AutoPlay').prop('checked');
    let sliderx_AutoPlayOptions = $('.autoPlayOptions');

    // Show or hide AutoPlay Options
    if (sliderxAutoPlayVal) {
      sliderx_AutoPlayOptions.css("display", "flex");
    } else {
      sliderx_AutoPlayOptions.css("display", "none");
    }


    /* ==== Text Content ===== */
    
    // Title
    let sliderxTitleVal = $('#sliderx_title').prop('checked');
    let titleStyleWrapper = $('.titleStyleWrapper');

    if (sliderxTitleVal) {
      titleStyleWrapper.css("display", "block");
    } else {
      titleStyleWrapper.css("display", "none");
    }

    // Subtitle
    let sliderxSubtitleVal = $('#sliderx_subtitle').prop('checked');
    let subtitleStyleWrapper = $('.subtitleStyleWrapper');

    if (sliderxSubtitleVal) {
      subtitleStyleWrapper.css("display", "block");
    } else {
      subtitleStyleWrapper.css("display", "none");
    }

    // Description
    let sliderxDescriptionVal = $('#sliderx_desc').prop('checked');
    let descriptionStyleWrapper = $('.descriptionStyleWrapper');

    if (sliderxDescriptionVal) {
      descriptionStyleWrapper.css("display", "block");
    } else {
      descriptionStyleWrapper.css("display", "none");
    }

    // CTA
    let sliderxCtaVal = $('#sliderx_cta').prop('checked');
    let ctaStyleWrapper = $('.ctaStyleWrapper');

    if (sliderxCtaVal) {
      ctaStyleWrapper.css("display", "block");
    } else {
      ctaStyleWrapper.css("display", "none");
    }



    /* ==== Navigation ===== */
    // Arrow
    let sliderxArrowVal = $('#nav_arrow').prop('checked');
    let sliderx_navigationOptions = $('.sliderx_navigation_options_list');

    if (sliderxArrowVal) {
      sliderx_navigationOptions.css("display", "block");
    } else {
      sliderx_navigationOptions.css("display", "none");
    }
    
    $(document).ready(function() {
      if (sliderxArrowVal) {
        sliderx_navigationOptions.css("display", "block");
      } else {
        sliderx_navigationOptions.css("display", "none");
      }
    });

    /* ==== Pagination ===== */

    let sliderxPaginationVal = $('#sliderxPagination').prop('checked');
    let sliderx_paginationOptions = $('.sliderx_pagination_options_list');

    if (sliderxPaginationVal) {
      sliderx_paginationOptions.css("display", "block");
    } else {
      sliderx_paginationOptions.css("display", "none");
    }

  });


  // function for initial load
  function sliderX_switcher() {

    let layoutTypeValue = $('input[name="sliderx_layoutType"]:checked').val();
    let layoutAutoHeight = $('#layoutAutoHeight').prop('checked');

    let sliderType = $('input[name="sliderXType"]:checked').val();
    if (sliderType === "carowave" || sliderType === "centermode") {
      $(".sliderx_centeredSlide").show();
    } else {
      $(".sliderx_centeredSlide").hide();
    }
  
      /* ==== General ===== */
      // Layout
      let autoHeightSwitcher_div = $('.autoHeight_switcher_div');
      // sliderxLayouts_dimensions div
      let sliderxLayouts_dimensions = $('.sliderxLayouts_dimensions');
    
      // Hide both elements by default
      autoHeightSwitcher_div.hide();
      sliderxLayouts_dimensions.hide();
  
      // Show or hide elements based on layoutTypeValue
      if (layoutTypeValue === "fullWidth") {
        autoHeightSwitcher_div.show();
        if (!layoutAutoHeight) {
          sliderxLayouts_dimensions.show();
        }
      } else if (layoutTypeValue === "boxed" || layoutTypeValue === "custom") {
          sliderxLayouts_dimensions.show();
      }
  
      // Autoplay
      let sliderxAutoPlayVal = $('#sliderx_AutoPlay').prop('checked');
      let sliderx_AutoPlayOptions = $('.autoPlayOptions');
  
      // Show or hide AutoPlay Options
      if (sliderxAutoPlayVal) {
        sliderx_AutoPlayOptions.css("display", "flex");
      } else {
        sliderx_AutoPlayOptions.css("display", "none");
      }
  
  
      /* ==== Text Content ===== */
      
      // Title
      let sliderxTitleVal = $('#sliderx_title').prop('checked');
      let titleStyleWrapper = $('.titleStyleWrapper');
  
      if (sliderxTitleVal) {
        titleStyleWrapper.css("display", "block");
      } else {
        titleStyleWrapper.css("display", "none");
      }
  
      // Subtitle
      let sliderxSubtitleVal = $('#sliderx_subtitle').prop('checked');
      let subtitleStyleWrapper = $('.subtitleStyleWrapper');
  
      if (sliderxSubtitleVal) {
        subtitleStyleWrapper.css("display", "block");
      } else {
        subtitleStyleWrapper.css("display", "none");
      }
  
      // Description
      let sliderxDescriptionVal = $('#sliderx_desc').prop('checked');
      let descriptionStyleWrapper = $('.descriptionStyleWrapper');
  
      if (sliderxDescriptionVal) {
        descriptionStyleWrapper.css("display", "block");
      } else {
        descriptionStyleWrapper.css("display", "none");
      }
  
      // CTA
      let sliderxCtaVal = $('#sliderx_cta').prop('checked');
      let ctaStyleWrapper = $('.ctaStyleWrapper');
  
      if (sliderxCtaVal) {
        ctaStyleWrapper.css("display", "block");
      } else {
        ctaStyleWrapper.css("display", "none");
      }
  
  
  
      /* ==== Navigation ===== */
      // Arrow
      let sliderxArrowVal = $('#nav_arrow').prop('checked');
      let sliderx_navigationOptions = $('.sliderx_navigation_options_list');
  
      if (sliderxArrowVal) {
        sliderx_navigationOptions.css("display", "block");
      } else {
        sliderx_navigationOptions.css("display", "none");
      }
      
      $(document).ready(function() {
        if (sliderxArrowVal) {
          sliderx_navigationOptions.css("display", "block");
        } else {
          sliderx_navigationOptions.css("display", "none");
        }
      });
  
      /* ==== Pagination ===== */
  
      let sliderxPaginationVal = $('#sliderxPagination').prop('checked');
      let sliderx_paginationOptions = $('.sliderx_pagination_options_list');
  
      if (sliderxPaginationVal) {
        sliderx_paginationOptions.css("display", "block");
      } else {
        sliderx_paginationOptions.css("display", "none");
      }

  }
  sliderX_switcher();

  /* ====== Project Data Fetch from backend option ==========
    ========================================================*/
  $("#sliderx_createProject_btn").on("click", function (e) {
      // Prevent the default action of the button click initially
      e.preventDefault();

      let projectNameInput = $("#projectNameInput");
      let projectName = projectNameInput.val();
      let sliderType = $('input[name="sliderType"]:checked').val();
      
      // Validate the project name
      if (!projectName || projectName === '') {
          projectNameInput.addClass("is-invalid");
          return false;
      } else {
          projectNameInput.removeClass("is-invalid").addClass("is-valid");
      }

      let editorUrl = $("#xslierEditor_url").val();
      let projectCreateBtn = $("#sliderx_createProject_btn");
      let xslier_successTxt = $(".xslier_successTxt");
      
      let project_nonce = projectCreateBtn.attr("nonce")
    

      $.ajax({
          type: 'POST',
          url: AjaxObj.ajaxUrl,
          data: {
              action: 'initial_setup_action',
              nonce: AjaxObj.nonce,
              projectName,
              sliderType,
          },
          success: function (response) {
              xslier_successTxt.show();
              projectCreateBtn.text("Processing...");
            // Simulate saving process
              setTimeout(function () {
                // Check if saving process was successful
                let savingSuccessful = true;
                if (savingSuccessful) {
                  // Show success message
                  projectCreateBtn.text("Redirecting");
                } else {
                  // Show error message
                  sliderXSaveBtn.text("Failed to redirect. Please try again.");
                }
                // Redirect to the Updated/ Editor URL after 1 seconds
                setTimeout(function () {
                  window.location.href = editorUrl;
                }, 1000);
              }, 1000);

            // Optionally, you can trigger a click event on the button here
            projectCreateBtn.off("click").trigger("click");
          },
          error: function (error) {
              console.error('AJAX error:', error);
          },
      });
  });

  /**
   * ============= Slider Content Data ==============
   * ============================================= 
   */

  
  /* ====== Sava Data ======= */
  function save_xSlidesData() {
    let sliderXId = $("#sliderxId").val();
    let sliderXData = [];
    // Loop through each item in the repeater
    $('.xSlides_item').each(function(index) {
      var itemData = {
          image: $(this).find('img').attr('src') || '',
          title: $(this).find('.sliderx_title_input').val() || '',
          subtitle: $(this).find('.sliderx_subtitle_input').val() || '',
          description: $(this).find('.sliderX_desc_wrapper textarea').val() || '',
          btnText1: $(this).find('.sliderx_button_item:eq(0) .sliderx_btnText1').val() || '',
          btnLink1: $(this).find('.sliderx_button_item:eq(0) .sliderx_btnLink1').val() || '',
          btnText2: $(this).find('.sliderx_button_item:eq(1) .sliderx_btnText2').val() || '',
          btnLink2: $(this).find('.sliderx_button_item:eq(1) .sliderx_btnLink2').val() || ''
      };
      // Push the itemData object into the sliderXData array
      sliderXData.push(itemData);

    });

    // Handle change event on the checkbox input
    const dataSource = $('input[name="sliderx_dataSource"]:checked').val();
    const postType = $('.sliderx_postType :selected').val();
    const productType = $('.sliderx_productType :selected').val();
   
  
    const numberOfPost = $('.numberOf_post').val();
    const includeVal = $('.sliderx_include').val();
    const excludeVal = $('.sliderx_exclude').val();
    const excludeOpt_too = $('input[name="exclude_options_too[]"]:checked').map(function () { return this.value; }).get();
  
    const dataFilter = {
      include: includeVal ?? '',
      exclude: excludeVal ?? '',
      excludeToo: excludeOpt_too ?? '',
    }
  
    // Taxonomy Filter
    let taxonomyVal = false;;
    $('input[name="taxonomy"]').each(function() {
      taxonomyVal = $(this).is(':checked');
    });
    const sliderxTaxonomyVal = $('.sliderx_taxonomy :selected').val();
    const sliderxTaxonomyTerms = $('.sliderx_postType_terms').val();
    const sliderxTermsOperator = $('.sliderx_terms_operator :selected').val();
  
    const taxonomyFilter = {
      taxonomy: sliderxTaxonomyVal ?? '',
      terms: sliderxTaxonomyTerms ?? '',
      operator: sliderxTermsOperator ?? '',
    }
  
    const postArgs = {
      postType,
      numberOfPost,
      dataFilter
    }

    if (postType === "product") {
      postArgs.productType = productType;
    }
  
    if (taxonomyVal) {
      postArgs.taxonomyFilter = taxonomyFilter;
    }
    // Send data to PHP script via AJAX
    $.ajax({
        url: ObjSlide.ajaxUrl,
        method: 'POST',
        data: {
          action: 'sliderXData_action',
          nonce: ObjSlide.nonce,
          sliderId : sliderXId,
          sliderData: sliderXData,
          dataSource: dataSource,
          postArgs: postArgs,
        },
        success: function(response) {
            // Handle success
            console.log('Data saved successfully:', response);
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });
  }

  // Function to save Slider Settings data
  function save_sliderXSettings() {

    // Slider id for settings
    let sliderXId = $("#sliderxId").val();

    /*======= General ===========  */
    let sliderxLayoutType = $('input[name="sliderx_layoutType"]:checked').val();
    let sliderType = $('input[name="sliderXType"]:checked').val();
    let sliderxAnimationVal = $('.sliderxAnimation').val();

    let LayoutWidth = $('#sliderx_width').val();
    let LayoutHeight = $('#sliderx_height').val();
    let LayoutRatio = $('#slider_ratio').val();
    let layoutAutoHeight = $('#layoutAutoHeight').prop('checked');

    const layoutDimensions = {
      width: LayoutWidth,
      height: LayoutHeight,
      ratio: LayoutRatio,
    }

    const layout = {
      layoutType: sliderxLayoutType,
      dimension: layoutDimensions,
      autoHeight: layoutAutoHeight
    }

    let layoutsDirection = $('input[name="layoutsDirection"]:checked').val();
    let autoPlay = $('#sliderx_AutoPlay').prop('checked');
    let autoplayDelay = $('#autoplayDelay').val();
    let autoPlayPauseOnHover = $('#autoPlay_pauseOnhover').prop('checked');
    let autoPlayDisableOnInteraction = $('#autoPlay_disableOnInteraction').prop('checked');

    const autoPlayProp = {
      autoPlayDelay : autoplayDelay,
      pauseOnHover : autoPlayPauseOnHover,
      disableOnInteraction : autoPlayDisableOnInteraction,
    }

    let sliderxLoop = $('#sliderx_loop').prop('checked');
    let sliderxKeyboardControl = $('#sliderx_keyboardControl').prop('checked');
    let sliderxMousewheel = $('#sliderx_mousewheel').prop('checked');
    let sliderxCenteredSlide = $('#sliderx_centeredSlide').prop('checked');

    const general = {
      layout: layout,
      animationType: sliderxAnimationVal,
      layoutDir : layoutsDirection,
      autoPlay: autoPlay,
      autoPlayProp: autoPlay ? autoPlayProp || '' : '',
      loop: sliderxLoop,
      KeyboardControl: sliderxKeyboardControl,
      mouseWheel: sliderxMousewheel,
      centeredSlide: sliderxCenteredSlide,
    }

    /*======= Text Content ===========  */
    // Content Box
    let contentBoxWidthVal     = $(".sliderx_content_boxWidth").val();
    let contentBoxAlignmentVal = $('input[name="sliderxContentBox_alignment"]:checked').val() || ''; 

    const contentBoxStyle = {
      width: contentBoxWidthVal,
      alignment: contentBoxAlignmentVal,
    };    
    
    // Slider Image
    let imageAlignmentVal = $('input[name="sliderxImage_alignment"]:checked').val() || ''; 
    const imageStyle = {
      alignment: imageAlignmentVal,
    };

    // Title
    let sliderx_title  = $('#sliderx_title').prop('checked');
    let titleAlignment = $('input[name="sliderXTitle_alignment"]:checked').val() || ''; 
    let titleFontSize  = $("#title_Fontsize").val() || ''; 
    let titleFontColor = $("#title_FontColor").val() || ''; 
    let titleBgColor = $("#title_FontBg").val() || ''; 
    let title_excerpt = $("#title_excerpt1").val() || '';

    const titleStyle = {
      excerpt: title_excerpt,
      alignment: titleAlignment,
      fontsize: titleFontSize,
      fontColor: titleFontColor,
      titleBg: titleBgColor
    };

    // Subtitle
    let sliderx_subtitle  = $('#sliderx_subtitle').prop('checked');
    let subTitleAlignment = $('input[name="subTitleAlignment"]:checked').val() || '';
    let subFontSize       = $("#subTitle_FontSize").val() || '';
    let subTitleColor     = $("#subTitle_FontColor").val() || '';
    let subTitleBgColor = $("#subTitle_bgColor").val() || '';
    let subtitle_excerpt = $("#subtitle_excerpt1").val() || '';

    const subTitleStyle = {
      excerpt: subtitle_excerpt,
      alignment : subTitleAlignment,
      fontsize : subFontSize,
      color : subTitleColor,
      bgColor : subTitleBgColor
    }

    // Description
    let sliderx_desc = $('#sliderx_desc').prop('checked');
    let descAlignment = $('input[name="descAlignment"]:checked').val() || '';
    let desc_FontSize = $("#desc_FontSize").val() || '';
    let desc_FontColor = $("#desc_FontColor").val() || '';
    let desc_bgColor = $("#desc_bgColor").val() || '';
    let desc_excerpt = $("#desc_excerpt1").val() || '';

    const descStyle = {
      excerpt: desc_excerpt,
      alignment : descAlignment,
      fontsize : desc_FontSize,
      color : desc_FontColor,
      bgColor :  desc_bgColor
    }
  
    // CTA true / false
    let sliderx_cta = $('#sliderx_cta').prop('checked');

    // CTA 
    let ctaAlignment = $('input[name="ctaAlignment"]:checked').val() || '';
    let cta_FontSize = $("#sliderx_cta_fontSize").val() || '';
    let cta_FontColor = $("#sliderx_cta_color").val() || '';
    let cta_bgColor = $("#sliderx_cta_bg").val() || '';

    // CTA 1
    // let ctaAlignment_1 = $('input[name="ctaAlignment1"]:checked').val() || '';
    // let cta_FontSize_1 = $("#sliderx_cta_fontSize1").val() || '';
    // let cta_FontColor_1 = $("#sliderx_cta_color1").val() || '';
    // let cta_bgColor_1 = $("#sliderx_cta_bg1").val() || '';

    //CTA_2 
    // let ctaAlignment_2 = $('input[name="ctaAlignment2"]:checked').val() || '';
    // let cta_FontSize_2 = $("#sliderx_cta_fontSize2").val() || '';
    // let cta_FontColor_2 = $("#sliderx_cta_color2").val() || '';
    // let cta_bgColor_2 = $("#sliderx_cta_bg2").val() || '';

    const ctaStyle = {
      alignment : ctaAlignment,
      fontsize : cta_FontSize,
      color : cta_FontColor,
      bgColor :  cta_bgColor
    }
    // const ctaStyle2 = {
    //   alignment : ctaAlignment_2,
    //   fontsize : cta_FontSize_2,
    //   color : cta_FontColor_2,
    //   bgColor :  cta_bgColor_2
    // }

    const textContent = {
      title: sliderx_title,
      titleStyle: sliderx_title ? titleStyle : '', 
      subtitle: sliderx_subtitle,
      subTitleStyle: sliderx_subtitle ? subTitleStyle : '', 
      desc: sliderx_desc,
      descStyle: sliderx_desc ? descStyle : '', 
      cta: sliderx_cta,
      ctaStyle: sliderx_cta ? ctaStyle : '', 
    };

    if (sliderType === "slider") {
      textContent.contentBox = contentBoxStyle;
    }
    if (sliderType === "featured") {
      textContent.sliderImg = imageStyle
    }

    /*======= Navigation ===========  */
    let navValue = $('#nav_arrow').prop('checked');
    let navType = $('input[name="navigationType"]:checked').val() || '';
    let navSize = $("#sliderx_nav_size").val();
    let navColor = $("#sliderx_nav_color").val() ?? '';

    const navStyle = {
      fontsize : navSize,
      color : navColor,
    }

    const navigation = {
      navigation: navValue,
      navType: navType,
      style: navStyle
    }

    /*======= Pagination ===========  */
    let paginationValue = $('#sliderxPagination').prop('checked');
    let paginationType = $('input[name="sliderx_paginationType"]:checked').val() || '';
    let paginationPosition = $('input[name="sliderx_paginationPosition"]:checked').val() || '';
    // Style
    let paginationSize = $("#sliderxPagination_size").val() || '';
    let paginationColor = $("#sliderxPagination_color").val() || '';

    // Active Style
    let paginationActiveSize = $("#sliderx_paginationActive_size").val() || '';
    let paginationActiveColor = $("#sliderx_paginationActive_color").val() || '';

    const paginationStyle = {
      fontsize : paginationSize,
      color : paginationColor,
    }
    const paginationActiveStyle = {
      fontsize : paginationActiveSize,
      color : paginationActiveColor,
    }
    const pagination = {
      paginationVal: paginationValue,
      paginationType: paginationType,
      position: paginationPosition,
      style : paginationStyle,
      activeStyle : paginationActiveStyle
    }

    // API
    const apiUrl = $(".sliderX_api_url").val();

    /*======= Animation ===========  */
    // Title
    const titleAnimateVal      = $(".slider_titleAnimation_list").val();
    const titleAnimateDuration = $("#sliderx_titleAnimate_duration").val();
    const titleAnimateDelay    = $("#sliderx_titleAnimate_delay").val();
    
    // Subtitle
    const subtitleAnimateVal       = $(".slider_subTitleAnimation_list").val();
    const subtitleAnimate_duration = $("#sliderx_subtitleAnimate_duration").val();
    const subtitleAnimate_delay    = $("#sliderx_subtitleAnimate_delay").val();
    // DESC
    const descAnimateVal       = $(".slider_descriptionAnimation_list").val();
    const descAnimate_duration = $("#sliderx_descAnimate_duration").val();
    const descAnimate_delay = $("#sliderx_descAnimate_delay").val();
    
    // CTA 1
    const ctaAnimateVal_one    = $(".slider_ctaAnimation_list_1").val();
    const ctaAnimate_duration1 = $("#sliderx_cta_animate_duration1").val();
    const ctaAnimate_delay1    = $("#sliderx_cta_animate_delay1").val();
    // CTA 2
    const ctaAnimateVal_two    = $(".slider_ctaAnimation_list_2").val();
    const ctaAnimate_duration2 = $("#sliderx_cta_animate_duration2").val();
    const ctaAnimate_delay2    = $("#sliderx_cta_animate_delay2").val();

    const title = {
      animation: titleAnimateVal,
      duration: titleAnimateDuration,
      delay: titleAnimateDelay,
    }

    const subtitle = {
      animation: subtitleAnimateVal,
      duration: subtitleAnimate_duration,
      delay: subtitleAnimate_delay,
    }

    const desc = {
      animation: descAnimateVal,
      duration: descAnimate_duration,
      delay: descAnimate_delay,
    }

    const cta1 = {
      animation: ctaAnimateVal_one,
      duration: ctaAnimate_duration1,
      delay: ctaAnimate_delay1,
    }
    
    const cta2 = {
      animation: ctaAnimateVal_two,
      duration: ctaAnimate_duration2,
      delay: ctaAnimate_delay2,
    }
    
    const animation = {
      title,
      subtitle,
      desc,
      cta1,
      cta2
    }
    const sliderXSettings = {
      sliderType,
      general,
      textContent,
      navigation,
      pagination,
      animation,
      apiUrl
    }

    // Send data to PHP script via AJAX
    $.ajax({
        url: settingsObj.ajaxUrl,
        method: 'POST',
        data: {
          action: 'sliderXSettings_action',
          nonce: settingsObj.nonce,
          sliderId : sliderXId,
          settingsData: sliderXSettings
        },
        success: function(response) {
            // Handle success
            console.log('Data saved successfully:', response);
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });

  }

  // Call the save_xSlidesData , save_sliderXSettings function when needed
  $(".sliderx_save_btn").on('click', function (e) {
    e.preventDefault();

    let sliderXSaveBtn = $(this);
    // Save the xSlides data and sliderX settings
    save_xSlidesData();
    save_sliderXSettings();

    // Get the current URL
    let currentURL = window.location.href;
    // Find the position of the last occurrence of '/'
    let lastIndex = currentURL.lastIndexOf('/');
    // Extract the URL up to the last occurrence of '/'
    let baseUrl = currentURL.substring(0, lastIndex);
    baseUrl = baseUrl+'/admin.php?page=sliderx'

    // Show "Saving..." message
    sliderXSaveBtn.text("Saving....");

    // Simulate saving process
    setTimeout(function () {
      // Check if saving process was successful
      let savingSuccessful = true;

      if (savingSuccessful) {
        // Show success message
        sliderXSaveBtn.text("Saved successfully!");
      } else {
        // Show error message
        sliderXSaveBtn.text("Save failed. Please try again.");
      }
      // Redirect to the dashboard URL after 3 seconds
      setTimeout(function () {
        window.location.href = baseUrl;
      }, 500);
    }, 1000);

  });

  /* ====== Update Data ======= */
  function update_xSlidesData() {
      let sliderxUpdateId = $("#sliderx_updateId").val();
  
      let sliderXData = [];
      // Loop through each item in the repeater
      $('.xSlides_item').each(function(index) {
        var itemData = {
            image: $(this).find('img').attr('src') || '',
            title: $(this).find('.sliderx_title_input').val() || '',
            subtitle: $(this).find('.sliderx_subtitle_input').val() || '',
            description: $(this).find('.sliderX_desc_wrapper textarea').val() || '',
            btnText1: $(this).find('.sliderx_button_item:eq(0) .sliderx_btnText1').val() || '',
            btnLink1: $(this).find('.sliderx_button_item:eq(0) .sliderx_btnLink1').val() || '',
            btnText2: $(this).find('.sliderx_button_item:eq(1) .sliderx_btnText2').val() || '',
            btnLink2: $(this).find('.sliderx_button_item:eq(1) .sliderx_btnLink2').val() || ''
        };
        // Push the itemData object into the sliderXData array
        sliderXData.push(itemData);

      });

      // Handle change event on the checkbox input
      const dataSource = $('input[name="sliderx_dataSource"]:checked').val();
      const postType = $('.sliderx_postType :selected').val();
      const productType = $('.sliderx_productType :selected').val();
    
    
      const numberOfPost = $('.numberOf_post').val();
      const includeVal = $('.sliderx_include').val();
      const excludeVal = $('.sliderx_exclude').val();
      const excludeOpt_too = $('input[name="exclude_options_too[]"]:checked').map(function () { return this.value; }).get();
    
      const dataFilter = {
        include: includeVal ?? '',
        exclude: excludeVal ?? '',
        excludeToo: excludeOpt_too ?? '',
      }
    
      // Taxonomy Filter
      let taxonomyVal = false;;
      $('input[name="taxonomy"]').each(function() {
        taxonomyVal = $(this).is(':checked');
      });
      const sliderxTaxonomyVal = $('.sliderx_taxonomy :selected').val();
      const sliderxTaxonomyTerms = $('.sliderx_postType_terms').val();
      const sliderxTermsOperator = $('.sliderx_terms_operator :selected').val();
    
      const taxonomyFilter = {
        taxonomy: sliderxTaxonomyVal ?? '',
        terms: sliderxTaxonomyTerms ?? '',
        operator: sliderxTermsOperator ?? '',
      }
    
      const postArgs = {
        postType,
        numberOfPost,
        dataFilter
    }
    
    if (postType === "product") {
      postArgs.productType = productType ?? '';
    }
  
    if (taxonomyVal) {
      postArgs.taxonomyFilter = taxonomyFilter;
    }

    // Send data to PHP script via AJAX
    $.ajax({
        url: updateData.ajaxUrl,
        method: 'POST',
        data: {
          action: 'update_sliderXData_action',
          nonce: updateData.nonce,
          updateId : sliderxUpdateId,
          sliderData: sliderXData,
          dataSource: dataSource,
          postArgs: postArgs,
        },
        success: function(response) {
            // Handle success
            console.log('Data saved successfully:', response);
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });
  }
  // Function to save Slider Settings data
  function update_sliderXSettings() {

    // Slider id for settings
    let sliderXUpdateId = $("#sliderx_updateId").val();
    // Get Preview Value
    let previewVal = $(".sliderx_preview_button").attr("preview");
    // Project Title
    let projectName = $('input[name="sliderx_projectName"]').val();

    /*======= General ===========  */
    let sliderxLayoutType = $('input[name="sliderx_layoutType"]:checked').val();
    let sliderType = $('input[name="sliderXType"]:checked').val();
    let sliderxAnimationVal = $('.sliderxAnimation').val();


    let LayoutWidth = $('#sliderx_width').val();
    let LayoutHeight = $('#sliderx_height').val();
    let LayoutRatio = $('#slider_ratio').val();
    let layoutAutoHeight = $('#layoutAutoHeight').prop('checked');

    const layoutDimensions = {
      width: LayoutWidth,
      height: LayoutHeight,
      ratio: LayoutRatio,
    }

    const layout = {
      layoutType: sliderxLayoutType,
      dimension: layoutDimensions,
      autoHeight: layoutAutoHeight
    }

    let layoutsDirection = $('input[name="layoutsDirection"]:checked').val();
    let autoPlay = $('#sliderx_AutoPlay').prop('checked');
    let autoplayDelay = $('#autoplayDelay').val();
    let autoPlayPauseOnHover = $('#autoPlay_pauseOnhover').prop('checked');
    let autoPlayDisableOnInteraction = $('#autoPlay_disableOnInteraction').prop('checked');


    const autoPlayProp = {
      autoPlayDelay : autoplayDelay,
      pauseOnHover : autoPlayPauseOnHover,
      disableOnInteraction : autoPlayDisableOnInteraction,
    }

    let sliderxLoop = $('#sliderx_loop').prop('checked');
    let sliderxKeyboardControl = $('#sliderx_keyboardControl').prop('checked');
    let sliderxMousewheel = $('#sliderx_mousewheel').prop('checked');
    let sliderxCenteredSlide = $('#sliderx_centeredSlide').prop('checked');

    const general = {
      layout: layout,
      animationType: sliderxAnimationVal,
      layoutDir : layoutsDirection,
      autoPlay: autoPlay,
      autoPlayProp: autoPlay ? autoPlayProp || '' : '',
      loop: sliderxLoop,
      KeyboardControl: sliderxKeyboardControl,
      mouseWheel: sliderxMousewheel,
      centeredSlide: sliderxCenteredSlide,
    }

    /*======= Text Content ===========  */
    // Content Box
    let contentBoxWidthVal     = $(".sliderx_content_boxWidth").val();
    let contentBoxAlignmentVal = $('input[name="sliderxContentBox_alignment"]:checked').val() || ''; 

    const contentBoxStyle = {
      width: contentBoxWidthVal,
      alignment: contentBoxAlignmentVal,
    };

    // Slider featured Image
    let imageAlignmentVal = $('input[name="sliderxImage_alignment"]:checked').val() || ''; 
    const imageStyle = {
      alignment: imageAlignmentVal,
    };

    // Title
    let sliderx_title  = $('#sliderx_title').prop('checked');
    let titleAlignment = $('input[name="sliderXTitle_alignment"]:checked').val() || ''; 
    let titleFontSize  = $("#title_Fontsize").val() || ''; 
    let titleFontColor = $("#title_FontColor").val() || ''; 
    let titleBgColor = $("#title_FontBg").val() || ''; 
    let title_excerpt = $("#title_excerpt2").val() || '';

    const titleStyle = {
      excerpt: title_excerpt,
      alignment: titleAlignment,
      fontsize: titleFontSize,
      fontColor: titleFontColor,
      titleBg: titleBgColor
    };

    // Subtitle
    let sliderx_subtitle = $('#sliderx_subtitle').prop('checked');
    let subTitleAlignment = $('input[name="subTitleAlignment"]:checked').val() || '';
    let subFontSize = $("#subTitle_FontSize").val() || '';
    let subTitleColor = $("#subTitle_FontColor").val() || '';
    let subTitleBgColor = $("#subTitle_bgColor").val() || '';
    let subtitleExcerpt = $("#subtitle_excerpt2").val() || '';

    const subTitleStyle = {
      excerpt : subtitleExcerpt,
      alignment : subTitleAlignment,
      fontsize : subFontSize,
      color : subTitleColor,
      bgColor : subTitleBgColor
    }

    // Description
    let sliderx_desc = $('#sliderx_desc').prop('checked');
    let descAlignment = $('input[name="descAlignment"]:checked').val() || '';
    let desc_FontSize = $("#desc_FontSize").val() || '';
    let desc_FontColor = $("#desc_FontColor").val() || '';
    let desc_bgColor = $("#desc_bgColor").val() || '';
    let desc_excerpt = $("#desc_excerpt2").val() || '';

    const descStyle = {
      excerpt: desc_excerpt,
      alignment : descAlignment,
      fontsize : desc_FontSize,
      color : desc_FontColor,
      bgColor :  desc_bgColor
    }

    // CTA true / false
    let sliderx_cta = $('#sliderx_cta').prop('checked');

    // CTA 
    let ctaAlignment = $('input[name="ctaAlignment"]:checked').val() || '';
    let cta_FontSize = $("#sliderx_cta_fontSize").val() || '';
    let cta_FontColor = $("#sliderx_cta_color").val() || '';
    let cta_bgColor = $("#sliderx_cta_bg").val() || '';

    // CTA 1
    // let ctaAlignment_1 = $('input[name="ctaAlignment1"]:checked').val() || '';
    // let cta_FontSize_1 = $("#sliderx_cta_fontSize1").val() || '';
    // let cta_FontColor_1 = $("#sliderx_cta_color1").val() || '';
    // let cta_bgColor_1 = $("#sliderx_cta_bg1").val() || '';

    //CTA_2 
    // let ctaAlignment_2 = $('input[name="ctaAlignment2"]:checked').val() || '';
    // let cta_FontSize_2 = $("#sliderx_cta_fontSize2").val() || '';
    // let cta_FontColor_2 = $("#sliderx_cta_color2").val() || '';
    // let cta_bgColor_2 = $("#sliderx_cta_bg2").val() || '';

    const ctaStyle = {
      alignment : ctaAlignment,
      fontsize : cta_FontSize,
      color : cta_FontColor,
      bgColor :  cta_bgColor
    }
    // const ctaStyle2 = {
    //   alignment : ctaAlignment_2,
    //   fontsize : cta_FontSize_2,
    //   color : cta_FontColor_2,
    //   bgColor :  cta_bgColor_2
    // }

    const textContent = {
      title: sliderx_title,
      titleStyle: sliderx_title ? titleStyle : '', 
      subtitle: sliderx_subtitle,
      subTitleStyle: sliderx_subtitle ? subTitleStyle : '', 
      desc: sliderx_desc,
      descStyle: sliderx_desc ? descStyle : '', 
      cta: sliderx_cta,
      ctaStyle: sliderx_cta ? ctaStyle : '', 
    };











    if (sliderType === "slider") {
      textContent.contentBox = contentBoxStyle;
    }
    if (sliderType === "featured") {
      textContent.sliderImg = imageStyle
    }

    /*======= Navigation ===========  */
    let navValue = $('#nav_arrow').prop('checked');
    let navType = $('input[name="navigationType"]:checked').val() || '';
    let navSize = $("#sliderx_nav_size").val();
    let navColor = $("#sliderx_nav_color").val() ?? '';

    const navStyle = {
      fontsize : navSize,
      color : navColor,
    }
    const navigation = {
      navigation: navValue,
      navType: navType,
      style: navStyle
    }

    /*======= Pagination ===========  */
    let paginationValue = $('#sliderxPagination').prop('checked');
    let paginationType = $('input[name="sliderx_paginationType"]:checked').val() || '';
    let paginationPosition = $('input[name="sliderx_paginationPosition"]:checked').val() || '';
    // Style
    let paginationSize = $("#sliderxPagination_size").val() || '';
    let paginationColor = $("#sliderxPagination_color").val() || '';

    // Active Style
    let paginationActiveSize = $("#sliderx_paginationActive_size").val() || '';
    let paginationActiveColor = $("#sliderx_paginationActive_color").val() || '';

    const paginationStyle = {
      fontsize : paginationSize,
      color : paginationColor,
    }
    const paginationActiveStyle = {
      fontsize : paginationActiveSize,
      color : paginationActiveColor,
    }
    const pagination = {
      paginationVal: paginationValue,
      paginationType: paginationType,
      position: paginationPosition,
      style : paginationStyle,
      activeStyle : paginationActiveStyle
    }
    // Api
    const apiUrl = $(".sliderX_api_url").val();


    /*======= Animation ===========  */
    // Title
    const titleAnimateVal      = $(".slider_titleAnimation_list").val();
    const titleAnimateDuration = $("#sliderx_title_animate_duration").val();
    const titleAnimateDelay    = $("#sliderx_title_animate_delay").val();
    
    // Subtitle
    const subtitleAnimateVal       = $(".slider_subTitleAnimation_list").val();
    const subtitleAnimate_duration = $("#sliderx_subtitle_animate_duration").val();
    const subtitleAnimate_delay    = $("#sliderx_subtitle_animate_delay").val();
    // DESC
    const descAnimateVal       = $(".slider_descriptionAnimation_list").val();
    const descAnimate_duration = $("#sliderx_desc_animate_duration").val();
    const descAnimate_delay    = $("#sliderx_desc_animate_delay").val();
    
    // CTA
    const ctaAnimateVal_one     = $(".slider_ctaAnimation_list_3").val();
    const ctaAnimate_duration_1 = $("#sliderx_cta_animate_duration3").val();
    const ctaAnimate_delay_1    = $("#sliderx_cta_animate_delay3").val();

    const ctaAnimateVal_two     = $(".slider_ctaAnimation_list_4").val();
    const ctaAnimate_duration_2 = $("#sliderx_cta_animate_duration4").val();
    const ctaAnimate_delay_2    = $("#sliderx_cta_animate_delay4").val();
        

    const title = {
      animation: titleAnimateVal,
      duration: titleAnimateDuration,
      delay: titleAnimateDelay,
    }
    const subtitle = {
      animation: subtitleAnimateVal,
      duration: subtitleAnimate_duration,
      delay: subtitleAnimate_delay,
    }

    const desc = {
      animation: descAnimateVal,
      duration: descAnimate_duration,
      delay: descAnimate_delay,
    }

    const cta1 = {
      animation: ctaAnimateVal_one,
      duration: ctaAnimate_duration_1,
      delay: ctaAnimate_delay_1,
    }
    const cta2 = {
      animation: ctaAnimateVal_two,
      duration: ctaAnimate_duration_2,
      delay:    ctaAnimate_delay_2,
    }
    const animation = {
      title,
      subtitle,
      desc,
      cta1,
      cta2
    }

    const sliderXSettings = {
      projectName,
      sliderType,
      general,
      textContent,
      navigation,
      pagination,
      animation,
      apiUrl,
      previewVal
    }

    // Send data to PHP script via AJAX
    $.ajax({
        url: updateSettings.ajaxUrl,
        method: 'POST',
        data: {
          action: 'update_sliderXSettings_action',
          nonce: updateSettings.nonce,
          updateId : sliderXUpdateId,
          settingsData: sliderXSettings
        },
        success: function(response) {
            // Handle success
            console.log('Data saved successfully:', response);
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });

  }

  // Update data
  $(".sliderx_update_btn").on('click', function (e) {
    e.preventDefault();

    let sliderXSaveBtn = $(this);

    // Save the xSlides data and sliderX settings
    update_xSlidesData();
    update_sliderXSettings();

    // let sliderXDashboard_url = $(".sliderX_dashboard_url").val();
    // Get the current URL
    let currentURL = window.location.href;

    // Find the position of the last occurrence of '/'
    let lastIndex = currentURL.lastIndexOf('/');

    // Extract the URL up to the last occurrence of '/'
    let baseUrl = currentURL.substring(0, lastIndex);
    baseUrl = baseUrl + '/admin.php?page=sliderx&sliderx=update'
    
    sliderXSaveBtn.text("Updating....");
    // Simulate saving process
    setTimeout(function () {
      let savingSuccessful = true;
      if (savingSuccessful) {
        sliderXSaveBtn.text("Updated successfully!");
      } else {
        sliderXSaveBtn.text("Save failed. Please try again.");
      }
      // Redirect to the dashboard URL after 3 seconds
      setTimeout(function () {
        window.location.href = currentURL;
      }, 500);
    }, 1000);

  });


  // Toggle Settings Options
  $(".sliderx_settingsBtn").on("click", function (e) {
    e.preventDefault();
    $(".sliderx_settings_panel").toggle();
    $(".sliderx_settings_panel").toggleClass("active");
  });
   

  // ShortCode Copy
  $(".sliderx_shortcode_copy").click(function (e) {
    e.preventDefault();
    var $button = $(this); // Store $(this) in a variable
    var sliderx_shortcode_value = $button.prev(".sliderx_shortcode").text();
    copyToClipboard(sliderx_shortcode_value);
    $button.text("Copied").css("color", "#f2f2f2"); // Simplified syntax
    setTimeout(function () {
      $button.text("Copy").css("color", "#f2f2f2"); // Use the stored variable
    }, 1000);
  });

  // Publish ShortCode Copy
  $(".shortcode_copy_btn").click(function (e) {
    e.preventDefault();
    var $button = $(this); // Store $(this) in a variable
    var sliderx_shortcode_value = $button.prev(".shortcode_field").text();
    sliderx_shortcode_value = sliderx_shortcode_value.trim();
    copyToClipboard(sliderx_shortcode_value);

    $button.text("Copied").css("color", "#61c1b3"); // Simplified syntax
    setTimeout(function () {
      $button.text("Copy Shortcode").css("color", "#f2f2f2"); // Use the stored variable
    }, 1000);
  });

  function copyToClipboard(text) {
    $("<input>").val(text).appendTo("body").select();
    document.execCommand("copy");
  }


  /* ====== SliderX Delete ======= */
  $(".sliderX_delId").click(function (e) {
    e.preventDefault();
    const sliderDel_id = $(this).attr('delid');

    // Get the current URL
    let currentURL = window.location.href;
    // Find the position of the last occurrence of '/'
    let lastIndex = currentURL.lastIndexOf('/');
    // Extract the URL up to the last occurrence of '/'
    let baseUrl = currentURL.substring(0, lastIndex);
    baseUrl = baseUrl+'/admin.php?page=sliderx'

    // Send data to PHP script via AJAX
    $.ajax({
        url: sliderDelObj.ajaxUrl,
        method: 'POST',
        data: {
          action: 'delete_sliderx_action',
          nonce: sliderDelObj.nonce,
          delId : sliderDel_id,
        },
        success: function(response) {
          if (response.success) {
            window.location.href = baseUrl;
          }
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });

  });

  /* ===== SliderX delete slider item ===== */
  $(".sliderX_itemDelete").click(function (e) {
    e.preventDefault();
    const slider_id = $(this).attr('slider_id');
    const sliderItem_id = $(this).data('item');
    // Send data to PHP script via AJAX
    $.ajax({
        url: sliderItemObj.ajaxUrl,
        method: 'POST',
        data: {
          action: 'delete_sliderxItem_action',
          nonce: sliderItemObj.nonce,
          sliderId : slider_id,
          itemId : sliderItem_id
        },
        success: function (response) {
          const redirectUrl = response?.data?.redirectUrl
          
          if (response.success) {
              window.location.reload();
          }
        
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error saving data:', error);
        }
    });

  });


  /* ======= SliderX-- Remove slider item======*/
  $(document).on('click', '.sliderX_item_remove', function (e) {
    e.preventDefault();
    let sliderItem = $(this).parent();
    // let groupItem = $(sliderItem).parent();
    sliderItem = sliderItem.closest('.xSlides_item').remove() ;
  });


  /* ====== Slider Direction ======= */
  $(".sliderX_vertical").hide();
  // Trigger the change event on page load to set the initial state
  $('input[name="layoutsDirection"]:checked').trigger('change');
  $(document).on('change', 'input[name="layoutsDirection"]', function () {
      // Get the value of the changed input
      var directionValue = $(this).val();
      if (directionValue === "vertical") {
          $(".sliderX_vertical").show();
      } else if (directionValue === "horizontal") {
          $(".sliderX_vertical").hide();
      }
  });
  

  /**
   * ============= Slider Animation ==============
   * ============================================= 
   */

  // Function to reset and populate dropdown based on sliderTypeValue
  function populateDropdown(sliderTypeValue, animationType) {
      // Cache the dropdown element
      const $select = $(".sliderxAnimation");
      // Clear existing options
      $select.empty();
      
      // Define effect arrays
      const effects = {
          slider: ['slide', 'fade', 'cube', 'flip', 'cards', 'coverflow'],
          thumbnail: ['slide', 'fade', 'cube', 'flip', 'cards', 'coverflow'],
          featured: ['slide', 'fade', 'cube', 'flip', 'cards', 'coverflow'],
          carousel: ['slide', 'coverflow'],
          carowave: ['slide', 'coverflow'],
          centermode: ['slide', 'coverflow'],
          group: ['slide', 'cube', 'flip']
      };
      
      // Determine the effects to use
      const selectedEffects = effects[sliderTypeValue] || [];
      // Populate the dropdown
      if (selectedEffects.length > 0) {
          selectedEffects.forEach(effect => {
              let capitalizedEffect = effect.charAt(0).toUpperCase() + effect.slice(1);
              $select.append(`<option value="${effect}" ${animationType === effect ? "selected" : ""}>${capitalizedEffect}</option>`);
          });
      } else {
          // Default option
          $select.append('<option selected>Select Effect</option>');
    }
  }

  // Initially load SlierType and animation Type for
  const sliderType = $('input[name="sliderXType"]:checked').val();
  const sliderxAnimation_type = $(".sliderxAnimation :selected").val() || "slide";
  populateDropdown(sliderType, sliderxAnimation_type);

  
  // Data from database
  const settingsConfig = configObj.settings || {};
  // Iterate over each settings object
  settingsConfig.forEach((settingsObj) => {
    // Parse the JSON-formatted general settings
    const general = JSON.parse(settingsObj.general);
    const animationType = (typeof general.animationType === 'string' && general.animationType !== "Select Effect") ? general.animationType : '';
    // Event listener for change event on inputs with name sliderXType
    $(document).on('change', 'input[name="sliderXType"]', function() {
        const sliderTypeValue = $(this).val();
        populateDropdown(sliderTypeValue, animationType);
    });
  });

  /* ====== Data Source ======= */
  $(".sliderx_creation").hide();
  $(".sliderx_postData_wrapper").hide();

  function sliderX_dataSource(dataSourceVal) {
      if (dataSourceVal === "custom") {
        $(".sliderx_creation").show();
        $(".sliderx_postData_wrapper").hide();
        $(".sliderx_accordion").show();
      } else {
        $(".sliderx_creation").hide();
        $(".sliderx_postData_wrapper").show();
        $(".sliderx_accordion").hide();
      }
  }

  // Cache the jQuery selector for the input
  const $dataSourceInputs = $('input[name="sliderx_dataSource"]');

  // Get the initial state and initialize
  const initialState = $dataSourceInputs.filter(':checked').val();
  sliderX_dataSource(initialState);

  // Handle change event on the checkbox input
  $(document).on('change', 'input[name="sliderx_dataSource"]', function () {
      const dataSourceVal = $(this).val();
      sliderX_dataSource(dataSourceVal);
  });
  

  // Select2 -- Config -- Selector
  const sliderxInclude = $(".sliderx_include");
  const sliderxExclude = $(".sliderx_exclude");
  const sliderxTaxonomy = $(".sliderx_taxonomy");
  const sliderxPostType_terms = $(".sliderx_postType_terms");
  // Includes
  sliderxInclude.each(function() {
    $(this).select2({
      theme: "classic",
      width: 'resolve',
      multiple: true,
      placeholder: 'Choose Include Items'
    });
  });
  // Excludes
  sliderxExclude.each(function () {
    $(this).select2({
      theme: "classic",
      width: 'resolve',
      multiple: true,
      placeholder: 'Choose Exclude items'
    })
  });

  // Taxonomy
  sliderxTaxonomy.each(function () {
    $(this).select2({
      theme: "classic",
      width: 'resolve',
      multiple: false,
      placeholder: 'Choose Taxonomy'
    })
  });

  // Taxonomy Terms
  sliderxPostType_terms.each(function () {
    $(this).select2({
      theme: "classic",
      width: 'resolve',
      multiple: true,
      placeholder: 'Choose Terms'
    })
  });

  // Event listener for changing post type
  $(document).on('change', '.sliderx_postType', function (e) {
    e.preventDefault();
    let postTypeVal = $(this).val() || "post";
    sliderx_includes(postTypeVal);
    sliderx_excludes(postTypeVal);
    sliderx_productType(postTypeVal);
    sliderx_postTypeTaxonomy(postTypeVal);
  });

  // Initial function calls for post type
  let postTypeVal = $(".sliderx_postType :selected").val() || "post";


  sliderx_includes(postTypeVal);
  sliderx_excludes(postTypeVal);
  sliderx_productType(postTypeVal);
  sliderx_postTypeTaxonomy(postTypeVal);

  // Event listener for changing Taxonomy
  $(document).on('change', '.sliderx_taxonomy', function (e) {
      e.preventDefault();
      let taxonomyVal = $(this).val() || "category";
      sliderx_categoryByTaxonomy(taxonomyVal);
  });

  // Initial function call for taxonomy
  const taxonomyVal = $(".sliderx_taxonomy :selected").val() || "category";
  sliderx_categoryByTaxonomy(taxonomyVal);

 
    // Initial setup based on the selected value of '.sliderx_include'
    let includeVal = $(".sliderx_include").val();
    excludeControl(includeVal);
  
    // Event listener for change on '.sliderx_include'
    $(document).on('change', '.sliderx_include', function () {
        let includeVal = $(this).val();
        excludeControl(includeVal);
    });

    // Function to control disabled and visibility
    function excludeControl(includeVal) {
        // Find all elements with class '.sliderx_exclude'
        let allExcludes = $(".sliderx_exclude");
        let allExcludesContainer = allExcludes.next(".select2-container");

        if (includeVal && includeVal.length > 0) {
            // Disable all elements with class '.sliderx_exclude'
            allExcludes.prop('disabled', true);
            allExcludesContainer.css("display", "none");
        } else {
            // Enable and show all elements with class '.sliderx_exclude'
            allExcludes.prop('disabled', false);
            allExcludesContainer.css("display", "block");
        }
    }


    // Includes
    function sliderx_includes(postTypeVal) {
      let sliderx_include = $(".sliderx_include");
      let sliderxUpdateId = $("#sliderx_updateId").val();

      let allExcludes = $(".sliderx_exclude");
      let allExcludesContainer = allExcludes.next(".select2-container");

      $.ajax({
        url: includeObj.ajaxUrl,
        method: 'POST',
        data: {
            action: 'postTypeInclude_action',
            nonce: includeObj.nonce,
            sliderId: typeof sliderxUpdateId !== 'undefined' ? sliderxUpdateId : '',
            postType: postTypeVal
        },
        success: function (response) {
            // Clear previous options in Choices.js
            sliderx_include.empty();
            // Check if response data and postData exist
            if (response.data && Array.isArray(response.data.postData)) {
                const postData = response.data.postData;
                const dbPostData = response.data.dbPostData;
                if (dbPostData.length > 0) {
                    allExcludes.prop('disabled', true);
                    allExcludesContainer.css("display", "none");
                } else {
                    // Enable and show all elements with class '.sliderx_exclude'
                    allExcludes.prop('disabled', false);
                    allExcludesContainer.css("display", "block");
                }
              
                postData.forEach(element => {
                  let isSelected = dbPostData.includes(element.ID);
                  // Append option for each taxonomy to sliderxTaxonomy
                  sliderxInclude.append('<option value="' + element.ID + '" ' + ( isSelected ? 'selected' : '') + '>' + element.post_title + '</option>');
                });
            } else {
                console.error('No post data found');
            }
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error('Error fetching data:', error);
        }
      });
    }
    // Excludes
    function sliderx_excludes(postTypeVal) {
      let sliderx_exclude = $(".sliderx_exclude");
      let sliderxUpdateId = $("#sliderx_updateId").val();


      $.ajax({
        url: excludeObj.ajaxUrl,
        method: 'POST',
        data: {
            action: 'postTypeExclude_action',
            nonce: excludeObj.nonce,
            sliderId: typeof sliderxUpdateId !== 'undefined' ? sliderxUpdateId : '',
            postType: postTypeVal
        },
        success: function (response) {
        // Clear previous options in Choices.js
        sliderx_exclude.empty();
        if (response.data && Array.isArray(response.data.postData)) {
            const postData = response.data.postData;
            const dbPostData = response.data.dbPostData;
            postData.forEach(element => {
              let isSelected = dbPostData.includes(element.ID);
              // Append option for each taxonomy to sliderxTaxonomy
              sliderx_exclude.append('<option value="' + element.ID + '" ' + ( isSelected ? 'selected' : '') + '>' + element.post_title + '</option>');
            });
        } else {
            console.error('No post data found');
        }

        },
        error: function (xhr, status, error) {
            // Handle error
            console.error('Error fetching data:', error);
        }
      });
    }

    // Get Taxonomy Name By PostType
    function sliderx_postTypeTaxonomy(postTypeVal) {

      // console.log(postTypeVal);

      let sliderxTaxonomy = $(".sliderx_taxonomy");
      let sliderxUpdateId = $("#sliderx_updateId").val();

      $.ajax({
          url: taxonomyObj.ajaxUrl,
          method: 'POST',
          data: {
              action: 'postTypeTaxonomy_action',
              nonce: taxonomyObj.nonce,
              sliderId: sliderxUpdateId ?? '',
              postType: postTypeVal,
          },
          success: function (response) {
              // Clear previous options in the sliderxTaxonomy container
              sliderxTaxonomy.empty();
              // Check if response data and taxonomyData exist and is an object
              if (response.data && typeof response.data.taxonomyData === 'object') {
                const taxonomyData = response.data.taxonomyData;
                const dbTaxonomyName = response.data.dbTaxonomy;
                  // Iterate over each taxonomy object in taxonomyData
                  Object.keys(taxonomyData).forEach(function(taxonomyKey) {
                      const taxonomy = taxonomyData[taxonomyKey];
                      // Append option for each taxonomy to sliderxTaxonomy
                      sliderxTaxonomy.append('<option value="' + taxonomy.name + '" ' + (taxonomy.name === dbTaxonomyName ? 'selected' : '') + '>' + taxonomy.label + '</option>');
                  });
              } else {
                  console.error('Invalid taxonomy data format:', response.data.taxonomyData);
              }
          },
          error: function (xhr, status, error) {
              // Handle error
              console.error('Error fetching data:', error);
          }
      });
    }

    // Get Taxonomy Values By Taxonomy name
    function sliderx_categoryByTaxonomy(taxonomyVal) {
      let taxonomyTerms = $(".sliderx_postType_terms");
      let sliderxUpdateId = $("#sliderx_updateId").val();
      $.ajax({
          url: taxonomyValObj.ajaxUrl,
          method: 'POST',
          data: {
              action: 'taxonomyVal_action',
              nonce: taxonomyValObj.nonce,
              sliderId: sliderxUpdateId ?? '',
              taxonomy: taxonomyVal,
          },
          success: function (response) {
              // Clear previous options in the sliderxTaxonomy container
              taxonomyTerms.empty();
              // Check if response data and taxonomyVal exist and is an array
            if (response.data && Array.isArray(response.data.taxonomyVal)) {
                  const taxonomyValues = response.data.taxonomyVal;
                  const dbTerms = response.data.dbTerms;

                  // Iterate over taxonomy values and append options
                  taxonomyValues.forEach(element => {
                      let isSelected = dbTerms.includes(element.slug);
                      taxonomyTerms.append('<option value="' + element.slug + '" ' + (isSelected ? 'selected' : '') + '>' + element.name + '</option>');
                  });
              } else {
                  console.error('Invalid taxonomy data format2:', response.data);
              }
          },
          error: function (xhr, status, error) {
              // Handle error
              console.error('Error fetching data:', xhr.responseText);
          }
      });
    }



  // Handle Taxonomy Options
  // Initial setup based on the checkbox state
  $('input[name="taxonomy"]').each(function() {
      const isChecked = $(this).is(':checked');
      sliderX_taxonomyOptions(isChecked);
  });

  // Event listener for change event on the checkboxes
  $(document).on('change', 'input[name="taxonomy"]', function () {
      const isChecked = $(this).is(':checked');
      sliderX_taxonomyOptions(isChecked);
  })

  function sliderX_taxonomyOptions(isChecked) {
    if (isChecked) {
        $(".sliderx_taxonomy_wrapper").show();
    } else {
        $(".sliderx_taxonomy_wrapper").hide();
    }
  }


  // Dependency Control
  function sliderx_productType(postTypeVal) {
    if (postTypeVal === "product") {
      $(".sliderx_productType").show();
    } else {
      $(".sliderx_productType").hide();
    }
  }
  

  /**
   * ================== Importer =================
   * ============================================= 
   */

  $("#sliderx_import_btn").on("click", function (e) {
    // Prevent the default action of the button click initially
    e.preventDefault();

    const button = $(this);
    const templateType = $('input[name="templateType"]:checked').val();
    const preLoader = $(".sliderTemplate_preloader");
    const currentURL = window.location.href;
    const lastIndex = currentURL.lastIndexOf('/');
    const baseUrl = currentURL.substring(0, lastIndex) + '/admin.php?page=sliderx';
    const buttonDismiss = button.attr("data-bs-dismiss");

    const successMsg = $(".importer_success_msg");

    // const sliderx_template_wrapper = $(".sliderx_template_settings_wrapper");

    // Update button state
    button.text("Importing...");
    button.attr("disabled", true);
    preLoader.css({"visibility": "visible"});

    // Redirect if button has modal dismiss attribute
    if (buttonDismiss !== undefined && buttonDismiss === "modal") {
        window.location.href = baseUrl;
    }

    $.ajax({
        type: 'POST',
        url: importObj.ajaxUrl,
        data: {
            action: 'demoImport_action',
            nonce: importObj.nonce,
            templateType,
        },
        success: function (response) {
            const dataStatus = response?.data?.status;
            if (response.success && dataStatus === "success") {
              preLoader.css({ "visibility": "hidden" });
              button.text("Close");
              successMsg.css({"visibility": "visible"});
              button.attr("disabled", false);
              button.attr("data-bs-dismiss", "modal");
              // sliderx_template_wrapper.html(response.data.html);
            }

        },
        error: function (error) {
            console.error('AJAX error:', error);
        },
    });
  });



  // Imported template data Re-use
  $(".template_use").on("click", function (e) {
    // Prevent the default action of the button click initially
    e.preventDefault();
    const button = $(this);
    const useTemplate = $(this).data("template");
    const preLoader = $(".sliderTemplate_preloader");
    const currentURL = window.location.href;
    const lastIndex = currentURL.lastIndexOf('/');
    const baseUrl = currentURL.substring(0, lastIndex) + '/admin.php?page=sliderx';

    const successMsg = $(".importer_success_msg");
    // Update button state
    button.text("Using...");
    button.text("Creating new one...");
    button.attr("disabled", true);
    // preLoader.css({"visibility": "visible"});

    $.ajax({
      type: 'POST',
      url: importUseObj.ajaxUrl,
      data: {
          action: 'importUse_action',
          nonce: importUseObj.nonce,
          useTemplate,
      },
      success: function (response) {
          
        const dataStatus = response?.data?.status;
        if (response.success && dataStatus === "success") {
          // Simulate saving process
          successMsg.text("Imported data has been used for new slider successfully").css({"visibility": "visible"});
            setTimeout(function () {
              let savingSuccessful = true;
              if (savingSuccessful) {
                  button.text("Used");
                  button.attr("disabled", false);
              }
              // Redirect to the URL after 1 seconds
              setTimeout(function () {
                window.location.href = baseUrl;
              }, 500);
            }, 1000);
        }

      },
      error: function (error) {
          console.error('AJAX error:', error);
      },
    });
    

  });



  //check the initially selected radio button and run the function
  const initiallyChecked = $('.sliderx_template_item input[name="templateType"]:checked');
  if (initiallyChecked.length) {
    templateImporterControl(initiallyChecked);
  }

  
  // Event handler for when a radio button with the name 'templateType' is changed
  $(document).on('change', '.sliderx_template_item input[name="templateType"]', function () {
    const templateType = $(this).val();
    templateImporterControl($(this)); 
  });
  
  function templateImporterControl(element) {

    const templateType = element.val();
    // Get the data attribute value of the .template_use element within the same .template_item_wrapper
    const useTemplateVal = element.closest('.template_item_wrapper').find(".template_use").data("template");
   
    // Get the import button element
    const importButton = $("#sliderx_import_btn");
  
    // Enable or disable the import button based on the condition
    if (templateType === useTemplateVal) {
      importButton.attr("disabled", true);
    } else {
      importButton.attr("disabled", false);
    }
  }
  



  /**
   * ============= Preview Section ===============
   * ============================================= 
   */
  $(".sliderx_prev_arrow").on('click', function () {
      const arrowIcon = $(this);
      const sectionPreview = $(".section_preview");
      const sectionPreviewWrapper = $(".sliderx_preview_wrapper");

      // Toggle the classes
      if (arrowIcon.hasClass('dashicons-arrow-up-alt2')) {
          arrowIcon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
          sectionPreview.css({"padding-bottom": 0});
          sectionPreviewWrapper.slideUp();
      } else {
          arrowIcon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
          sectionPreview.css({"padding-bottom": "20px"});
          sectionPreviewWrapper.slideDown();

      }
  });

  // Preview Switcher Button
  const section_preview = $(".section_preview");
  const previewButton = $(".sliderx_preview_button");
  const previewButtonVal = previewButton.attr("preview");

  // Hide the preview section initially
  section_preview.hide();
  // Preview Switcher Button
  previewButton.on("click", function () {
    const previewSwitcherButton = $(this);
    const previewSwitcherClass = previewSwitcherButton.find('.dashicons');
    const isHidden = previewSwitcherClass.hasClass('dashicons-visibility');
    
    // Toggle the classes and update the button text and section visibility
    previewSwitcherClass.toggleClass('dashicons-visibility dashicons-hidden');
    section_preview.toggle();
    
    // Update button text based on visibility state
    previewSwitcherButton.contents().filter(function() {
      return this.nodeType == 3; // Node type 3 is a text node
    })[0].nodeValue = isHidden ? " Hide Preview" : " Show Preview";

    // Change previewVal based on visibility state
    let previewVal = isHidden ? "yes" : "no";
    previewSwitcherButton.attr("preview", previewVal);

    let previewId = previewSwitcherButton.attr("previewId");

  });


  // Initial Preview button Status Control
  previewSwitcher(previewButtonVal);

  function previewSwitcher(previewButtonVal) {
    let sectionPreview = $(".section_preview");
    // Ensure section visibility based on initial value
    if (previewButtonVal === "yes") {
      sectionPreview.show();
    } else {
      sectionPreview.hide();
    }
  }



}); // End of jQuery




/* ================ All Callback Functions ===============
========================================================*/

// Media Callback Function
function sliderXMedia(id) {
  let frame = wp.media({
      title: 'Select or Slide Image / Media',
      button: {
          text: 'Upload Slide Image'
      },
      multiple: false  // Set to true if you want to allow multiple media selection
  });

  frame.on('select', function() {
      let attachment = frame.state().get('selection').first().toJSON();
      // Display the selected media
      jQuery(`#sliderx-uploaded-media-${id}`).html(`<img src="${attachment.url}" alt="Uploaded Media">`);
  });

  frame.open();
}



// Color Picker
var sliderx_colorPicker = Coloris({
  // The default behavior is to append the color picker's dialog to the end of the document's
  // body. but it is possible to append it to a custom parent instead. This is especially useful
  // when the color fields are in a scrollable container and you want the color picker's dialog
  // to remain anchored to them. You will need to set the CSS position of the desired container
  // to "relative" or "absolute".
  // The value of this option can be either a CSS selector or an HTMLElement/Element/Node.
  // Note: This should be a scrollable container with enough space to display the picker.
  parent: '.container',

  // A custom selector to bind the color picker to. This must point to HTML input fields.
  // This can also accept an HTMLElement or an array of HTMLElements instead of a CSS selector.
  el: '.color-field',

  // The bound input fields are wrapped in a div that adds a thumbnail showing the current color
  // and a button to open the color picker (for accessibility only). If you wish to keep your
  // fields unaltered, set this to false, in which case you will lose the color thumbnail and
  // the accessible button (not recommended).
  // Note: This only works if you specify a custom selector to bind the picker (option above),
  // it doesn't work on the default [data-coloris] attribute selector.
  wrap: true,

  // Set to true to activate basic right-to-left support.
  rtl: false,

  // Available themes: default, large, polaroid, pill (horizontal).
  // More themes might be added in the future.
  theme: 'default',

  // Set the theme to light or dark mode:
  // * light: light mode (default).
  // * dark: dark mode.
  // * auto: automatically enables dark mode when the user prefers a dark color scheme.
  themeMode: 'light',

  // The margin in pixels between the input fields and the color picker's dialog.
  margin: 2,

  // Set the preferred color string format:
  // * hex: outputs #RRGGBB or #RRGGBBAA (default).
  // * rgb: outputs rgb(R, G, B) or rgba(R, G, B, A).
  // * hsl: outputs hsl(H, S, L) or hsla(H, S, L, A).
  // * auto: guesses the format from the active input field. Defaults to hex if it fails.
  // * mixed: outputs #RRGGBB when alpha is 1; otherwise rgba(R, G, B, A).
  format: 'hex',

  // Set to true to enable format toggle buttons in the color picker dialog.
  // This will also force the format option (above) to auto.
  formatToggle: false,

  // Enable or disable alpha support.
  // When disabled, it will strip the alpha value from the existing color string in all formats.
  alpha: true,

  // Set to true to always include the alpha value in the color value even if the opacity is 100%.
  forceAlpha: false,

  // Set to true to hide all the color picker widgets (spectrum, hue, ...) except the swatches.
  swatchesOnly: false,

  // Focus the color value input when the color picker dialog is opened.
  focusInput: true,

  // Select and focus the color value input when the color picker dialog is opened.
  selectInput: false,

  // Show an optional clear button
  clearButton: true,

  // Set the label of the clear button
  clearLabel: 'Clear',

  // Show an optional close button
  closeButton: false,

  // Set the label of the close button
  closeLabel: 'Close',

  // An array of the desired color swatches to display. If omitted or the array is empty,
  // the color swatches will be disabled.
  swatches: [
    'white',
    '#264653',
    '#2a9d8f',
    '#e9c46a',
    'rgb(244,162,97)',
    '#e76f51',
    '#d62828',
    'navy',
    '#07b',
    '#0096c7',
    '#00b4d880',
    'rgba(0,119,182,0.8)'
  ],

  // Set to true to use the color picker as an inline widget. In this mode the color picker is
  // always visible and positioned statically within its container, which is by default the body
  // of the document. Use the "parent" option to set a custom container.
  // Note: In this mode, the best way to get the picked color, is listening to the "coloris:pick"
  // event and reading the value from the event detail (See example in the Events section). The
  // other way is to read the value of the input field with the id "clr-color-value".
  inline: false,

  // In inline mode, this is the default color that is set when the picker is initialized.
  defaultColor: '#000000',

  // A function that is called whenever a new color is picked. This defaults to an empty function,
  // but can be set to a custom one. The selected color and the current input field are passed to
  // the function as arguments.
  // Use in instances (described below) to perform a custom action for each instance. 
  onChange: (color, input) => undefined
});













