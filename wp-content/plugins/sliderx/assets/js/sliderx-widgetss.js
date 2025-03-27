"use strict";

document.addEventListener('DOMContentLoaded', function () { 


  console.log("widget script loaded");
  

  // Function to apply animations

  function applyAnimations(slide) {
    // Remove any existing animation classes
    slide.querySelectorAll('.animate__animated').forEach(el => {
      el.classList.remove('animate__animated');
      el.style.animationDelay = ''; // Reset delay
      el.style.animationDuration = ''; // Reset duration
    });

    // Add animation classes and set delay and duration based on data-animation, data-delay, and data-duration attributes
    slide.querySelectorAll('[data-animation]').forEach(el => {
      const animation = el.getAttribute('data-animation');
      const delay = el.getAttribute('data-delay');
      const duration = el.getAttribute('data-duration');

      if (animation) {
        el.classList.add('animate__animated', `animate__${animation}`);
        if (delay) {
          el.style.animationDelay = delay;
        }
        if (duration) {
          el.style.animationDuration = duration;
        }
      }
    });
  };

  // Function to initialize the Swiper for each settings object
  function WidgetSliderxHandler_free($scope) {
    const settingsData = configObj.settings || [];

    console.log(settingsData);
    

    settingsData.forEach((settingsObj) => {
      const general = JSON.parse(settingsObj.general);
      const content = JSON.parse(settingsObj.content);
      const navigation = JSON.parse(settingsObj.navigation);
      const pagination = JSON.parse(settingsObj.pagination);

      const animationType = (typeof general.animationType === 'string' && general.animationType !== "Select Effect") ? general.animationType : "slide";
      const sliderType = settingsObj.sliderType;

      const sliderXConfig = {
        slidesPerView: 1,
        slidesPerColumn: 2,
        effect: animationType,
        lazy: true,
        slidesPerView: 'auto',
        speed: 600,
        parallax: true,
        zoom: true,
        on: {
          init: function () {
            const initialSlide = document.querySelector('.swiper-slide.swiper-slide-active');
            if (initialSlide) {
              applyAnimations(initialSlide);
            }
          },
          slideChange: function () {
            setTimeout(() => {
              const previousSlide = document.querySelector('.swiper-slide.swiper-slide-prev');
              const currentSlide = document.querySelector('.swiper-slide.swiper-slide-active');

              if (previousSlide) {
                previousSlide.querySelectorAll('.animate__animated').forEach(el => {
                  el.classList.remove('animate__animated');
                  el.style.animationDelay = '';
                  el.style.animationDuration = '';
                });
              }
              if (currentSlide) {
                applyAnimations(currentSlide);
              }
            }, 300);
          }
        }
      };

      // Adjust settings based on animation type and slider type
      if (animationType === "coverflow") {
        sliderXConfig.coverflowEffect = {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        };
        sliderXConfig.centeredSlides = true;
      }

      if (animationType === "cube") {
        sliderXConfig.grabCursor = true;
        sliderXConfig.cubeEffect = {
          shadow: true,
          slideShadows: true,
          shadowOffset: 20,
          shadowScale: 0.94,
        };
      }

      if (sliderType === "carousel" || sliderType === 'centermode' || sliderType === 'carowave') {
        sliderXConfig.spaceBetween = 20;
        sliderXConfig.breakpoints = {
          480: { slidesPerView: 1, spaceBetween: 20 },
          640: { slidesPerView: 2, spaceBetween: 20 },
          768: { slidesPerView: 3, spaceBetween: 20 },
          1024: { slidesPerView: 3, spaceBetween: 20 },
          1920: { slidesPerView: 4, spaceBetween: 20 },
        };
      }

      const thumbnailSelector = `#sliderX_thumbnail-${settingsObj.sliderId}`;
      const thumbSwiper = new Swiper(thumbnailSelector, {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
      });

      if (sliderType === "thumbnail") {
        sliderXConfig.thumbs = { swiper: thumbSwiper };
      }

      const layoutDir = general.layoutDir;
      const autoPlayVal = general.autoPlay === "true";
      const autoPlayProp = general.autoPlayProp;
      const autoPlayDelay = Number(autoPlayProp.autoPlayDelay);
      const pauseOnHover = autoPlayProp.pauseOnHover === "true";
      const disableOnInteraction = autoPlayProp.disableOnInteraction === "true";

      if (layoutDir === "vertical" && (sliderType === "featured" || sliderType === "slider")) {
        sliderXConfig.direction = "vertical";

        const nextButton = document.querySelector('.swiper-button-next');
        const prevButton = document.querySelector('.swiper-button-prev');

        if (nextButton) {
          nextButton.style.right = '20px';
          nextButton.style.transform = 'rotate(90deg)';
        }

        if (prevButton) {
          prevButton.style.left = '20px';
          prevButton.style.transform = 'rotate(90deg)';
        }
      } else {
        sliderXConfig.direction = "horizontal";
      }

      if (autoPlayVal) {
        sliderXConfig.autoplay = {
          delay: autoPlayDelay,
          pauseOnMouseEnter: pauseOnHover,
          disableOnInteraction: disableOnInteraction,
        };
      }

      sliderXConfig.loop = general.loop === "false" ? false : Boolean(general.loop);
      const KeyboardControlVal = general.KeyboardControl === "true";
      if (KeyboardControlVal) {
        sliderXConfig.keyboard = { enabled: true };
      }
      sliderXConfig.mousewheel = general.mouseWheel === "false" ? false : Boolean(general.mouseWheel);
      sliderXConfig.centeredSlides = general.centeredSlide === "false" ? false : Boolean(general.centeredSlide);

      const navigationVal = navigation.navigation === "true";
      if (navigationVal) {
        sliderXConfig.navigation = {
          nextEl: ".swiper-button-prev",
          prevEl: ".swiper-button-next",
        };
      }

      const paginationVal = pagination.paginationVal === "true";
      const paginationType = pagination.paginationType || 'bullets';
      if (paginationVal) {
        sliderXConfig.pagination = {
          el: ".swiper-pagination",
          type: paginationType,
          clickable: true,
          dynamicBullets: paginationType === "bullets",
        };
      }

      const sliderSelector = `#sliderX-${settingsObj.sliderId}`;
      const swiper = new Swiper(sliderSelector, sliderXConfig);
    });
  }

  // Initialize the widget under Elementor
  window.addEventListener('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/sliderx-widget.default', WidgetSliderxHandler_free);
  });


});











